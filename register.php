<!-- 登録ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('register', '登録 | IPUT学生団体');
?>

<main class="contents" style="background-image: url('src/register_bg_img.png')">
    <!-- 登録フォーム -->
    <div class="container w-100 h-100 d-flex align-items-center justify-content-center p-5" id="form-login">
        <form class="row row-cols-1 g-3 p-4 pb-5 max-width-md">

            <div class="container col col-md-8">
                <label class="form-label" for="user-input">ユーザー名</label>
                <input type="user" class="form-control" id="user-input" value="" placeholder="ユーザー名を入力してください"
                    aria-label="ユーザー名" aria-describedby="user-help" required>
                <div class="form-text" id="user-help"></div>
                <div class="invalid-feedback">正しいメールアドレスを入力してください</div>
            </div>

            <div class="container col col-md-8">
                <label class="form-label" for="password-input">パスワード</label>
                <input type="password" class="form-control" id="password-input" value=""
                    placeholder="パスワードを入力してください" aria-label="パスワード" aria-describedby="password-help" required>
                <div class="form-text" id="password-help"></div>
                <div class="invalid-feedback">正しいパスワードを入力してください</div>
            </div>
            
            <div class="container col col-md-8 d-flex justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" id="keep-input" type="checkbox" value="" aria-label="ログイン状態の維持"
                        aria-describedby="keep-help">
                    <label class="form-check-label" for="keep-input">ログイン状態を維持しますか？</label>
                    <div class="form-text" id="keep-help">共有のパソコンではチェックを外す</div>
                </div>
            </div>
            <div class="container col col-md-8 d-flex justify-content-center">
                <button class="btn btn-success" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</main>

<!-- フッター -->
<?php footer('index'); ?>