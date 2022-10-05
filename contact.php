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
    <div class="contact_main">
        <div class="description_p">
            <p>当サイト又は、IPUT学生団体に関するお問い合わせは、下記のお問い合わせフォームよりご連絡ください。<br>
                お問い合わせをする前に、よくある質問（FAQ）に同じ質問がないかご確認ください。<br>
                尚、当サイト又は、IPUT学生団体以外のお問い合わせにつきましてはお答えすることが出来ませんのであらかじめご了承ください。
            </p>
        </div>

        <!-- Bootstrap よくある質問はこちらから -->
        <div class="que_btn">
            <button type="button" class="btn btn-secondary btn-lg">よくある質問はこちらから</button>
        </div>
        <!-- 必須 お名前 -->
        <div class="contact_sum">
            <div class="required_box">
                <h5><span class="badge bg-danger">必須</span></h5>

                <div class="contact_item">
                    <h3><b>お名前</b></h3>
                </div>

            </div>
            <!-- from input text large -->
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="お名前を入力してください" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
        </div>
        <!-- 必須 メールアドレス -->
        <div class="contact_mail">
            <div class="contact_sum">
                <div class="required_box">

                    <h5><span class="badge bg-danger">必須</span></h5>

                    <div class="contact_item">
                        <h3><b>メールアドレス</b></h3>
                    </div>
                </div>
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="メールアドレスを入力してください" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                </div>
            </div>
        </div>
        <!-- from input text large -->

        <!-- 必須 お問い合わせ内容 -->
        <div class="contact_sum">
            <div class="required_box">

                <h5><span class="badge bg-danger">必須</span></h5>

                <div class="contact_item">
                    <h3><b>お問い合わせ内容</b></h3>
                </div>
            </div>
            <!-- from input Textarea -->
            <div class="form-floating">
                <textarea class="form-control" id="floatingTextarea2" style="height: 150px"></textarea>
                <label for="floatingTextarea2"></label>
            </div>
        </div>

        <!-- 左にトップページに戻る(Bootstrap Button　Large Secondary) 右送信する -->
        <div class="top_send_button">
            <button type="button" class="btn btn-secondary btn-lg">トップページへ戻る</button>
            <button type="button" class="btn btn-primary btn-lg">送信する</button>

        </div>
</main>




<!-- フッター -->
<?php footer('index'); ?>