<?php
//サークルページの入会申請
function participation_application() {
  if ( isset(
      $_POST['grade'],       // 学年
      $_POST['department'],  // 学科
      $_POST['reason'],      // 理由
      $_POST['postID']       // 投稿ID
  ) )
  {
      // 入力チェック
      $default_grade = array('1', '2', '3', '4', '教授');
      if ( !in_array( $_POST['grade'], $default_grade, true ) ) {
          modal('不正なリクエストです', 'もう一度お試しください。');
          return;
      }

      $default_department = array('情報工学科', 'デジタルエンタテイメント学科', '他大学', 'その他');
      if ( !in_array( $_POST['department'], $default_department, true ) ) {
          modal('不正なリクエストです', 'もう一度お試しください。');
          return;
      }

      if ( mb_strlen( $_POST['reason'] ) > 500 ) input_value_error_exit();

      // 情報取得
      $circle_post = get_post( $_POST['postID'] ); // サークル情報
      $user = wp_get_current_user(); // ユーザー情報

      // 未ログインの場合
      if ( $user->ID === 0 ) {
          modal('不正なリクエストです', 'ログインしてからお試しください。');
          return;
      }

      // ログイン中のユーザーのメールアドレス取得
      $login_user_email = get_user_option('user_email', $user->ID);

      // 承認用リンク作成
      $user_id = $user->ID;
      $approval_key = substr( md5( $user_id . $_POST['postID'] ), 0, 16 ); // userIdとpostIdをmd5でハッシュ化
      $approval_url = home_url("index.php/post-circle/?_post=edit&id={$_POST['postID']}&userid={$user_id}&approval_key={$approval_key}");

      // 承認用メール
      $to = get_post_custom( $_POST['postID'] )['contactMailAddress'][0];
      $subject = "【{$circle_post->post_title}】参加申請が届きました。";
      $message = "
{$user->last_name} {$user->first_name}さんからサークルへ参加申請が届きました。

学年：{$_POST['grade']}年
学科：{$_POST['department']}
メールアドレス：{$login_user_email}

参加理由
--------------------
{$_POST['reason']}

参加を承認する場合は以下のリンクにアクセスしてください。
{$approval_url}


============================
IPUT ONEへのお問い合わせはこのメールに返信してください。
IPUT ONE制作チーム
iputone.staff@gmail.com
";
      my_sendmail( $to, $subject, $message );

      modal('申請が完了しました', '参加完了メールをお待ちください。');
      return;
  } else {
      modal('エラー', '不正なリクエストです。');
      return;
  }
}

//サークルお問い合わせ
function circle_contact() {
  if ( isset(
      $_POST['grade'],       // 学年
      $_POST['department'],  // 学科
      $_POST['contactbody'], // 問い合わせ内容
      $_POST['postID']       // 投稿ID
  ) )
  {
      // 入力チェック
      $default_grade = array('1', '2', '3', '4', '教授');
      if ( !in_array( $_POST['grade'], $default_grade, true ) ) {
          modal('不正なリクエストです', 'もう一度お試しください。');
          return;
      }

      $default_department = array('情報工学科', 'デジタルエンタテイメント学科', '他大学', 'その他');
      if ( !in_array( $_POST['department'], $default_department, true ) ) {
          modal('不正なリクエストです', 'もう一度お試しください。');
          return;
      }

      if ( mb_strlen( $_POST['contactbody'] ) > 500 ) input_value_error_exit();

      // 情報取得
      $circle_post = get_post( $_POST['postID'] ); // サークル情報
      $user = wp_get_current_user(); // ユーザー情報

      // 未ログインの場合
      if ( $user->ID === 0 ) {
          modal('不正なリクエストです', 'ログインしてからお試しください。');
          return;
      }

      // ログイン中のユーザーのメールアドレス取得
      $login_user_email = get_user_option('user_email', $user->ID);

      // お問い合わせメール
      $to = get_post_custom( $_POST['postID'] )['contactMailAddress'][0];
      $subject = "【IPUT ONE】{$circle_post->post_title}についてお問い合わせを頂いております。";
      $message = "
{$user->last_name} {$user->first_name}さんからお問い合わせがありました。

学年：{$_POST['grade']}年
学科：{$_POST['department']}
メールアドレス：{$login_user_email}

お問い合わせ内容
--------------------
{$_POST['contactbody']}


============================
IPUT ONEへのお問い合わせはこのメールに返信してください。
IPUT ONE制作チーム
iputone.staff@gmail.com
";
      my_sendmail( $to, $subject, $message );

      modal('お問い合わせが完了しました', '返信をお待ちください。');

  } else {
      modal('エラー', '不正なリクエストです。');
      return;
  }
}