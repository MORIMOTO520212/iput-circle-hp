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
        <!-- WordPressでは自動的に読み込まれる -->
        <link href="style.css" rel="stylesheet" type="text/css"/>

        <!-- CSS Bootstrap v5.2.2 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css"
            integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- CSS Bootstrap Icons v1.9.1 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
            integrity="sha512-5PV92qsds/16vyYIJo3T/As4m2d8b6oWYfoqV+vtizRB6KhF1F9kYzWzQmsO6T3z3QG2Xdhrx7FQ+5R1LiQdUA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Google Fonts Icons | Rounded & Variable -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <!-- jQuery v3.6.1 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- JavaScript Bootstrap Bundle v5.2.2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.bundle.min.js"
            integrity="sha512-BOsvKbLb0dB1IVplOL9ptU1EYA+LuCKEluZWRUYG73hxqNBU85JBIBhPGwhQl7O633KtkjMv8lvxZcWP+N3V3w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                                <a class="nav-link active" aria-current="page" href="#">ニュース</a>
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