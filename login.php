<?php
/**
 * Template Name: ログインページ
 */
?>

<?php
require_once( get_theme_file_path('assets/components/form_loading.php') );

get_header();
?>

<main class="contents" style="background-image: url('<?php echo get_theme_file_uri('src/background/student-salon-blue.webp'); ?>')">
    <!-- LOGIN FORM -->
    <div class="form-loading container max-width-md w-100 h-100 d-flex align-items-center justify-content-center p-5" id="form-login">
        <form class="row row-cols-1 g-3 p-4 pb-5 max-width-md needs-validation" id="form" action="" method="post" novalidate>

            <div class="container col col-md-8">
                <label class="form-label" for="login">ユーザー名またはメールアドレス</label>
                <input type="text" class="form-control" id="login" name="login" value="" placeholder="ユーザー名またはメールアドレスを入力してください"
                    aria-label="メールアドレス" aria-describedby="login-help" required>
                <div class="form-text" id="login-help">大学のメールアドレス</div>
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
                <button class="btn btn-success submitBtn" type="submit" name="submit_type" value="login">ログイン</button>
            </div>
            <?php wp_nonce_field( 'login_nonce_action', 'login_nonce' ); ?>

            <a class="text-center" href="<?php echo home_url('index.php/signup'); ?>">ここから新規登録する</a>
        </form>
    </div>
</main>

<?php form_loading(); ?>

<?php get_footer(); ?>