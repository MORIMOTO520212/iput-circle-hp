<?php
/**
 * Template Name: ニュース一覧ページ
*/
?>

<?php

$param_d = get_params('d');

// ページパラメータの確認（マイナスの数値や文字記号を1とする）
if ( isset( $param_d ) ) {
    $paged = $param_d > 0 ? $param_d : 1;
} else {
    $paged = 1;
}

/* 記事 取得 */
$args = array(
    'post_type'      => 'post',        // 投稿タイプ
    'posts_per_page' => 12,            // 投稿取得数
    'category_name'  => 'news',
    'paged'          => $paged,        // 現在のページ
);

// 条件指定があった場合
$param_event_1 = get_params('e1'); // 調査
$param_event_2 = get_params('e2'); // 行事・イベント
$param_event_3 = get_params('e3'); // レジャー
$param_event_4 = get_params('e4'); // 食事
$param_event_5 = get_params('e5'); // 重要連絡

$tags = array();
// タグID追加
if ( $param_event_1 ) $tags[] = get_tags(array('slug' => '行事・イベント'))[0]->term_id;
if ( $param_event_2 ) $tags[] = get_tags(array('slug' => '活動記録'))[0]->term_id;
if ( $param_event_3 ) $tags[] = get_tags(array('slug' => '重要連絡'))[0]->term_id;
if ( !empty($tags) ) {
    $args['tag__and'] = $tags;
}

$the_query = new WP_Query( $args );    // 投稿データ

get_header();
?>

<div class="top">
    <div class="title">
        <h1>ニュース一覧</h1>
    </div>
    <div class="filter">
        <!-- 検索フォーム -->
        <input type="text" class="search-input form-control" placeholder="検索する文字を入力してください"
        aria-label="search" aria-describedby="basic-addon1">
        <!-- Flex -->
        <div class="search-settings">
            <input type="checkbox" class="btn-check" id="btn-check1" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check1">調査</label>
            <input type="checkbox" class="btn-check" id="btn-check2" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check2">行事・イベント</label>
            <input type="checkbox" class="btn-check" id="btn-check3" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check3">レジャー</label>
            <input type="checkbox" class="btn-check" id="btn-check4" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check4">食事</label>
            <input type="checkbox" class="btn-check" id="btn-check5" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check5">重要連絡</label>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <button type="button" class="btn btn-primary" disabled>この条件で検索する</button>
        </div>
    </div>
</div>

<div class="container pt-4 pb-4" style="max-width: 750px !important;">
    <div class="row row-cols-1  row-cols-lg-3 g-2 g-lg-3">

        <?php
        if ( $the_query->have_posts() ):
        while ( $the_query->have_posts() ):
        $the_query->the_post();

        // カスタムデータ取得
        $post_custom = get_post_custom( get_the_ID() );

        // 内部公開の判定
        if ( $post_custom['permission'][0] === "true" && !is_user_logged_in() ) continue;
        ?>
        <div class="col">
            <div class="card h-100 a-button">
                <a href="<?php echo get_permalink( get_the_ID() ); ?>"></a>
                <div class="row g-0">
                    <div class="thumbnail col-4 col-lg-12">
                        <?php
                        // サムネイルURL
                        $thumbnail_url = !empty($post_custom['topImage'][0]) ? wp_get_attachment_image_src( $post_custom['topImage'][0] )[0] : get_theme_file_uri('src/no_image_activity.png');
                        ?>
                        <img src="<?php echo $thumbnail_url; ?>"
                        class="card-img-top ratio h-100" alt="...">
                    </div>
                    <div class="col-8  col-lg-12">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span class="line-clamp-3"><?php the_title(); ?></span>
                            </h5>
                            <p class="card-text"><small class="text-muted"><?php echo get_the_date(); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endwhile;
        endif;
        ?>

    </div>
</div>

<div class="page">
    <!-- Pagination -->
    <nav aria-label="Page navigation pt-3">
    <?php
    $pagination = paginate_links(
        array(
            'base'    => home_url("index.php/search-activity/%_%"),
            'format'  => '?d=%#%',
            'type'    => 'list',
            'current' => $paged, // int current page
            'total'   => $the_query->max_num_pages,  // int total pages
        )
    );
    echo $pagination;
    ?>
    </nav>
</div>

<script>
    /* Add Bootstrap Pagination Class */
    $('ul.page-numbers').addClass('pagination justify-content-center');
    $('ul.page-numbers li').addClass('page-item');
    $('ul.page-numbers li a').addClass('page-link');
    $('ul.page-numbers li span').addClass('page-link');
    $('ul.page-numbers li .current').parent().addClass('active');
</script>

<?=get_footer()?>