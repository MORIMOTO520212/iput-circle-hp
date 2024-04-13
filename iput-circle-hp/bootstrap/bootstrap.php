<?php
// wp_create_category()
require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
// wpmu_signup_user(), wpmu_signup_user_notification()
//require_once( ABSPATH . 'wp-includes/ms-functions.php' );


//////////////////////////////////////////
//変数の初期化=>config/config.php

//////////////////////////////////////////
//初期設定
/* * * * 初期設定 * * * */
// 投稿カテゴリーの存在チェック（activity, news）
// なければ作成する.
function check_post_categories() {
    $cat_id = get_cat_ID('activity');
    if($cat_id != 0 || !$cat_id) {
        require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
        wp_create_category('activity');
    }
    $cat_id = get_cat_ID('news');
    if($cat_id != 0 || !$cat_id) {
        require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
        wp_create_category('news');
    }
}
check_post_categories();


// nonceのaction用のランダム値をCookieに保存しておく.
// ソースコードから推測されないようにするため.
if( isset( $_COOKIE['wp_nonce_action'] ) !== false ) {
    $experied = time() + 1 * 24 * 3600; // 1日
    setcookie('wp_nonce_action', bin2hex(random_bytes(10)), $experied);
}

/**
 * 管理者以外はアドミンバーを非表示
 */
show_admin_bar(false);

/**
 * CORS設定
 */
function cors_http_header(){
  header("Access-Control-Allow-Origin: *");
}
add_action('send_headers', 'cors_http_header');



/////////////////////////////
//  WordPressのフックの登録 //
/////////////////////////////

////////////////////////////////////////
//ワードプレス全体

//カスタム投稿タイプ サークル
add_action('init', 'post_type_circle');

/**
 * WordPress標準の絵文字生成機能のアクションフックを解除
 * 理由：Trix Editorと干渉して絵文字を入力すると画像として張り付けてしまう。
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );

//画像アップロード
add_action( 'wp_handle_upload', 'otocon_resize_at_upload' );                  //画像アップロード時の圧縮
/**
 * リサイズ画像を生成しない
*/
function not_create_image( $new_sizes, $image_meta ) {
  unset( $new_sizes['thumbnail']    );
  unset( $new_sizes['medium']       );
  unset( $new_sizes['medium_large'] );
  unset( $new_sizes['large']        );
  unset( $new_sizes['1536x1536']    );
  unset( $new_sizes['2048x2048']    );
  return $new_sizes;
}
add_filter('intermediate_image_sizes_advanced', 'not_create_image', 10, 2);   //リサイズ画像を生成しない

////////////////////////////////////////
//管理画面側

add_action( 'admin_menu', 'set_custom_fields' );  //カスタム投稿タイプ　カスタムフィールドを設置
add_action( 'save_post', 'save_custom_fields' );  //カスタムフィールドの値の保存
