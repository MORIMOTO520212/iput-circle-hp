<?php
/**
 *  Template Name: サインアップ
 */
?>

<?php
require_once( get_theme_file_path('assets/components/form_loading.php') );

$param_token = get_params('token');
$param_t = get_params('t');

// 認証メールに記載されたユーザー承認用リンクからアクセスしたときに、
// ユーザーを有効化する処理を行う。
if ( isset( $param_token ) ) {
    user_activation( $param_token );
}
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
            if( $param_t === null ):
            ?>

            <form action="" method="post" class="d-flex flex-column px-5 py-3 signup-form needs-validation form-loading" novalidate>
                <h3>ようこそ！</h3>
                <div class="mt-0">
                    <label for="username">ユーザー名</label>
                    <input type="text" id="username" minlength="1" maxlength="15" pattern="^[a-zA-Z0-9_]{1,15}$" name="username" class="form-control" placeholder="ユーザー名" aria-label="ユーザー名" aria-describedby="username-help" required>
                    <div class="form-text" id="username-help">投稿者の名前として公開されます</div>
                    <div class="invalid-feedback">ユーザー名は半角英数字+アンダーバーのみです。</div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 gy-2 gy-md-0">
                    <div class="col">
                        <label for="lastname">氏</label>
                        <input type="text" id="lastname" minlength="1" maxlength="20" pattern="^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$" name="lastname" class="form-control" placeholder="氏" aria-label="姓" aria-describedby="lastname-help" required>
                        <div class="form-text" id="lastname-help">Last name</div>
                        <div class="invalid-feedback">名前に数字と記号は使えません。</div>
                    </div>
                    <div class="col">
                        <label for="firstname">名</label>
                        <input type="text" id="firstname" minlength="1" maxlength="20" pattern="^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$" name="firstname" class="form-control" placeholder="名" aria-label="名" aria-describedby="firstname-help" required>
                        <div class="form-text" id="firstname-help">First name</div>
                        <div class="invalid-feedback">名前に数字と記号は使えません。</div>
                    </div>
                </div>
                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" minlength="2" maxlength="50" name="email" class="form-control" placeholder="メールアドレス" aria-label="メールアドレス" aria-describedby="email-help" required>
                    <div class="form-text" id="email-help">大学のメールアドレスのみ</div>
                    <div class="invalid-feedback">メールアドレスの形式が違います</div>
                </div>
                <div>
                    <label for="password">パスワード</label>
                    <input type="password" minlength="6" maxlength="16" pattern="^[ -~]{6,16}$" name="password" id="password" class="form-control" placeholder="パスワード" aria-label="パスワード" aria-describedby="password-help" required>
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
            elseif ( $param_t === 'confirm' ):
            ?>

            <form action="" method="post" class="d-flex flex-column px-5 py-3 signup-form needs-validation">
                <h3>確認メールを送信しました。</h3>
                <p>登録したメールをご確認いただき、メールに記載されたURLをクリックしてIPUT ONEへの登録を完了してください。</p>
            </form>
            <script>
                /* 登録フォームのセッションストレージを削除する */
                sessionStorage.removeItem('username');
                sessionStorage.removeItem('lastname');
                sessionStorage.removeItem('firstname');
                sessionStorage.removeItem('enail');
            </script>

            <?php
            /* ユーザー登録完了画面 */
            elseif ( $param_t === 'done' ):
            ?>

            <form action="" method="post" class="d-flex flex-column px-5 py-3 signup-form needs-validation">
                <h3>登録が完了しました。</h3>
                <p>アカウント登録が正常に完了いたしました。右上のマイページから記事を投稿することができます。</p>
            </form>

            <?php
            /* ユーザー登録エラー画面 */
            elseif ( $param_t === 'error' ):
            ?>

            <form action="" method="post" class="d-flex flex-column px-5 py-3 signup-form needs-validation">
                <h3>登録中にエラーが発生しました。</h3>
                <p>
                    お手数ですが、原因調査のため下記のメールアドレスまでご連絡ください。<br>
                    <?php echo get_option('admin_email'); ?>
                </p>
            </form>

            <?php
            endif;
            ?>
        </div>
    </div>
</main>

<script>
    /* セッションストレージ */
    const e_username  = document.getElementById('username');
    const e_lastname  = document.getElementById('lastname');
    const e_firstname = document.getElementById('firstname');
    const e_email     = document.getElementById('email');

    /* セッションストレージから保持した入力値の取得と設置 */
    e_username.value  = sessionStorage.username ?? '';
    e_lastname.value  = sessionStorage.lastname ?? '';
    e_firstname.value = sessionStorage.firstname ?? '';
    e_email.value     = sessionStorage.email ?? '';


    /* 新規ユーザー登録フォーム入力値の保持 */
    e_username.addEventListener('change', (event) => {
        sessionStorage.username = event.target.value;	
    });

    e_lastname.addEventListener('change', (event) => {
        sessionStorage.lastname = event.target.value;	
    });

    e_firstname.addEventListener('change', (event) => {
        sessionStorage.firstname = event.target.value;	
    });

    e_email.addEventListener('change', (event) => {
        sessionStorage.email = event.target.value;	
    });
</script>

<?php form_loading(); ?>

<?php get_footer(); ?>