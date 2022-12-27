<?php
// media_upload_hundle()
require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );
// wp_create_category()
require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
// wpmu_signup_user(), wpmu_signup_user_notification()
require_once( ABSPATH . 'wp-includes/ms-functions.php' );



/* * * * 変数の初期化 * * * */

// アップロード画像の最大ファイルサイズ（byte）
$max_file_size = 5242880; //5MB
// ファイルサイズ閾値（byte）
$compression_file_size_threshold = 1048576; //1MB

$upload_post_name = "";



/* * * * 初期設定 * * * */

// 投稿カテゴリーのチェック（activity, news）
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



/**
 * 管理者以外はアドミンバーを非表示
 */
show_admin_bar(false);


/**
 * クエリパラメータの取得
 * $_GETやget_query_varでパラメータが取得できないのでその代わりの関数です。
 * @param string $key - パラメータのキーを指定する。
 * @return string|null パラメータが見つかった場合はその値を返し、見つからなかった場合はnullを返す。
 */
function get_params( $key = "" ) {
    preg_match( "/\?(.*)/", $_SERVER['REQUEST_URI'], $matches );
    if ( empty( $matches ) ) {
        return null;
    }
    parse_str( $matches[1], $args );

    foreach( array_keys($args) as $get_key ) {
        if ( $key === $get_key ) return $args[$get_key];
    }
    return null;
}


/**
 * ローカルホストかどうか
 * @return bool ローカルホストだった場合はtrue、そうでない場合はfalseを返す。
*/
function is_localhost() {
    if ( $_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1' ) {
        return true;
    }
    return false;
}



/**
 * カスタム投稿タイプ サークル
 * 
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
 * WordPressで管理する時間の文字列を、年、月、日で分割する。
 * @param string $date
 * @return string
 * 例えば、引数に'2022-11-11 01:19:30'を渡すと'2022年11月11日'が返される
 */
function date_formatting( $date ) {
    preg_match( '/(\d{4})-(\d{2})-(\d{2})/', $date, $matches );
    $year  = $matches[1];
    $month = $matches[2];
    $day   = $matches[3];
    return "{$year}年{$month}月{$day}日";
}



/**
 * カスタム投稿タイプ　カスタムフィールドを設置
 * 
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
    add_meta_box(
        'author',
        '作成者',
        'post_author_meta_box',
        'circle'
    );
}
add_action( 'admin_menu', 'set_custom_fields' );

/* サークル基本情報フォームHTML */
function form_01_custom_fields() {
    global $post;
    ?>
    <p>トップ画像ID <input type="text" name="topImage" value="<?php echo get_post_meta($post->ID, 'topImage', true); ?>" size="30"></p>
    <p>ヘッダー画像ID <input type="text" name="headerImage" value="<?php echo get_post_meta($post->ID, 'headerImage', true); ?>" size="30"></p>
    <p>所属人数 <input type="text" name="belongNum" value="<?php echo get_post_meta($post->ID, 'belongNum', true); ?>" size="30"></p>
    <p>活動日程 <input type="text" name="schedule" value="<?php echo get_post_meta($post->ID, 'schedule', true); ?>" size="30"></p>
    <p>活動場所 <input type="text" name="place" value="<?php echo get_post_meta($post->ID, 'place', true); ?>" size="30"></p>
    <p>サークルカテゴリ <input type="text" name="categoryRadio" value="<?php echo get_post_meta($post->ID, 'categoryRadio', true); ?>" size="30"></p>
    <p>設立日 <input type="date" name="establishmentDate" value="<?php echo get_post_meta($post->ID, 'establishmentDate', true); ?>" size="30"></p>
    <p>活動頻度 <input type="text" name="activityFrequency" value="<?php echo get_post_meta($post->ID, 'activityFrequency', true); ?>" size="30"></p>
    <p>会費 <input type="text" name="membershipFree" value="<?php echo get_post_meta($post->ID, 'membershipFree', true); ?>" size="30"></p>
    <p>公式Twitterユーザー名 <input type="text" name="twitterUserName" value="<?php echo get_post_meta($post->ID, 'twitterUserName', true); ?>" size="30"></p>
    <input type="hidden" name="is_post" value="">
<?php
}

