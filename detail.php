<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
head('detail', 'サークル詳細ページ | IPUT学生団体');
?>

<div class="top-image" style="background-image: url('src/girl.png');">
    <img src="src/girl.png" />
    <p class="top-text">Nectgramsプログラミングサークル</p>
</div>

<!-- サークル基本情報 -->
<div class="container p-md-3 g-0 mt-4 top-sub-text">
    <ul class="p-0">
        <li class="line">
            <h2>所属人数</h2>
            <p>40</p>
        </li>
        <li class="line">
            <h2>活動日程</h2>
            <p>毎週土曜日</p>
        </li>
        <li class="line">
            <h2>活動場所</h2>
            <p>コクーンタワー</p>
        </li>
        <li>
            <h2>カテゴリ</h2>
            <p>創造</p>
        </li>
    </ul>
</div>

<!-- メイン -->
<div class="container mt-3 mt-md-5">
    <div class="row">
        <!-- main contents -->
        <div class="col-lg-8">
            <div class="mobile-nav">
                <div class="container">
                    <!-- mobile navigation -->
                    <div class="row">
                        <div class="col-6 g-2">
                            <a href="#">
                                <div class="mobile-menu-link icon journal-bookmark-fill">
                                    活動一覧
                                </div>
                            </a>
                            <a href="#">
                                <div class="mobile-menu-link mt-3 icon twitter">
                                    公式Twitter
                                </div>
                            </a>
                        </div>
                        <div class="col-6 g-2">
                            <a href="#">
                                <div class="mobile-menu-link icon person-fill">
                                    参加申請
                                </div>
                            </a>
                            <a href="#">
                                <div class="mobile-menu-link mt-3 icon envelope-fill">
                                    お問い合わせ
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-nav">
                <div class="mt-5"></div>
            </div>
            <div class="overview">
                <h2>サークル概要</h2>
                <hr />
                <p>
                    Nectgramsは、プログラミングサークルで、プログラミングを軸としたクリエイティブな開発をするサークルです。
                </p>
            </div>

            <!-- 基本情報テーブル -->
            <div class="information mt-5">
                <h2>サークル情報</h2>
                <hr />
                <table class="table table-bordered border-3 border-dark">
                    <thead>
                        <tr>
                            <td>代表者</td>
                            <td>代表者 氏名</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>設立日</td>
                            <td>2022年08月17日</td>
                        </tr>
                        <tr>
                            <td>活動頻度</td>
                            <td>週1回</td>
                        </tr>
                        <tr>
                            <td>会費</td>
                            <td>なし</td>
                        </tr>
                        <tr>
                            <td>特色</td>
                            <td>
                                <span class="badge rounded-pill bg-primary">のんびり</span>
                                <span class="badge rounded-pill bg-primary">掛け持ちOK</span>
                                <span class="badge rounded-pill bg-primary">オンライン活動</span>
                                <span class="badge rounded-pill bg-primary">飲み会あり</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="activity-content mt-5">
                <h2>活動内容</h2>
                <hr />
                <p>
                    私たちのサークルは、メンバーの「やってみたい」「それいいね」というアイデアや共感、各々の興味関心で班を作り、その班で一つの制作を行います。今までは「アプリ開発班」「NNC深層学習班」「Unityゲーム開発班」「WEB班」の4つの班がそれぞれが掲げた目標制作物に向けて活動を行いました。もちろんこれは、あくまで一例です。班は2名以上であれば誰でも作ることができます。
                </p>
                <img class="img-fluid mt-3" src="./src/no_image.png" />
            </div>

            <div class="album mt-5">
                <h2>アルバム</h2>
                <hr />
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <img class="img-thumbnail mt-4" src="./src/no_image.png" />
                            <img class="img-thumbnail mt-4" src="./src/no_image.png" />
                        </div>
                        <div class="col-xl-6">
                            <img class="img-thumbnail mt-4" src="./src/no_image.png" />
                            <img class="img-thumbnail mt-4" src="./src/no_image.png" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="activity-posts mt-5">
                <h2>活動記録</h2>
                <hr />
                <?php
                for($i = 0; $i < 5; $i++):
                ?>
                <div class="container">
                    <div class="row act-card">
                        <div class="col-4 col-sm-3 h-100 ps-0">
                            <img src="./src/girl.png" />
                        </div>
                        <div class="col-8 col-sm-9">
                            <p>2022年08月15日</p>
                            <p class="card-text line-clamp-2">記事タイトルをここへ</p>
                        </div>
                    </div>
                    <hr />
                </div>
                <?php
                endfor;
                ?>
            </div>
        </div>
        <!-- desktop navigation -->
        <div class="col-xl-4 mt-5">
            <nav class="toc mx-4">
                <a href="#">
                    <div class="menu-link mt-4 icon journal-bookmark-fill">活動一覧</div>
                </a>
                <a href="#">
                    <div class="menu-link mt-4 icon person-fill">参加申請</div>
                </a>
                <a href="#">
                    <div class="menu-link mt-4 icon twitter">公式Twitter</div>
                </a>
                <a href="#">
                    <div class="menu-link mt-4 icon envelope-fill">お問い合わせ</div>
                </a>
                <p class="mt-4">最終更新日: 2022/08/16</p>
            </nav>
        </div>
    </div>
</div>


<?php footer('detail'); ?>