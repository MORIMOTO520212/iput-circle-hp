<?php
/**
 *  Template Name: アカウント情報
 */
?>

<?php
if( isset($_GET['t']) ) {
    if( $_GET['t'] == "logout" ) {
        wp_logout();
        wp_redirect( home_url() );
        exit;
    }
}

/* ユーザープロファイル情報取得 */
$user_id = wp_get_current_user()->id;
$firstname = get_user_option('first_name', $user_id);
$lastname = get_user_option('last_name', $user_id);
$username = get_user_option('user_login', $user_id);
$displayname = get_user_option('display_name', $user_id);
$email = get_user_option('user_email', $user_id);
?>

<?php get_header(); ?>

<!-- コンテンツ -->
<div class="main mx-2 mb-5">
    <h2 class="txt-subject text-center"><?php the_title(); ?></h2>
    <form class="container row-cols-1 g-3 mb-5 max-width-sm" action="" method="post" novalidate style="padding: 30px 40px;">
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
        <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
        <?php wp_nonce_field( 'profile_nonce_action', 'profile_nonce' ); ?>

        <!-- button -->
        <div class="botton-edit d-flex justify-content-end">
            <button id="edit" class="btn btn-success" type="submit" name="submit_type" value="profile">編集する</button>
        </div>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#accountDel" disabled>アカウントを削除する</button>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">アカウントを削除する</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var flag = 1;
    $("form").submit(function() {
        if(flag) {
            $("#edit").text("更新する");
            $("#displayname").prop("disabled", false);
            $("#lastname").prop("disabled", false);
            $("#firstname").prop("disabled", false);
            $("#password").prop("disabled", false);
            flag = 0;
            return false;
        }
    });
</script>

<?php get_footer(); ?>