/* サークル説明フォームHTML */
function form_02_custom_fields() {
    global $post;
    echo '<p>管理番号 <input type="text" name="contents_num" value="'.get_post_meta($post->ID, 'contents_num', true).'" size="30"></p>';
}

/* 管理者情報フォームHTML */
function form_03_custom_fields() {
    global $post;
    echo '<p>管理番号 <input type="text" name="contents_num" value="'.get_post_meta($post->ID, 'contents_num', true).'" size="30"></p>';
}

/* カスタムフィールドの値を保存 */
function save_custom_fields( $post_id ) {
    if ( isset( $_POST['is_post'] ) ) {
        update_post_meta( $post_id, 'topImage',          $_POST['topImage']          );
        update_post_meta( $post_id, 'headerImage',       $_POST['headerImage']       );
        update_post_meta( $post_id, 'belongNum',         $_POST['belongNum']         );
        update_post_meta( $post_id, 'schedule',          $_POST['schedule']          );
        update_post_meta( $post_id, 'place',             $_POST['place']             );
        update_post_meta( $post_id, 'categoryRadio',     $_POST['categoryRadio']     );
        update_post_meta( $post_id, 'establishmentDate', $_POST['establishmentDate'] );
        update_post_meta( $post_id, 'activityFrequency', $_POST['activityFrequency'] );
        update_post_meta( $post_id, 'membershipFree',    $_POST['membershipFree']    );
        update_post_meta( $post_id, 'twitterUserName',   $_POST['twitterUserName']   );
    }
}
add_action( 'save_post', 'save_custom_fields' );



/**
 * 画像のリンクからattachment idを取得する
 * @param string $image_src - 
 * @return string $id - attachment id
 */
function get_attachment_id_from_src( $image_src ) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}



/**
 * Bootstrap モーダル テンプレート関数
 * 
 * modal(モーダルのタイトル, モーダルの本文)
 */
function modal( $title, $message ) {
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
            var myModalElm = $('#myModal');
            var options = "keyboard";
            myModalElm.removeClass('display'); // display:none解除
            var myModal = new bootstrap.Modal(myModalElm, options);
            myModal.show();
        }
    </script>
<?php
}



/**
 * 容量が大きい画像の圧縮
 * 
 * 指定ファイルサイズ以上なら横幅1200pxで圧縮
*/
function otocon_resize_at_upload( $file ) {
    global $compression_file_size_threshold; // ファイルサイズ閾値
	if ( $file['type'] == 'image/jpeg' || $file['type'] == 'image/gif' || $file['type'] == 'image/png') {
        if ( $_FILES[$GLOBALS['upload_post_name']]['size'] > $compression_file_size_threshold ) {
            $w = 1200;
            $h = 0;
            $image = wp_get_image_editor( $file['file'] );
            if ( ! is_wp_error( $image ) ) {
                $size = getimagesize( $file['file'] );
                if ( $size[0] > $w || $size[1] > $h ){
                    $image->resize( $w, $h, false );
                    $image->save( $file['file'] );
                }
            } else {
                echo $image->get_error_message();
            }
        }

	}
	return $file;
}
add_action( 'wp_handle_upload', 'otocon_resize_at_upload' );



