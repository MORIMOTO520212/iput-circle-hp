<!-- 登録ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('register', '登録 | IPUT学生団体');
?>

    <!-- コンテンツ -->
    <div class="main">
        <img class="img-background" src="src/register-background.png" alt="">
        <div class="top">
            <!-- ファーストビュー -->
            <div class="register">
                <h4>新規ユーザー登録</h4>
                <p>ユーザー名*</p>
                <!-- Bootstrap 入力フォーム -->
                <input type="text" class="form-control" placeholder="ユーザー名を入力してください" aria-label="Recipient's username" aria-describedby="basic-addon2">

                <p>名*</p>
                <!-- Bootstrap 入力フォーム -->
                <input type="text" class="form-control" placeholder="名を入力してください" aria-label="Recipient's username" aria-describedby="basic-addon2">

                <p>姓*</p>
                <!-- Bootstrap 入力フォーム -->
                <input type="text" class="form-control" placeholder="姓を入力してください" aria-label="Recipient's username" aria-describedby="basic-addon2">

                <p>メール*</p>
                <!-- Bootstrap 入力フォーム -->
                <input type="text" class="form-control" placeholder="メールアドレスを入力してください" aria-label="Recipient's username" aria-describedby="basic-addon2">

                <p>パスワード*</p>
                <!-- Bootstrap 入力フォーム -->
                <input type="text" class="form-control" placeholder="パスワードを入力してください" aria-label="Recipient's username" aria-describedby="basic-addon2">

                <!-- Bootstrap 登録ボタン -->
                <button type="button" class="btn btn-success" style="width: 100px;">登録</button>
            </div>
        </div>
    </div>

<!-- フッター -->
<?php footer('index'); ?>