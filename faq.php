<?php
/**
 * Template Name: FAQページ
*/
?>

<?php get_header(); ?>

<?php
$faqData = array(
    array(
        'cat_name' => '学校に関するFAQ',
        'contents' => array(
            array(
                'Q' => '落とし物を見つけた場合はどうしますか？',
                'A' => '学生カウンターへ届けてください。また、落とし物をした場合は学生カウンターへ行ってください。',    
            ),
            array(
                'Q' => 'ゴミを捨てる場所はどこですか？',
                'A' => '各階には緑の扉と赤の扉のSKルームがありますので、そこで捨ててください。',
            ),
            array(
                'Q' => 'コクーンタワーでお湯を入れられる場所はありますか？',
                'A' => '2FのNewDaysで入れることができます。',    
            ),
        ),
    ),
    array(
        'cat_name' => 'サークル活動に関するFAQ',
        'contents' => array(
            array(
                'Q' => '教室を借りるには？',
                'A' => '管理部に連絡してください。教室の予約が出来たり、自習室を借りられます。土曜にも借りることができます。',
            ),

            array(
                'Q' => 'サークルを公認にするにはどうしたら良いですか？',
                'A' => '公認にはメンバーが10人以上必要という条件があります。それをクリアした場合、サークルの編集ページから公認申請を送ることができます。',    
            ),
        ),
    ),
);
?>


<!-- faq -->
<main class="container-fluid p-0" id="contents">
    <div class="position-relative" id="faq-top">
        <img src="<?php echo get_theme_file_uri('src/background/room1.webp'); ?>" class="w-100">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="text-center text-white">
                <h1>よくあるご質問</h1>
                <h3>FAQ</h3>
            </div>
        </div>
    </div>
    <!-- 高さの調整用 -->
    <div class="mt-lg-5"></div>
    <!-- contents -->
    <div class="row pt-5 mx-0 px-2 px-md-4" id="faq-contents">
        <!-- side bar ... ? -->
        <div class="col-lg-4 pe-lg-5">
            <div class="shadow rounded-3 me-lg-5 mb-5" id="faq-side-contents">
            <!-- sub contents -->
                <div class="p-4">
                    <!-- リスト内のアイコンが未実装 -->
                    <p class="fs-5">項目から探す</p>
                    <ul class="list-unstyled">
                        <?php
                        foreach ( $faqData as $i => $faq ): 
                        ?>
                            <li class="pt-3"><img src="<?php echo get_theme_file_uri('src/chevron_right.svg'); ?>" class="pb-1 me-2"><a href="<?php echo"#category-{$i}" ?>" 
                                class="text-decoration-none text-black fs-6"><?php echo $faq['cat_name'] ?></a></li>
                        <?php
                        endforeach;
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
                foreach ( $faqData as $i => $faq ):
                ?>
                <h3 class="fw-bold" id="<?php echo "category-{$i}" ?>"><?php echo $faq['cat_name'] ?></h3>
                <!-- 各質問の間隔は32pxで仮置き -->
                <div class="justify-content-start row row-cols-lg-2 g-4 pb-5">
                    <?php
                    foreach ( $faq['contents'] as $j => $contents ):
                    ?>
                    <div class="accordion col-lg-6">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo "headingOne{$i}{$j}" ?>">
                                <button type="button" class="accordion-button bg-content" data-bs-toggle="collapse" 
                                    data-bs-target="<?php echo "#collapseOne{$i}{$j}" ?>" aria-expanded="true" aria-controls="<?php echo "collapseOne{$i}{$j}" ?>">
                                    Q <?php echo $contents['Q'] ?>
                                </button>
                            </h2>
                            <div id="<?php echo "collapseOne{$i}{$j}" ?>" class="accordion-collapse collapse show bg-content" aria-labelledby="<?php echo "headingOne{$i}{$j}" ?>">
                                <div class="accordion-body">
                                    <strong><?php echo $contents['A'] ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    endforeach;
                    ?>
                </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</main>

<!-- フッター -->
<?php get_footer(); ?>