/**
 * 画像アップロード処理 関数
 * 
 * @param string $input_name 画像が添付されたinputタグのname属性
 * @return array $attachment_id, $img_url
*/
function upload_image( $input_name ) {
    global $max_file_size;

    // ファイルの存在確認
    if ( isset( $_FILES[$input_name] ) === false ) {
        return '';
    }

    // ファイルサイズが5MB以上はアップロードしない
    if ( $_FILES[$input_name]['size'] > $max_file_size ) {
        return '';
    }

    // アップロード処理
    $GLOBALS['upload_post_name'] = $input_name;
    $attachment_id = media_handle_upload( $input_name, 0 );

    // アップロードエラーチェック
    if ( is_wp_error( $attachment_id ) ) {
        // 何もしない
        return '';
    } else {
        // アップロードした画像リンク
        $img_url = wp_get_attachment_image_src( $attachment_id, 'full' )[0];
    }

    return array( $attachment_id, $img_url );
}



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
add_filter('intermediate_image_sizes_advanced', 'not_create_image', 10, 2);



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

    // ログイン処理
    $user = wp_signon($creds);
    if( is_wp_error($user) ) {
        modal( 'ログインに失敗しました', $user->get_error_message() );
        return;
    }
    // マイページへ遷移する
    wp_redirect( home_url( "index.php/author/{$user->user_login}" ) );
    exit;
    return true;
}



/**
 * サインアップページ アカウント作成
 * 
 * @return true|false 完了, 中断
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
    // ユーザー名の確認
    // 半角英数字+アンダーバー1～15文字
    if ( !(preg_match("/^[a-zA-Z0-9_]{1,15}$/iD", $user_name)) ) {
        modal('ユーザー名の入力', 'ユーザー名は半角英数字+アンダーバーのみです。');
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
    // <正規表現>
    // TK20***@**.iput.ac.jpのみ："/^[a-z0-9+_-]{2,16}@(tokyo|tks).iput.ac.jp$/iD"
    // 
    if ( !(preg_match("/^[a-z0-9+._-]{2,16}@(.*)iput.ac.jp$/iD", $user_email)) ) {
        modal('登録できません', '学校のメールアドレスのみ登録可能です。使用できるドメインはiput.ac.jpのみです。');
        return;
    }

    // パスワードの確認
    // 半角英数字+記号を6文字以上16文字以下
    if ( !(preg_match("/^[ -~]{6,16}$/iD", $user_pass)) ) {
        modal('パスワードの入力', 'パスワードは半角英数字+記号6～16文字以内で入力してください。');
        return;
    }
    // 氏名の確認
    if ( !(preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $user_first_name)) ) {
        modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
        return;
    }
    if ( !(preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $user_last_name)) ) {
        modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
        return;
    }

    // ユーザー仮登録
    [$activation_key, $user_approval_url] = signup_provisional( $user_name, $user_email, $user_pass, $user_first_name, $user_last_name );
    if ( $user_approval_url ) {
        // 認証メール送信
        user_approval_sendmail( $user_email, $activation_key, $user_approval_url );
    } else {
        modal('エラー', 'ユーザーの仮登録に失敗しました');
        return;
    }

    return true;
}

/**
 * ユーザーの仮登録
 * ユーザー情報をsignupsテーブルに保持し、認証リンクを返す。
 * @param string        $user_login - ユーザー名
 * @return array|false  array($activation_key, $user_approval_url) | false
*/
function signup_provisional( $user_login, $user_email, $password, $first_name, $last_name ) {
    global $wpdb;

	$user_login = preg_replace( '/\s+/', '', sanitize_user( $user_login, true ) );
	$user_email = sanitize_email( $user_email );

    /** @var string ユーザーの有効化キー16文字（メール認証で使う） */
	$activation_key = substr( md5( time() . wp_rand() . $user_email ), 0, 16 );

    // データベース書き込み
	$res = $wpdb->insert(
		$wpdb->signups,
		array(
			'user_login'      => $user_login,
			'user_email'      => $user_email,
            'password'        => $password,
            'first_name'      => $first_name,
            'last_name'       => $last_name,
			'user_registered' => current_time( 'mysql', true ),
			'activation_key'  => $activation_key,
		)
	);
    if ( $res ) {
        $user_approval_url = home_url( '/index.php/signup?token=' . $activation_key );
        return array($activation_key, $user_approval_url);
    }
    return false;
}

