<!-- トップページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('index', 'IPUT学生団体');
?>

<main class="contents">
    <!-- ファーストビュー -->
    <div class="top">
        <!-- 登録フォーム -->
        <div class="register">
            <h2>サインアップ</h2>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping-userid">
                    <span class="bi bi-person-circle"></span>
                </span>
                <input type="text" class="form-control mb-0" placeholder="@ユーザー名を入力してください" aria-label="userid" aria-describedby="addon-wrapping">
            </div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping-email">
                    <span class="bi bi-envelope-fill"></span>
                </span>
                <input type="text" class="form-control mb-0" placeholder="学校のメールアドレスを入力してください" aria-label="email" aria-describedby="addon-wrapping">
            </div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping-password">
                    <span class="bi bi-key-fill"></span>
                </span>
                <input type="text" class="form-control mb-0" placeholder="パスワードを入力してください" aria-label="password" aria-describedby="addon-wrapping">
            </div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping-password-confirm">
                    <span class="bi bi-key-fill"></span>
                </span>
                <input type="text" class="form-control mb-0" placeholder="もう一度パスワードを入力してください" aria-label="password" aria-describedby="addon-wrapping">
            </div>
            <!-- Bootstrap 登録ボタン -->
            <button type="button" class="btn btn-success">登録する</button>
        </div>
    </div>

    <!-- トップ カテゴリ only wider than -lg -->
    <div class="container d-none d-lg-block p-0 pb-5" id="top-category">
        <div class="d-flex justify-content-evenly">
            <div class="w-25 p-4 pb-5 ms-4 me-4">
                <h3>活動</h3>
                <span>サークル・ゼミの活動状況を報告します。</span>
            </div>
            <div class="w-25 p-4 pb-5 ms-4 me-4">
                <h3>ニュース</h3>
                <span>不定期で学校に関した自由な投稿を期待します。</span>
            </div>
            <div class="w-25 p-4 pb-5 ms-4 me-4">
                <h3>サークル</h3>
                <span>IPUTで活動しているサークルを紹介します。</span>
            </div>
            <div class="w-25 p-4 pb-5 ms-4 me-4">
                <h3>FAQ</h3>
                <span>学生が気になる学校に関する質問をまとめています。</span>
            </div>
        </div>
    </div>
    <!-- トップ & メイン余白 only wider than -lg -->
    <div class="spacing d-none d-lg-block"></div>

    <!-- メイン -->
    <div class="main container pt-5 pb-5">

        <!-- インフォメーション -->
        <div class="parent-tab container w-100 rounded bg-white p-0 max-width-md">
            <!-- タブ -->
            <ul class="nav nav-tabs p-3 pb-0" id="info-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab" aria-controls="new" aria-selected="true">
                        新規情報
                    </button>
                </li>
                <!-- wider than -sm -->
                <li class="nav-item d-none d-sm-block" role="presentation">
                    <button class="nav-link" id="notice-tab" data-bs-toggle="tab" data-bs-target="#notice" type="button" role="tab" aria-controls="notice" aria-selected="false">
                        お知らせ
                    </button>
                </li>
                <!-- wider than -sm -->
                <li class="nav-item d-none d-sm-block" role="presentation">
                    <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button" role="tab" aria-controls="event" aria-selected="false">
                        イベント・行事
                    </button>
                </li>
                <!-- smaller than -sm -->
                <li class="nav-item dropdown d-sm-none">
                    <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">その他
                    </button>
                    <ul class="dropdown-menu">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link dropdown-item" id="notice-tab-sm" data-bs-toggle="tab" data-bs-target="#notice" type="button" role="tab" aria-controls="notice" aria-selected="false">
                                お知らせ
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link dropdown-item" id="event-tab-sm" data-bs-toggle="tab" data-bs-target="#event" type="button" role="tab" aria-controls="event" aria-selected="false">
                                イベント・行事
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- コンテンツ -->
            <div class="tab-content p-4 pt-0" id="info-content">
                <!-- 新規情報 -->
                <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                    <div class="list-group list-group-flush">
                        <?php
                        for ($i = 0; $i < 3; $i++) :
                        ?>
                            <a class="list-group-item pt-3" href="#">
                                <div class="mb-1">
                                    <span class="badge bg-primary">New</span>
                                    <span class="badge bg-danger">重要</span>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5>記事のタイトル</h5>
                                    <small class="text-muted">5時間前</small>
                                </div>
                                <p>
                                    ここへ記事の本文が挿入されます。ここへ表示される記事の本文は、
                                    最大3行までとし、本文の内容が溢れる場合（オーバーフロー）は三点リーダーで
                                    省略を示します。CSSを用いてtext-overflowで溢れる文字を省略をすることができます。
                                </p>
                            </a>
                        <?php
                        endfor;
                        ?>
                    </div>
                </div>
                <!-- お知らせ -->
                <div class="tab-pane fade" id="notice" role="tabpanel" aria-labelledby="notice-tab">
                    <div class="list-group list-group-flush">
                        <?php
                        for ($i = 0; $i < 3; $i++) :
                        ?>
                            <a class="list-group-item pt-3" href="#">
                                <div class="mb-1">
                                    <span class="badge bg-primary">New</span>
                                    <span class="badge bg-danger">重要</span>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5>記事のタイトル</h5>
                                    <small class="text-muted">5時間前</small>
                                </div>
                                <p>
                                    ここへ記事の本文が挿入されます。ここへ表示される記事の本文は、
                                    最大3行までとし、本文の内容が溢れる場合（オーバーフロー）は三点リーダーで
                                    省略を示します。CSSを用いてtext-overflowで溢れる文字を省略をすることができます。
                                </p>
                            </a>
                        <?php
                        endfor;
                        ?>
                    </div>
                </div>
                <!-- イベント・行事 -->
                <div class="tab-pane fade" id="event" role="tabpanel" aria-labelledby="event-tab">
                    <div class="list-group list-group-flush">
                        <?php
                        for ($i = 0; $i < 3; $i++) :
                        ?>
                            <a class="list-group-item pt-3" href="#">
                                <div class="mb-1">
                                    <span class="badge bg-primary">New</span>
                                    <span class="badge bg-danger">重要</span>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5>記事のタイトル</h5>
                                    <small class="text-muted">5時間前</small>
                                </div>
                                <p>
                                    ここへ記事の本文が挿入されます。ここへ表示される記事の本文は、
                                    最大3行までとし、本文の内容が溢れる場合（オーバーフロー）は三点リーダーで
                                    省略を示します。CSSを用いてtext-overflowで溢れる文字を省略をすることができます。
                                </p>
                            </a>
                        <?php
                        endfor;
                        ?>
                    </div>
                </div>
                <!-- ボタン 一覧を表示する -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-success">一覧を表示する</button>
                </div>
            </div>
        </div>

        <!-- 活動・ニュース -->
        <div class="container w-100 mt-5 max-width-lg">
            <div class="row row-cols-1 row-cols-lg-2 g-5">
                <!-- 活動 -->
                <div class="col">
                    <h4>活動</h4>
                    <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-3 pt-3">
                        <?php
                        for ($i = 0; $i < 4; $i++) :
                        ?>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-4 col-lg-12">
                                            <img src="src/no_image.png" class="card-img-top ratio-3x2 h-100" alt="...">
                                        </div>
                                        <div class="col-8 col-lg-12">
                                            <div class="card-body h-100 d-flex flex-column">
                                                <h5 class="card-title">
                                                    <a class="card-link line-clamp-2" href="#">
                                                        記事タイトルタイトルタイトルタイトルタイトル
                                                    </a>
                                                </h5>
                                                <div class="card-text d-none d-lg-block">
                                                    <p class="line-clamp-3">
                                                        ここへ記事の本文が挿入されます。ここへ表示される記事の本文は、
                                                        最大3行までとし、本文の内容が溢れる場合（オーバーフロー）は三点リーダーで
                                                        省略を示します。CSSを用いてtext-overflowで溢れる文字を省略をすることができます。
                                                    </p>
                                                </div>
                                                <div class="card-text d-flex justify-content-between align-items-center mt-auto">
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://pbs.twimg.com/tweet_video_thumb/FVn1kCxVUAAl5jv.jpg" class="rounded-circle author-icon" alt="...">
                                                        <small class="ms-1 me-1 line-clamp-1">ぽちゃぽちゃままま</small>
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <small class="text-muted">3時間前</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endfor;
                        ?>
                    </div>
                    <!-- ボタン もっと見る -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-success">もっと見る</button>
                    </div>
                </div>
                <!-- ニュース -->
                <div class="col">
                    <h4>ニュース</h4>
                    <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-3 pt-3">
                        <?php
                        for ($i = 0; $i < 4; $i++) :
                        ?>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-4 col-lg-12">
                                            <img src="src/no_image.png" class="card-img-top ratio-3x2 h-100" alt="...">
                                        </div>
                                        <div class="col-8 col-lg-12">
                                            <div class="card-body h-100 d-flex flex-column">
                                                <h5 class="card-title">
                                                    <a class="card-link line-clamp-2" href="#">
                                                        記事タイトルタイトルタイトルタイトルタイトル
                                                    </a>
                                                </h5>
                                                <div class="card-text d-none d-lg-block">
                                                    <p class="line-clamp-3">
                                                        ここへ記事の本文が挿入されます。ここへ表示される記事の本文は、
                                                        最大3行までとし、本文の内容が溢れる場合（オーバーフロー）は三点リーダーで
                                                        省略を示します。CSSを用いてtext-overflowで溢れる文字を省略をすることができます。
                                                    </p>
                                                </div>
                                                <div class="card-text d-flex justify-content-between align-items-center mt-auto">
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://pbs.twimg.com/tweet_video_thumb/FVn1kCxVUAAl5jv.jpg" class="rounded-circle author-icon" alt="...">
                                                        <small class="ms-1 me-1 line-clamp-1">ぽちゃぽちゃままま</small>
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <small class="text-muted">3時間前</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endfor;
                        ?>
                    </div>
                    <!-- ボタン もっと見る -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-success">もっと見る</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- サークル -->
        <div class="container w-100 mt-5 max-width-lg">
            <h4>サークル</h4>
            <!-- サークル カテゴリ wider than -lg -->
            <div class="d-none d-lg-block pt-3">
                <div class="row row-cols-3 g-3">
                    <div class="col">
                        <a class="circle-category" href="#">
                            <div class="d-flex justify-content-around rounded ratio-16x9">
                                <h5>運動</h5>
                                <span class="sport-icon"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="circle-category" href="#">
                            <div class="d-flex justify-content-around rounded ratio-16x9">
                                <h5>文化<br>学術</h5>
                                <span class="culture-icon"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="circle-category" href="#">
                            <div class="d-flex justify-content-around rounded ratio-16x9">
                                <h5>創造</h5>
                                <span class="creation-icon"></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- サークル カテゴリ smaller than -lg -->
            <div class="d-lg-none pt-3">
                <div class="row row-cols-1 g-1">
                    <div class="col">
                        <a class="circle-category-s" href="#">
                            <div class="row g-0 rounded ratio-21x5">
                                <div class="col">運動</div>
                                <div class="col-5 d-flex justify-content-evenly">
                                    <span class="sport-icon"></span>
                                    <span></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="circle-category-s" href="#">
                            <div class="row g-0 rounded ratio-21x5">
                                <div class="col">文化・学術</div>
                                <div class="col-5 d-flex justify-content-evenly">
                                    <span class="culture-icon"></span>
                                    <span></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="circle-category-s" href="#">
                            <div class="row g-0 rounded ratio-21x5">
                                <div class="col">創造</div>
                                <div class="col-5 d-flex justify-content-evenly">
                                    <span class="creation-icon"></span>
                                    <span></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 運動 -->
            <div class="pt-5">
                <h4 class="rounded circle-category-title sport-icon">運動</h4>
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3 pt-3">
                    <?php
                    for ($i = 0; $i < 3; $i++) {
                        circle_card('サークル' . ($i + 1) ** ($i * 20), null, '会館' . ($i + 1) * 10, ($i + 2) ** ($i + 1));
                    }
                    ?>
                </div>
            </div>
            <!-- 文化・学術 -->
            <div class="pt-5">
                <h4 class="rounded circle-category-title culture-icon">文化・学術</h4>
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3 pt-3">
                    <?php
                    for ($i = 0; $i < 3; $i++) {
                        circle_card('サークルサークルサークルサークル', null, 'Discord', ($i + 10) * ($i + 1 * 2));
                    }
                    ?>
                </div>
            </div>
            <!-- 創造-->
            <div class="pt-5">
                <h4 class="rounded circle-category-title creation-icon">創造</h4>
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3 pt-3">
                    <?php
                    for ($i = 0; $i < 3; $i++) {
                        circle_card('サークル' . ($i + 1) ** ($i * 10), null, null, ($i + 5) ** ($i + 1));
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- PHP関数 -->
        <?php
        /* サークル カードのテンプレート */
        function circle_card($circle_name, $thumbnail_image, $place_text, $members_text)
        {
        ?>
            <div class="col">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-4 col-lg-12">
                            <img src="src/no_image.png" class="card-img-top ratio-3x2 h-100" alt="...">
                        </div>
                        <div class="col-8 col-lg-12">
                            <div class="card-body h-100 d-flex flex-column">
                                <h5 class="card-title">
                                    <a class="card-link circle-title" href="#">
                                        <span class="line-clamp-1">
                                            <?php echo $circle_name; ?>
                                        </span>
                                    </a>
                                </h5>
                                <div class="card-text mt-auto">
                                    <div class="row row-cols-1 mb-0 circle-info">
                                        <small class="col line-clamp-1"><?php echo $place_text ?? '不明'; ?></small>
                                        <small class="col line-clamp-1"><?php echo $members_text ?? '不明'; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</main>

<!-- フッター -->
<?php footer('index'); ?>