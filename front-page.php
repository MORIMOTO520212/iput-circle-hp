<?php
/* Template Name: トップ */
?>

<?php get_header() ?>

<main class="contents">
    <!-- ファーストビュー -->
    <div class="top row row-cols-1 row-cols-md-2 g-0 overflow-hidden" style="background-image: url('<?php echo get_theme_file_uri('src/background/cocoon-tower2.webp'); ?>');">
        <div class="col"></div>
        <div class="col">
            <?php
            // ログインしていない場合、登録フォームを表示する
            if ( !is_user_logged_in() ):
            ?>
            <!-- 登録フォーム -->
            <form class="register mx-3 mx-sm-auto mt-5 needs-validation" action="" method="post" novalidate>
                <h3>新規ユーザーの登録</h3>
                <!-- ユーザー名 -->
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping-userid">
                        <span class="bi bi-person-circle"></span>
                    </span>
                    <input type="text" id="username" minlength="1" maxlength="15" pattern="^[a-zA-Z0-9_]{1,15}$" class="form-control mb-0" 
                        name="username" placeholder="ユーザー名を半角英数で入力してください" aria-label="ユーザー名を入力してください" required>
                </div>
                <!-- 氏名 -->
                <div class="row row-cols-1 row-cols-sm-2 mb-3">
                    <div class="col mb-2 mb-sm-auto">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">氏</span>
                            <input type="text" minlength="1" maxlength="20" pattern="^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$" class="form-control" 
                                name="lastname" id="lastname" placeholder="氏" aria-label="氏" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">名</span>
                            <input type="text" minlength="1" maxlength="20" pattern="^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$" class="form-control" 
                                name="firstname" id="firstname" placeholder="名" aria-label="名" required>
                        </div>
                    </div>
                </div>
                <!-- 学校のメールアドレス -->
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text">
                        <span class="bi bi-envelope-fill"></span>
                    </span>
                    <input type="text" id="email" minlength="2" maxlength="50" class="form-control mb-0" name="email" placeholder="学校のメールアドレスを入力してください" 
                        aria-label="学校のメールアドレスを入力してください" required>
                </div>
                <!-- パスワード -->
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text">
                        <span class="bi bi-key-fill"></span>
                    </span>
                    <input type="password" minlength="6" maxlength="16" class="form-control mb-0" name="password" placeholder="パスワードを入力してください" 
                        aria-label="パスワードを入力してください" required>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" name="submit_type" class="btn btn-success" value="signup">アカウントを作成する</button>
                </div>
                <?php wp_nonce_field( 'N9zxfbth', 'signup_nonce' ); ?>
            </form>
            <?php
            endif;
            ?>
        </div>
    </div>

    <!-- トップ カテゴリ only wider than -lg -->
    <div class="container d-none d-lg-block p-0 pb-5" id="top-category">
        <div class="d-flex justify-content-evenly">
            <div class="w-25 p-4 pb-5 ms-4 me-4 shadow-hover card-link-parent">
                <a class="card-link" href="#activity"></a>
                <h3>活動</h3>
                <span>サークル・ゼミの活動状況を報告します。</span>
            </div>
            <div class="w-25 p-4 pb-5 ms-4 me-4 shadow-hover card-link-parent">
                <a class="card-link" href="#news"></a>
                <h3>ニュース</h3>
                <span>不定期で学校に関した自由な投稿を期待します。</span>
            </div>
            <div class="w-25 p-4 pb-5 ms-4 me-4 shadow-hover card-link-parent">
                <a class="card-link" href="#circle"></a>
                <h3>サークル</h3>
                <span>IPUTで活動しているサークルを紹介します。</span>
            </div>
            <div class="w-25 p-4 pb-5 ms-4 me-4 shadow-hover card-link-parent">
                <a class="card-link" href="<?php echo home_url('index.php/faq'); ?>"></a>
                <h3>FAQ</h3>
                <span>学生が気になる学校に関する質問をまとめています。</span>
            </div>
        </div>
    </div>
    <!-- トップ & メイン余白 only wider than -lg -->
    <div class="spacing d-none d-lg-block"></div>

    <!-- メイン -->
    <div class="main container pt-5 pb-5">

        <!-- インフォメーション -->
        <div class="parent-tab container w-100 rounded bg-white p-0 max-width-md">
            <!-- タブ -->
            <ul class="nav nav-tabs p-3 pb-0" id="info-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab" aria-controls="new" aria-selected="true">
                        新規情報
                    </button>
                </li>
                <!-- wider than -sm -->
                <li class="nav-item d-none d-sm-block" role="presentation">
                    <button class="nav-link" id="notice-tab" data-bs-toggle="tab" data-bs-target="#notice" type="button" role="tab" aria-controls="notice" aria-selected="false">
                        お知らせ
                    </button>
                </li>
                <!-- wider than -sm -->
                <li class="nav-item d-none d-sm-block" role="presentation">
                    <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button" role="tab" aria-controls="event" aria-selected="false">
                        行事・イベント
                    </button>
                </li>
                <!-- smaller than -sm -->
                <li class="nav-item dropdown d-sm-none">
                    <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">その他
                    </button>
                    <ul class="dropdown-menu">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link dropdown-item" id="notice-tab-sm" data-bs-toggle="tab" data-bs-target="#notice" type="button" role="tab" aria-controls="notice" aria-selected="false">
                                お知らせ
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link dropdown-item" id="event-tab-sm" data-bs-toggle="tab" data-bs-target="#event" type="button" role="tab" aria-controls="event" aria-selected="false">
                                行事・イベント
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- コンテンツ -->
            <div class="tab-content p-4 pt-0" id="info-content">
            <?php
            $new_info_array       = null;  // 新規情報
            $announcement_array   = null;  // お知らせ
            $event_array          = null;  // 行事・イベント
            $aritcle_is_important = false;
            $news_datas           = null;

            // 記事データ取得
            $news_datas = get_article_data("news");

            if ( $news_datas ) {

                // 記事取得
                foreach ( $news_datas as $post ) {
                    setup_postdata( $post );
                    $news_all_tags = get_the_tags();

                    if( $news_all_tags ) { // タグが存在する場合
                        $article_tags_array = array_column($news_all_tags, 'name');

                        if(in_array('新規情報', $article_tags_array)) {
                            $new_info_array[] = create_article_datas($post, $article_tags_array);
                        }

                        if(in_array('お知らせ', $article_tags_array)) {
                            $announcement_array[] = create_article_datas($post, $article_tags_array);
                        }

                        if(in_array('行事・イベント', $article_tags_array)) {
                            $event_array[] = create_article_datas($post, $article_tags_array);
                        }

                    } else { // $all_tagsにタグが存在しない場合
                        continue;
                    }
                }

            } else { // 記事情報がなかったら
            }

            // 一覧情報取得に利用したループをリセットする
            wp_reset_postdata();
            ?>
                <!-- 新規情報 -->
                <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                    <div class="list-group list-group-flush mt-2">
                    <?php circle_news($new_info_array); //$new_info_arrayの記事一覧を表示 ?> 
                    </div>
                </div>
                <!-- お知らせ -->
                <div class="tab-pane fade" id="notice" role="tabpanel" aria-labelledby="notice-tab">
                    <div class="list-group list-group-flush mt-2">
                    <?php circle_news($announcement_array); //$announcement_arrayの記事一覧を表示 ?>
                    </div>
                </div>
                <!-- イベント・行事 -->
                <div class="tab-pane fade" id="event" role="tabpanel" aria-labelledby="event-tab">
                    <div class="list-group list-group-flush mt-2">
                    <?php circle_news($event_array); //$event_arrayの記事一覧を表示 ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 活動・ニュース -->
        <div class="container w-100 mt-5 max-width-lg">
            <div class="row row-cols-1 row-cols-lg-2 g-5">

                <!-- 活動 -->
                <div class="col" id="activity">
                    <h4>活動</h4>
                    <?php
                    $card_array = null;
                    // 記事データを取得
                    $card_datas = get_article_data('activity');

                    if ( $card_datas ) {
                        for ( $i = 0; $i < 4; $i++ ) {
                            if ( !isset( $card_datas[$i] ) ) break;
                            $post = $card_datas[$i];
                            // 内部公開の判定
                            if ( get_post_custom( $post->ID )['permission'][0] === "true" && !is_user_logged_in() ) continue;
                            $card_array[] = create_article_datas($post, null);
                        }

                    } else {
                        $card_array = null;
                    }
                    wp_reset_postdata();

                    // 活動カード描画
                    circle_info_card($card_array);
                    ?>
                    
                    <!-- ボタン もっと見る -->
                    <div class="d-flex justify-content-end mt-3">
                        <a href="<?=home_url('index.php/search-activity')?>">
                            <button type="button" class="btn btn-success">もっと見る</button>
                        </a>
                    </div>
                </div>

                <!-- ニュース -->
                <div class="col" id="news">
                    <h4>ニュース</h4>
                    <?php
                    $card_array = null;
                    // 記事データ取得
                    $card_datas = get_article_data('news');

                    if ( $card_datas ) {
                        for ( $i = 0; $i < 4; $i++ ) {
                            if ( !isset( $card_datas[$i] ) ) break;
                            $post = $card_datas[$i];
                            // 内部公開の判定
                            if ( get_post_custom( $post->ID )['permission'][0] === "true" && !is_user_logged_in() ) continue;
                            $card_array[] = create_article_datas($post, null);
                        }

                    } else {
                        $card_array = null;
                    }
                    wp_reset_postdata();

                    // 活動カード描画
                    circle_info_card($card_array);
                    ?>

                    <!-- ボタン もっと見る -->
                    <div class="d-flex justify-content-end mt-3">
                        <a href="#">
                            <button type="button" class="btn btn-success" disabled>もっと見る</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- サークル -->
        <div class="container w-100 mt-5 max-width-lg" id="circle">
            <h4>サークル</h4>
            <!-- サークル カテゴリ wider than -lg -->
            <div class="d-none d-lg-block pt-3">
                <div class="row row-cols-3 g-3">
                    <div class="col">
                        <a class="circle-category shadow-hover" href="#circle-sport">
                            <div class="d-flex justify-content-around rounded ratio-16x9">
                                <h5>運動</h5>
                                <span class="sport-icon"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="circle-category shadow-hover" href="#circle-culture">
                            <div class="d-flex justify-content-around rounded ratio-16x9">
                                <h5>文化<br>学術</h5>
                                <span class="culture-icon"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="circle-category shadow-hover" href="#circle-creation">
                            <div class="d-flex justify-content-around rounded ratio-16x9">
                                <h5>創造</h5>
                                <span class="creation-icon"></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- サークル カテゴリ smaller than -lg -->
            <div class="d-lg-none pt-3">
                <div class="row row-cols-1 g-1">
                    <div class="col">
                        <a class="circle-category-s" href="#circle-sport">
                            <div class="row g-0 rounded ratio-21x5">
                                <div class="col">運動</div>
                                <div class="col-5 d-flex justify-content-evenly">
                                    <span class="sport-icon"></span>
                                    <span></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="circle-category-s" href="#circle-culture">
                            <div class="row g-0 rounded ratio-21x5">
                                <div class="col">文化・学術</div>
                                <div class="col-5 d-flex justify-content-evenly">
                                    <span class="culture-icon"></span>
                                    <span></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="circle-category-s" href="#circle-creation">
                            <div class="row g-0 rounded ratio-21x5">
                                <div class="col">創造</div>
                                <div class="col-5 d-flex justify-content-evenly">
                                    <span class="creation-icon"></span>
                                    <span></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            $args = array(
                'posts_per_page'   => -1,
                'post_type'        => 'circle', 
            );
            $circle_data = get_posts( $args );
            ?>
            
            <!-- 運動 -->
            <div class="pt-5" id="circle-sport">
                <h4 class="rounded circle-category-title sport-icon">運動</h4>
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3 pt-2">
                    <?php
                    foreach ( $circle_data as $post ) {
                        $post_custom = get_post_custom( $post->ID );
                        if ( $post_custom['categoryRadio'][0] === '運動' ) {
                            circle_card( $post->post_title, $post_custom['topImage'][0], $post_custom['place'][0], $post_custom['belongNum'][0], get_permalink($post->ID) );
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- 文化・学術 -->
            <div class="pt-5" id="circle-culture">
                <h4 class="rounded circle-category-title culture-icon">文化・学術</h4>
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3 pt-2">
                    <?php
                    foreach ( $circle_data as $post ) {
                        $post_custom = get_post_custom( $post->ID );
                        if ( $post_custom['categoryRadio'][0] === '文化・学術' ) {
                            circle_card( $post->post_title, $post_custom['topImage'][0], $post_custom['place'][0], $post_custom['belongNum'][0], get_permalink($post->ID) );
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- 創造 -->
            <div class="pt-5" id="circle-creation">
                <h4 class="rounded circle-category-title creation-icon">創造</h4>
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3 pt-2">
                    <?php
                    foreach ( $circle_data as $post ) {
                        $post_custom = get_post_custom( $post->ID );
                        if ( $post_custom['categoryRadio'][0] === '創造' ) {
                            circle_card( $post->post_title, $post_custom['topImage'][0], $post_custom['place'][0], $post_custom['belongNum'][0], get_permalink($post->ID) );
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
/* サークル カードのテンプレート */
function circle_card($circle_name, $thumbnail_image, $place_text, $members_text, $url) {
    ?>
    <div class="col">
        <div class="card h-100">
            <a class="card-link" href="<?php echo $url; ?>"></a>
            <div class="row g-0">
                <div class="col-4 col-lg-12">
                    <img src="<?php echo !empty($thumbnail_image) ? wp_get_attachment_image_src( $thumbnail_image )[0] : get_theme_file_uri('src/no_image.png'); ?>"
                        class="card-img-top ratio-3x2 h-100" alt="...">
                </div>
                <div class="col-8 col-lg-12">
                    <div class="card-body h-100 d-flex flex-column">
                        <h5 class="card-title circle-title">
                            <span class="line-clamp-1"><?php echo $circle_name; ?></span>
                        </h5>
                        <div class="card-text mt-auto">
                            <div class="row row-cols-1 mb-0 circle-info">
                                <small class="col line-clamp-1"><?php echo $place_text ?? ''; ?></small>
                                <small class="col line-clamp-1"><?php echo $members_text ?? ''; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/* 記事一覧の記事テンプレート*/
function circle_news($article_array) {
    if($article_array == null): // 表示する記事がない場合
    ?>
    <p class="pt-4 text-center">記事がありません。</p>
    <?php
    else: // 表示する記事がある場合
        foreach($article_array as $article):
    ?>
        <a class="list-group-item mt-1" href="<?php echo $article -> link; ?>">
            <div class="mb-1">
                <span class="badge bg-primary">New</span>
                <?php if($article -> is_important == 'true'):// 重要タグの有無 ?>
                <span class="badge bg-danger">重要</span>
                <?php endif; ?>
            </div>
            <div class="d-flex w-100 justify-content-between">
                <h5 class="line-clamp-1"><?php echo $article -> title; //タイトル ?></h5>
                <small class="text-muted"><?php echo $article -> date; ?></small>
            </div>
            <p class="line-clamp-2">
                <?php echo $article -> excerpt; //本文抜粋 ?>
            </p>
        </a>
    <?php
        endforeach;
    ?>
        <!-- ボタン 一覧を表示する -->
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-success">一覧を表示する</button>
        </div>
    <?php
    endif;
}

/* 記事カードのテンプレート（活動、ニュース） */
function circle_info_card(?array $card_array) {
    if($card_array == null): //表示する記事がない場合
    ?>
    <p class="pt-4 text-center">記事がありません。</p>
    <?php
    else: //表示する記事がある場合
    ?>
    <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-3 pt-3">
    <?php
    foreach($card_array as $card):
    ?>
    <div class="col">
        <div class="card h-100">
            <a class="card-link" href="<?php echo $card->link; ?>"></a>
            <div class="row g-0">
                <div class="col-4 col-lg-12">
                    <img src="<?php echo $card->img; ?>" class="card-img-top ratio-3x2 h-100" alt="...">
                </div>
                <div class="col-8 col-lg-12">
                    <div class="card-body h-100 d-flex flex-column">
                        <h1 class="card-title fs-6 line-clamp-2">
                            <?php echo $card->title; ?>
                        </h1>
                        <!-- 本文 -->
                        <div class="card-text d-flex justify-content-between align-items-center mt-auto">
                            <div class="text-nowrap">
                                <small class="text-muted"><?php echo $card->date; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    endforeach;
    ?>
    </div>
    <?php
    endif;
}

/* postデータからインスタンスを作成し各インスタンスごとにデータを格納 */
function create_article_datas(WP_Post $post, ?array $article_tags_array):?object {
    $article_id = new article_data(); // 記事のID名でインスタンスを作成
    $article_id->title   = get_the_title();    // タイトル
    $article_id->link    = get_permalink();    // リンク
    $article_id->date    = get_the_date();     // 投稿日
    $article_id->excerpt = get_the_excerpt();  // 本文
    $post_custom = get_post_custom( get_the_ID() );
    $article_id->img = !empty($post_custom['topImage'][0]) ? wp_get_attachment_image_src( $post_custom['topImage'][0] )[0] : get_theme_file_uri('src/no_image_activity.png');

    if($article_tags_array != null):
        if( in_array('重要', $article_tags_array) ): // 重要タグの有無
            $article_id->is_important = true;
        else:
            $article_id->is_important = false;
        endif;
    endif;
    return $article_id;
}

// 記事データ取得
function get_article_data(string $article_category) {
    // 取得したい内容を配列に記載します（不要箇所は省略可）
    $all_article_array = array(
        'posts_per_page'   => -1,     // 読み込みしたい記事数（全件取得時は-1）
        'orderby'          => 'date', // 日付順でソート
        'exclude'          => '',     // 一覧に表示したくない記事のID（複数時は,区切）
        'post_type'        => 'post', // 投稿記事の取り出す
        'category_name'    => $article_category  // 表示したいカテゴリーのスラッグを指定
    );

    // 配列で指定した内容で、記事情報を取得
    $all_datas = get_posts( $all_article_array );
    return $all_datas;
}

/* php インスタンス */
class article_data {
    public string $title   = ' ';        //タイトル
    public string $link    = ' ';        // リンク
    public string $date    = ' ';        // 投稿日
    public string $excerpt = ' ';        // 本文
    public string $img     = ' ';        // アイキャッチ画像
    public bool  $is_important = false; // 重要タグの有無(nullable)
}
?>

<script>
    /* セッションストレージ */
    const e_username  = document.getElementById('username');
    const e_lastname  = document.getElementById('lastname');
    const e_firstname = document.getElementById('firstname');
    const e_email     = document.getElementById('email');

    /* セッションストレージから保持した入力値の取得と設置 */
    e_username.value  = sessionStorage.username ?? '';
    e_lastname.value  = sessionStorage.lastname ?? '';
    e_firstname.value = sessionStorage.firstname ?? '';
    e_email.value     = sessionStorage.email ?? '';


    /* 新規ユーザー登録フォーム入力値の保持 */
    e_username.addEventListener('change', (event) => {
        sessionStorage.username = event.target.value;	
    });

    e_lastname.addEventListener('change', (event) => {
        sessionStorage.lastname = event.target.value;	
    });

    e_firstname.addEventListener('change', (event) => {
        sessionStorage.firstname = event.target.value;	
    });

    e_email.addEventListener('change', (event) => {
        sessionStorage.email = event.target.value;	
    });
</script>

<?php get_footer(); ?>