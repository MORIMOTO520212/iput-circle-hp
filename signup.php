<?php
/**
 *  Template Name: サインアップ
 */
?>

<?php get_header(); ?>


<main class="bg" style="background-image: url('<?php echo get_theme_file_uri('src/background/student-salon-blue.webp'); ?>');">
    <div class="container pt-5 pb-5">
        <div class="d-flex justify-content-center align-items-center">
            <style>
                .signup-form {
                    border-radius: 12px;
                }
                .signup-form > :nth-child(n) {
                    margin-top: 1rem;
                }
            </style>

            <?php
            /* 登録画面 */
            if( isset( $_GET['t'] ) === false ):
            ?>

            <form action="" method="post" class="d-flex flex-column px-5 py-3 signup-form needs-validation" novalidate>
                <h3>ようこそ！</h3>
                <div class="mt-0">
                    <label for="username">ユーザー名</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="ユーザー名" aria-label="ユーザー名" aria-describedby="username-help" required>
                    <div class="form-text" id="username-help">投稿者の名前として公開されます</div>
                    <div class="invalid-feedback">入力必須です</div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 gy-2 gy-md-0">
                    <div class="col">
                        <label for="lastname">姓</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="姓" aria-label="姓" aria-describedby="lastname-help" required>
                        <div class="form-text" id="lastname-help">Last name</div>
                        <div class="invalid-feedback">入力必須です</div>
                    </div>
                    <div class="col">
                        <label for="firstname">名</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="名" aria-label="名" aria-describedby="firstname-help" required>
                        <div class="form-text" id="firstname-help">First name</div>
                        <div class="invalid-feedback">入力必須です</div>
                    </div>
                </div>
                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="メールアドレス" aria-label="メールアドレス" aria-describedby="email-help" required>
                    <div class="form-text" id="email-help">大学のメールアドレスのみ</div>
                    <div class="invalid-feedback">メールアドレスの形式が違います</div>
                </div>
                <div>
                    <label for="password">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="パスワード" aria-label="パスワード" aria-describedby="password-help" required>
                    <div class="form-text" id="password-help">半角英数字記号6文字以上で入力してください</div>
                    <div class="invalid-feedback">入力必須です</div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" name="submit_type" class="btn btn-success" value="signup">アカウントを作成する</button>
                </div>
                <a class="text-center" href="<?php echo home_url('index.php/login'); ?>">ここからログインする</a>
                <?php wp_nonce_field( 'N9zxfbth', 'signup_nonce' ); ?>
            </form>

            <?php
            /* 確認画面 */
            elseif ( $_GET['t'] === 'confirm' ):
            ?>

            <form action="" method="post" class="d-flex flex-column px-5 py-3 signup-form needs-validation">
                <h3>確認メールを送信しました。</h3>
                <p>メールをご確認いただき、メールに記載されたURLをクリックして、IPUT ONEへの登録を完了してください。</p>
            </form>

            <?php
            /* 承認画面 */
            elseif ( $_GET['t'] === 'auth' ):
            $res = user_activation( $_GET['token'] );
            if ( $res ):
            ?>

            <form action="" method="post" class="d-flex flex-column px-5 py-3 signup-form needs-validation">
                <h3>登録が完了しました。</h3>
                <p>アカウント登録が正常に完了致しました。右上のマイページから記事を投稿することができます。</p>
            </form>

            <?php
            endif;
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>