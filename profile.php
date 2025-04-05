<?php

/**
 *  Template Name: アカウント情報
 */
?>

<?php

/* ログイン状態のチェック */
if (!is_user_logged_in()) {
    echo "ログインしてください。";
    exit;
}

$param_t = get_params('t'); // パラメータ取得

// ログアウト処理
if (isset($param_t) && $param_t === "logout") {
    wp_logout();
    wp_redirect(home_url());
    exit;
}


/* ユーザープロファイル情報取得 */
$user_id = wp_get_current_user()->id;
$firstname = get_user_option('first_name', $user_id);
$lastname = get_user_option('last_name', $user_id);
$username = get_user_option('user_login', $user_id);
$displayname = get_user_option('display_name', $user_id);
$email = get_user_option('user_email', $user_id);

$export_data = [
    'title' => get_the_title(),
    'userId' => $user_id,
    'userName' => $username,
    'firstName' => $firstname,
    'lastName' => $lastname,
    'displayName' => $displayname,
    'email' => $email,
    'nonceHtml' => wp_nonce_field(action: 'vpd8NFzp', name: 'profile_nonce'),
    'themeFileUri' => get_theme_file_uri()
];

$discord_user_id = get_user_meta($user_id, 'discord_user_id', true) ?? "";
$discord_avatar = get_user_meta($user_id, 'discord_avatar', true) ?? "";
$discord_avatar_url = $discord_user_id && $discord_avatar ? "https://cdn.discordapp.com/avatars/$discord_user_id/$discord_avatar.png?size=256" : "";
?>

<?php get_header(); ?>

<!-- <div id="profilePage"></div> -->

<!-- コンテンツ -->
<div class="main mx-2 mb-5">
    <h2 class="txt-subject text-center"><?php the_title(); ?></h2>
    <form id="profile" class="form-loading container row-cols-1 g-3 mb-5 max-width-sm" action="" method="post" novalidate style="padding: 30px 40px;">
        <?php
        if ($discord_avatar_url) {
        ?>
            <div class="mb-3 w-100 d-flex justify-content-center">
                <img src="<?= $discord_avatar_url ?>" class="w-25 rounded-circle" />
            </div>
        <?php
        }
        ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" disabled>
            <label for="username">ユーザー名（変更できません）</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="displayname"
                placeholder="" name="displayname" value="<?php echo $displayname; ?>" disabled>
            <label for="displayname">表示名</label>
        </div>
        <div class="wrapper-name" style="width: 100%;">
            <div class="form-floating mb-3" style="width: 49%;">
                <input type="text" autocomplete="family-name" class="form-control"
                    id="lastname" placeholder="" name="lastname" value="<?php echo $lastname; ?>" disabled>
                <label for="lastname">姓</label>
            </div>
            <div class="form-floating mb-3" style="width: 49%;">
                <input type="text" autocomplete="given-name" class="form-control"
                    id="firstname" placeholder="" name="firstname" value="<?php echo $firstname; ?>" disabled>
                <label for="firstname">名</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
            <label for="email">メールアドレス（変更できません）</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" placeholder="" name="password" value="" disabled>
            <label for="password">新しいパスワード</label>
        </div>

        <?php
        // $action引数の文字列はパスワードではありません.
        wp_nonce_field('vpd8NFzp', 'profile_nonce');
        ?>

        <!-- button -->
        <div class="d-flex justify-content-end mb-3">
            <button id="edit" class="btn btn-success" type="submit" name="submit_type" value="profile">編集する</button>
        </div>

        <div class="mb-3">
            <p class="mb-2 fw-bold">アカウント連携</p>
            <a href="https://discord.com/oauth2/authorize?client_id=1250622307618132019&response_type=code&redirect_uri=https%3A%2F%2Fiput-one.com%2Findex.php%2Fprofile%2F&scope=identify" class="discord-button mb-2">
                <img src="<?= get_theme_file_uri('src/Discord-Symbol-White.svg'); ?>" />
                <p class="text-white">Discordと連携する</p>
            </a>
            <small class="d-block"><strong>STEP1:</strong> IPUT ONEのアカウントをDiscordと連携させることで、さまざまなIPUT ONEの機能をDiscordで使うことができます。</small>
        </div>

        <div class="mb-5">
            <a class="discord-button mb-2" href="https://discord.com/oauth2/authorize?client_id=1250622307618132019">
                <p class="text-white">Discord Botをインストールする</p>
            </a>
            <small class="d-block"><strong>STEP2:</strong> アカウント連携後にDiscord Botをお使いのアカウントにインストールしてください。</small>
        </div>

        <div class="d-flex justify-content-between gap-2">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#accountDel">アカウントを削除する</button>
            <a class="btn btn-warning" href="./?t=logout" role="button">ログアウトする</a>
        </div>
        <small class="text-secondary">一度削除すると元に戻せません</small>
    </form>

    <div class="modal fade" id="accountDel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">本当にアカウントを削除しますか？</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-dismiss="modal" style="font-size: 10px;"></button>
                </div>
                <div class="modal-body">
                    <label>一度削除したアカウントはもとに戻すことができません。</label>
                    <label>もう一度ご利用になるには、再登録してください。</label>
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <button type="submit" class="btn btn-danger" name="submit_type" value="delete">アカウントを削除する</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var flag = 1;
    $("form#profile").submit(function() {
        if (flag) {
            $("#edit").text("更新する");
            $("#displayname").prop("disabled", false);
            $("#lastname").prop("disabled", false);
            $("#firstname").prop("disabled", false);
            $("#password").prop("disabled", false);
            setTimeout(() => {
                document.querySelector('.loading').classList.add('d-none');
            }, 500);
            flag = 0;
            return false;
        }
    });
</script>

<script type="application/json" id="__REACT_DATA__">
    <?php echo json_encode($export_data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>
</script>

<?php get_footer(); ?>