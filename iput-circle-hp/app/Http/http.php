<?php

/**
 * POSTリクエストを受け付ける
 * after_setup_theme に処理をフック
 */
add_action('after_setup_theme', function() {
  // ログインする
  if ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'login' ) {
      if ( !isset( $_POST['login_nonce'] ) ) return;
      if ( !wp_verify_nonce( $_POST['login_nonce'], 'N4wcFHsn' ) ) return;
      user_login();
  }
  // サインアップ
  elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'signup') {
      if ( !isset( $_POST['signup_nonce'] ) ) return;
      if ( !wp_verify_nonce( $_POST['signup_nonce'], 'N9zxfbth' ) ) return;
      $res = user_signup(); // サインアップの処理
      if ($res === true) {
          wp_redirect( home_url('index.php/signup?t=confirm') );
          exit;
      }
  }
  // 基本情報の更新
  elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'profile' ) {
      if ( !isset( $_POST['profile_nonce'] ) ) return;
      if ( !wp_verify_nonce( $_POST['profile_nonce'], 'vpd8NFzp' ) ) return;
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
  // ニュースを投稿する
  elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'post_news' ) {
      if ( !isset( $_POST['post_news_nonce'] ) ) return;
      if ( !wp_verify_nonce( $_POST['post_news_nonce'], 'Fr4XZRu6' ) ) return;
      post_news();
  }
  // ニュースを投稿する
  elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'edit_news' ) {
      if ( !isset( $_POST['post_news_nonce'] ) ) return;
      if ( !wp_verify_nonce( $_POST['post_news_nonce'], 'Fr4XZRu6' ) ) return;
      post_news();
  }
  // サークルページ - サークル申請
  elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'participation_application' ) {
      if ( !isset( $_POST['participation_application_nonce'] ) ) return;
      if ( !wp_verify_nonce( $_POST['participation_application_nonce'], 'M3fHXt2T' ) ) return;
      participation_application();
  }
  // サークルページ - お問い合わせ
  elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'circle_contact' ) {
      if ( !isset( $_POST['circle_contact_nonce'] ) ) return;
      if ( !wp_verify_nonce( $_POST['circle_contact_nonce'], 'P5kseWwp' ) ) return;
      circle_contact();
  }
  // ダッシュボード - メール送信用GASデプロイID
  elseif ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'gas_deploy_id' ) {
      if ( !isset( $_POST['circle_contact_nonce'] ) ) return;
      if ( !wp_verify_nonce( $_POST['circle_contact_nonce'], 'Ujfsi4390k' ) ) return;
      $to = get_option('admin_email');
      $subject = "{$_POST['your_name']} さんからお問い合わせを受け取っています。";
      $message = "
氏名：{$_POST['your_name']}
メールアドレス：{$_POST['email']}
内容：
{$_POST['contact']}
      ";
      my_gas_sendmail($to, $subject, $message);
  }
});