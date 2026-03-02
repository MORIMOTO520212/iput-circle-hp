<?php
/**
 * ActivitiesSeeder — サンプル活動記録データの作成
 * 本番環境の実データを参考にした開発・テスト用データ
 *
 * ActivityController::handlePost() の処理を再現:
 *   - post_category: [get_cat_ID('activity'), $organizationId（サークル名カテゴリ）]
 *   - meta: permission, topImage
 *   - tags: '活動報告' | '行事・イベント' | '重要報告'
 */

// 'activity' カテゴリの確認・作成
$activity_cat_id = get_cat_ID('activity');
if (!$activity_cat_id) {
    $activity_cat_id = wp_create_category('activity');
    echo "✓ Created 'activity' category (ID: $activity_cat_id)\n";
}

/**
 * サークル名からそのカテゴリ ID を取得する
 * CirclesSeeder で wp_create_category($circle_name) して紐付けた前提
 */
function get_circle_cat_id(string $circle_name): int
{
    $cat = get_term_by('name', $circle_name, 'category');
    return $cat ? (int) $cat->term_id : 0;
}

// 活動記録データ（本番の実投稿をベースに作成）
$activities = [
    [
        'title'      => '第1回活動',
        'content'    => '第1回の活動を行いました！作るためにはまず遊ぶ！ジャンルの違う5つのゲームが揃っております！',
        'circle'     => 'アナログゲーム研究会',
        'tags'       => ['活動報告'],
        'permission' => 'false',
    ],
    [
        'title'      => '第2回活動',
        'content'    => '第2回の活動を行いました！みんなでおすすめのゲームを持ち寄って遊びました！着々とボドゲの輪が広がっています。',
        'circle'     => 'アナログゲーム研究会',
        'tags'       => ['活動報告'],
        'permission' => 'false',
    ],
    [
        'title'      => '狩歌カラオケ',
        'content'    => '狩歌をせっかく買ったので、狩歌カラオケを開催しました！めちゃくちゃ盛り上がったので、また開催したいと思います！',
        'circle'     => 'アナログゲーム研究会',
        'tags'       => ['行事・イベント'],
        'permission' => 'false',
    ],
    [
        'title'      => 'フットサル第1回練習',
        'content'    => '初めての練習を行いました！初心者から経験者まで一緒に楽しくプレイできました。次回もぜひ参加ください！',
        'circle'     => 'IPUTフットサルサークル',
        'tags'       => ['活動報告'],
        'permission' => 'false',
    ],
    [
        'title'      => '第1回プレゼン大会',
        'content'    => '初回のプレゼン大会を開催しました！テーマは自由で、「行き過ぎた未来予測」や「なぜアンパンマンは普段無防備なのか」など個性的な発表が盛りだくさんでした。',
        'circle'     => 'ITED（プレゼンサークル）',
        'tags'       => ['行事・イベント'],
        'permission' => 'false',
    ],
];

foreach ($activities as $activity) {
    // 重複チェック
    $existing = get_posts([
        'post_type'      => 'post',
        'post_status'    => 'any',
        'posts_per_page' => 1,
        'title'          => $activity['title'],
    ]);
    if (!empty($existing)) {
        echo "- {$activity['title']}: already exists (skipped)\n";
        continue;
    }

    $circle_cat_id = get_circle_cat_id($activity['circle']);
    if (!$circle_cat_id) {
        echo "! Circle category not found: {$activity['circle']} — run CirclesSeeder first\n";
        continue;
    }

    $post_id = wp_insert_post([
        'post_type'     => 'post',
        'post_status'   => 'publish',
        'post_title'    => $activity['title'],
        'post_content'  => $activity['content'],
        'post_category' => [$activity_cat_id, $circle_cat_id],
        'tags_input'    => $activity['tags'],
        'post_name'     => md5($activity['title']),
    ], true);

    if (is_wp_error($post_id)) {
        echo "✗ Failed: {$activity['title']} ({$post_id->get_error_message()})\n";
        continue;
    }

    update_post_meta($post_id, 'permission', $activity['permission']);
    update_post_meta($post_id, 'topImage',   '');

    echo "✓ Created activity: {$activity['title']} (ID: $post_id)\n";
}
