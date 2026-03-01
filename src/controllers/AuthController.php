<?php

class AuthController
{
    private $userModel;
    private $mailService;
    private $validator;

    public function __construct()
    {
        $this->userModel   = new UserModel();
        $this->mailService = new MailService();
        $this->validator   = new ValidationService();
    }

    /**
     * ログイン処理
     */
    public function login()
    {
        $user_login    = isset($_POST['login'])    ? sanitize_text_field($_POST['login'])    : '';
        $user_password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';

        if ($user_login === '' || $user_password === '') return;

        $creds = array(
            'user_login'    => $user_login,
            'user_password' => $user_password,
        );
        if (isset($_POST['keep_loggedin'])) {
            $creds['remember'] = true;
        }

        $user = wp_signon($creds);
        if (is_wp_error($user)) {
            modal('ログインに失敗しました', $user->get_error_message());
            return;
        }

        wp_redirect(home_url("index.php/author/{$user->user_login}"));
        exit;
    }

    /**
     * サインアップ処理
     * @return true|string true - 成功, エラーコード
     */
    public function signup()
    {
        $user_name       = isset($_POST['username'])  ? sanitize_text_field($_POST['username'])  : '';
        $user_pass       = isset($_POST['password'])  ? sanitize_text_field($_POST['password'])  : '';
        $user_email      = isset($_POST['email'])     ? sanitize_text_field($_POST['email'])     : '';
        $user_first_name = isset($_POST['firstname']) ? sanitize_text_field($_POST['firstname']) : '';
        $user_last_name  = isset($_POST['lastname'])  ? sanitize_text_field($_POST['lastname'])  : '';

        if (username_exists($user_name) !== false) {
            modal('登録できません', 'すでにユーザー名「' . $user_name . '」は登録されています。<br>他の名前を入力してください。');
            return "E01";
        }
        if (!$this->validator->validateUsername($user_name)) {
            modal('ユーザー名の入力', 'ユーザー名は半角英数字+アンダーバーのみです。');
            return "E02";
        }
        if (email_exists($user_email) !== false) {
            modal('登録できません', 'すでにメールアドレス「' . $user_email . '」は登録されています。');
            return "E03";
        }
        if (!$this->validator->validateIputEmail($user_email)) {
            modal('登録できません', '学校のメールアドレスのみ登録可能です。使用できるドメインはiput.ac.jpのみです。');
            return "E04";
        }
        if (!$this->validator->validatePassword($user_pass)) {
            modal('パスワードの入力', 'パスワードは半角英数字+記号6～16文字以内で入力してください。');
            return "E05";
        }
        if (!$this->validator->validateName($user_first_name)) {
            modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
            return "E06";
        }
        if (!$this->validator->validateName($user_last_name)) {
            modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
            return "E07";
        }

        $result = $this->userModel->createProvisional($user_name, $user_email, $user_pass, $user_first_name, $user_last_name);
        if ($result) {
            [$activation_key, $user_approval_url] = $result;
            $this->sendApprovalMail($user_email, $activation_key, $user_approval_url);
        } else {
            modal('エラー', 'ユーザーの仮登録に失敗しました');
            return "E08";
        }

        return true;
    }

    /**
     * メール認証によるユーザー有効化
     */
    public function activate($activation_key)
    {
        $user = $this->userModel->findProvisionalByKey($activation_key);

        if ($user) {
            $userdata = array(
                'user_login'   => $user->user_login,
                'user_pass'    => $user->password,
                'user_email'   => $user->user_email,
                'first_name'   => $user->first_name,
                'last_name'    => $user->last_name,
                'display_name' => $user->user_login,
                'role'         => 'author',
            );

            $user_id = $this->userModel->createUser($userdata);
            if (is_wp_error($user_id)) {
                modal('ユーザーの作成に失敗しました', "{$user_id->get_error_code()}<br>{$user_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
                return false;
            }

            $this->userModel->deleteProvisional($activation_key);
            wp_set_auth_cookie($user_id, false, is_ssl());

            $this->mailService->send(
                $user->user_email,
                "【IPUT ONE】メールアドレス認証",
                "IPUT ONEにご登録いただき、ありがとうございます。\n登録が正常に完了しました。\n\n何かご質問がありましたらこのメールにご返信ください。\n\n============================\nIPUT ONE制作チーム\niputone.staff@gmail.com"
            );

            wp_redirect(home_url("index.php/signup?t=done"));
            exit;
        } else {
            wp_redirect(home_url("index.php/signup?t=error"));
        }

        return true;
    }

    /**
     * プロフィール更新
     */
    public function profileUpdate()
    {
        $display_name = isset($_POST['displayname']) ? sanitize_text_field($_POST['displayname']) : null;
        $user_pass    = isset($_POST['password'])    ? sanitize_text_field($_POST['password'])    : null;
        $first_name   = isset($_POST['firstname'])   ? sanitize_text_field($_POST['firstname'])   : null;
        $last_name    = isset($_POST['lastname'])    ? sanitize_text_field($_POST['lastname'])    : null;

        $user_id = wp_get_current_user()->ID;

        if (!$user_id) {
            modal('更新できませんでした', 'もう一度試してください。E01');
            return;
        }

        $userdata = array('ID' => $user_id);

        if ($display_name) {
            if ($this->validator->validateDisplayName($display_name)) {
                $userdata['display_name'] = $display_name;
            } else {
                modal('表示名の入力', '表示名は半角英数字+アンダースコア4～12文字で入力してください。');
                return;
            }
        }
        if ($user_pass) {
            if ($this->validator->validatePassword($user_pass)) {
                $userdata['user_pass'] = $user_pass;
            } else {
                modal('パスワードの入力', 'パスワードは半角英数字+記号6～16文字以内で入力してください。');
                return;
            }
        }
        if ($first_name) {
            if ($this->validator->validateName($first_name)) {
                $userdata['first_name'] = $first_name;
            } else {
                modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
                return;
            }
        }
        if ($last_name) {
            if ($this->validator->validateName($last_name)) {
                $userdata['last_name'] = $last_name;
            } else {
                modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
                return;
            }
        }

        $result = $this->userModel->updateUser($userdata);

        if (is_wp_error($result)) {
            modal('ユーザーの更新に失敗しました', "{$result->get_error_code()}<br>{$result->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
        } else {
            modal('更新が完了しました', 'ユーザープロフィールの更新が正常に完了しました。');
        }
    }

    private function sendApprovalMail($user_email, $activation_key, $user_approval_url)
    {
        $rows = $this->userModel->findNameByKey($activation_key);
        $name = $rows[0]->last_name . " " . $rows[0]->first_name;

        $message = "
{$name} 様

IPUT ONEにご登録いただき、ありがとうございます。
本メールは、ご登録いただいたメールアドレスの確認証メールです。

下記のリンクにアクセスして、アカウント登録を完了してください。
{$user_approval_url}

============================
IPUT ONE制作チーム
iputone.staff@gmail.com
";
        $this->mailService->send($user_email, "【IPUT ONE】メールアドレス認証", $message);
    }
}
