<?php
// media_upload_hundle()
require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );
// wp_create_category()
require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
// wpmu_signup_user(), wpmu_signup_user_notification()
require_once( ABSPATH . 'wp-includes/ms-functions.php' );

/**
 * 変数の初期化
*/
// アップロード画像の最大ファイルサイズ（byte）
$max_file_size = 5242880; //5MB
// ファイルサイズ閾値
$compression_file_size_threshold = 1048576;

$upload_post_name = "";

/**
 * 管理者以外はアドミンバーを非表示
 */
show_admin_bar(false);



/**
 * 投稿とサークルの投稿時スラッグ自動生成
 * 
 * postIDをmd5でハッシュ化したものをスラッグとして使う
 * ※ランダム値をハッシュ化すると更新時にスラッグが変わるので、固定されたpostIDを採用
 */
function custom_auto_post_slug($slug, $post_ID, $post_status, $post_type) {
    if ( $post_type === "post" || $post_type === "circle" ) {
        $slug = md5($post_ID);
    }
    return $slug;
}
add_filter('wp_unique_post_slug', 'custom_auto_post_slug', 10, 4);



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
 * 
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
}
add_action( 'admin_menu', 'set_custom_fields' );

/* サークル基本情報フォームHTML */
function form_01_custom_fields() {
    global $post;
    ?>
    <p>トップ画像 <input type="text" name="topImage" value="<?php echo get_post_meta($post->ID, 'topImage', true); ?>" size="30"></p>
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
    global $compression_file_size_threshold;
	if ( $file['type'] == 'image/jpeg' || $file['type'] == 'image/gif' || $file['type'] == 'image/png') {

        if ( $_FILES[$GLOBALS['upload_post_name']]['size'] > $compression_file_size_threshold ) {
            $w = 1200;
            $h = 0;
            $image = wp_get_image_editor( $file['file'] );
            if ( ! is_wp_error( $image ) ) {
                $size = getimagesize( $file['file'] );
                if ( $size[0] > $w || $size[1] > $h ){
                    $image->resize( $w, $h, false );
                    $final_image = $image->save( $file['file'] );
                }
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

    // ファイルサイズが5MB以上はアップロードしない
    if ( $_FILES[$input_name]['size'] > $max_file_size ) {
        return array( NULL, NULL );
    }

    // アップロード処理
    $GLOBALS['upload_post_name'] = $input_name;
    $attachment_id = media_handle_upload( $input_name, 0 );

    // アップロードエラーチェック
    if ( is_wp_error( $attachment_id ) ) {
        // 何もしない
        return array( NULL, NULL );
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

    // ユーザー仮登録
    [$activation_key, $user_approval_url] = signup_provisional( $user_name, $user_email, $user_pass, $user_first_name, $user_last_name );
    if ( $user_approval_url ) {
        // 認証メール送信
        user_approval_sendmail( $user_email, $activation_key, $user_approval_url );
    } else {
        modal('エラー', 'ユーザーの仮登録に失敗しました');
        return;
    }

    return 1;
}

/**
 * ユーザーの仮登録
 * @param string        $user_login
 * @return array|false $activation_key, $user_approval_url
*/
function signup_provisional( $user_login, $user_email, $password, $first_name, $last_name ) {
    global $wpdb;
    // バリデーションチェック
    // データベース書き込み
	$user_login = preg_replace( '/\s+/', '', sanitize_user( $user_login, true ) );
	$user_email = sanitize_email( $user_email );
    /** @var string ユーザーの有効化キー（メール認証で使う） */
	$activation_key = substr( md5( time() . wp_rand() . $user_email ), 0, 16 );

	$res = $wpdb->insert(
		$wpdb->signups,
		array(
			'user_login'     => $user_login,
			'user_email'     => $user_email,
            'password'       => $password,
            'first_name'     => $first_name,
            'last_name'      => $last_name,
			'user_registered'     => current_time( 'mysql', true ),
			'activation_key' => $activation_key,
		)
	);
    if ( $res ) {
        $user_approval_url = home_url( '/index.php/signup?t=auth&token=' . $activation_key );
        return array($activation_key, $user_approval_url);
    }
    return false;
}

/**
 * ユーザーにユーザー登録のメール認証を送信する
 * @param string      $user_email
 * @param string      $user_approval_url
 * @return true|false 送信成功, 送信失敗
*/
function user_approval_sendmail( $user_email, $activation_key, $user_approval_url ) {
    global $wpdb;
    $res = $wpdb->get_results("SELECT first_name, last_name FROM {$wpdb->signups} WHERE activation_key='{$activation_key}'");
    $name = $res[0]->last_name . " " . $res[0]->first_name;

    $to = $user_email;

	$headers = "
	From: IPUT ONE制作チーム <iputone.staff@gmail.com>\r\n
	Reply-To: IPUT ONE制作チーム <iputone.staff@gmail.com>\r\n
    cc: iputone.staff@gmail.com\r\n
    ";

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

    wp_mail( $to, $subject, $message, $headers );

    return 1;
}

/**
 * ユーザー承認
 * 
 * @param string $activation_key 有効化キー
*/
function user_activation( $activation_key ) {
    // signupテーブルのレコードを削除する
    // ユーザー側へメール
    // 管理者側へメール
    // 問題がなければユーザーを登録する処理を開始

    $user = $wpdb->get_results("SELECT * FROM {$wpdb->signups} WHERE activation_key='{$activation_key}'");

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
            modal('ユーザーの作成に失敗しました', "${$user_id->get_error_code()}<br>${$user_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
            return;
        }
    
        // ユーザーの削除
        $wpdb->get_results("DELETE FROM {$wpdb->signups} WHERE activation_key='{$activation_key}'");
    
        // 登録完了後、そのままログインさせる（ 任意 ）
        wp_set_auth_cookie( $user_id, false, is_ssl() );

        return 1;
    }
    return 0;
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
        $_POST['twitterUserName'   ], // 公式Twitterユーザー名
        $_POST['circle_post_nonce' ], // WordPressNonce
        ) )
    {
        // ページ公開ステータスの取得
        $post_status = "publish"; // draft | publish
        if ( isset( $_GET['post_status'] ) ) {
            $post_status = $_GET['post_status'];
        }

        // 既存のサークル名ではないか
        $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'circle',
        );
        $circles = get_posts( $args );
        foreach ( $circles as $circle ) {
            if ( $circle->post_title === $_POST['circleName'] ) {
                modal('エラー', '既に同じ名前のサークルが存在しています。');
                return;
            }
        }

        // 文字数チェック
        if ( mb_strlen( $_POST['circleName']      ) > 20 ) input_value_error_exit();
        if ( mb_strlen( $_POST['belongNum']       ) > 3  ) input_value_error_exit();
        if ( mb_strlen( $_POST['schedule']        ) > 15 ) input_value_error_exit();
        if ( mb_strlen( $_POST['twitterUserName'] ) > 30 ) input_value_error_exit();

        // トップ画像をアップロード
        $top_img_url = upload_image('topImage')[1] ?? '';

        // ヘッダー画像をアップロード
        $header_img_url = upload_image('headerImage')[1] ?? '';


        // アルバム画像
        // ～ここへ処理～

        // 投稿処理
        $post_data = array(
            'post_title'     => $_POST['circleName'],      // 投稿のタイトル
            'post_name'      => md5( time() ),             // スラッグ名（時間をmd5でハッシュ化したもの）
            'post_type'      => 'circle',                  // 投稿タイプ
            'post_status'    => $post_status,              // 公開ステータス
            'post_content'   => $_POST['activitySummary'], // 投稿の全文
            'post_author'    => wp_get_current_user()->ID, // 作成者のユーザー ID。デフォルトはログイン中のユーザーの ID。
            'post_category'  => array(),                   // 投稿カテゴリー。デフォルトは空（カテゴリーなし）。
        );
        $post_id = wp_insert_post( $post_data, true ); // 投稿を作成　自動サニタイズ

        if (  is_wp_error( $post_id ) ) {
            modal('エラー', '投稿に失敗しました。');
            return;
        }

        // カテゴリ作成
        $category_id = wp_create_category( $_POST['circleName'] );

        if ( !($category_id) ) {
            modal('エラー', '投稿に失敗しました。');
            return;
        }

        // 投稿にカスタムフィールドを追加（自動サニタイズ、add_post_meta関数は禁止）
        update_post_meta( $post_id, 'topImage',           $top_img_url                 ); // トップ画像（URL）
        update_post_meta( $post_id, 'headerImage',        $header_img_url              ); // ヘッダー画像（URL）
        update_post_meta( $post_id, 'belongNum',          $_POST['belongNum']          ); // 所属人数
        update_post_meta( $post_id, 'schedule',           $_POST['schedule']           ); // 活動日程
        update_post_meta( $post_id, 'place',              $_POST['place']              ); // 活動場所
        update_post_meta( $post_id, 'categoryRadio',      $_POST['categoryRadio']      ); // サークルカテゴリ
        update_post_meta( $post_id, 'establishmentDate',  $_POST['establishmentDate']  ); // 設立日
        update_post_meta( $post_id, 'activityFrequency',  $_POST['activityFrequency']  ); // 活動頻度
        update_post_meta( $post_id, 'membershipFree',     $_POST['membershipFree']     ); // 会費
        update_post_meta( $post_id, 'features',           $_POST['features']           ); // 特色（配列をシリアル化して文字列で保存）
        update_post_meta( $post_id, 'activityDetail',     $_POST['activityDetail']     ); // 活動内容
        update_post_meta( $post_id, 'contactMailAddress', $_POST['contactMailAddress'] ); // 連絡先
        update_post_meta( $post_id, 'representative',     $_POST['representative']     ); // 代表者氏名
        update_post_meta( $post_id, 'twitterUserName',    $_POST['twitterUserName']    ); // 公式Twitterユーザー名
        update_post_meta( $post_id, 'circleCategoryId',   $category_id                 ); // サークルカテゴリID

        

    } else {
        modal('エラー', '不正なリクエストです。');
        return;
    }

    // サークルページへリダイレクト
    wp_redirect( get_permalink( $post_id ) );
    exit;
    return 1;
}



/**
 * サークル作成ページ　更新処理
*/
function update_circle() {
    //  サークル名は変更不可
    return false;
}

/**
 * サークル作成ページ　サークル削除処理
*/
function delete_circle() {
    // サークル名のタグを削除する
    return false;
}

function input_value_error_exit( $error_code = "" ) {
    modal('エラー', "入力フォームを修正してもう一度お試しください。{$error_code}");
    return;
}



/**
 * POSTリクエストを受け取る
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
        }
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
        if ( !wp_verify_nonce( $_POST['circle_post_nonce'], 'n4Uyh98k' ) ) return;
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