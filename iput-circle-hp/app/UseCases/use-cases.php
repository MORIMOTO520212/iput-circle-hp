<?php

//メール送信システム
/**
 * GoogleのSMTPサーバーを使ってメール送信
 * 宛先、件名、内容を引数に送り、メールを送信する
 * @param string $to - 宛先メールアドレス
 * @param string $subject - 件名
 * @param string $message - 本文
 * @return bool  true - 送信成功, false - メールアドレス取得失敗
 * 
*/
function my_sendmail( $to, $subject, $message ) {
  // gasのidとurl
  // iputone.staff@gmai.comのGASにデータを送信します。
  // デプロイID
  $id = 'AKfycbyT1dyHETFo9r4Z1SRsh23sa6hTTx-Vfs6bKmt0-xvCDURrubEVdAFSWhY4vSHvj4nN';
  //POST送信先
  $post_url = "https://script.google.com/macros/s/$id/exec";
  
  // WordPressの管理者メールアドレスを取得
  $admin_email = get_option('admin_email');

  if ( $admin_email ) {
      //POSTデータ
      $post_data = array(
          "toAddress" => $to,
          "subject" => $subject,
          "message" => $message,
      );

      //cURL
      $ch = curl_init();
      curl_setopt_array($ch, [
          CURLOPT_URL => $post_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_POST => true, 
          CURLOPT_POSTFIELDS => json_encode($post_data),
      ]);
      // post実行
      curl_exec($ch);
      // cURLクローズ
      curl_close($ch);
  } else {
      return false;
  }
  return true;
}

/**
 * Google App Scriptからメール送信する
 * 宛先、件名、内容を引数に送り、メールを送信する
 * @param string $to - 宛先メールアドレス
 * @param string $subject - 件名
 * @param string $message - 本文
 * @param string $headers - メールヘッダ。特別な理由がない限り指定しない
 * @return bool  true - 送信成功, false - メールアドレス取得失敗
 */
function my_gas_sendmail( $to, $subject, $message, $headers = "" ) {

  // WordPressの管理者メールアドレスを取得
  $admin_email = get_option('admin_email');

  $gas_deploy_id = get_post_meta( 1, 'gas_deploy_id', true );
  $post_url = "https://script.google.com/macros/s/$gas_deploy_id/exec";

  if ( $admin_email ) {
      
      
  } else {
      return false;
  }
  return true;
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
 * inputフォームエラー時の警告モーダル
 * @param string $error_code - エラーコード
 * @return false
*/
function input_value_error_exit( $error_code = "" ) {
    modal('エラー', "入力フォームを修正してもう一度お試しください。{$error_code}");
    return;
}

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