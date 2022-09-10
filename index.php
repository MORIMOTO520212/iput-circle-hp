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
                <input type="text" class="form-control mb-0" placeholder="@ユーザー名を入力してください" aria-label="userid"
                       aria-describedby="addon-wrapping">
            </div>

            <div class="input-group flex-nowrap mb-3">
          <span class="input-group-text" id="addon-wrapping-email">
            <span class="bi bi-envelope-fill"></span>
          </span>
                <input type="text" class="form-control mb-0" placeholder="学校のメールアドレスを入力してください" aria-label="email"
                       aria-describedby="addon-wrapping">
            </div>

            <div class="input-group flex-nowrap mb-3">
          <span class="input-group-text" id="addon-wrapping-password">
            <span class="bi bi-key-fill"></span>
          </span>
                <input type="text" class="form-control mb-0" placeholder="パスワードを入力してください" aria-label="password"
                       aria-describedby="addon-wrapping">
            </div>
            <div class="input-group flex-nowrap mb-3">
          <span class="input-group-text" id="addon-wrapping-password-confirm">
            <span class="bi bi-key-fill"></span>
          </span>
                <input type="text" class="form-control mb-0" placeholder="もう一度パスワードを入力してください" aria-label="password"
                       aria-describedby="addon-wrapping">
            </div>

            <!-- Bootstrap 登録ボタン -->
            <button type="button" class="btn btn-success">登録する</button>
        </div>
    </div>

    <!-- トップ カテゴリ wider than -lg -->
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

    <!-- トップ & メイン余白 wider than -lg -->
    <div class="spacing d-none d-lg-block"></div>

    <!-- メイン -->
    <div class="main container pt-5 pb-5">

        <!-- インフォメーション -->
        <!-- タブ -->
        <div class="parent-tab container w-100 rounded bg-white p-0 max-width-md">
            <ul class="nav nav-tabs p-3 pb-0" id="info-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new"
                            type="button"
                            role="tab" aria-controls="new" aria-selected="true">
                        新規情報
                    </button>
                </li>
                <!-- wider than -sm -->
                <li class="nav-item d-none d-sm-block" role="presentation">
                    <button class="nav-link" id="notice-tab" data-bs-toggle="tab" data-bs-target="#notice" type="button"
                            role="tab" aria-controls="notice" aria-selected="false">
                        お知らせ
                    </button>
                </li>
                <!-- wider than -sm -->
                <li class="nav-item d-none d-sm-block" role="presentation">
                    <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button"
                            role="tab" aria-controls="event" aria-selected="false">
                        イベント・行事
                    </button>
                </li>
                <!-- smaller than -sm -->
                <li class="nav-item dropdown d-sm-none">
                    <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button"
                            aria-expanded="false">その他
                    </button>
                    <ul class="dropdown-menu">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link dropdown-item" id="notice-tab-sm" data-bs-toggle="tab"
                                    data-bs-target="#notice" type="button"
                                    role="tab" aria-controls="notice" aria-selected="false">
                                お知らせ
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link dropdown-item" id="event-tab-sm" data-bs-toggle="tab"
                                    data-bs-target="#event" type="button"
                                    role="tab" aria-controls="event" aria-selected="false">
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
                    <!-- リストグループ -->
                    <div class="list-group list-group-flush">
                        <?php
                        for($i=0; $i<3; $i++):
                        ?>
                        <a href="#" class="list-group-item pt-3">
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
                    <!-- リストグループ -->
                    <div class="list-group list-group-flush">
                        <?php
                        for($i=0; $i<3; $i++):
                        ?>
                        <a href="#" class="list-group-item pt-3">
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
                    <!-- リストグループ -->
                    <div class="list-group list-group-flush">
                        <?php
                        for($i=0; $i<3; $i++):
                        ?>
                        <a href="#" class="list-group-item pt-3">
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
                    <div class="pt-4">
                        <div class="row row-cols-1 row-cols-lg-2 g-3">
                            <?php
                            for($i=0; $i<4; $i++):
                            ?>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-4 col-lg-12">
                                            <img src="src/no_image.png" class="h-100 ratio-3x2" alt="...">
                                        </div>
                                        <div class="col-8 col-lg-12">
                                            <div class="card-body">
                                                <h5 class="card-title line-clamp-2">
                                                    <a class="card-link" href="#">
                                                        記事タイトルタイトルタイトルタイトルタイトル
                                                    </a>
                                                </h5>
                                                <div class="d-none d-lg-block">
                                                    <p class="line-clamp-3">
                                                        ここへ記事の本文が挿入されます。ここへ表示される記事の本文は、
                                                        最大3行までとし、本文の内容が溢れる場合（オーバーフロー）は三点リーダーで
                                                        省略を示します。CSSを用いてtext-overflowで溢れる文字を省略をすることができます。
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <div class="line-clamp-1">
                                                        <img src="https://pbs.twimg.com/tweet_video_thumb/FVn1kCxVUAAl5jv.jpg" class="rounded-circle" alt="..." style="height: 1.8rem; aspect-ratio: 1 / 1; object-fit: cover;">
                                                        <small>ぽちゃぽちゃままま</small>
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
                <!-- ニュース -->
                <div class="col">
                    <h4>ニュース</h4>
                    <div class="pt-4">
                    <div class="row row-cols-1 row-cols-lg-2 g-3">
                            <?php
                            for($i=0; $i<4; $i++):
                            ?>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-4 col-lg-12">
                                            <img src="src/no_image.png" class="h-100 ratio-3x2" alt="...">
                                        </div>
                                        <div class="col-8 col-lg-12">
                                            <div class="card-body">
                                                <h5 class="card-title line-clamp-2">
                                                    <a class="card-link" href="#">
                                                        記事タイトルタイトルタイトルタイトルタイトル
                                                    </a>
                                                </h5>
                                                <div class="d-none d-lg-block">
                                                    <p class="line-clamp-3">
                                                        ここへ記事の本文が挿入されます。ここへ表示される記事の本文は、
                                                        最大3行までとし、本文の内容が溢れる場合（オーバーフロー）は三点リーダーで
                                                        省略を示します。CSSを用いてtext-overflowで溢れる文字を省略をすることができます。
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <div class="line-clamp-1">
                                                        <img src="https://pbs.twimg.com/tweet_video_thumb/FVn1kCxVUAAl5jv.jpg" class="rounded-circle" alt="..." style="height: 1.8rem; aspect-ratio: 1 / 1; object-fit: cover;">
                                                        <small>ぽちゃぽちゃままま</small>
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
        </div>

        

        <!-- サークル -->
        <h4 class="container w-75 p-0 mt-5 max-width-lg">サークル</h4>

        <!-- サークル カテゴリ wider than -lg -->
        <div class="container w-75 d-none d-lg-block pt-4 max-width-lg">
            <div class="row row-cols-3 g-4">
                <div class="col">
                    <a href="#" style="color: #000; text-decoration: none;">
                        <img class="img-fluid ratio-16x10"
                             style="border-radius: 10%;"
                             src="src/man.png" alt="sport">
                        <p class="text-center underline-right-up">運動</p>
                    </a>
                </div>
                <div class="col">
                    <a href="#" style="color: #000; text-decoration: none;">
                        <img class="img-fluid ratio-16x10"
                             style="border-radius: 10%;"
                             src="src/girl.png" alt="culture">
                        <p class="text-center underline-right-up">文化・学術</p>
                    </a>
                </div>
                <div class="col">
                    <a href="#" style="color: #000; text-decoration: none;">
                        <img class="img-fluid ratio-16x10"
                             style="border-radius: 10%;"
                             src="src/keyboard.png" alt="creation">
                        <p class="text-center underline-right-up">創造</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- サークル カテゴリ smaller than -lg -->
        <div class="container w-75 d-lg-none pt-4 max-width-lg">
            <div class="row row-cols-1 g-2">
                <div class="col mask-parent">
                    <a href="#" style="color: #000; text-decoration: none;">
                        <img class="img-fluid rounded ratio-16x5"
                             style="object-position: center -32px;"
                             src="src/man.png" alt="sport">
                        <p class="expand">運動</p>
                    </a>
                </div>
                <div class="col mask-parent">
                    <a href="#" style="color: #000; text-decoration: none;">
                        <img class="img-fluid rounded ratio-16x5"
                             style="object-position: center center"
                             src="src/girl.png" alt="culture">
                        <p class="expand">文化・学術</p>
                    </a>
                </div>
                <div class="col mask-parent">
                    <a href="#" style="color: #000; text-decoration: none;">
                        <img class="img-fluid rounded ratio-16x5"
                             style="object-position: center bottom"
                             src="src/keyboard.png" alt="creation">
                        <p class="expand">創造</p>
                    </a>
                </div>
            </div>
        </div>

        <?php
        /* サークル カードのテンプレート */
        function circle_card($circle_name, $thumbnail_image, $place_text, $members_text) {
        ?>
        <div class="col">
            <div class="card h-100">
                <a class="card-link" href="#">
                    <img src="src/no_image.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title line-clamp-2"><?php echo $circle_name; ?></h5>
                        <ul class="list-unstyled">
                            <li class="place-text line-clamp-3">場所</li>
                            <li class="members-text line-clamp-3">人数</li>
                        </ul>
                    </div>
                </a>
            </div>
        </div>
        <?php } ?>

        <!-- サークル カテゴリ別 -->
        <div class="container w-75 max-width-lg">
            <!-- 運動 -->
            <div class="pt-5">
                <div class="cards-head pt-2 pb-4 mb-2"><span class="sport-icon">運動</span></div>
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    <?php
                    for($i=0; $i<3; $i++) {
                        circle_card('サークル名', '', '', '');
                    }
                    ?>
                </div>
            </div>
            <!-- 文化・学術 -->
            <div class="pt-5">
                <div class="cards-head pt-2 pb-4 mb-2"><span class="culture-icon">文化・学術</span></div>
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    <?php
                    for($i=0; $i<3; $i++) {
                        circle_card('サークル名', '', '', '');
                    }
                    ?>
                </div>
            </div>
            <!-- 創造 -->
            <div class="pt-5">
                <div class="cards-head pt-2 pb-4 mb-2"><span class="creation-icon">創造</span></div>
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    <?php
                    for($i=0; $i<3; $i++) {
                        circle_card('サークル名', '', '', '');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- フッター -->
<?php footer('index'); ?>