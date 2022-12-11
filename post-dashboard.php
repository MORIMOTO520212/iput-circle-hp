<?php
/* Template Name: 記事管理ページ */
?>

<?php
// クエリパラメータの確認
if ( isset( $_GET['type'] ) === false ) {
    echo "エラー";
    exit;
}

if ( $_GET['type'] === 'post' ) {
    /** @var int $posts_length 記事の数をカウントする */
    $posts_length = intval( count_user_posts( wp_get_current_user()->id, 'post' ) );
    $title = '記事を管理する';
} elseif ( $_GET['type'] === 'circle' ) {
    $posts_length = intval( count_user_posts( wp_get_current_user()->id, 'circle' ) );
    $title = 'サークルを管理する';
} else {
    echo "エラー";
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
if ( isset( $_GET['d'] ) ) {
    $paged = $_GET['d'] > 0 ? $_GET['d'] : 1;
} else {
    $paged = 1;
}

/* 記事一覧の取得 */
$args = array(
    'post_type'      => $_GET['type'], // 投稿タイプ
    'posts_per_page' => 5,             // 投稿取得数
    'paged'          => $paged,        // 現在のページ
);
$the_query = new WP_Query( $args );    // 投稿データ

get_header();
?>

<main class="container" id="main">
    <div class="px-lg-4 px-0 py-4 mw-100">
        <div class="text-secondary text-center fs-2 p-lg-3"><?php echo $title; ?></div>
        <div class="p-3" id="post-dashboard">
            <div class="row p-lg-3">
                <div class="col-lg-10 col-7 text-secondary text-start fs-6">タイトル</div>
                <div class="col-lg-2 col-5 text-secondary text-center fs-6">オプション</div>
            </div>
            <div id="pageBody">
                <!-- 記事一覧 -->
                <?php
                if($the_query->have_posts()):
                while($the_query->have_posts()):
                $the_query->the_post(); // 記事情報取得
                ?>
                <div class="row py-3 px-lg-3 border-bottom border-1 border-secondary">
                    <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="col-lg-10 col-7 text-decoration-none text-black text-start overflow-hidden fs-6 text-truncate"><?php the_title(); ?></a>
                    <div class="col-lg-2 col-5 row mx-auto justify-content-center">
                        <div class="col-6">
                            <a class="p-0 w-100 btn btn-secondary editbtn" href="?_post=edit" role="button"></a>
                        </div>
                        <div class="col-6">
                            <a class="p-0 w-100 btn btn-danger deletebtn" href="?_post=delete" role="button"></a>
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
                'base'    => home_url("index.php/post-dashboard/?type={$_GET['type']}%_%"),
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