<?php
/* Template Name: ログイン */


get_header();


// ユーザー認証
if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    $creds = array();
    $creds['user_login'] = $_POST['email'];
    $creds['user_password'] = $_POST['password'];
    if( isset($_POST['keep_loggedin']) ) {
        $creds['remember'] = true;
    }
    $user = wp_signon($creds);

    if( is_wp_error($user) ) {
        // ログイン失敗時
?>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none;">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header alert alert-warning">
                    <h5 class="modal-title" id="exampleModalLabel">ログインに失敗しました。</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $user->get_error_message(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">わかりました</button>
                </div>
                </div>
            </div>
        </div>
        <script>
            window.onload = () => {
                var elem = $('#myModal');
                var options = "keyboard";
                elem.removeClass('display'); // display:none解除
                var myModal = new bootstrap.Modal(elem, options);
                myModal.show();
            }
        </script>
<?php
    } else {
        // ログイン成功時 トップページに遷移
        wp_redirect( home_url() );
    }
}
?>

<main class="contents" style="background-image: url('<?=get_theme_file_uri('src/firstView_Image.jpg')?>')">
    <!-- LOGIN FORM -->
    <div class="container max-width-md w-100 h-100 d-flex align-items-center justify-content-center p-5" id="form-login">
        <form class="row row-cols-1 g-3 p-4 pb-5 max-width-md needs-validation" id="form" action="" method="post" novalidate>

            <div class="container col col-md-8">
                <label class="form-label" for="email-input">ユーザー名またはメールアドレス</label>
                <input type="email" class="form-control" id="email-input" name="email" value="" placeholder="ユーザー名またはメールアドレスを入力してください"
                    aria-label="メールアドレス" aria-describedby="email-help" required>
                <div class="form-text" id="email-help">大学のメールアドレス</div>
                <div class="invalid-feedback">
                    入力必須です
                </div>
            </div>

            <div class="container col col-md-8">
                <label class="form-label" for="password-input">パスワード</label>
                <input type="password" class="form-control" id="password-input" name="password" value=""
                    placeholder="パスワードを入力してください" aria-label="パスワード" aria-describedby="password-help" required>
                <div class="form-text" id="password-help"></div>
                <div class="invalid-feedback">
                    入力必須です
                </div>
            </div>

            <div class="container col col-md-8 d-flex justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" id="keep-input" name="keep_loggedin" type="checkbox" value="forever" aria-label="ログイン状態の維持"
                        aria-describedby="keep-help">
                    <label class="form-check-label" for="keep-input">ログイン状態を維持しますか？</label>
                    <div class="form-text" id="keep-help">
                        共有のパソコンではチェックを外す
                    </div>
                </div>
            </div>

            <div class="container col col-md-8 d-flex justify-content-center">
                <button class="btn btn-success submitBtn" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</main>

<script>
    // Insert post url into the form before POST.
    $('#form').submit(function() {
        $(this).attr('action', '<?php echo get_the_permalink(); ?>');
    });
</script>

<?=get_footer()?>