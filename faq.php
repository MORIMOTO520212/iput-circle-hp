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
                        ?>
                            <li class="pt-3"><img src="../src/chevron_right_white_24dp.svg" class="pb-1 me-2"><a href=" <?php echo"#category-{$i}" ?> " class="text-decoration-none text-black fs-6"> <?php echo"カテゴリ{$i}" ?> </a></li>
                        <?php
                        }
                        ?>
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
            ?>
                <h1 class="fw-bold" id="<?php echo "category-{$i}" ?>"><?php echo"カテゴリ{$i}" ?></h1>
                <!-- 各質問の間隔は32pxで仮置き -->
                <div class="justify-content-start row row-cols-lg-2 g-4 pb-5">
                <?php
                for($j=1; $j<($i*3 ) ; $j++){
                ?>
                    <div class="accordion col-lg-6" id="<?php echo"faq-accordion-{$i}-{$j}" ?>">
                    <!-- Accordion items -->
                    <!-- quiestions -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo"faq-questions-{$i}-{$j}" ?>">
                                <button type="button" class="accordion-button collapsed bg-content" data-bs-toggle="collapse" data-bs-target=" <?php echo"#faq-questions-detail-{$i}-{$j}" ?>" aria-expanded="false" aria-controls=" <?php echo"faq-questions-detail-{$i}-{$j}" ?>">
                                    Q <?php echo"{$i}-{$j}" ?>. Quiestion Text
                                </button>
                            </h2>
                            <div id="<?php echo"faq-questions-detail-{$i}-{$j}" ?>" class="accordion-collapse collapse bg-content" aria-labelledby=" <?php echo"faq-questions-{$i}-{$j}" ?>">
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    <!-- answers -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo"faq-answers-{$i}-{$j}" ?>">
                                <button type="button" class="accordion-button collapsed bg-content" data-bs-toggle="collapse" data-bs-target=" <?php echo"#faq-answers-detail-{$i}-{$j}" ?>" aria-expanded="false" aria-controls=" <?php echo"faq-answers-detail-{$i}-{$j}" ?>">
                                    A <?php echo"{$i}-{$j}" ?>. Answer Text
                                </button>
                            </h2>
                            <div id="<?php echo"faq-answers-detail-{$i}-{$j}" ?>" class="accordion-collapse collapse bg-content" aria-labelledby=" <?php echo"faq-answers-{$i}-{$j}" ?>">
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                }
                ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>

<!-- フッター -->
<?php footer('index'); ?>