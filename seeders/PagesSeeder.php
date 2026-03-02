<?php
/**
 * PagesSeeder — テーマが必要とする固定ページを作成
 * 本番環境のページタイトル・スラッグに合わせている
 */

// ── トップページ（ホームページ設定が必要なので個別に処理）──────────────
$top = get_page_by_path('top');
if ($top) {
    echo "- top: already exists (skipped)\n";
    $top_id = $top->ID;
} else {
    $top_id = wp_insert_post([
        'post_type'   => 'page',
        'post_status' => 'publish',
        'post_title'  => 'トップ',
        'post_name'   => 'top',
    ]);
    update_post_meta($top_id, '_wp_page_template', 'front-page.php');
    echo "✓ Created page: top (ID: $top_id)\n";
}

// ホームページを固定ページ「トップ」に設定
update_option('show_on_front', 'page');
update_option('page_on_front', $top_id);
echo "✓ Homepage set to 'top' (ID: $top_id)\n";

// ── その他の固定ページ ─────────────────────────────────────────────────
$pages = [
    // 認証
    ['slug' => 'login',           'title' => 'ログイン'],
    ['slug' => 'signup',          'title' => '新規登録'],
    // 一覧
    ['slug' => 'search-activity', 'title' => '活動一覧'],
    ['slug' => 'search-news',     'title' => 'ニュース一覧'],
    // 投稿
    ['slug' => 'post-activity',   'title' => '活動記録投稿ページ'],
    ['slug' => 'post-news',       'title' => 'ニュース投稿ページ'],
    ['slug' => 'post-circle',     'title' => 'サークルを作成&編集する'],
    ['slug' => 'post-dashboard',  'title' => '記事管理ページ'],
    // ユーザー
    ['slug' => 'profile',         'title' => 'アカウント情報'],
    // その他
    ['slug' => 'faq',             'title' => 'FAQページ'],
    ['slug' => 'contact',         'title' => 'お問い合わせ'],
    ['slug' => 'circle-contact',  'title' => 'サークル お問い合わせ'],
    ['slug' => 'media-upload',    'title' => 'メディアアップロード（ウィジウィグエディタ用）'],
    ['slug' => 'privacy-policy',  'title' => 'プライバシーポリシー'],
];

foreach ($pages as $page) {
    $existing = get_page_by_path($page['slug']);
    if ($existing) {
        echo "- {$page['slug']}: already exists (skipped)\n";
        continue;
    }
    $id = wp_insert_post([
        'post_type'   => 'page',
        'post_status' => 'publish',
        'post_title'  => $page['title'],
        'post_name'   => $page['slug'],
    ]);
    echo "✓ Created page: {$page['slug']} (ID: $id)\n";
}
