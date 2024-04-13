<?php
/**
 * セキュリティチェック
 *
 * このコードは、functions.php ファイルが WordPress の環境外から
 * 直接アクセスされた場合に、スクリプトの実行を防ぎます。
 */
defined( 'ABSPATH' ) || exit;

// 分割したファイルパスを配列に追加
$function_files = [
    '/app/app.php',//全てのファイルをインポート
    '/config/config.php',//設定
    '/bootstrap/bootstrap.php',//起動
];

foreach ($function_files as $file) {
    if ((file_exists(__DIR__ . $file))) { // ファイルが存在する場合
        // ファイルを読み込む
        require_once __DIR__ . $file;
    } else { // ファイルが見つからない場合
        // エラーメッセージを表示
        trigger_error("`$file`ファイルが見つかりません", E_USER_ERROR);
    }
}