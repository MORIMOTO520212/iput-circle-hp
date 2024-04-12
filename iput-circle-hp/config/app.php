<?php
/**
 * 管理者以外はアドミンバーを非表示
 */
show_admin_bar(false);

/**
 * CORS設定
 */
add_action('send_headers', 'cors_http_header');
function cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}

/**
 * WordPress標準の絵文字生成機能のアクションフックを解除
 * 理由：Trix Editorと干渉して絵文字を入力すると画像として張り付けてしまう。
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );
?>