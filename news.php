<!-- トップページ -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ニュース一覧 | IPUT学生団体</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/style-news.css" rel="stylesheet" type="text/css"/>
    <!-- CSS Bootstrap v5.0.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS Bootstrap Icons v1.8.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- Google Fonts Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>

<body>
<!-- ヘッダー -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #99CD00;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">IPUT学生団体</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#top-nav"
                    aria-controls="top-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="top-nav">
                <ul class="navbar-nav">
                    <li class="nav-item ms-2 me-2">
                        <a class="nav-link active" aria-current="page" href="#">活動</a>
                    </li>
                    <li class="nav-item ms-2 me-2">
                        <a class="nav-link active" aria-current="page" href="#">ブログ</a>
                    </li>
                    <li class="nav-item ms-2 me-2">
                        <a class="nav-link active" aria-current="page" href="#">サークル</a>
                    </li>
                    <li class="nav-item ms-2 me-2">
                        <a class="nav-link active" aria-current="page" href="#">FAQ</a>
                    </li>
                    <li class="nav-item ms-2 me-2">
                        <a class="nav-link active" aria-current="page" href="#">お問い合わせ</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="nav-item ms-2 me-2 d-flex justify-content-end">
                        <button type="button" class="btn btn-light" style="border-radius: 20px">ログイン</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

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
            </div>
        </div>
    </div>
</main>

<!-- フッター -->
<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-links">
                    <div class="row">
                        <div class="col">
                            <h6>リンク</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><a href="#">活動一覧</a></p>
                            <p class="mb-1"><a href="#">ニュース一覧</a></p>
                            <p class="mb-1"><a href="#">FAQ</a></p>
                            <p class="mb-1"><a href="#">お問い合わせ</a></p>
                        </div>
                        <div class="col-md-6">
                            <p><a href="#">このサイトについて</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 offset-md-1">
                    <h6>外部リンク</h6>
                    <p><a href="#">東京国際工科専門職大学</a></p>
                    <p><a href="#">IPUT days Tokyo - Twitter</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="assets/base.js"></script>
<!-- JavaScript Bootstrap v5.0.2 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"
  integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
  crossorigin="anonymous"></script> -->
<!-- jQuery Slim v3.3.1 -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
</body>
</html>