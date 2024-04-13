<?php
//モーダル表示
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

//ユーザ登録関係
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

//画像アップロード関係
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

/**
 * 画像アップロード処理 関数
 * 
 * @param string $input_name 画像が添付されたinputタグのname属性
 * @return array $attachment_id, $img_url
*/
// media_handle_upload()
require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );
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