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

/**
 * Bootstrap モーダル テンプレート関数
 * 引数
 * $title - モーダルのタイトル
 * $message - モーダルの本文
 */
function modal($title, $message) {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header alert alert-warning">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $title; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $message; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">わかりました</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = () => {
            var elem = $('#myModal');
            var options = "keyboard";
            elem.removeClass('display'); // display:none解除
            var myModal = new bootstrap.Modal(elem, options);
            myModal.show();
        }
    </script>
<?php
}

/**
 * アカウント作成
 */
function user_signup() {
    $user_name  = isset( $_POST['username'] ) ? sanitize_text_field( $_POST['username'] ) : '';
    $user_pass  = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';
    $user_email = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
    $user_first_name = isset( $_POST['firstname'] ) ? sanitize_text_field( $_POST['firstname'] ) : '';
    $user_last_name = isset( $_POST['lastname'] ) ? sanitize_text_field( $_POST['lastname'] ) : '';

    //すでにユーザー名が使われていないかチェック
    if ( username_exists( $user_name ) !== false ) {
        modal('登録できません', 'すでにユーザー名「'. $user_name .'」は登録されています。');
    }
    //すでにメールアドレスが使われていないかチェック
    elseif ( email_exists( $user_email ) !== false ) {
        modal('登録できません', 'すでにメールアドレス「'. $user_email .'」は登録されています。');
    }
    //メールの文字列確認
    // ドメイン - 大文字小文字区別なしの数字以外
    elseif ( !(preg_match("/^([a-z0-9+_-]+)(.[a-z0-9+_-]+)*@([a-z0-9-]+.)+[a-z]{2,6}$/iD", $user_email)) ) {
        modal('登録できません', '正しいメールアドレスを入力してください。');
    }
    // パスワードの確認
    // 8-16文字かつ大文字と小文字と数字を含む
    elseif ( !(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,16}$/", $user_pass)) ) {
        modal('登録できません', '大文字、小文字、数字を組み合わせて 8 文字以上で入力してください。');
    }
    //問題がなければユーザーを登録する処理を開始
    else {
        $userdata = array(
            'user_login' => $user_name,       //  ログイン名
            'user_pass'  => $user_pass,       //  パスワード
            'user_email' => $user_email,      //  メールアドレス
            'first_name' => $user_first_name,   // 名
            'last_name' => $user_last_name      // 姓
        );
        $user_id = wp_insert_user( $userdata );

        // ユーザーの作成に失敗
        if ( is_wp_error( $user_id ) ) {
            echo $user_id -> get_error_code(); // WP_Error() の第一引数
            echo $user_id -> get_error_message(); // WP_Error() の第二引数
            modal('ユーザーの作成に失敗しました', "${$user_id->get_error_code()}<br>${$user_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
        }
        // 登録完了後、そのままログインさせる（ 任意 ）
        else {
            wp_set_auth_cookie( $user_id, false, is_ssl() );

            // リダイレクト
            wp_redirect( home_url('/') );
            exit;
            return;
        }
    }
}


/**
 * after_setup_theme に処理をフック
 */
add_action('after_setup_theme', function() {
    //アカウント作成フォームからの送信か
    if ( isset( $_POST['signup'] ) && $_POST['signup'] === 'signup') {
        // nonceチェック
        if ( !isset( $_POST['signup_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['signup_nonce'], 'signup_nonce_action' ) ) return;
        user_signup();
    }
});