<?php

/**
 * クエリパラメータの取得
 */
function get_params($key = "")
{
    preg_match("/\?(.*)/", $_SERVER['REQUEST_URI'], $matches);
    if (empty($matches)) {
        return null;
    }
    parse_str($matches[1], $args);

    foreach (array_keys($args) as $get_key) {
        if ($key === $get_key) return $args[$get_key];
    }
    return null;
}

/**
 * ローカルホストかどうか
 */
function is_localhost()
{
    return $_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1';
}

/**
 * WordPressで管理する時間の文字列を年月日で整形する
 * 例: '2022-11-11 01:19:30' → '2022年11月11日'
 */
function date_formatting($date)
{
    preg_match('/(\d{4})-(\d{2})-(\d{2})/', $date, $matches);
    return "{$matches[1]}年{$matches[2]}月{$matches[3]}日";
}

/**
 * 後方互換ラッパー: ユーザー有効化
 */
function user_activation($activation_key)
{
    return (new AuthController())->activate($activation_key);
}

/**
 * 投稿カテゴリーの存在チェック（activity, news）
 * なければ作成する
 */
function check_post_categories()
{
    $cat_id = get_cat_ID('activity');
    if ($cat_id != 0 || !$cat_id) {
        require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');
        wp_create_category('activity');
    }
    $cat_id = get_cat_ID('news');
    if ($cat_id != 0 || !$cat_id) {
        require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');
        wp_create_category('news');
    }
}
