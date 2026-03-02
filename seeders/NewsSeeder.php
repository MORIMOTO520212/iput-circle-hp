<?php
/**
 * NewsSeeder — サンプルニュースデータの作成
 * 開発・テスト用データ
 *
 * NewsController::handlePost() の処理を再現:
 *   - post_category: [get_cat_ID('news')]
 *   - meta: clip, permission, topImage
 *   - tags: '行事・イベント' | 'レジャー' | '食事' | 'お知らせ' | '重要連絡'
 */

// 'news' カテゴリの確認・作成
$news_cat_id = get_cat_ID('news');
if (!$news_cat_id) {
    $news_cat_id = wp_create_category('news');
    echo "✓ Created 'news' category (ID: $news_cat_id)\n";
}

$news_items = [
    [
        'title'      => '2026年度 新入生歓迎会のお知らせ',
        'content'    => '2026年4月に新入生歓迎会を開催します。各サークルの紹介・体験ブースを設置予定です。新1年生はぜひご参加ください！',
        'tags'       => ['行事・イベント'],
        'permission' => 'false',
        'clip'       => 'false',
    ],
    [
        'title'      => 'サークル合同BBQを開催します',
        'content'    => '今年も恒例のサークル合同BBQを開催します。参加希望のサークルはIPUT ONEスタッフまでご連絡ください。',
        'tags'       => ['行事・イベント', 'レジャー'],
        'permission' => 'false',
        'clip'       => 'false',
    ],
    [
        'title'      => 'サークル活動報告の投稿方法について',
        'content'    => '活動記録の投稿方法をリニューアルしました。新しい手順については使い方ガイドをご確認ください。',
        'tags'       => ['お知らせ'],
        'permission' => 'false',
        'clip'       => 'false',
    ],
];

foreach ($news_items as $news) {
    // 重複チェック
    $existing = get_posts([
        'post_type'      => 'post',
        'post_status'    => 'any',
        'posts_per_page' => 1,
        'title'          => $news['title'],
    ]);
    if (!empty($existing)) {
        echo "- {$news['title']}: already exists (skipped)\n";
        continue;
    }

    $post_id = wp_insert_post([
        'post_type'     => 'post',
        'post_status'   => 'publish',
        'post_title'    => $news['title'],
        'post_content'  => $news['content'],
        'post_category' => [$news_cat_id],
        'tags_input'    => $news['tags'],
        'post_name'     => md5($news['title']),
    ], true);

    if (is_wp_error($post_id)) {
        echo "✗ Failed: {$news['title']} ({$post_id->get_error_message()})\n";
        continue;
    }

    update_post_meta($post_id, 'clip',       $news['clip']);
    update_post_meta($post_id, 'permission', $news['permission']);
    update_post_meta($post_id, 'topImage',   '');

    echo "✓ Created news: {$news['title']} (ID: $post_id)\n";
}
