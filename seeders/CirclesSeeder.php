<?php
/**
 * CirclesSeeder — サンプルサークルデータの作成
 * 本番環境の実データを参考にした開発・テスト用データ
 *
 * CircleController::handlePost() の処理を再現:
 *   1. circle 投稿を作成
 *   2. サークル名でカテゴリを作成（活動記録の organizationId として使用）
 *   3. circle 投稿にそのカテゴリを紐付け
 *   4. メタデータを保存
 */

$circles = [
    [
        'title'   => 'アナログゲーム研究会',
        'content' => 'アナログゲーム愛好者が集まるサークルです。ゲームを楽しみ、研究・開発することが目的。冬コミ2026での販売を目標としており、学校での居場所や友達を求める人を歓迎します。参加希望者はSlackでご連絡ください。',
        'meta'    => [
            'belongNum'          => '10',
            'schedule'           => '毎週金曜 16:30〜',
            'place'              => '図書館',
            'categoryRadio'      => '文化系',
            'establishmentDate'  => '2025-10',
            'activityFrequency'  => '週1回',
            'membershipFree'     => '無料',
            'activityDetail'     => 'アナログゲーム愛好者が集まるサークルです。冬コミ2026での販売を目標としています。',
            'contactMailAddress' => '',
            'representative'     => '代表者A',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => 'IPUTフットサルサークル',
        'content' => '初心者向けフットサルサークル。学年を超えて友好的になれるサークルを目指す。「ひとりでも友達を誘ってでも気軽に参加してください」という方針です。',
        'meta'    => [
            'belongNum'          => '15',
            'schedule'           => '毎週土曜 13:00〜',
            'place'              => '体育館',
            'categoryRadio'      => '体育・スポーツ系',
            'establishmentDate'  => '2025-11',
            'activityFrequency'  => '週1回',
            'membershipFree'     => '無料',
            'activityDetail'     => '初心者でも楽しめるフットサルサークルです。学年を超えて仲良くなれる環境を大切にしています。',
            'contactMailAddress' => '',
            'representative'     => '代表者B',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => '蒙古タンメン中本サークル',
        'content' => '基本理念は「辛さの向こう側にある感動をみんなで分かち合う」こと。中本特有の「辛旨」を追求し、初心者から愛好者まで互いの好みを尊重する平和な激辛サークルです。',
        'meta'    => [
            'belongNum'          => '8',
            'schedule'           => '月2回 土曜昼',
            'place'              => '蒙古タンメン中本',
            'categoryRadio'      => '文化系',
            'establishmentDate'  => '2025-12',
            'activityFrequency'  => '月2回',
            'membershipFree'     => '無料',
            'activityDetail'     => '辛さの向こう側にある感動をみんなで分かち合うサークルです。初心者から愛好者まで歓迎します。',
            'contactMailAddress' => '',
            'representative'     => '代表者C',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => 'オカルトサークル',
        'content' => 'オカルト・都市伝説・ホラーについて談話や制作を行うサークルです。展示会参加や作品鑑賞を通じて人の心を動かす表現方法を考察しています。',
        'meta'    => [
            'belongNum'          => '6',
            'schedule'           => '月1回 日曜',
            'place'              => '会議室',
            'categoryRadio'      => '文化系',
            'establishmentDate'  => '2025-12',
            'activityFrequency'  => '月1回',
            'membershipFree'     => '無料',
            'activityDetail'     => 'オカルト・都市伝説・ホラーについて語り合うサークルです。展示会参加や作品制作も行います。',
            'contactMailAddress' => '',
            'representative'     => '代表者D',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => 'ITED（プレゼンサークル）',
        'content' => 'フリーテーマで「1人5分間のプレゼン」を実施するサークルです。テーマ例：「行き過ぎた未来予測」「なぜアンパンマンは普段無防備なのか」など。緊張感と楽しい交流を組み合わせています。',
        'meta'    => [
            'belongNum'          => '12',
            'schedule'           => '毎週水曜 17:00〜',
            'place'              => '多目的室',
            'categoryRadio'      => '文化系',
            'establishmentDate'  => '2025-11',
            'activityFrequency'  => '週1回',
            'membershipFree'     => '無料',
            'activityDetail'     => 'フリーテーマで5分間のプレゼンを行うサークルです。発表を通じてプレゼンスキルを磨きます。',
            'contactMailAddress' => '',
            'representative'     => '代表者E',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => 'E-sportsサークル',
        'content' => 'エンジョイ勢・ガチ勢など全員で楽しめるサークルです。ガチ勢はE-sports関連イベントや大会への参加をサポートします。',
        'meta'    => [
            'belongNum'          => '20',
            'schedule'           => '毎週木曜 17:00〜',
            'place'              => 'PCルーム',
            'categoryRadio'      => 'eスポーツ系',
            'establishmentDate'  => '2025-11',
            'activityFrequency'  => '週1回',
            'membershipFree'     => '無料',
            'activityDetail'     => 'エンジョイ勢・ガチ勢問わず全員で楽しめるE-sportsサークルです。大会参加もサポートします。',
            'contactMailAddress' => '',
            'representative'     => '代表者F',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => '登山サークル',
        'content' => '登山を楽しむサークルです。ルールは厳しいですが、登山を楽しみたい・興味がある人を募集しています。初心者も気軽にどうぞ。',
        'meta'    => [
            'belongNum'          => '8',
            'schedule'           => '月1〜2回 週末',
            'place'              => '各登山スポット',
            'categoryRadio'      => '体育・スポーツ系',
            'establishmentDate'  => '2025-10',
            'activityFrequency'  => '月1〜2回',
            'membershipFree'     => '無料',
            'activityDetail'     => '都内近郊の山を中心に登山を楽しむサークルです。安全を第一に活動しています。',
            'contactMailAddress' => '',
            'representative'     => '代表者G',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => '自動車サークル',
        'content' => '車好きが集まるサークルです。車を所有していなくても大歓迎。将来的にはモータースポーツ活動を目指します。ファミリーカー・スポーツカー・国産車・輸入車など多様な車に乗る人が集まっています。',
        'meta'    => [
            'belongNum'          => '10',
            'schedule'           => '月1回 日曜',
            'place'              => '駐車場・ドライブスポット',
            'categoryRadio'      => '文化系',
            'establishmentDate'  => '2025-07',
            'activityFrequency'  => '月1回',
            'membershipFree'     => '無料',
            'activityDetail'     => '車を所有していなくても参加できる自動車好きのサークルです。将来的にはモータースポーツへの参加も目指しています。',
            'contactMailAddress' => '',
            'representative'     => '代表者H',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => '映画サークル',
        'content' => '映画やドラマの感想・おすすめポイント・考察をシェアするサークルです。映画館での写真を貼るだけでも参加できます。',
        'meta'    => [
            'belongNum'          => '12',
            'schedule'           => '月2回 土曜',
            'place'              => '多目的室・映画館',
            'categoryRadio'      => '文化系',
            'establishmentDate'  => '2025-06',
            'activityFrequency'  => '月2回',
            'membershipFree'     => '無料',
            'activityDetail'     => '映画・ドラマの感想や考察をシェアする映画好きのサークルです。気軽に参加できます。',
            'contactMailAddress' => '',
            'representative'     => '代表者I',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
    [
        'title'   => 'クリエイトリー',
        'content' => 'プロのクリエイターを目指す人向けのサークルです。毎日放課後に制作に打ち込みます。チームでの挑戦か個人での制作かは自由。外部への発信を前提に作品を仕上げ、コンテスト応募なども検討しています。',
        'meta'    => [
            'belongNum'          => '9',
            'schedule'           => '毎日放課後',
            'place'              => 'クリエイティブルーム',
            'categoryRadio'      => '文化系',
            'establishmentDate'  => '2025-06',
            'activityFrequency'  => '毎日',
            'membershipFree'     => '無料',
            'activityDetail'     => 'プロのクリエイターを目指す人が集まるサークルです。CG・映像・イラストなど各分野で制作活動を行います。',
            'contactMailAddress' => '',
            'representative'     => '代表者J',
            'twitterUserName'    => '',
            'features'           => [],
        ],
    ],
];

foreach ($circles as $circle) {
    // 重複チェック（post_title で検索）
    $existing = get_posts([
        'post_type'      => 'circle',
        'post_status'    => 'any',
        'posts_per_page' => 1,
        'title'          => $circle['title'],
    ]);
    if (!empty($existing)) {
        echo "- {$circle['title']}: already exists (skipped)\n";
        continue;
    }

    // サークル投稿を作成
    $post_id = wp_insert_post([
        'post_type'    => 'circle',
        'post_status'  => 'publish',
        'post_title'   => $circle['title'],
        'post_content' => $circle['content'],
        'post_name'    => md5($circle['title']),
    ], true);

    if (is_wp_error($post_id)) {
        echo "✗ Failed to create circle: {$circle['title']} ({$post_id->get_error_message()})\n";
        continue;
    }

    // サークル名でカテゴリを作成して投稿に紐付け（CircleModel::createCategory() と同じ処理）
    $cat_id = wp_create_category($circle['title']);
    wp_set_post_categories($post_id, [$cat_id], true);

    // メタデータ保存
    update_post_meta($post_id, 'topImage',    '');
    update_post_meta($post_id, 'headerImage', '');
    foreach ($circle['meta'] as $key => $value) {
        update_post_meta($post_id, $key, $value);
    }

    echo "✓ Created circle: {$circle['title']} (ID: $post_id, Cat: $cat_id)\n";
}
