<!-- お問い合わせページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('contact', 'お問い合わせ | IPUT学生団体');
?>

<?php
//var_dump($_POST);

$page_flag = 0;
if( !empty($_POST['btn_sub']) ) {

	$page_flag = 1;




    $header = null;
	$auto_reply_subject = null;
	$auto_reply_text = null;
	$admin_reply_subject = null;
	$admin_reply_text = null;
	date_default_timezone_set('Asia/Tokyo');

	// ヘッダー情報を設定
	$header = "MIME-Version: 1.0\n";
	$header .= "From: GRAYCODE <noreply@gray-code.com>\n";
	$header .= "Reply-To: GRAYCODE <noreply@gray-code.com>\n";

	// 件名を設定
	$auto_reply_subject = 'お問い合わせありがとうございます。';

	// 本文を設定
	$auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。
下記の内容でお問い合わせを受け付けました。\n\n";
	$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$auto_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$auto_reply_text .= "メールアドレス：" . $_POST['Email'] . "\n\n";
	$auto_reply_text .= "GRAYCODE 事務局";

	// メール送信
	mb_send_mail( $_POST['Email'], $auto_reply_subject, $auto_reply_text, $header);

	// 運営側へ送るメールの件名
	$admin_reply_subject = "お問い合わせを受け付けました";
	
	// 本文を設定
	$admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
	$admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$admin_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$admin_reply_text .= "メールアドレス：" . $_POST['Email'] . "\n\n";

	// 運営側へメール送信
	mb_send_mail( 'iputone.staff@gmail.com', $admin_reply_subject, $admin_reply_text, $header);



}
?>



<main class="contents">




<!--ここから>
<?php if( $page_flag === 1 ): ?>


    <div class="contact-message-container">
    <div class="contact-message-wrapper">
        <h1 class="contact-main-message">お問い合わせありがとうございました！</h1>
        <h4 class="contact-body-message">
            <span>
                この度は、IPUTに関するお問い合わせをいただき<br>
                誠にありがとうございます。<br>
                3日以内に、担当者よりご連絡いたします。                    
            </span>
        </h4>
        <img src="src/thanks.png" alt="Thank You!!">
    </div>
    </div>
</form>



<?php else: ?>


    <!-- top -->
    <div class="position-relative" id="contact-top">
        <img src="src/contact-top-img.jpg" class="w-100">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="text-center text-white">
                <!-- お問い合わせ -->
                <h1>お問い合わせ</h1>
                <!-- CONTACT -->
                <h3>CONTACT</h3>
            </div>
        </div>
    </div>



    <!-- main -->
    <div class="contact_main container">
        <div class="row">
            <div class="description_p">
                <p>当サイト又は、IPUT学生団体に関するお問い合わせは、下記のお問い合わせフォームよりご連絡ください。<br>
                    お問い合わせをする前に、よくある質問（FAQ）に同じ質問がないかご確認ください。<br>
                    尚、当サイト又は、IPUT学生団体以外のお問い合わせにつきましてはお答えすることが出来ませんのであらかじめご了承ください。
                </p>
            </div>

            <!-- Bootstrap よくある質問はこちらから -->
            <div class="que_btn">
                <a href="http://localhost/iput-circle-hp/faq.php">
                    <button type="button" class="btn btn-secondary btn-lg">よくある質問はこちらから(行先がlocal)</button>
                </a>
            </div>
            <!-- 必須 お名前 -->
            <form class="row g-3 needs-validation" method="post" action="" novalidate>
                <div class="required_box">
                    <h5><span class="badge bg-danger">必須</span></h5>

                    <div class="contact_item">
                        <h3><b>お名前</b></h3>
                    </div>

                </div>
                <!-- from input text large -->
                <div class="col-lg-6">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" name="your_name" placeholder="お名前を入力してください" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="" required>
                        <div class="invalid-feedback">
                            入力をお願いします。
                        </div>
                    </div>

                </div>

                <!-- 必須 メールアドレス -->
                <div class="contact_mail">
                </div>

                <div class="required_box">

                    <h5><span class="badge bg-danger">必須</span></h5>

                    <div class="contact_item">
                        <h3><b>メールアドレス</b></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" placeholder="メールアドレスを入力してください" name="Email" aria-label="Sizing example input" aria-describedby="email-help" value="" required>
                        <div class="invalid-feedback">
                            正しいメールアドレスを入力してください。
                        </div>
                    </div>

                </div>
                <div class="contact_mail"></div>

                <!-- from input text large -->

                <!-- 必須 お問い合わせ内容 -->

                <div class="required_box">

                    <h5><span class="badge bg-danger">必須</span></h5>

                    <div class="contact_item">
                        <h3><b>お問い合わせ内容</b></h3>
                    </div>
                </div>
                <!-- from input Textarea -->
                <div class="col-lg-6">
                    <div class="form-floating">
                        <textarea class="form-control" name="contact" id="floatingTextarea2" style="height: 150px"  required></textarea>

                    </div>
                </div>

                <!-- 左にトップページに戻る(Bootstrap Button　Large Secondary) 右送信する -->
                <div class="top_send_button">
                    <div class="col-3">
                        <a href="http://localhost/iput-circle-hp/index.php">
                            <button type="button" class="btn btn-secondary btn-lg">トップページへ戻る(local)</button>
                        </a>
                    </div>


                    <div class="col-3">
                        <input type="submit" name="btn_sub"  class="btn btn-primary btn-lg" value="送信する" require>

                        
                    </div>
                </div>
            </form>
        </div>
    </div>





    <?php endif; ?>

</main>




<!-- フッター -->
<?php footer('index'); ?>

<script src="assets/contact.js"></script>