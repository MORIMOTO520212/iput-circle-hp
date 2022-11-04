<?php

/**
 * 管理者以外はアドミンバーを非表示
 */
show_admin_bar(false);

/**
 * 投稿時スラッグ自動生成
 * 投稿ページのみ生成する
 */
function custom_auto_post_slug($slug, $post_ID, $post_status, $post_type) {
    if($post_type == 'post' or $post_type == 'circle'){
        $slug = md5(time()); // UNIX時間をmd5でハッシュ化したものをスラッグ名に使う
        return $slug;
    }
    return $slug;
}
add_filter('wp_unique_post_slug', 'custom_auto_post_slug', 10, 4);

/**
 * カスタム投稿タイプ サークル
 */
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


/**
 * フォーム　メディアアップロード時の処理関数
 * フォームからメディアが送られてきた場合、WordPress側のメディアにアップロードする処理を行う。
*/
function media_verify($nonce, $post_id) {
    return "media_verify($nonce, $post_id)";
}

/**
 * Bootstrap モーダル テンプレート関数
 * modal(モーダルのタイトル, モーダルの本文)
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
 * ログインページ
*/
function user_login() {
    $user_login    = isset( $_POST['login'] )    ? sanitize_text_field( $_POST['login'] )    : '';
    $user_password = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';

    if ( $user_login === '' )    return;
    if ( $user_password === '' ) return;

    $creds = array();
    $creds += array( 'user_login'    => $user_login    );
    $creds += array( 'user_password' => $user_password );
    if( isset( $_POST['keep_loggedin'] ) ) {
        $creds += array( 'remember', true );
    }
    var_dump( $creds );

    // ログイン処理
    $user = wp_signon($creds);
    if( is_wp_error($user) ) {
        modal( 'ログインに失敗しました', $user->get_error_message() );
        return;
    }

    // マイページへリダイレクト
    echo "ログイン成功";
    wp_redirect( home_url( "index.php/author/{$user_login}" ) );
    exit;
    return 1;
}

/**
 * サインアップページ アカウント作成
 */
function user_signup() {
    $user_name       = isset( $_POST['username'] )  ? sanitize_text_field( $_POST['username'] )  : '';
    $user_pass       = isset( $_POST['password'] )  ? sanitize_text_field( $_POST['password'] )  : '';
    $user_email      = isset( $_POST['email'] )     ? sanitize_text_field( $_POST['email'] )     : '';
    $user_first_name = isset( $_POST['firstname'] ) ? sanitize_text_field( $_POST['firstname'] ) : '';
    $user_last_name  = isset( $_POST['lastname'] )  ? sanitize_text_field( $_POST['lastname'] )  : '';

    //すでにユーザー名が使われていないかチェック
    if ( username_exists( $user_name ) !== false ) {
        modal('登録できません', 'すでにユーザー名「'. $user_name .'」は登録されています。<br>他の名前を入力してください。');
        return;
    }
    // メールチェック
    if ( email_exists( $user_email ) !== false ) {
        modal('登録できません', 'すでにメールアドレス「'. $user_email .'」は登録されています。');
        return;
    }
    //メールの文字列確認
    // ユーザー名 - 半角英数字+プラス記号+マイナス記号+アンダーパス2~16文字
    // ドメイン名 - tokyo.iput.ac.jpまたはtks.iput.ac.jp
    if ( !(preg_match("/^[a-z0-9+_-]{2,16}@(tokyo|tks).iput.ac.jp$/iD", $user_email)) ) {
        modal('登録できません', '正しいメールアドレスを入力してください。使用できるドメインはtokyo.iput.ac.jpまたはtks.iput.ac.jpです。');
        return;
    }
    // パスワードの確認
    // 半角英数字+記号を6文字以上16文字以下
    if ( !(preg_match("/^[ -~]{6,16}$/iD", $user_pass)) ) {
        modal('パスワードの入力', 'パスワードは半角英数字+記号6～16文字以内で入力してください。');
        return;
    }
    if ( !(preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $user_first_name)) ) {
        modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
        return;
    }
    if ( !(preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $user_last_name)) ) {
        modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
        return;
    }

    // 問題がなければユーザーを登録する処理を開始
    $userdata = array(
        'user_login'   => $user_name,       //  ログイン名
        'user_pass'    => $user_pass,       //  パスワード
        'user_email'   => $user_email,      //  メールアドレス
        'first_name'   => $user_first_name, //  名
        'last_name'    => $user_last_name,  //  姓
        'display_name' => $user_name,       //  ブログ上の表示名
    );

    // ユーザー作成処理
    $user_id = wp_insert_user( $userdata );
    if ( is_wp_error( $user_id ) ) {
        modal('ユーザーの作成に失敗しました', "${$user_id->get_error_code()}<br>${$user_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
        return;
    }

    // 登録完了後、そのままログインさせる（ 任意 ）
    wp_set_auth_cookie( $user_id, false, is_ssl() );
    wp_redirect( home_url('/') );
    exit;
    return 1;
}

