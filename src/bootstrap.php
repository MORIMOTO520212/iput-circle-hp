<?php

/**
 * spl_autoload_register で src/ 以下のクラスを自動ロード
 */
spl_autoload_register(function ($class_name) {
    $base_dir = __DIR__ . '/';
    $file_map = array(
        // Models
        'UserModel'          => 'models/UserModel.php',
        'ImageModel'         => 'models/ImageModel.php',
        'CircleModel'        => 'models/CircleModel.php',
        'ActivityModel'      => 'models/ActivityModel.php',
        'NewsModel'          => 'models/NewsModel.php',
        // Services
        'MailService'        => 'services/MailService.php',
        'DiscordService'     => 'services/DiscordService.php',
        'ValidationService'  => 'services/ValidationService.php',
        // Controllers
        'AuthController'     => 'controllers/AuthController.php',
        'CircleController'   => 'controllers/CircleController.php',
        'ActivityController' => 'controllers/ActivityController.php',
        'NewsController'     => 'controllers/NewsController.php',
        'DiscordController'  => 'controllers/DiscordController.php',
        // Hooks
        'PostTypeHook'       => 'hooks/PostTypeHook.php',
        'AdminHook'          => 'hooks/AdminHook.php',
        'RequestHook'        => 'hooks/RequestHook.php',
        // Router
        'ApiRouter'          => 'ApiRouter.php',
    );

    if (isset($file_map[$class_name])) {
        require_once $base_dir . $file_map[$class_name];
    }
});

/**
 * ヘルパー・ラッパー関数をロード（グローバル関数定義）
 * ※オートローダーは class のみ対象のため、グローバル関数を含むファイルは明示的にロードする
 */
require_once __DIR__ . '/helpers/FunctionsHelper.php';
require_once __DIR__ . '/helpers/ViewHelper.php';
require_once __DIR__ . '/helpers/UrlHelper.php';
require_once __DIR__ . '/helpers/TrixHelper.php';
require_once __DIR__ . '/models/ImageModel.php';
require_once __DIR__ . '/services/MailService.php';
require_once __DIR__ . '/services/DiscordService.php';

/* * * * グローバル変数の初期化 * * * */

// アップロード可能な画像の最大ファイルサイズ（byte）
$max_file_size = 5242880; // 5MB
// 圧縮するファイルサイズ閾値（byte）
$compression_file_size_threshold = 1048576; // 1MB
$upload_post_name = "";

/* 各ページリンクのグローバル変数 */
global $page_url;
init_page_url();

/* 投稿カテゴリーの存在チェック */
check_post_categories();

/* nonceのaction用のランダム値をCookieに保存 */
if (isset($_COOKIE['wp_nonce_action']) !== false) {
    $experied = time() + 1 * 24 * 3600; // 1日
    setcookie('wp_nonce_action', bin2hex(random_bytes(10)), $experied);
}

/* 管理者以外はアドミンバーを非表示 */
show_admin_bar(false);

/* CORS設定 */
add_action('send_headers', function () {
    header("Access-Control-Allow-Origin: *");
});

/* WordPress標準の絵文字生成機能のアクションフックを解除（Trix Editor との干渉対策） */
remove_action('wp_head',         'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles',           10);

/**
 * Hook の登録
 */
(new PostTypeHook())->register();
(new AdminHook())->register();
(new RequestHook())->register();
(new ApiRouter())->register();
