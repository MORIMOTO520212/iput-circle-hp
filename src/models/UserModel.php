<?php

class UserModel
{
    /**
     * ユーザーの仮登録
     * ユーザー情報をsignupsテーブルに保持し、認証リンクを返す。
     * @return array|false array($activation_key, $user_approval_url) | false
     */
    public function createProvisional($user_login, $user_email, $password, $first_name, $last_name)
    {
        global $wpdb;

        $user_login = preg_replace('/\s+/', '', sanitize_user($user_login, true));
        $user_email = sanitize_email($user_email);

        $activation_key = substr(md5(time() . wp_rand() . $user_email), 0, 16);

        $res = $wpdb->insert(
            $wpdb->signups,
            array(
                'user_login'      => $user_login,
                'user_email'      => $user_email,
                'password'        => $password,
                'first_name'      => $first_name,
                'last_name'       => $last_name,
                'user_registered' => current_time('mysql', true),
                'activation_key'  => $activation_key,
            )
        );

        if ($res) {
            $user_approval_url = home_url('/index.php/signup?token=' . $activation_key);
            return array($activation_key, $user_approval_url);
        }
        return false;
    }

    /**
     * 仮登録データを activation_key で取得する
     */
    public function findProvisionalByKey($activation_key)
    {
        global $wpdb;
        $key  = esc_sql($activation_key);
        $rows = $wpdb->get_results("SELECT * FROM {$wpdb->signups} WHERE activation_key='{$key}'");
        return !empty($rows) ? $rows[0] : null;
    }

    /**
     * 仮登録ユーザーの氏名を取得する
     */
    public function findNameByKey($activation_key)
    {
        global $wpdb;
        $key = esc_sql($activation_key);
        return $wpdb->get_results("SELECT first_name, last_name FROM {$wpdb->signups} WHERE activation_key='{$key}'");
    }

    /**
     * 仮登録レコードを削除する
     */
    public function deleteProvisional($activation_key)
    {
        global $wpdb;
        $key = esc_sql($activation_key);
        $wpdb->get_results("DELETE FROM {$wpdb->signups} WHERE activation_key='{$key}'");
    }

    /**
     * ユーザーを本登録する
     * @return int|WP_Error user_id
     */
    public function createUser($userdata)
    {
        return wp_insert_user($userdata);
    }

    /**
     * ユーザー情報を更新する
     * @return int|WP_Error user_id
     */
    public function updateUser($userdata)
    {
        return wp_update_user($userdata);
    }
}
