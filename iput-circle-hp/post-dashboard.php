<?php
/* Template Name: 記事管理ページ */
?>

<?php

/* ログイン状態のチェック */
if ( !is_user_logged_in() ) {
    echo "ログインしてください。";
    exit;
}

$param_type = get_params('type');
$param_d = get_params('d');

// クエリパラメータのチェック
if ( $param_type === null ) {
    echo "エラー1";
    exit;
}

if ( $param_type === 'post' ) {
    /** @var int $posts_length 記事の数をカウントする */
    $posts_length = intval( count_user_posts( wp_get_current_user()->id, 'post' ) );
    $title = "記事を管理する";
    $option_url = home_url('index.php/post-%_%/');
} elseif ( $param_type === 'circle' ) {
    $posts_length = intval( count_user_posts( wp_get_current_user()->id, 'circle' ) );
    $title = "サークルを管理する";
    $option_url = home_url('index.php/post-circle');
} else {
    echo "エラー2";
    exit;
}

/* サイトタイトル変更 */
function change_title( $_title ) {
    global $title;
    if ( "記事管理ページ" === $_title ) {
        return $title;
    }
    return $_title;
}
add_filter( 'the_title', 'change_title', 10, 1 );

// ページパラメータの確認 マイナスの数値や文字記号を1とする
if ( isset( $param_d ) ) {
    $paged = $param_d > 0 ? $param_d : 1;
} else {
    $paged = 1;
}

/* 記事 取得 */
$args = array(
    'author'         => wp_get_current_user()->id, // 投稿者
    'post_type'      => $param_type,               // 投稿タイプ
    'post_status'    => array('draft','publish'),  // 公開ステータス
    'posts_per_page' => 10,                        // 投稿取得数
    'paged'          => $paged,                    // 現在のページ
);
$the_query = new WP_Query( $args );    // 投稿データ

get_header();
?>

<main class="container" id="main">
    <div class="px-lg-4 px-0 py-4 mw-100">
        <h2 class="text-center p-lg-3"><?php echo $title; ?></h2>
        <div class="p-3" id="post-dashboard">
            <div class="row p-lg-3">
                <div class="col-lg-10 col-7 text-secondary text-start fs-6">タイトル</div>
                <div class="col-lg-2 col-5 text-secondary text-center fs-6">オプション</div>
            </div>
            <div id="pageBody">
                <!-- 記事一覧 -->
                <?php
                if( $the_query->have_posts() ):
                while( $the_query->have_posts() ):
                $the_query->the_post(); // 記事情報取得
                ?>
                <div class="row py-3 px-lg-3 border-bottom border-1 border-secondary">
                    <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="col-lg-10 col-7 text-decoration-none text-black text-start overflow-hidden fs-6 text-truncate"><?php the_title(); ?></a>
                    <div class="col-lg-2 col-5 row mx-auto justify-content-center">
                        <?php
                        // 投稿はカテゴリのニュース(post-news)と活動記録(post-activity)を判別してリンクを更新する
                        if ( $param_type === 'post' ) {
                            $url = str_replace('%_%', get_the_category()[0]->name, $option_url);
                        } else {
                            $url = $option_url;
                        }
                        ?>
                        <div class="col-6">
                            <a class="p-0 w-100 btn btn-secondary editbtn" href="<?php
                            echo $url . "?_post=edit&id=" . get_the_ID(); ?>" role="button"></a>
                        </div>
                        <div class="col-6">
                            <a class="p-0 w-100 btn btn-danger deletebtn" href="<?php
                            echo $url . "?_post=delete&id=" . get_the_ID(); ?>" role="button"></a>
                        </div>
                    </div>
                </div>
                <?php
                endwhile;
                wp_reset_postdata();
                else:
                ?>
                <p class="text-center">まだ記事がありません。</p>
                <?php
                endif;
                ?>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation pt-3">
        <?php
        $pagination = paginate_links(
            array(
                'base'    => home_url("index.php/post-dashboard/?type={$param_type}%_%"),
                'format'  => '&d=%#%',
                'type'    => 'list',
                'current' => $paged, // int current page
                'total'   => $the_query->max_num_pages,  // int total pages
            )
        );
        echo $pagination;
        ?>
        </nav>

        <script>
            /* Add Bootstrap Pagination Class */
            $('ul.page-numbers').addClass('pagination justify-content-center');
            $('ul.page-numbers li').addClass('page-item');
            $('ul.page-numbers li a').addClass('page-link');
            $('ul.page-numbers li span').addClass('page-link');
            $('ul.page-numbers li .current').parent().addClass('active');
        </script>

    </div>
</main>

<?php get_footer(); ?>