/**
 * 基本情報ページ　ユーザープロフィール更新
*/
function profile_update() {
    $user_id       = isset( $_POST['userid'] )      ? sanitize_text_field( $_POST['userid'] )      : null;
    $display_name  = isset( $_POST['displayname'] ) ? sanitize_text_field( $_POST['displayname'] ) : null;
    $user_pass     = isset( $_POST['password'] )    ? sanitize_text_field( $_POST['password'] )    : null;
    $first_name    = isset( $_POST['firstname'] )   ? sanitize_text_field( $_POST['firstname'] )   : null;
    $last_name     = isset( $_POST['lastname'] )    ? sanitize_text_field( $_POST['lastname'] )    : null;
    // userdata初期化
    $userdata = array(
        'ID' => $user_id // ユーザーID
    );

    // user id チェック
    if ( $user_id == null ) {
        modal('更新できませんでした', 'もう一度試してください。E01');
        return;
    }
    // 表示名チェック
    if ( $display_name ) {
        // 半角英数字+アンダースコア4～12文字で入力されているか
        if ( preg_match("/^[a-z0-9_]{4,12}$/iD", $display_name) ) {
            $userdata += array('display_name' => $display_name);
        } else {
            modal('表示名の入力', '表示名は半角英数字+アンダースコア4～12文字で入力してください。');
            return;
        }
    }
    // パスワードチェック
    if ( $user_pass ) {
        // 半角英数字+記号を6文字以上16文字以下で入力されているか
        if ( preg_match("/^[ -~]{6,16}$/iD", $user_pass) ) {
            $userdata += array('user_pass' => $user_pass);
        } else {
            modal('パスワードの入力', 'パスワードは半角英数字+記号6～16文字以内で入力してください。');
            return;
        }
    }
    // 名チェック
    if ( $first_name ) {
        if ( preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $first_name) ) {
            $userdata += array('first_name' => $first_name);
        } else {
            modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
            return;
        }
    }
    // 姓チェック
    if ( $last_name ) {
        if ( preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $last_name) ) {
            $userdata += array('last_name' => $last_name);
        } else {
            modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
            return;
        }
    }

    // ユーザー情報を更新
    $user_id = wp_update_user( $userdata );

    // ユーザーの作成に失敗
    if ( is_wp_error( $user_id ) ) {
        echo $user_id -> get_error_code(); // WP_Error() の第一引数
        echo $user_id -> get_error_message(); // WP_Error() の第二引数
        modal('ユーザーの更新に失敗しました', "${$user_id->get_error_code()}<br>${$user_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
    } else {
        modal('更新が完了しました', 'ユーザープロフィールの更新が正常に完了しました。');
    }
    return 1;
}


/**
 * after_setup_theme に処理をフック
 */
add_action('after_setup_theme', function() {
    /* フォームの判定 */
    if ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'login' ) {
        if ( !isset( $_POST['login_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['login_nonce'], 'login_nonce_action' ) ) return;
        user_login();
    }
    // サインアップページ
    elseif ( isset( $_POST['signup'] ) && $_POST['signup'] === 'signup') {
        if ( !isset( $_POST['signup_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['signup_nonce'], 'signup_nonce_action' ) ) return; // wp nonceチェック
        user_signup();
    }
    // 基本情報ページ
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'profile' ) {
        if ( !isset( $_POST['profile_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['profile_nonce'], 'profile_nonce_action' ) ) return;
        profile_update();
    }
});