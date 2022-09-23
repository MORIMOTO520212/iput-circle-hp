<?php
/* Template Name: ログイン */

session_start();

/* トークンの生成（login.phpの検証） */
$token = bin2hex(random_bytes(32));
$_SESSION['token'] = $token;

/* login.phpからリダイレクトするときに使う */
$_SESSION['referrer'] = get_the_permalink();

/* ログインエラー処理 */
$error_title    = "";
$error_contents = "";
if ( isset($_GET['errorcode']) ) {
    $errorcode = $_GET['errorcode'];
    if ( 1 == $errorcode ) {
        $error_title = "ログインに失敗しました。";
        $error_contents = "トークンが異なるためログインに失敗しました。<br>ページを更新してから再度試してください。";
    }
}


get_header();
?>

<main class="contents" style="background-image: url('<?=get_theme_file_uri('src/firstView_Image.jpg')?>')">
    <!-- LOGIN FORM -->
    <div class="container max-width-md w-100 h-100 d-flex align-items-center justify-content-center p-5" id="form-login">
        <form class="row row-cols-1 g-3 p-4 pb-5 max-width-md" id="form" action="#">

            <div class="container col col-md-8">
                <label class="form-label" for="email-input">ユーザー名またはメールアドレス</label>
                <input type="email" class="form-control" id="email-input" name="email" value="" placeholder="メールアドレスを入力してください"
                    aria-label="メールアドレス" aria-describedby="email-help" required>
                <div class="form-text" id="email-help">大学のメールアドレス</div>
                <div class="invalid-feedback">正しいメールアドレスを入力してください</div>
            </div>

            <div class="container col col-md-8">
                <label class="form-label" for="password-input">パスワード</label>
                <input type="password" class="form-control" id="password-input" name="password" value=""
                    placeholder="パスワードを入力してください" aria-label="パスワード" aria-describedby="password-help" required>
                <div class="form-text" id="password-help"></div>
                <div class="invalid-feedback">正しいパスワードを入力してください</div>
            </div>

            <div class="container col col-md-8 d-flex justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" id="keep-input" name="keep_loggedin" type="checkbox" value="1" aria-label="ログイン状態の維持"
                        aria-describedby="keep-help">
                    <label class="form-check-label" for="keep-input">ログイン状態を維持しますか？</label>
                    <div class="form-text" id="keep-help">共有のパソコンではチェックを外す</div>
                </div>
            </div>

            <input type="hidden" name="token" value="<?php echo $token; ?>">

            <div class="container col col-md-8 d-flex justify-content-center">
                <button class="btn btn-success submitBtn" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header alert alert-warning">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo $error_title; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php echo $error_contents; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">わかりました</button>
        </div>
        </div>
    </div>
</div>

<script>
    // Insert post url into the form before POST.
    $('#form').submit(function() {
        $(this).attr('action', '<?php echo get_theme_file_uri('login.php'); ?>')
    });

    // Alert
    var options = "keyboard";
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), options);
    <?php
    if ( isset($_GET['errorcode']) ) :
    ?>
    myModal.show();
    <?php endif; ?>

</script>

<?=get_footer()?>