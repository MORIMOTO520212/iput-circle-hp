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
    if($post_type == 'post'){
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
 * カスタム投稿タイプ　カスタムフィールドを設置
*/
function set_custom_fields() {
    add_meta_box(
        'cf_01',
        'サークル基本情報',
        'form_01_custom_fields', //フィールドを指定する関数
        'circle',
        'normal',
        'default'
    );
    add_meta_box(
        'cf_02',
        'サークル説明', //タイトル
        'form_02_custom_fields', //フィールドを指定する関数
        'circle',
        'normal',
        'default'
    );
    add_meta_box(
        'cf_03',
        '管理者情報', //タイトル
        'form_03_custom_fields', //フィールドを指定する関数
        'circle',
        'normal',
        'default'
    );
}
add_action( 'admin_menu', 'set_custom_fields' );

function form_01_custom_fields() {
    global $post;
    ?>
    <p>トップ画像 <input type="text" name="topImage" value="<?php echo get_post_meta($post->ID, 'topImage', true); ?>" size="30"></p>
    <p>所属人数 <input type="text" name="belongNum" value="<?php echo get_post_meta($post->ID, 'belongNum', true); ?>" size="30"></p>
    <p>活動日程 <input type="text" name="schedule" value="<?php echo get_post_meta($post->ID, 'schedule', true); ?>" size="30"></p>
    <p>活動場所 <input type="text" name="place" value="<?php echo get_post_meta($post->ID, 'place', true); ?>" size="30"></p>
    <p>サークルカテゴリ <input type="text" name="categoryRadio" value="<?php echo get_post_meta($post->ID, 'categoryRadio', true); ?>" size="30"></p>
    <p>設立日 <input type="text" name="establishmentDate" value="<?php echo get_post_meta($post->ID, 'establishmentDate', true); ?>" size="30"></p>
    <p>活動頻度 <input type="text" name="activityFrequency" value="<?php echo get_post_meta($post->ID, 'activityFrequency', true); ?>" size="30"></p>
    <p>会費 <input type="text" name="membershipFree" value="<?php echo get_post_meta($post->ID, 'membershipFree', true); ?>" size="30"></p>
    <?php
}

function form_02_custom_fields() {
    global $post;
    echo '<p>管理番号 <input type="text" name="contents_num" value="'.get_post_meta($post->ID, 'contents_num', true).'" size="30"></p>';
}

function form_03_custom_fields() {
    global $post;
    echo '<p>管理番号 <input type="text" name="contents_num" value="'.get_post_meta($post->ID, 'contents_num', true).'" size="30"></p>';
}

//カスタムフィールドの値を保存
function save_custom_fields( $post_id ) {
    update_post_meta($post_id, 'topImage', $_POST['topImage'] );
    update_post_meta($post_id, 'belongNum', $_POST['belongNum'] );
    update_post_meta($post_id, 'schedule', $_POST['schedule'] );
}
add_action( 'save_post', 'save_custom_fields' );


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
 * サークル作成ページ サークル登録処理
*/
function create_circle() {
    if ( isset(
        $_POST['circleName'        ], // サークル名
        $_POST['belongNum'         ], // 所属人数
        $_POST['schedule'          ], // 活動日程
        $_POST['place'             ], // 活動場所
        $_POST['categoryRadio'     ], // サークルカテゴリ
        $_POST['establishmentDate' ], // 設立日
        $_POST['activityFrequency' ], // 活動頻度
        $_POST['membershipFree'    ], // 会費
        $_POST['features'          ], // 特色(array)
        $_POST['activitySummary'   ], // サークル概要
        $_POST['activityDetail'    ], // 活動内容
        $_POST['contactMailAddress'], // 連絡先
        $_POST['representative'    ], // 代表者氏名
        $_POST['circle_post_nonce' ], // WordPressNonce
        ) )
    {
        // 公開ステータス
        $post_status = "publish"; // draft | publish
        if ( isset( $_GET['post_status'] ) ) {
            $post_status = $_GET['post_status'];
        }

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        // トップ画像をアップロード
        $top_img_url = "";
        if ( wp_verify_nonce( $_POST['circle_post_nonce'], 'circle_post_nonce_action' ) ) {
            $attachment_id = media_handle_upload('topImage', 0);
            // アップロードエラーチェック
            if ( is_wp_error( $attachment_id ) ) {
                modal('エラー', 'トップ画像がアップロードできませんでした。');
            } else {
                $top_img_url = wp_get_attachment_url( $attachment_id );
            }
        }
        // アルバム画像
        // ～ここへ処理～

        // 投稿処理
        $post_data = array(
            'post_title'     => $_POST['circleName'],      // 投稿のタイトル
            'post_name'      => md5(time()),               // スラッグ名（時間をmd5でハッシュ化したもの）
            'post_type'      => 'circle',                  // 投稿タイプ
            'post_status'    => $post_status,              // 公開ステータス
            'post_content'   => $_POST['activitySummary'], // 投稿の全文
            'post_author'    => wp_get_current_user()->ID, // 作成者のユーザー ID。デフォルトはログイン中のユーザーの ID。
            'post_category'  => array(),                   // 投稿カテゴリー。デフォルトは空（カテゴリーなし）。
        );
        $post_id = wp_insert_post( $post_data, true );

        if (  is_wp_error( $post_id ) ) {
            modal('エラー', '投稿に失敗しました。E01');
            return;
        }

        // 投稿にカスタムフィールドを追加
        add_post_meta( $post_id, 'topImage',           $top_img_url                 ); // トップ画像
        add_post_meta( $post_id, 'belongNum',          $_POST['belongNum']          ); // 所属人数
        add_post_meta( $post_id, 'schedule',           $_POST['schedule']           ); // 活動日程
        add_post_meta( $post_id, 'place',              $_POST['place']              ); // 活動場所
        add_post_meta( $post_id, 'categoryRadio',      $_POST['categoryRadio']      ); // サークルカテゴリ
        add_post_meta( $post_id, 'establishmentDate',  $_POST['establishmentDate']  ); // 設立日
        add_post_meta( $post_id, 'activityFrequency',  $_POST['activityFrequency']  ); // 活動頻度
        add_post_meta( $post_id, 'membershipFree',     $_POST['membershipFree']     ); // 会費
        add_post_meta( $post_id, 'features',           $_POST['features']           ); // 特色
        add_post_meta( $post_id, 'activityDetail',     $_POST['activityDetail']     ); // 活動内容
        add_post_meta( $post_id, 'contactMailAddress', $_POST['contactMailAddress'] ); // 連絡先
        add_post_meta( $post_id, 'representative',     $_POST['representative']     ); // 代表者氏名

    } else {
        modal('エラー', '不正なリクエストです。E02');
        return;
    }

    // サークルページへリダイレクト
    wp_redirect( get_permalink( $post_id ) );
    exit;
    return 1;
}



/**
 * フォームのPOSTリクエストを受け取る
 * after_setup_theme に処理をフック
 */
add_action('after_setup_theme', function() {
    // ログインする
    if ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'login' ) {
        if ( !isset( $_POST['login_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['login_nonce'], 'login_nonce_action' ) ) return;
        user_login();
    }
    // サインアップ
    elseif ( isset( $_POST['signup'] ) && $_POST['signup'] === 'signup') {
        if ( !isset( $_POST['signup_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['signup_nonce'], 'signup_nonce_action' ) ) return;
        user_signup();
    }
    // 基本情報の更新
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'profile' ) {
        if ( !isset( $_POST['profile_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['profile_nonce'], 'profile_nonce_action' ) ) return;
        profile_update();
    }
    // サークルを作成する
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'circle_post' ) {
        if ( !isset( $_POST['circle_post_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['circle_post_nonce'], 'circle_post_nonce_action' ) ) return;
        create_circle();
    }
    // サークルをドラフト保存する
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'circle_draft' ) {
        if ( !isset( $_POST['circle_draft_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['circle_edit_nonce'], 'circle_draft_nonce_action' ) ) return;
    }
    // サークルを編集する
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'circle_edit' ) {
        if ( !isset( $_POST['circle_edit_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['circle_edit_nonce'], 'circle_edit_nonce_action' ) ) return;
    }
});