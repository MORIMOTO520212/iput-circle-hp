<!-- お問い合わせページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('contact', 'お問い合わせ | IPUT学生団体');
?>



<main "contents">

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
            <form class="row g-3 needs-validation" novalidate>
                <div class="required_box">
                    <h5><span class="badge bg-danger">必須</span></h5>

                    <div class="contact_item">
                        <h3><b>お名前</b></h3>
                    </div>

                </div>
                <!-- from input text large -->
                <div class="col-lg-6">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="お名前を入力してください" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                    </div>
                    <div class="valid-feedback">
                        入力完了!
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
                        <input type="text" class="form-control" placeholder="メールアドレスを入力してください" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required>
                    </div>
                    <div class="valid-feedback">
                        入力完了!
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
                        <textarea class="form-control" id="floatingTextarea2" style="height: 150px" required></textarea>
                        <label for="floatingTextarea2"></label>
                    </div>
                </div>
            </form>

            <!-- 左にトップページに戻る(Bootstrap Button　Large Secondary) 右送信する -->
            <div class="top_send_button">
                <div class="col-3">
                    <a href="http://localhost/iput-circle-hp/index.php">
                        <button type="button" class="btn btn-secondary btn-lg">トップページへ戻る(local)</button>
                    </a>
                </div>
                <div class="col-3">
                    <a href="http://localhost/iput-circle-hp/contact-thanks.php">
                        <button type="submit" class="btn btn-primary btn-lg" require>送信する(local)</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>




<!-- フッター -->
<?php footer('index'); ?>