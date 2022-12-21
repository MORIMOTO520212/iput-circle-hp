<?php
/* Template Name: サークルのお問い合わせページ */


/* ログイン状態のチェック */
if ( !is_user_logged_in() ) {
    echo "ログインしてください。";
    exit;
}

$flag = 0;

// メール送信
if ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === 'circle-contact' ) {
    // WordPressの管理者メールアドレスを取得
    $admin_email = get_option('admin_email');
    $to = sanitize_email( $_POST['to'] );
    $from = sanitize_email( $_POST['from'] );
    $circleName = sanitize_text_field( $_POST['circlename'] );
    $message = sanitize_text_field( $_POST['body'] );

    $subject = "【IPUT ONE】{$circleName}についてお問い合わせを頂いております。";
    $headers = "
    From: IPUT ONE制作チーム <{$admin_email}>\r\n
    Reply-To: {$from}\r\n
    cc: {$admin_email}\r\n
    ";
    wp_mail( $to, $subject, $message, $headers );
    $flag = 1;

} else {
    $to = get_params('to');
    $from = get_params('from');
    $circleName = get_params('circlename');
}

get_header();
?>

<?php
if ( $flag ):
?>

<!-- send mail complate -->
<div class="container">
    <p clas="text-center">
        送信が完了しました。後日、サークルの関係者から返信がありますのでお待ちください。<br>
        このページは閉じてください。
    </p>
</div>

<?php
else:
?>

<!-- send mail form -->
<form class="container needs-validation" action="" method="post" novalidate>
    <h2 class="text-center my-3"><?php echo $circleName; ?> お問い合わせ</h2>
    <div class="pt-3">
        <p>お問い合わせ内容</p>
        <textarea type="text" class="form-control" name="body" required></textarea>
    </div>
    <input type="hidden" name="from" value="<?php echo $from; ?>" />
    <input type="hidden" name="to" value="<?php echo $to; ?>" />
    <input type="hidden" name="circlename" value="<?php echo $circleName; ?>" />
    <div class="d-flex justify-content-center pt-3">
        <button type="submit" class="btn btn-primary" name="submit_type" value="circle-contact">送信</button>
    </div>
</form>

<?php
endif;
?>

<?php get_footer(); ?>