/**
 * ユーザー登録のメール認証を送信する
 * @param string      $user_email
 * @param string      $user_approval_url - 認証リンク
 * @return true|false 送信成功, 送信失敗
*/
function user_approval_sendmail( $user_email, $activation_key, $user_approval_url ) {
    global $wpdb;
    $res = $wpdb->get_results("SELECT first_name, last_name FROM {$wpdb->signups} WHERE activation_key='{$activation_key}'");
    $name = $res[0]->last_name . " " . $res[0]->first_name;

    $to      = $user_email;
    $subject = "【IPUT ONE】メールアドレス認証";
    $message = "
    {$name} 様

    IPUT ONEにご登録いただき、ありがとうございます。
    本メールは、ご登録いただいたメールアドレスの確認証メールです。
    
    下記のリンクにアクセスして、アカウント登録を完了してください。
    {$user_approval_url}

    ============================
    IPUT ONE制作チーム
    iputone.staff@gmail.com
    ";
    my_sendmail( $to, $subject, $message );

    return 1;
}

/**
 * ユーザーを有効化する
 * 一度実行したら2回目はスルーする。
 * @param string $activation_key - 有効化キー
 * @return bool true - 成功, false - 失敗
*/
function user_activation( $activation_key ) {
    global $wpdb;

    
    $user = $wpdb->get_results("SELECT * FROM {$wpdb->signups} WHERE activation_key='{$activation_key}'");

    // ユーザーを登録する
    if ( $user ) {
        $userdata = array(
            'user_login'   => $user[0]->user_login,  // ログイン名
            'user_pass'    => $user[0]->password,    // パスワード
            'user_email'   => $user[0]->user_email,  // メールアドレス
            'first_name'   => $user[0]->first_name,  // 名
            'last_name'    => $user[0]->last_name,   // 姓
            'display_name' => $user[0]->user_login,  // ブログ上の表示名
            'role'         => 'author'
        );
    
        // ユーザー作成処理
        $user_id = wp_insert_user( $userdata );
        if ( is_wp_error( $user_id ) ) {
            modal('ユーザーの作成に失敗しました', "{$user_id->get_error_code()}<br>{$user_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
            return false;
        }
    
        // signupテーブルのレコードを削除する
        $wpdb->get_results("DELETE FROM {$wpdb->signups} WHERE activation_key='{$activation_key}'");
    
        // 登録完了後、そのままログインさせる（ 任意 ）
        wp_set_auth_cookie( $user_id, false, is_ssl() );

        // 登録完了メール
        $to      = $user[0]->user_email;
        $subject = "【IPUT ONE】メールアドレス認証";
        $message = "
        IPUT ONEにご登録いただき、ありがとうございます。
        登録が正常に完了しました。

        何かご質問がありましたらこのメールにご返信ください。
    
        ============================
        IPUT ONE制作チーム
        iputone.staff@gmail.com
        ";
        my_sendmail( $to, $subject, $message );

        wp_redirect( home_url("index.php/signup?t=done") );
        exit;
    } else {
        // エラー
        wp_redirect( home_url("index.php/signup?t=error") );
    }

    return true;
}


/**
 * 基本情報ページ　ユーザープロフィール更新
*/
function profile_update() {
    $user_id       = isset( $_POST['userid'] )      ? sanitize_text_field( $_POST['userid']      ) : null;
    $display_name  = isset( $_POST['displayname'] ) ? sanitize_text_field( $_POST['displayname'] ) : null;
    $user_pass     = isset( $_POST['password'] )    ? sanitize_text_field( $_POST['password']    ) : null;
    $first_name    = isset( $_POST['firstname'] )   ? sanitize_text_field( $_POST['firstname']   ) : null;
    $last_name     = isset( $_POST['lastname'] )    ? sanitize_text_field( $_POST['lastname']    ) : null;
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
        echo $user_id->get_error_code();
        echo $user_id->get_error_message();
        modal('ユーザーの更新に失敗しました', "{$user_id->get_error_code()}<br>{$user_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
    } else {
        modal('更新が完了しました', 'ユーザープロフィールの更新が正常に完了しました。');
    }
    return 1;
}



/**
 * サークル 作成, 編集
 * 
 * # データベースに記録されるデータ
 * ## 基本データ一覧
 * - post_title    - タイトル
 * - post_name     - スラッグ名（時間をmd5でハッシュ化したものを用いる）
 * - post_type     - 投稿タイプ（circle）
 * - post_status   - 公開状態（draft | publish）
 * - post_content  - 投稿の全文
 * - post_category - 投稿カテゴリには投稿サークルのカテゴリを作成して追加する。
 * 
 * ## カスタムメタデータ一覧
 * - topImage    - トップ画像のattachment id
 * - headerImage - ヘッダー画像のattachment id
*/
function post_circle() {
    // パラメータのチェック
    if ( isset(
        $_POST['circleName'        ], // サークル名
        $_POST['belongNum'         ], // 所属人数
        $_POST['schedule'          ], // 活動日程
        $_POST['place'             ], // 活動場所
        $_POST['categoryRadio'     ], // サークルカテゴリ
        $_POST['establishmentDate' ], // 設立日
        $_POST['activityFrequency' ], // 活動頻度
        $_POST['membershipFree'    ], // 会費
        $_POST['activitySummary'   ], // サークル概要
        $_POST['activityDetail'    ], // 活動内容
        $_POST['contactMailAddress'], // 連絡先
        $_POST['representative'    ], // 代表者氏名
        $_POST['twitterUserName'   ], // 公式Twitterユーザー名
        $_POST['circle_post_nonce' ], // WordPressNonce
        ) )
    {
        // 新規投稿のフラグ
        $is_newpost = isset( $_POST['postID'] ) ? false : true;

        // 文字数チェック
        if ( mb_strlen( $_POST['circleName']      ) > 50 ) input_value_error_exit();
        if ( mb_strlen( $_POST['belongNum']       ) > 3  ) input_value_error_exit();
        if ( mb_strlen( $_POST['schedule']        ) > 15 ) input_value_error_exit();
        if ( mb_strlen( $_POST['twitterUserName'] ) > 30 ) input_value_error_exit();

        // 公開状態
        $post_status = 'publish';

        if ( $_POST['submit_type'] === 'draft_circle' ) {
            $post_status = 'draft';
        }

        // 投稿データの配列を作成
        $post_data = array(
            'post_title'     => $_POST['circleName'],      // 投稿のタイトル
            'post_type'      => 'circle',                  // 投稿タイプ
            'post_status'    => $post_status,              // 公開ステータス
            'post_content'   => $_POST['activitySummary'], // 投稿の全文
        );

        /* 新規投稿の場合 */
        if ( $is_newpost ) {

            // スラッグ名を作成する（時間をmd5でハッシュ化したもの）
            $post_data['post_name'] = md5( time() );

            // 既存のサークル名ではないかチェック
            $args = array(
                'posts_per_page' => -1,
                'post_type'      => 'circle',
            );
            $circles = get_posts( $args );
            foreach ( $circles as $circle ) {
                if ( $circle->post_title === $_POST['circleName'] ) {
                    modal('エラー', '既に同じ名前のサークルが存在しています。名前を変更してください。');
                    return;
                }
            }

        /* 更新の場合 */
        } else {

            // postIDを指定する
            $post_data['ID'] = $_POST['postID'];

            // カテゴリ名を更新する
            $cat_id = get_cat_ID( get_the_title( $_POST['postID'] ) );
            wp_update_term( $cat_id, 'category', array(
                'name' => sanitize_text_field( $_POST['circleName'] ),
                'slug' => sanitize_text_field( $_POST['circleName'] ),
              ) );
        }

        // 投稿を作成する
        $post_id = wp_insert_post( $post_data, true ); // 投稿を作成　自動サニタイズ

        if (  is_wp_error( $post_id ) ) {
            modal('エラー', '投稿に失敗しました。');
            return;
        }

        // サークルのカテゴリを作成する
        if ( $is_newpost ) {
            $category_id = wp_create_category( $_POST['circleName'] );
            wp_set_post_categories( $post_id, array($category_id), true );
        }
        

        // トップ画像のアップロード
        $topImage_id = upload_image('topImage')[0] ?? '';

        // ヘッダー画像のアップロード
        $headerImage_id = upload_image('headerImage')[0] ?? '';

        // アルバム画像
        // ～ここへ処理～


        // カスタムフィールド（自動サニタイズ、add_post_meta関数は禁止）
        // 更新時に画像をアップしない場合はスルー
        if ( $is_newpost || !empty( $topImage_id ) ) {
            update_post_meta( $post_id, 'topImage', $topImage_id ); // トップ画像

        }
        if ( $is_newpost || !empty( $headerImage_id ) ) {

            if ( !empty( $headerImage_id ) ) {
                update_post_meta( $post_id, 'headerImage', $headerImage_id ); // ヘッダー画像 設定

            } else {
                update_post_meta( $post_id, 'headerImage', $topImage_id ); // ヘッダー画像が無い場合、代わりにトップ画像を設定する
            }
        }

        // 自動サニタイズ、add_post_meta関数は禁止
        update_post_meta( $post_id, 'belongNum',          $_POST['belongNum']          ); // 所属人数
        update_post_meta( $post_id, 'schedule',           $_POST['schedule']           ); // 活動日程
        update_post_meta( $post_id, 'place',              $_POST['place']              ); // 活動場所
        update_post_meta( $post_id, 'categoryRadio',      $_POST['categoryRadio']      ); // サークルカテゴリ
        update_post_meta( $post_id, 'establishmentDate',  $_POST['establishmentDate']  ); // 設立日
        update_post_meta( $post_id, 'activityFrequency',  $_POST['activityFrequency']  ); // 活動頻度
        update_post_meta( $post_id, 'membershipFree',     $_POST['membershipFree']     ); // 会費
        update_post_meta( $post_id, 'activityDetail',     $_POST['activityDetail']     ); // 活動内容
        update_post_meta( $post_id, 'contactMailAddress', $_POST['contactMailAddress'] ); // 連絡先
        update_post_meta( $post_id, 'representative',     $_POST['representative']     ); // 代表者氏名
        update_post_meta( $post_id, 'twitterUserName',    $_POST['twitterUserName']    ); // 公式Twitterユーザー名
        update_post_meta( $post_id, 'features',           $_POST['features'] ?? array()); // 特色（配列をシリアル化して文字列で保存）

    } else {
        modal('エラー', '不正なリクエストです。');
        return;
    }

    // サークルページへリダイレクト
    if ( $_POST['submit_type'] === 'draft_circle' ) {
        wp_redirect( home_url('index.php/post-dashboard/?type=circle') );
    } else {
        wp_redirect( get_permalink( $post_id ) );
    }
    exit;
    return 1;
}



/**
 * 活動記録投稿ページ 投稿処理
 * 
 * # データベースに記録されるデータ
 * ## 記事データ一覧
 * - post_title    - タイトル
 * - post_content  - コンテンツ
 * - post_category - 活動のカテゴリIDとサークルカテゴリID
 * - tags_input    - タグ
 * - post_status   - 公開設定
 * 
 * ## カスタムメタデータ一覧
 * - organization  - 所属サークル名
 * - permission    - 内部公開設定 true-内部公開, false-外部公開
*/
function post_activity() {
    if ( isset(
        $_POST['title'],       // 記事のタイトル
        $_POST['contents'],    // 記事の内容
        $_POST['organizationId'] // 所属しているサークルのカテゴリID
    ) )
    {
        // 文字数チェック
        if ( mb_strlen( $_POST['title'] )    > 50 ) input_value_error_exit();
        if ( mb_strlen( $_POST['contents'] ) <  1 ) input_value_error_exit();

        // タグが規定の名前であるかチェック
        if ( isset( $_POST['tags'] ) ) {

            array_map( function ($tag) {
                if ( !in_array( $tag, array('活動報告', '行事・イベント', '重要報告') ) ) {
                    modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
                    return;
                }
            }, $_POST['tags'] );
        }

        $post_data = array(
            'post_title'    => $_POST['title'],    // タイトル
            'post_content'  => $_POST['contents'], // コンテンツ
            'post_category' => array( get_cat_ID('activity'),  $_POST['organizationId'] ),  // カテゴリID
            'tags_input'    => $_POST['tags'] ?? '', // タグ
            'post_status'   => 'publish', // 公開設定
        );

        if ( $_POST['submit_type'] === 'post_activity' ) {
            // スラッグ名を作成する（時間をmd5でハッシュ化したもの）
            $post_data['post_name'] = md5( time() );
        }
        elseif ( $_POST['submit_type'] === 'edit_activity' ) {
            // postIDを指定する
            if ( isset( $_POST['postID'] ) ) {
                $post_data['ID'] = $_POST['postID'];
            }
        }

        $post_id = wp_insert_post( $post_data, true );

        if ( is_wp_error( $post_id ) ) {
            echo $post_id->get_error_code();
            echo $post_id->get_error_message();
            modal('記事の投稿に失敗しました', "{$post_id->get_error_code()}<br>{$post_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
            return;
        }
        
        // 内部公開 設定
        if ( isset( $_POST['permission'] ) ) {
            update_post_meta( $post_id, 'permission', 'true' );
        } else {
            update_post_meta( $post_id, 'permission', 'false' );
        }

        // 記事内容からアイキャッチ画像 設定
        if ( is_localhost() ) {
            $pattern = "http:\/\/(.*?)(.png|.jpg)";
        } else {
            $pattern = "https:\/\/(.*?)(.png|.jpg)";
        }
        preg_match( "/{$pattern}/", $_POST['contents'], $matches ); // 画像URLのマッチ

        $topImage_url = !empty($matches) ? esc_url( $matches[0] ) : '';

        if ( !empty($topImage_url) ) {
            $topImage_id = get_attachment_id_from_src( $topImage_url ); // urlからサムネイルIDを取得
            update_post_meta( $post_id, 'topImage', $topImage_id );
        } else {
            update_post_meta( $post_id, 'topImage', '' );
        }

        // リダイレクト
        wp_redirect( get_permalink( $post_id ) );
        exit;
        return true;

    } else {
        modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
        return;
    }
}


/**
 * ニュース投稿ページ 投稿処理
*/
function post_news() {
    if ( isset(
        $_POST['title'],       // 記事のタイトル
        $_POST['contents'],    // 記事の内容
    ) )
    {
        // 文字数チェック
        if ( mb_strlen( $_POST['title'] )    > 50 ) input_value_error_exit();
        if ( mb_strlen( $_POST['contents'] ) <  1 ) input_value_error_exit();

        // タグが規定の名前であるかチェック
        if ( isset( $_POST['tags'] ) ) {

            array_map( function ($tag) {
                if ( !in_array( $tag, array('行事・イベント', 'レジャー', '食事', 'お知らせ', '重要連絡') ) ) {
                    modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
                    return;
                }
            }, $_POST['tags'] );
        }

        $post_data = array(
            'post_title'    => $_POST['title'],    // タイトル
            'post_content'  => $_POST['contents'], // コンテンツ
            'post_name'     => md5( time() ),      // スラッグ名を作成する（時間をmd5でハッシュ化したもの）
            'post_category' => array( get_cat_ID('news') ),  // カテゴリID
            'tags_input'    => isset( $_POST['tags'] ) ? $_POST['tags'] : '', // タグ
            'post_status'   => 'publish', // 公開設定
        );

        $post_id = wp_insert_post( $post_data, true );

        if ( is_wp_error( $post_id ) ) {
            echo $post_id->get_error_code();
            echo $post_id->get_error_message();
            modal('記事の投稿に失敗しました', "{$post_id->get_error_code()}<br>{$post_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
            return;
        }
        
        // クリップ 設定
        if ( isset( $_POST['clip'] ) ) {
            update_post_meta( $post_id, 'clip', $_POST['limit_date'] );
        } else {
            update_post_meta( $post_id, 'clip', 'false' );
        }

        // 内部公開 設定
        if ( isset( $_POST['permission'] ) ) {
            update_post_meta( $post_id, 'permission', 'true' );
        } else {
            update_post_meta( $post_id, 'permission', 'false' );
        }

        // 記事内容からアイキャッチ画像 設定
        $pattern = (is_localhost() ? 'http:' : 'https:') . "\/\/(.*?)(.png|.jpg)";

        preg_match( "/{$pattern}/", $_POST['contents'], $matches ); // 画像URLのマッチ

        if ( !empty($matches) ) {
            $topImage_url = esc_url( $matches[0] );
            $topImage_id = get_attachment_id_from_src( $topImage_url ); // urlからサムネイルIDを取得
            update_post_meta( $post_id, 'topImage', $topImage_id );

        } else {
            update_post_meta( $post_id, 'topImage', '' );
        }

        // リダイレクト
        wp_redirect( get_permalink( $post_id ) );
        exit;
        return true;

    } else {
        modal('エラー', '不正なリクエストです。');
        return;
    }
}


/**
 * POSTリクエストを受け付ける
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
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'signup') {
        if ( !isset( $_POST['signup_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['signup_nonce'], 'N9zxfbth' ) ) return;
        $res = user_signup();
        if ( $res ) {
            wp_redirect( home_url('index.php/signup?t=confirm') );
            exit;
        }
    }
    // 基本情報の更新
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'profile' ) {
        if ( !isset( $_POST['profile_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['profile_nonce'], 'profile_nonce_action' ) ) return;
        profile_update();
    }
    // サークルを作成する
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'post_circle' ) {
        if ( !isset( $_POST['circle_post_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['circle_post_nonce'], 'n4Uyh98k' ) ) return;
        post_circle();
    }
    // サークルをドラフト保存する
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'draft_circle' ) {
        if ( !isset( $_POST['circle_post_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['circle_post_nonce'], 'n4Uyh98k' ) ) return;
        post_circle();
    }
    // サークルを編集する
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'edit_circle' ) {
        if ( !isset( $_POST['circle_post_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['circle_post_nonce'], 'n4Uyh98k' ) ) return;
        post_circle();
    }
    // 活動記録を投稿する
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'post_activity' ) {
        if ( !isset( $_POST['post_activity_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['post_activity_nonce'], 'Mw8mgUz5' ) ) return;
        post_activity();
    }
    // 活動記録を編集する
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'edit_activity' ) {
        if ( !isset( $_POST['post_activity_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['post_activity_nonce'], 'Mw8mgUz5' ) ) return;
        post_activity();
    }
    // ニュース投稿ページ
    elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'post_news' ) {
        if ( !isset( $_POST['post_news_nonce'] ) ) return;
        if ( !wp_verify_nonce( $_POST['post_news_nonce'], 'Fr4XZRu6' ) ) return;
        post_news();
    }
});


/**
 * メールを送信する
 * @param string $to - 宛先メールアドレス
 * @param string $subject - 件名
 * @param string $message - 本文
 * @param string $headers - メールヘッダ。特別な理由がない限り指定しない
 * @return bool  true - 送信成功, false - メールアドレス取得失敗
 * 
*/
function my_sendmail( $to, $subject, $message, $headers = "" ) {

    // WordPressの管理者メールアドレスを取得
    $admin_email = get_option('admin_email');

    if ( $admin_email ) {
        $headers = "
        From: IPUT ONE制作チーム <{$admin_email}>\r\n
        Reply-To: IPUT ONE制作チーム <{$admin_email}>\r\n
        cc: {$admin_email}\r\n
        ";
        wp_mail( $to, $subject, $message, $headers );
    } else {
        return false;
    }

    return true;
}

/**
 * inputフォームエラー時のアラートモーダル
 * @param string $error_code - エラーコード
 * @return false
*/
function input_value_error_exit( $error_code = "" ) {
    modal('エラー', "入力フォームを修正してもう一度お試しください。{$error_code}");
    return;
}