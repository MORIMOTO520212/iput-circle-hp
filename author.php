<?php
/* Template Name: マイページ */

// マイページは固定ページに登録しません。
// index.php/author/<username> でアクセスできます。
?>

<?php get_header(); ?>

<div class="main container">
    <h2>ようこそ、<?php the_author(); ?>さん</h2>
    <p>ここはマイページです。記事の投稿や、サークルの管理をすることができます。</p>
    <div class="main-first">
        <div class="posts-number p-3 mb-3">
            <p class="m-0">記事の投稿数</p>
            <div class="number">
                <span style="font-size:2rem;"><?php echo count_user_posts( wp_get_current_user()->id ); ?></span>
                件
            </div>
        </div>
        <div class="create-circle mb-3">
            <a class="button" href="<?php echo home_url("index.php/post-circle/?_post=create"); ?>"></a>
            <div><h4>サークルを作成する</h4></div>
            <div class="icon">
                <span></span>
            </div>
        </div>
    </div>

    <div class="main-second">
        <div class="management-card">
            <a class="button" href="<?php echo home_url("index.php/post-activity/?_post=create"); ?>"></a>
            <div class="title">
                <h4 class="pb-2">活動記録を書く</h4>
                <p>サークルの活動や、その他の課外活動に関する活動状況について書きます。</p>
            </div>
            <div class="main-icon">
                <div class="icon-activity">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="management-card" style="background:#c9c9c9;">
            <a class="button" href="#"></a>
            <div class="title">
                <h4 class="pb-2">ニュースを書く</h4>
                <p>イベントや行事など、学生に知らせたいことについて書きます。</p>
            </div>
            <div class="main-icon">
                <div class="icon-news">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="management-card">
            <a class="button" href="<?php echo home_url("index.php/post-dashboard/?type=circle&paged=1"); ?>"></a>
            <div class="title">
                <h4 class="pb-2">サークルを管理する</h4>
                <p>作成したサークルを管理できます。</p>
            </div>
            <div class="main-icon">
                <div class="icon-circle">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="management-card">
            <a class="button" href="<?php echo home_url("index.php/post-dashboard/?type=post&paged=1"); ?>"></a>
            <div class="title">
                <h4 class="pb-2">記事を管理する</h4>
                <p>投稿した活動記録とニュースを管理できます。</p>
            </div>
            <div class="main-icon">
                <div class="icon-article">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="management-card settings">
            <a class="button" href="<?php echo home_url("index.php/profile"); ?>"></a>
            <div class="title">
                <h4 class="mb-0">アカウント情報</h4>
            </div>
            <i class="bi bi-arrow-right fs-4"></i>
        </div>

    </div>
</div>

<?=get_footer()?>