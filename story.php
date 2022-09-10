<!-- 記事ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('story', '記事 | IPUT学生団体');
?>

<div class="container pt-3 max-width-lg">
    <!-- ぱんくずリスト -->
    <div class="pt-2 pb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">トップ</a></li>
                <li class="breadcrumb-item"><a href="#">ニュース</a></li>
                <li class="breadcrumb-item active" aria-current="page">コクーン周辺のオススメ飯屋！</li>
            </ol>
        </nav>
    </div>

    <!-- タイトルバナー -->
    <div class="title d-flex flex-row">
        <!-- アイキャッチ画像 wider than -lg -->
        <img class="thumb d-none d-lg-block" src="src/no_image.png" alt="...">
        <!-- 情報 -->
        <div class="d-flex flex-column w-100 m-3">
            <!-- top -->
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="title-color">コクーン周辺のオススメ飯屋！</h3>
                <div class="mb-2">
                    <span class="badge bg-danger">内部公開</span>
                </div>
            </div>
            <!-- bottom -->
            <div class="d-flex justify-content-between align-items-center mt-auto">
                <div>
                    <span>Tags:</span>
                    <span class="badge bg-secondary">ニュース</span>
                    <span class="badge bg-secondary">調査</span>
                </div>
                <div>
                    <span class="badge bi bi-twitter" style="background: #38AFFF;">ツイート</span>
                </div>
                <div class="title-color">
                    <div>@username</div>
                    <div>2022/08/20</div>
                </div>
            </div>
        </div>
    </div>

    <!-- コンテンツ -->
    <div class="container pt-5">
        <!-- 概要 -->
        <div class="summary">
            <h4>コクーンタワー周辺のオススメの飲食店を学生からアンケートを取り集計しました</h4>
        </div>
        <!-- 本文 -->
        <div class="detail">
            <?php
            for($i=0; $i<3; $i++):
            ?>
            <img class="post-img" src="src/no_image.png" alt="...">
            <?php
            endfor;
            ?>
            <p>学生調査を行ったところ... 焼肉しか勝たん。</p>
        </div>
    </div>
</div>

<!-- ボタン 一覧に戻る -->
<div class="d-flex align-items-center foot mt-5">
    <div class="container max-width-lg">
        <button type="button" class="btn btn-success">一覧に戻る</button>
    </div>
</div>

<!-- フッター -->
<?php footer('story'); ?>