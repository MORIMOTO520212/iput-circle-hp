<?php
/**
 * Template Name: お問い合わせページ
*/
?>

<?php
$page_flag = 0;
if( isset( $_POST['btn_sub'] ) ) {
	$page_flag           = 1;
    $header              = null;
	$auto_reply_subject  = null;
	$auto_reply_text     = null;
	$admin_reply_subject = null;
	$admin_reply_text    = null;
	date_default_timezone_set('Asia/Tokyo');

    // WordPressの管理者メールアドレスを取得
    $admin_email = get_option('admin_email');

	// ヘッダー情報を設定
	$header = "MIME-Version: 1.0\n";
	$header .= "From: IPUTONE制作チーム <{$admin_email}>\n";
	$header .= "Reply-To: IPUTONE制作チーム <{$admin_email}>\n";

    /* ユーザーにメール送信 */
	$auto_reply_subject = 'お問い合わせありがとうございます。';

	$auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。下記の内容でお問い合わせを受け付けました。\n\n";
    $auto_reply_text .= "{$_POST['contact']}\n";
	$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$auto_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$auto_reply_text .= "メールアドレス：" . $_POST['Email'] . "\n\n";
	$auto_reply_text .= "IPUTONE制作チーム";

	mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text, $header );


	/* 運営者側にメール送信 */
	$admin_reply_subject = "お問い合わせを受け付けました";
	
	$admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
    $admin_reply_text .= "{$_POST['contact']}\n";
	$admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$admin_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$admin_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";

	mb_send_mail( $admin_email, $admin_reply_subject, $admin_reply_text, $header );

    wp_redirect( home_url('index.php/contact/?t=done') );
    exit;
}
?>

<?php get_header(); ?>

<main class="contents">

    <?php
    /* お問い合わせ画面 */
    if ( get_params('t') === null ):
    ?>

    <!-- top -->
    <div class="position-relative" id="contact-top">
        <img src="<?php echo get_theme_file_uri('src/background/room2.webp'); ?>" class="w-100">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="text-center text-white">
                <h1>お問い合わせ</h1>
                <h3>CONTACT</h3>
            </div>
        </div>
    </div>
    <!-- main -->
    <div class="contact_main container">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="description_p">
                当サイト又は、IPUT ONE制作チームに関するお問い合わせは、下記のお問い合わせフォームよりご連絡ください。<br>
                お問い合わせをする前に、よくある質問（FAQ）に同じ質問がないかご確認ください。<br>
                尚、当サイト又は、IPUT ONE制作チーム以外のお問い合わせにつきましてはお答えすることが出来ませんのであらかじめご了承ください。
                </div>
            </div>

            <div class="d-flex justify-content-center que_btn">
                <a href="<?php echo home_url('index.php/faq') ?>" class="btn btn-secondary">よくある質問はこちら</a>
            </div>

            <div class="d-flex justify-content-center">
                <form class="col-12 col-md-6 needs-validation" method="post" action="" novalidate>
                    <!-- 必須 お名前 -->
                    <div class="mb-custom-form">
                        <div class="d-flex mb-2">
                            <span class="badge bg-danger">必須</span>
                            <div class="contact_item">お名前</div>
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="お名前を入力してください" name="your_name"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="" required>
                            <div class="invalid-feedback">
                                入力をお願いします。
                            </div>
                        </div>
                    </div>

                    <!-- 必須 メールアドレス -->
                    <div class="mb-custom-form">
                        <div class="d-flex mb-2">
                            <span class="badge bg-danger">必須</span>
                            <div class="contact_item">メールアドレス</div>
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="メールアドレスを入力してください" name="email"
                                aria-label="Sizing example input" aria-describedby="email-help" value="" required>
                            <div class="invalid-feedback">
                                正しいメールアドレスを入力してください。
                            </div>
                        </div>
                    </div>

                    <!-- 必須 お問い合わせ内容 -->
                    <div class="mb-custom-form">
                        <div class="d-flex mb-2">
                            <span class="badge bg-danger">必須</span>
                            <div class="contact_item">お問い合わせ内容</div>
                        </div>
                        <div>
                            <textarea class="form-control" name="contact" id="floatingTextarea2" style="height: 150px" required></textarea>
                        </div>
                    </div>

                    <div class="top_send_button">
                        <a href="<?php echo home_url('/'); ?>" class="btn btn-secondary">トップページへ戻る</a>
                        <input type="submit" name="btn_sub"  class="btn btn-primary" value="送信する">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    /* お問い合わせ完了画面 */
    elseif ( get_params('t') === 'done' ):
    ?>

    <div class="container thanks-msg" style="margin-top:70px;">
        <h3 class="text-center" style="color:#707070;">お問い合わせありがとうございました！</h3>
        <h6 class="text-center mt-3">
            <span>
                お問い合わせをいただき誠にありがとうございます。<br>
                後日、IPUTONE制作チームよりご連絡いたします。                    
            </span>
        </h6>
        <img src="<?php echo get_theme_file_uri('src/thanks.png'); ?>" alt="Thank You!!">
    </div>

    <?php endif; ?>

</main>

<script src="<?php echo get_theme_file_uri('assets/contact.js'); ?>"></script>
<?php get_footer(); ?>

