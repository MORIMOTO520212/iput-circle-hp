<!-- トップページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('faq', 'FAQ | IPUT学生団体');
?>


    <!-- faq -->
<main class="container-fluid p-0" id="contents">
    <!-- top -->
    <!-- 大まか指示通りできているはず -->
    <div class="position-relative" id="faq-top">
        <img src="src/faq-top-img.jpg" class="w-100">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="text-center text-white">
                <!-- よくあるご質問 -->
                <h1>よくあるご質問</h1>
                <!-- FAQ -->
                <h3>FAQ</h3>
            </div>
        </div>
    </div>
    <!-- 高さの調整用 -->
    <div class="mt-lg-5"></div>
    <!-- contents -->
    <div class="row pt-5 mx-0 px-4" id="faq-contents">
        <!-- side bar ... ? -->
        <div class="col-lg-4 pe-lg-5">
            <div class="shadow rounded-3 me-lg-5 mb-5" id="faq-side-contents">
            <!-- sub contents -->
                <div class="p-4">
                    <!-- リスト内のアイコンが未実装 -->
                    <p class="fs-5">項目から探す</p>
                    <ul class="list-unstyled">
                        <?php
                        for ($i=1; $i < 6; $i++) { 
                            echo("<li class=\"pt-3\"><img src=\"../src/chevron_right_white_24dp.svg\" class=\"pb-1 me-2\"><a href=\"#category-$i\" class=\"text-decoration-none text-black fs-6\">カテゴリ$i</a></li>");
                        }?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- faq -->
        <div class="col-lg-8" id="faq-main-contents">
            <!-- faq contents -->
            <!-- category-1 -->
            <div class="mb-5">
            <?php
            for($i=1; $i<6; $i++){
                echo("<h1 class=\"fw-bold\" id=\"category-$i\">カテゴリ$i</h1>");
                //<!-- 各質問の間隔は32pxで仮置き -->
                echo('<div class="justify-content-around row row-cols-lg-2 g-4 pb-5">');
                for($j=1; $j<5; $j++){
                    echo("<div class=\"accordion col-lg-6\" id=\"faq-accordion-$i-$j\">");
                    // <!-- Accordion items -->
                    // <!-- quiestions -->
                        echo("<div class=\"accordion-item\">");
                            echo("<h2 class=\"accordion-header\" id=\"faq-questions-$i-$j\">");
                                echo("<button type=\"button\" class=\"accordion-button collapsed bg-content\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq-questions-detail-$i-$j\" aria-expanded=\"false\" aria-controls=\"faq-questions-detail-$i-$j\">");
                                    echo("Q $i-$j. Quiestion Text");
                                echo('</button>');
                            echo('</h2>');
                            echo("<div id=\"faq-questions-detail-$i-$j\" class=\"accordion-collapse collapse bg-content\" aria-labelledby=\"faq-questions-$i-$j\">");
                                echo("<div class=\"accordion-body\">");
                                    echo('<strong>Sample Text</strong>');
                                echo('</div>');
                            echo('</div>');
                        echo('</div>');
                    // answer
                        echo("<div class=\"accordion-item\">");
                            echo("<h2 class=\"accordion-header\" id=\"faq-answers-$i-$j\">");
                                echo("<button type=\"button\" class=\"accordion-button collapsed bg-content\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq-answers-detail-$i-$j\" aria-expanded=\"false\" aria-controls=\"faq-answers-detail-$i-$j\">");
                                    echo("A $i-$j. Answer Text");
                                echo('</button>');
                            echo('</h2>');
                            echo("<div id=\"faq-answers-detail-$i-$j\" class=\"accordion-collapse collapse bg-content\" aria-labelledby=\"faq-answers-$i-$j\">");
                                echo("<div class=\"accordion-body\">");
                                    echo('<strong>Sample Text</strong>');
                                echo('</div>');
                            echo('</div>');
                        echo('</div>');
                    echo('</div>');
                }
                echo('</div>');
            }
            ?>
        </div>
    </div>
</main>

<!-- フッター -->
<?php footer('index'); ?>