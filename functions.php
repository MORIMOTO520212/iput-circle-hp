<?php

/* 管理者以外はアドミンバーを非表示 */
show_admin_bar(false);

/* 投稿時スラッグ自動生成 */
// 投稿ページのみ生成する
function custom_auto_post_slug($slug, $post_ID, $post_status, $post_type) {
    if($post_type == 'post' or $post_type == 'circle'){
        $slug = md5(time()); // UNIX時間をmd5でハッシュ化したものをスラッグ名に使う
        return $slug;
    }
    return $slug;
}
add_filter('wp_unique_post_slug', 'custom_auto_post_slug', 10, 4);

/* カスタム投稿タイプ サークル */
function post_type_circle() {
    register_post_type('circle', // 投稿タイプ名
    array(
        'labels' => array(
            'name'          => 'サークル',
            'singular_name' => 'circle'
        ),
        'public' => true,
        'menu_position' => 5,
    )
    );
}
add_action('init', 'post_type_circle');


/* WP-Members Membership カスタマイズ */
// reference:https://syuntech.net/wordpress/wp-members_fooklist/

// 登録後のリダイレクト先
function the_reg_redirect() {
    wp_redirect(home_url('/index.php/verification'));
    exit();
}
add_action('wpmem_register_redirect','the_reg_redirect' );

// ログイン後のリダイレクト先
function my_login_redirect($redirect_to, $user_id) {
    return home_url('/');
}
add_filter('wpmem_login_redirect', 'my_login_redirect', 10, 2);

// ログインフォーム div設置
function my_login_form_row_wrapper($args, $action) {
    $args['row_before'] = '<div class="my-row-wrapper">';
    $args['row_after']  = '</div>';
    return $args;
}
add_filter('wpmem_login_form_args', 'my_login_form_row_wrapper', 10, 2);

// 登録フォーム div設置
function my_register_form_row_wrapper($args, $tag) {
    $args = array(
        'row_before' => '<div class="my-row-wrapper">',
        'row_after'  => '</div>',
    );
  
    return $args;
}
add_filter('wpmem_register_form_args', 'my_register_form_row_wrapper', 10, 2);


// ログインフォームの編集
function my_login_inputs( $default_inputs ) {
    // user name
    $default_inputs[0]['name'] = 'ユーザ名またはメールアドレス';
    $default_inputs[0]['class'] = 'form-control';
    // password
    $default_inputs[1]['name'] = 'パスワード';
    $default_inputs[1]['class'] = 'form-control';
    return $default_inputs;
}
add_filter( 'wpmem_inc_login_inputs', 'my_login_inputs' );

// ログイン失敗時のテキストの編集
function my_login_failed_args() {
    /**
     * This example changes the login error message, removing the
     * heading tags and text, changing the message. Note the 
     * tags that are not being changed need not be included.
     */
    $args = array( 
        'div_before'     => '<div align="center" id="wpmem_msg">',
        'div_after'      => '</div>', 
        'heading_before' => '<h3>',
        'heading'        => __( 'Login Failed!', 'wp-members' ),
        'heading_after'  => '</h3>',
        'p_before'       => '<p>',
        'message'        => __( 'You entered an invalid username or password.', 'wp-members' ),
        'p_after'        => '</p>',
    );
 
    return $args;
}
add_filter( 'wpmem_login_failed_args', 'my_login_failed_args' );