<?php

class RequestHook
{
    public function register()
    {
        add_action('after_setup_theme', array($this, 'dispatch'));
    }

    /**
     * POSTリクエストのディスパッチャー
     */
    public function dispatch()
    {
        $submit_type = isset($_POST['submit_type']) ? $_POST['submit_type'] : null;

        if ($submit_type === 'login') {
            if (!isset($_POST['login_nonce'])) return;
            if (!wp_verify_nonce($_POST['login_nonce'], 'N4wcFHsn')) return;
            (new AuthController())->login();
        } elseif ($submit_type === 'signup') {
            if (!isset($_POST['signup_nonce'])) return;
            if (!wp_verify_nonce($_POST['signup_nonce'], 'N9zxfbth')) return;
            $res = (new AuthController())->signup();
            if ($res === true) {
                wp_redirect(home_url('index.php/signup?t=confirm'));
                exit;
            }
        } elseif ($submit_type === 'profile') {
            if (!isset($_POST['profile_nonce'])) return;
            if (!wp_verify_nonce($_POST['profile_nonce'], 'vpd8NFzp')) return;
            (new AuthController())->profileUpdate();
        } elseif (in_array($submit_type, array('post_circle', 'draft_circle', 'edit_circle'), true)) {
            if (!isset($_POST['circle_post_nonce'])) return;
            if (!wp_verify_nonce($_POST['circle_post_nonce'], 'n4Uyh98k')) return;
            (new CircleController())->handlePost();
        } elseif (in_array($submit_type, array('post_activity', 'edit_activity'), true)) {
            if (!isset($_POST['post_activity_nonce'])) return;
            if (!wp_verify_nonce($_POST['post_activity_nonce'], 'Mw8mgUz5')) return;
            (new ActivityController())->handlePost();
        } elseif (in_array($submit_type, array('post_news', 'edit_news'), true)) {
            if (!isset($_POST['post_news_nonce'])) return;
            if (!wp_verify_nonce($_POST['post_news_nonce'], 'Fr4XZRu6')) return;
            (new NewsController())->handlePost();
        } elseif ($submit_type === 'participation_application') {
            if (!isset($_POST['participation_application_nonce'])) return;
            if (!wp_verify_nonce($_POST['participation_application_nonce'], 'M3fHXt2T')) return;
            (new DiscordController())->participationApplication();
        } elseif ($submit_type === 'circle_contact') {
            if (!isset($_POST['circle_contact_nonce'])) return;
            if (!wp_verify_nonce($_POST['circle_contact_nonce'], 'P5kseWwp')) return;
            (new DiscordController())->circleContact();
        } elseif ($submit_type === 'gas_deploy_id') {
            update_post_meta(1, 'gas_deploy_id', $_POST['gas_deploy_id']);
        } elseif ($submit_type === 'discordbot_api_base') {
            update_post_meta(1, 'discordbot_api_base', $_POST['discordbot_api_base']);
        } elseif (get_params('code')) {
            (new DiscordController())->authenticate();
        }
    }
}
