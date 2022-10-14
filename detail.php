<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
head('detail', 'サークル詳細ページ | IPUT学生団体');
?>

<div class="top-image">
    <img src="src/detail-top.png" />
    <p class="top-text">Nectgramsプログラミングサークル</p>
</div>

<div class="top-sub-text">
    <ul>
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

<div class="container mt-5">
    <div class="row">
        <div class="col-xl-9">
            <div class="overview">
                <h2>サークル概要</h2>
                <hr />
                <p>
                    Nectgramsは、プログラミングサークルで、プログラミングを軸としたクリエイティブな開発をするサークルです。
                </p>
            </div>

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
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <img class="img-thumbnail" src="./src/no_image.png" />
                        </div>
                        <div class="col-6">
                            <p>2022年08月15日</p>
                            <p>記事タイトルをここへ</p>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <img class="img-thumbnail" src="./src/no_image.png" />
                        </div>
                        <div class="col-6">
                            <p>2022年08月15日</p>
                            <p>記事タイトルをここへ</p>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <img class="img-thumbnail" src="./src/no_image.png" />
                        </div>
                        <div class="col-6">
                            <p>2022年08月15日</p>
                            <p>記事タイトルをここへ</p>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <img class="img-thumbnail" src="./src/no_image.png" />
                        </div>
                        <div class="col-6">
                            <p>2022年08月15日</p>
                            <p>記事タイトルをここへ</p>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
        <div class="col-xl-3 mt-5">
            <nav class="toc">
                <div class="menu-link mt-4">
                    <i class="bi bi-journal-bookmark-fill"></i>活動一覧
                </div>
                <div class="menu-link mt-4">
                    <i class="bi bi-person-fill"></i>参加申請
                </div>
                <div class="menu-link mt-4">
                    <i class="bi bi-twitter"></i>公式Twitter
                </div>
                <div class="menu-link mt-4">
                    <i class="bi bi-envelope-fill"></i>お問い合わせ
                </div>
                <p class="mt-4">最終更新日: 2022/08/16</p>
            </nav>
        </div>
    </div>
</div>


<?php footer('detail'); ?>