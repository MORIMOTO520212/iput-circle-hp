<?php
/* Template Name: signup_user.php */

/*
仮のユーザーを作成する
wpmu_signup_user( $user, $user_email, $meta = '' )

有効化メールを送信する
wpmu_signup_user_notification( $user, $user_email, $key, $meta )

　本文を編集する
　function signup_notice_content( $content ){
　    $content = "";
　    return $content;
　}
　add_filter('wpmu_signup_user_notification_email', 'signup_notice_content', 10, 1 )
*/

get_header();


if ( isset( $_POST['submit_type'] ) && $_POST['submit_type'] === "signup_user" ) {
    wpmu_signup_user( $user, $user_email, $meta = '' );
}

?>

<form action="" method="post">

    <label for="username">username:</label>
    <input type="text" id="username" name="username" value="">

    <label for="email">email:</label>
    <input type="text" id="email" name="email" value="">

    <button type="submit" name="submit_type" value="signup_user">送信</button>
</form>

<?php get_footer(); ?>