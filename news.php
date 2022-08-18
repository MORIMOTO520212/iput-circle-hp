<!-- ニュース一覧ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('news', 'ニュース | IPUT学生団体');
?>

<main class="contents">
    <!-- トップ バナー -->
    <div class="container top-banner">
        <img class="banner-img" src="src/banner_1080p.png" alt="...">
    </div> 

    <!-- メイン -->
    <div class="main pt-5 pb-5">
        <!-- ニュース一覧 -->
        <h3 class="container w-50 text-center">ニュース一覧</h3>
        <!-- カード -->
        <div class="container w-75 pt-5 max-width-lg">
            <div class="row row-cols-1 row-cols-lg-3 g-4">
                <?php
                for($i=0; $i<4; $i++){
                ?>
                <div class="col">
                    <div class="card h-100">
                        <a class="card-link" href="#">
                            <img src="src/no_image.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">記事のタイトル</h5>
                                <p class="card-text">ここへ記事の本文が挿入されます。ここへ表示される記事の本文は、
                                    最大3行までとし、本文の内容が溢れる場合（オーバーフロー）は三点リーダーで
                                    省略を示します。CSSを用いてtext-overflowで溢れる文字を省略をすることができます。</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</main>

<!-- フッター -->
<?php footer('index'); ?>