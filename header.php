<?php
/*  * * * ヘッダー * * *
    $page_name - この引数にページの名前を指定するとそのページのCSSが読み込まれます.
    WordPressではget_header関数を用いる
*/
function head($page_name, $page_title) {
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title><?php echo $page_title ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-script-type" content="text/javascript" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Keywords" content="東京国際工科専門職大学,専門職大学,iput" />
        <meta name="Description" content="" />
        <!-- CSS -->
        <link href="assets/style-<?php echo $page_name ?>.css" rel="stylesheet" type="text/css"/>
        <link href="assets/style-header.css" rel="stylesheet" type="text/css"/>
        <link href="assets/style-footer.css" rel="stylesheet" type="text/css"/>

        <!-- CSS Bootstrap v5.2.0 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- CSS Bootstrap Icons v1.9.1 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <!-- Google Fonts Icons | Rounded & Variable -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                                <hr class="border-top">
                            </li>
                            <li class="nav-item ms-2 me-2 d-flex justify-content-end">
                                <button type="button" class="btn btn-light rounded-pill">ログイン</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

<?php
}
?>