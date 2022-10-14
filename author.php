<!-- 活動一覧ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('author', 'マイページ');
?>


<div class="main container">
    <h2>ようこそ、@user_nameさん</h2>
    <p>ここはマイページです。記事の投稿や、サークルの管理をすることができます。</p>
    <div class="main-first">
        <div class="posts-number p-3 mb-3">
            <p class="m-0">記事の投稿数</p>
            <div class="number">
                <span style="font-size:2rem;">5</span>
                件
            </div>
        </div>
        <div class="create-circle mb-3">
            <a class="button" href="#"></a>
            <div><h4>サークルを作成する</h4></div>
            <div class="icon">
                <span></span>
            </div>
        </div>
    </div>

    <div class="main-second">
        <div class="management-card">
            <a class="button" href="#"></a>
            <div class="title">
                <h4 class="pb-2">活動記録を書く</h4>
                <p>サークルの活動や、その他の課外活動に関する活動状況</p>
            </div>
            <div class="main-icon">
                <div class="icon-activity">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="management-card">
            <a class="button" href="#"></a>
            <div class="title">
                <h4 class="pb-2">ニュースを書く</h4>
                <p>イベントや行事など、学生に知らせたいことについて</p>
            </div>
            <div class="main-icon">
                <div class="icon-news">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="management-card">
            <a class="button" href="#"></a>
            <div class="title">
                <h4 class="pb-2">サークルを管理する</h4>
                <p>サークルのダッシュボード</p>
            </div>
            <div class="main-icon">
                <div class="icon-circle">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="management-card">
            <a class="button" href="#"></a>
            <div class="title">
                <h4 class="pb-2">記事を管理する</h4>
                <p>活動記録とニュースのダッシュボード</p>
            </div>
            <div class="main-icon">
                <div class="icon-article">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="management-card settings">
            <a class="button" href="#"></a>
            <div class="title">
                <h4 class="mb-0">基本情報を編集する</h4>
            </div>
            <i class="bi bi-arrow-right fs-4"></i>
        </div>

    </div>
</div>

<!-- フッター -->
<?php footer('index'); ?>