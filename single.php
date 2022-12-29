<?php
/* Template Name: 記事 */
?>

<?php
global $post;

get_header();

/* カテゴリ名 取得 */
$category = get_the_category()[0]->name;
if ( $category === 'news' ) {
    $category_name = "ニュース";
}elseif ( $category === 'activity' ) {
    $category_name = "活動記録";
}

$tags = get_the_tags();

$post_custom = get_post_custom( get_the_ID() ); // カスタムメタデータ取得

// 内部公開の判定
if ( $post_custom['permission'][0] === "true" && !is_user_logged_in() ) {
    echo "ログインしてください。";
    exit;
}
?>

<div class="container pt-3 max-width-lg">
    <!-- breadcrumb -->
    <div class="pt-2 pb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo home_url() ?>">トップ</a>
                </li>
                <li class="breadcrumb-item"><a href="<?php echo home_url("index.php/search-{$category}"); ?>">
                    <?php echo $category_name; ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php the_title(); ?>
                </li>
            </ol>
        </nav>
    </div>

    <!-- title banner -->
    <div class="title d-flex flex-row">
        <!-- アイキャッチ画像 wider than -lg -->
        <img class="thumb d-none d-lg-block" src="<?php echo !empty($post_custom['topImage'][0]) ? wp_get_attachment_image_src( $post_custom['topImage'][0] )[0] : get_theme_file_uri('src/no_image_activity.png'); ?>" alt="...">
        <!-- 情報 -->
        <div class="d-flex flex-column w-100 m-3">
            <!-- top -->
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="title-color"><?php the_title(); ?></h3>
                <?php
                if ( $post_custom['permission'][0] === "true" ):
                ?>
                <div class="mb-2">
                    <span class="badge bg-danger">内部公開</span>
                </div>
                <?php
                endif;
                ?>
            </div>
            <!-- bottom -->
            <div class="d-flex justify-content-between align-items-center mt-auto">
                <div>
                    <span>タグ:</span>
                    <?php
                    foreach( get_the_tags() ?: array() as $tag ):
                    ?>
                    <span class="badge bg-secondary"><?php echo $tag->name; ?></span>
                    <?php
                    endforeach;
                    ?>
                </div>
                <!--<div class="ps-2" style="flex:1;"></div>-->
                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
                    class="twitter-share-button" data-show-count="false">Tweet</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                
                <div class="title-color">
                    <div><?php echo get_user_meta( $post->post_author, 'nickname', true ); ?></div>
                    <div><?php echo get_the_date(); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- コンテンツ -->
    <div class="detail container pt-5">
        <?php the_content(); ?>
    </div>
</div>

<!-- ボタン 一覧に戻る -->
<div class="d-flex align-items-center foot mt-5">
    <div class="container max-width-lg">
        <a class="btn btn-success" href="<?php echo home_url("index.php/search-{$category}"); ?>">一覧に戻る</a>
    </div>
</div>

<?=get_footer()?>