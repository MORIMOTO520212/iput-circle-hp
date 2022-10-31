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
    <!-- contents -->
    <div class="row mt-5 mx-0 px-4" id="faq-contents">
        <!-- 高さの調整用 -->
        <div class="mt-lg-5"></div>
        <!-- side bar ... ? -->
        <div class="shadow rounded-3 col-lg-2 h-50 mb-4 ms-lg-4" id="faq-side-contents">
        <!-- sub contents -->
            <div class="p-4">
                <!-- リスト内のアイコンが未実装 -->
                <p class="fs-5">項目から探す</p>
                <ul class="list-unstyled">
                    <li class="pt-3"><img src="./src/chevron_right_white_24dp.svg" class="pb-1 me-2"><a href="#category-1" class="text-decoration-none text-black fs-6">カテゴリ1</a></li>
                    <li class="pt-3"><img src="./src/chevron_right_white_24dp.svg" class="pb-1 me-2"><a href="#category-2" class="text-decoration-none text-black fs-6">カテゴリ2</a></li>
                    <li class="pt-3"><img src="./src/chevron_right_white_24dp.svg" class="pb-1 me-2"><a href="#category-3" class="text-decoration-none text-black fs-6">カテゴリ3</a></li>
                    <li class="pt-3"><img src="./src/chevron_right_white_24dp.svg" class="pb-1 me-2"><a href="#category-4" class="text-decoration-none text-black fs-6">カテゴリ4</a></li>
                    <li class="pt-3"><img src="./src/chevron_right_white_24dp.svg" class="pb-1 me-2"><a href="#category-5" class="text-decoration-none text-black fs-6">カテゴリ5</a></li>
                </ul>
            </div>
        </div>

        <!-- faq -->
        <div class=" mx-0 ms-lg-5 me-lg-3 col-lg p-0 ps-lg-3" id="faq-main-contents">
            <!-- faq contents -->
            <!-- category-1 -->
            <div class="mb-5">
                <h1 class="fw-bold" id="category-1">カテゴリ1</h1>
                <!-- 各質問の間隔は32pxで仮置き -->
                <div class="justify-content-around row row-cols-lg-2 g-4">
                    <!-- d-flex -->
                    <!-- Q 1-1 -->
                    <div class="accordion col-lg-6" id="faq-accordion-1-1">
                        <!-- Accordion items -->
                        <!-- 中身は適当。 -->
                        <!-- questions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-1-1">
                                <button type="button" class="accordion-button collapsed bg-content" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-1-1" aria-expanded="false" aria-controls="faq-questions-detail-1-1">
                                    Q 1-1. Question Text
                                </button>
                            </h2>
                            <div id="faq-questions-detail-1-1" class="accordion-collapse collapse bg-content" aria-labelledby="faq-questions-1-1"> <!-- data-bs-parent="#faq-accordion-1-1 -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                        <!-- answers -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-answers-1-1">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-answers-detail-1-1" aria-expanded="false" aria-controls="faq-answers-detail-1-1">
                                    A 1-1. Answer Text
                                </button>
                            </h2>
                            <div id="faq-answers-detail-1-1" class="accordion-collapse collapse" aria-labelledby="faq-answers-1-1"> <!-- data-bs-parent="#faq-accordion-1-1 -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Q 1-2 -->
                    <div class="accordion col-lg-6" id="faq-accordion-1-2">
                        <!-- Accordion items -->
                        <!-- questions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-1-2">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-1-2" aria-expanded="false" aria-controls="faq-questions-detail-1-2">
                                    Q 1-2. Question Text
                                </button>
                            </h2>
                            <div id="faq-questions-detail-1-2" class="accordion-collapse collapse" aria-labelledby="faq-questions-1-2"> <!-- data-bs-parent="#faq-accordion-1-2 -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                        <!-- answers -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-answers-1-2">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-answers-detail-1-2" aria-expanded="false" aria-controls="faq-answers-detail-1-2">
                                    A 1-2. Answer Text
                                </button>
                            </h2>
                            <div id="faq-answers-detail-1-2" class="accordion-collapse collapse" aria-labelledby="faq-answers-1-2"> <!-- data-bs-parent="#faq-accordion-1-2 -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- category-2 -->
            <div class="mb-5">
                <h1 class="fw-bold" id="category-2">カテゴリ2</h1>
                <div class="justify-content-around row row-cols-lg-2 g-4">
                    <!-- Q 2-1 -->
                    <div class="accordion col-lg-6" id="faq-accordion-2-1">
                        <!-- Accordion items -->
                        <!-- questions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-2-1">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-2-1" aria-expanded="false" aria-controls="faq-questions-detail-2-1">
                                    Q 2-1. Question Text
                                </button>
                            </h2>
                            <div id="faq-questions-detail-2-1" class="accordion-collapse collapse" aria-labelledby="faq-questions-2-1"> <!-- data-bs-parent="#faq-accordion-2-1" -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                        <!-- answers -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-answers-2-1">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-answers-detail-2-1" aria-expanded="false" aria-controls="faq-answers-detail-2-1">
                                    A 2-1. Answer Text
                                </button>
                            </h2>
                            <div id="faq-answers-detail-2-1" class="accordion-collapse collapse" aria-labelledby="faq-answers-2-1"> <!-- data-bs-parent="#faq-accordion-2-1" -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Q 2-2 -->
                    <div class="accordion col-lg-6" id="faq-accordion-2-2">
                        <!-- Accordion items -->
                        <!-- questions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-2-2">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-2-2" aria-expanded="false" aria-controls="faq-questions-detail-2-2">
                                    Q 2-2. Question Text
                                </button>
                            </h2>
                            <div id="faq-questions-detail-2-2" class="accordion-collapse collapse" aria-labelledby="faq-questions-2-2"> <!-- data-bs-parent="#faq-accordion-2-2" -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                        <!-- answers -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-answers-2-2">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-answers-detail-2-2" aria-expanded="false" aria-controls="faq-answers-detail-2-2">
                                    A 2-2. Answer Text
                                </button>
                            </h2>
                            <div id="faq-answers-detail-2-2" class="accordion-collapse collapse" aria-labelledby="faq-answers-2-2"> <!-- data-bs-parent="#faq-accordion-2-2" -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 改行 -->

                    <!-- Q 2-3 -->
                    <div class="accordion col-lg-6" id="faq-accordion-2-3">
                        <!-- Accordion items -->
                        <!-- questions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-2-3">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-2-3" aria-expanded="false" aria-controls="faq-questions-detail-2-3">
                                    Q 2-3. Question Text
                                </button>
                            </h2>
                            <div id="faq-questions-detail-2-3" class="accordion-collapse collapse" aria-labelledby="faq-questions-2-3"> <!-- data-bs-parent="#faq-accordion-2-3" -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                        <!-- answers -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-answers-2-3">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-answers-detail-2-3" aria-expanded="false" aria-controls="faq-answers-detail-2-3">
                                    A 2-3. Answer Text
                                </button>
                            </h2>
                            <div id="faq-answers-detail-2-3" class="accordion-collapse collapse" aria-labelledby="faq-answers-2-3"> <!-- data-bs-parent="#faq-accordion-2-3" -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Q 2-4 -->
                    <div class="accordion col-lg-6" id="faq-accordion-2-4">
                        <!-- Accordion items -->
                        <!-- questions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-2-4">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-2-4" aria-expanded="false" aria-controls="faq-questions-detail-2-4">
                                    Q 2-4. Question Text
                                </button>
                            </h2>
                            <div id="faq-questions-detail-2-4" class="accordion-collapse collapse" aria-labelledby="faq-questions-2-4"> <!-- data-bs-parent="#faq-accordion-2-4" -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                        <!-- answers -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-answers-2-4">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-answers-detail-2-4" aria-expanded="false" aria-controls="faq-answers-detail-2-4">
                                    A 2-4. Answer Text
                                </button>
                            </h2>
                            <div id="faq-answers-detail-2-4" class="accordion-collapse collapse" aria-labelledby="faq-answers-2-4"> <!-- data-bs-parent="#faq-accordion-2-4" -->
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- フッター -->
<?php footer('index'); ?>