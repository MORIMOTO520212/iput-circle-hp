<!-- お問い合わせページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('contact', 'お問い合わせ | IPUT学生団体');
?>

<main class="contents">

    <!-- top -->
    <div class="ONE" id="contact-top">
        <img src="src/contact-top-img.jpg" class="w-100">
        <div class="TWO">
            <div class="THREE">
                <!-- お問い合わせ -->
                <h1>お問い合わせ</h1>
                <!-- CONTACT -->
                <h3>CONTACT</h3>
            </div>
        </div>
    </div>

    <!-- main -->
    <div class="">
        <div class="">
            <p>当サイト又は、IPUT学生団体に関するお問い合わせは、下記のお問い合わせフォームよりご連絡ください。<br>
                お問い合わせをする前に、よくある質問（FAQ）に同じ質問がないかご確認ください。<br>
                尚、当サイト又は、IPUT学生団体以外のお問い合わせにつきましてはお答えすることが出来ませんのであらかじめご了承ください。</p>
        </div>

        <!-- Bootstrap よくある質問こちらから -->
        <div class="">
            <button type="button" class="btn btn-secondary btn-lg">トップページへ戻る</button>
        </div>
        <!-- 必須 お名前 -->
        <div class="required_box">

            <h5><span class="badge bg-secondary">必須</span></h5>
            <div class="FOUR">
                <h3><b>お名前</b></h3>
            </div>
        </div>
        <!-- from input text large -->
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">お名前を入力してください</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>
        <!-- 必須 メールアドレス -->
        <div class="required_box">
            <h5><span class="badge bg-secondary">必須</span></h5>
            <div class="FOUR">
                <h3><b>メールアドレス</b></h3>
            </div>
        </div>
        <!-- from input text large -->
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">メールアドレスを入力してください</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>
        <!-- 必須 お問い合わせ内容 -->
        <div class="required_box">
            <h5><span class="badge bg-secondary">必須</span></h5>
            <div class="FOUR">
                <h3><b>お問い合わせ内容</b></h3>
            </div>
        </div>
        <!-- from input Textarea -->
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Comments</label>
        </div>
        <!-- 左にトップページに戻る(Bootstrap Button　Large Secondary) 右送信する -->
        <div class="top_button">
            <button type="button" class="btn btn-secondary btn-lg">トップページへ戻る</button>
        </div>
        <div class="send_button">
            <button type="button" class="btn btn-primary btn-lg">送信する</button>
        </div>




        <!-- フッター -->
        <?php footer('index'); ?>