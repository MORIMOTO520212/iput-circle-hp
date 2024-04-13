<?php
//ファイル読み込み
// 分割したファイルパスを配列に追加
$function_files = [
  '/Api/Activity/activity.php', //活動記録の処理
  '/Api/Circle/circle.php',     //サークルページの処理
  '/Api/News/news.php',         //ニュース記事の処理
  '/Api/User/user.php',         //ユーザーの処理（ログインとかサインインとか）
  '/Api/UseCases/use-cases.php',//各ページで共通で使える処理
  '/Dashboard/dashboard.php',   //管理画面に関連の処理
  '/Http/http.php',             //POSTリクエスト振り分け
  '/UseCases/use-cases.php',   //全体で共通で使える処理
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

