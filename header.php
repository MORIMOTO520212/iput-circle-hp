<?php
// Anti-Clickjacking Measures
header('X-Frame-Options: DENY');

if ( is_author() ) { // is user page
    $title = "マイページ";
    $slug = "author";

}
elseif ( is_singular('circle') ) { // is circle custom type
    $slug = "single-circle";
}
elseif ( is_single() ) { // is post page
    $title = get_the_title();
    $slug = "single";

} else { // other page
    $title = get_the_title();
    $slug = get_post(get_the_ID())->post_name;
}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title><?php echo $title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-script-type" content="text/javascript" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Keywords" content="国際工科専門職大学,専門職大学,iput" />
        <meta name="Description" content="国際工科専門職大学のサークルサイトです。" />
        <!-- Icon -->
        <link rel="shortcut icon" href="<?php echo get_theme_file_uri('src/iputone_logo.svg'); ?>" />
        <!-- OGP Settings -->
        <meta property="og:title" content="IPUT ONE サークルサイト" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://iput-one.com" />
        <meta property="og:image" content="<?php echo get_theme_file_uri('src/ogp.jpg'); ?>" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:description" content="国際工科専門職大学のサークルサイトです。" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@iput_one"/>
        <!-- CSS -->
        <link href="<?=get_theme_file_uri("assets/style-$slug.css")?>" rel="stylesheet" type="text/css"/>
        <link href="<?=get_theme_file_uri("assets/style-footer.css")?>" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?=get_stylesheet_uri()?>"/>

        <!-- CSS Bootstrap v5.2.2 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css"
            integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- CSS Bootstrap Icons v1.9.1 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <!-- Google Fonts Icons | Rounded & Variable -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <!-- jQuery uncompressed v3.6.1 -->
        <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- popper.min.js 1.14.3 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- JavaScript Bootstrap Bundle v5.2.2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.bundle.min.js"
            integrity="sha512-BOsvKbLb0dB1IVplOL9ptU1EYA+LuCKEluZWRUYG73hxqNBU85JBIBhPGwhQl7O633KtkjMv8lvxZcWP+N3V3w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- trix.js v2.0.0 -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

        <!-- Google tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-BMPQRQ4Q0G"></script>
        <script>
            if("localhost" != location.hostname) {
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', 'G-BMPQRQ4Q0G');
            }
        </script>

        <?php wp_head(); ?>
    </head>
    <body>
        <!-- ヘッダー -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #99CD00;">
                <div class="container-fluid nav-padding">
                    <a class="navbar-brand" href="<?php echo home_url(); ?>">
                        <img class="me-1" src="<?php echo get_theme_file_uri("src/iputone_logo_white.svg"); ?>" style="width:26px;">
                        IPUT ONE
                    </a>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#top-nav"
                            aria-controls="top-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="top-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item ms-2 me-2">
                                <a class="nav-link active" aria-current="page" href="<?=home_url('index.php/search-activity')?>">活動</a>
                            </li>
                            <li class="nav-item ms-2 me-2">
                                <a class="nav-link active" aria-current="page" href="<?=home_url('index.php/search-news')?>">ニュース</a>
                            </li>
                            <li class="nav-item ms-2 me-2">
                                <a class="nav-link active" aria-current="page" href="<?=home_url()?>">サークル</a>
                            </li>
                            <li class="nav-item ms-2 me-2">
                                <a class="nav-link active" aria-current="page" href="<?=home_url('index.php/faq')?>">FAQ</a>
                            </li>
                            <li class="nav-item ms-2 me-2">
                                <a class="nav-link active" aria-current="page" href="<?=home_url('index.php/contact')?>">お問い合わせ</a>
                            </li>
                            <li>
                                <hr class="border-top">
                            </li>
                            <li class="nav-item ms-2 me-2 d-flex justify-content-end">
                                <?php
                                if ( is_user_logged_in() ) {
                                ?>
                                    <a href="<?php echo home_url( "index.php/author/" . wp_get_current_user()->user_nicename ); ?>">
                                        <button type="button" class="btn btn-light rounded-pill">マイページ</button>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="<?=home_url('index.php/login')?>">
                                        <button type="button" class="btn btn-light rounded-pill">ログイン</button>
                                    </a>
                                <?php
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>