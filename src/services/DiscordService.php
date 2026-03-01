<?php

class DiscordService
{
    /**
     * 参加申請をDiscordに送信する
     */
    public function sendJoinApplication(
        $application_user_name,
        $application_user_display_name,
        $application_user_email,
        $application_discord_user_id,
        $to_discord_guild_id,
        $to_discord_user_id,
        $grade,
        $department,
        $reason,
        $circle_name,
        $post_id
    ) {
        if ($to_discord_guild_id === null && $to_discord_user_id === null) return;

        $url = get_post_meta(1, 'discordbot_api_base', true) . '/circle/join';

        $data = array(
            'application_user_name'         => $application_user_name,
            'application_user_display_name' => $application_user_display_name,
            'application_discord_user_id'   => (int)$application_discord_user_id ?? 0,
            'to_discord_guild_id'           => (int)$to_discord_guild_id ?? 0,
            'to_discord_user_id'            => (int)$to_discord_user_id ?? 0,
            'application_user_email'        => $application_user_email,
            'grade'                         => (int)$grade,
            'department'                    => $department,
            'reason'                        => $reason,
            'club_name'                     => $circle_name,
            'post_id'                       => $post_id,
        );

        $context = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query($data),
            )
        );

        file_get_contents($url, false, stream_context_create($context));
    }

    /**
     * Discord OAuth トークン取得
     */
    public function getOAuthToken($code)
    {
        $url  = 'https://discord.com/api/oauth2/token';
        $data = array(
            'client_id'     => get_option('discord_client_id', '1250622307618132019'),
            'client_secret' => get_option('discord_client_secret', '8RSjnPinR-4LGlPIMWd6bJimCS8ZJM85'),
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => 'https://iput-one.com/index.php/profile/',
        );

        $context = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query($data, "", "&"),
            )
        );

        $response = file_get_contents($url, false, stream_context_create($context));
        return json_decode($response, true);
    }

    /**
     * Discord ユーザー情報取得
     */
    public function getUser($access_token)
    {
        $url     = 'https://discord.com/api/users/@me';
        $context = array(
            'http' => array(
                'method' => 'GET',
                'header' => "Authorization: Bearer $access_token",
            )
        );

        $response = file_get_contents($url, false, stream_context_create($context));
        return json_decode($response, true);
    }
}

/**
 * 後方互換ラッパー
 */
function join_application_send_discord(
    $application_user_name,
    $application_user_display_name,
    $application_user_email,
    $application_discord_user_id,
    $to_discord_guild_id,
    $to_discord_user_id,
    $grade,
    $department,
    $reason,
    $circle_name,
    $post_id
) {
    (new DiscordService())->sendJoinApplication(
        $application_user_name,
        $application_user_display_name,
        $application_user_email,
        $application_discord_user_id,
        $to_discord_guild_id,
        $to_discord_user_id,
        $grade,
        $department,
        $reason,
        $circle_name,
        $post_id
    );
}
