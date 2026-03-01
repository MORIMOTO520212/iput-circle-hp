<?php

class DiscordController
{
    private $discordService;
    private $mailService;

    public function __construct()
    {
        $this->discordService = new DiscordService();
        $this->mailService    = new MailService();
    }

    /**
     * Discord OAuth 認証処理
     */
    public function authenticate()
    {
        $param_code = get_params('code');

        try {
            $oauthResponse = $this->discordService->getOAuthToken($param_code);
        } catch (Exception $e) {
            modal('認証に失敗しました。。', $e->getMessage());
            return;
        }

        try {
            $userResponse = $this->discordService->getUser($oauthResponse['access_token']);
        } catch (Exception $e) {
            modal('ユーザーの取得に失敗しました。', $e->getMessage());
            return;
        }

        $user = wp_get_current_user();
        add_user_meta($user->ID, 'discord_access_token',  $oauthResponse['access_token'],  true);
        add_user_meta($user->ID, 'discord_refresh_token', $oauthResponse['refresh_token'], true);
        add_user_meta($user->ID, 'discord_user_id',       $userResponse['id'],             true);
        add_user_meta($user->ID, 'discord_avatar',        $userResponse['avatar'],         true);

        modal('Discordの連携が正常に行われました。', 'IPUT ONEのアカウントをDiscordと連携させることで、さまざまなIPUT ONEの機能をDiscordで使うことができます。');
    }

    /**
     * サークルへの参加申請処理
     */
    public function participationApplication()
    {
        if (!isset($_POST['grade'], $_POST['department'], $_POST['reason'], $_POST['postID'])) {
            modal('エラー', '不正なリクエストです。');
            return;
        }

        if (!in_array($_POST['grade'], array('1', '2', '3', '4', '教授'), true)) {
            modal('不正なリクエストです', 'もう一度お試しください。');
            return;
        }
        if (!in_array($_POST['department'], array('情報工学科', 'デジタルエンタテイメント学科', '他大学', 'その他'), true)) {
            modal('不正なリクエストです', 'もう一度お試しください。');
            return;
        }
        if (mb_strlen($_POST['reason']) > 500) { input_value_error_exit(); return; }

        $circle_post = get_post($_POST['postID']);
        $user        = wp_get_current_user();

        if ($user->ID === 0) {
            modal('不正なリクエストです', 'ログインしてからお試しください。');
            return;
        }

        $login_user_email = get_user_option('user_email', $user->ID);
        $user_id          = $user->ID;
        $approval_key     = substr(md5($user_id . $_POST['postID']), 0, 16);
        $approval_url     = home_url("index.php/post-circle/?_post=edit&id={$_POST['postID']}&userid={$user_id}&approval_key={$approval_key}");

        $to      = get_post_custom($_POST['postID'])['contactMailAddress'][0];
        $subject = "【{$circle_post->post_title}】参加申請が届きました。";
        $message = "
{$user->last_name} {$user->first_name}さんからサークルへ参加申請が届きました。

学年：{$_POST['grade']}年
学科：{$_POST['department']}
メールアドレス：{$login_user_email}

参加理由
--------------------
{$_POST['reason']}

参加を承認する場合は以下のリンクにアクセスしてください。
{$approval_url}


============================
IPUT ONEへのお問い合わせはこのメールに返信してください。
IPUT ONE制作チーム
iputone.staff@gmail.com
";
        $this->mailService->send($to, $subject, $message);

        $author_id                     = get_post_field('post_author', $_POST['postID']);
        $first_name                    = get_user_option('first_name', $user_id);
        $last_name                     = get_user_option('last_name', $user_id);
        $application_user_display_name = "{$last_name} {$first_name}";
        $application_discord_user_id   = get_user_meta($user->ID, 'discord_user_id', true) ?? null;
        $to_discord_guild_id           = get_post_custom($_POST['postID'])['discordGuildId'][0] ?? null;
        $to_discord_user_id            = get_user_meta($author_id, 'discord_user_id', true) ?? null;
        $grade                         = $_POST['grade'] === '教授' ? 5 : (int)$_POST['grade'];

        if (get_post_meta(1, 'discordbot_api_base', true)) {
            $this->discordService->sendJoinApplication(
                application_user_name: $user->display_name,
                application_user_display_name: $application_user_display_name,
                application_user_email: $user->user_email,
                application_discord_user_id: $application_discord_user_id,
                to_discord_guild_id: $to_discord_guild_id,
                to_discord_user_id: $to_discord_user_id,
                grade: $grade,
                department: $_POST['department'],
                reason: $_POST['reason'],
                circle_name: $circle_post->post_title,
                post_id: $_POST['postID'],
            );
        }

        modal('申請が完了しました', '参加完了メールをお待ちください。');
    }

    /**
     * サークルへのお問い合わせ処理
     */
    public function circleContact()
    {
        if (!isset($_POST['grade'], $_POST['department'], $_POST['contactbody'], $_POST['postID'])) {
            modal('エラー', '不正なリクエストです。');
            return;
        }

        if (!in_array($_POST['grade'], array('1', '2', '3', '4', '教授'), true)) {
            modal('不正なリクエストです', 'もう一度お試しください。');
            return;
        }
        if (!in_array($_POST['department'], array('情報工学科', 'デジタルエンタテイメント学科', '他大学', 'その他'), true)) {
            modal('不正なリクエストです', 'もう一度お試しください。');
            return;
        }
        if (mb_strlen($_POST['contactbody']) > 500) { input_value_error_exit(); return; }

        $circle_post      = get_post($_POST['postID']);
        $user             = wp_get_current_user();

        if ($user->ID === 0) {
            modal('不正なリクエストです', 'ログインしてからお試しください。');
            return;
        }

        $login_user_email = get_user_option('user_email', $user->ID);
        $to               = get_post_custom($_POST['postID'])['contactMailAddress'][0];
        $subject          = "【IPUT ONE】{$circle_post->post_title}についてお問い合わせを頂いております。";
        $message          = "
{$user->last_name} {$user->first_name}さんからお問い合わせがありました。

学年：{$_POST['grade']}年
学科：{$_POST['department']}
メールアドレス：{$login_user_email}

お問い合わせ内容
--------------------
{$_POST['contactbody']}


============================
IPUT ONEへのお問い合わせはこのメールに返信してください。
IPUT ONE制作チーム
iputone.staff@gmail.com
";
        $this->mailService->send($to, $subject, $message);
        modal('お問い合わせが完了しました', '返信をお待ちください。');
    }
}
