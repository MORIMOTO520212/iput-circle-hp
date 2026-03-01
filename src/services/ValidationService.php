<?php

class ValidationService
{
    /**
     * ユーザー名バリデーション（半角英数字+アンダーバー 1～15文字）
     */
    public function validateUsername($value)
    {
        return (bool) preg_match("/^[a-zA-Z0-9_]{1,15}$/iD", $value);
    }

    /**
     * メールアドレスバリデーション（iput.ac.jpドメイン）
     */
    public function validateIputEmail($value)
    {
        return (bool) preg_match("/^[a-z0-9+._-]{2,16}@(.*)iput.ac.jp$/iD", $value);
    }

    /**
     * パスワードバリデーション（半角英数字+記号 6～16文字）
     */
    public function validatePassword($value)
    {
        return (bool) preg_match("/^[ -~]{6,16}$/iD", $value);
    }

    /**
     * 氏名バリデーション（半角英字+日本語 1～12文字）
     */
    public function validateName($value)
    {
        return (bool) preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $value);
    }

    /**
     * 表示名バリデーション（半角英数字+アンダースコア 4～12文字）
     */
    public function validateDisplayName($value)
    {
        return (bool) preg_match("/^[a-z0-9_]{4,12}$/iD", $value);
    }
}
