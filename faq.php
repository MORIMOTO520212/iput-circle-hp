<!-- トップページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('faq', 'FAQ | IPUT学生団体');
?>


<main class="contents">
    <!-- faq -->
    <!-- top -->
    <div class="faq-top">
        <!-- 背景にイメージ
        <img src="src/faq-top-img.jpg" class="faq-top-img"> 
        -->
        <figure>
            <img src="src/faq-top-img.jpg">
            <figcaption>
                <div class="faq-top-message">
                    <!-- よくあるご質問 -->
                    <h1>よくあるご質問</h1>
                    <!-- FAQ -->
                    <h3>FAQ</h3>
                </div>
            </figcaption>
        </figure>
    </div>

    <!-- contents -->
    <div class="faq-contents">
        <!-- side bar ... ? -->
        <div class="shadow p-3 mb-5 bg-body rounded" id="faq-side-contents">
            <!-- sub contents -->
            <div class="faq-side-category">
                <p>項目から探す</p>
                <ul>
                    <li><a href="#"> カテゴリ1</a></li>
                    <li><a href="#"> カテゴリ2</a></li>
                    <li><a href="#"> カテゴリ3</a></li>
                    <li><a href="#"> カテゴリ4</a></li>
                    <li><a href="#"> カテゴリ5</a></li>
                </ul>
            </div>
        </div>

        <!-- main contents -->
        <div class="faq-main-contents">
            <!-- faq contents -->
            <div class="faq">
                <!-- category-1 -->
                <h1>カテゴリ1</h1>
                <div class="faq-category">
                    <!-- Q 1-1 -->
                    <div class="accordion" id="faq-accordion-1-1">
                        <!-- Accordion items -->
                        <!-- quiestions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-1-1">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-1-1" aria-expanded="false" aria-controls="faq-questions-detail-1-1">
                                    Q 1-1. Quiestion Text
                                </button>
                            </h2>
                            <div id="faq-questions-detail-1-1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion-1-1">
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
                            <div id="faq-answers-detail-1-1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion-1-1">
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Q 1-2 -->
                    <div class="accordion" id="faq-accordion-1-2">
                        <!-- Accordion items -->
                        <!-- quiestions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-1-2">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-1-2" aria-expanded="false" aria-controls="faq-questions-detail-1-2">
                                    Q 1-2. Quiestion Text
                                </button>
                            </h2>
                            <div id="faq-questions-detail-1-2" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion-1-2">
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
                            <div id="faq-answers-detail-1-2" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion-1-2">
                                <div class="accordion-body">
                                    <strong>Sample Text</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="faq">
                <!-- category-2 -->
                <h1>カテゴリ2</h1>
                <div class="faq-category">
                    <!-- Q 2-1 -->
                    <div class="accordion" id="faq-accordion-2-1">
                        <!-- Accordion items -->
                        <!-- quiestions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-2-1">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-2-1" aria-expanded="false" aria-controls="faq-questions-detail-2-1">
                                    Q 2-1. Quiestion Text
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
                    <div class="accordion" id="faq-accordion-2-2">
                        <!-- Accordion items -->
                        <!-- quiestions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-2-2">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-2-2" aria-expanded="false" aria-controls="faq-questions-detail-2-2">
                                    Q 2-2. Quiestion Text
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

                    <!-- Q 2-3 -->
                    <div class="accordion" id="faq-accordion-2-3">
                        <!-- Accordion items -->
                        <!-- quiestions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-2-3">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-2-3" aria-expanded="false" aria-controls="faq-questions-detail-2-3">
                                    Q 2-3. Quiestion Text
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
                    <div class="accordion" id="faq-accordion-2-4">
                        <!-- Accordion items -->
                        <!-- quiestions -->
                        <div class="accordion-item">
                            <!-- Accordion -->
                            <h2 class="accordion-header" id="faq-questions-2-4">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-questions-detail-2-4" aria-expanded="false" aria-controls="faq-questions-detail-2-4">
                                    Q 2-4. Quiestion Text
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