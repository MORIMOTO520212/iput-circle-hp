<?php

class MailService
{
    /**
     * GoogleのSMTPサーバーを使ってメール送信
     */
    public function send($to, $subject, $message)
    {
        $gas_deploy_id = get_post_meta(1, 'gas_deploy_id', true);
        $post_url      = "https://script.google.com/macros/s/$gas_deploy_id/exec";
        $admin_email   = get_option('admin_email');

        if (!$admin_email) {
            return false;
        }

        $post_data = array(
            "toAddress" => $to,
            "subject"   => $subject,
            "message"   => $message,
        );

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $post_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($post_data),
        ]);
        curl_exec($ch);
        curl_close($ch);

        return true;
    }
}

/**
 * 後方互換ラッパー
 */
function my_sendmail($to, $subject, $message)
{
    return (new MailService())->send($to, $subject, $message);
}

function my_gas_sendmail($to, $subject, $message, $headers = "")
{
    $admin_email = get_option('admin_email');
    if (!$admin_email) {
        return false;
    }
    return true;
}
