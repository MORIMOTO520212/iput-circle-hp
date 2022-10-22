<?php
/**
 *  Template Name: アカウント作成
 */
?>

<?php get_header(); ?>

<main class="bg" style="background: url('<?= get_theme_file_uri('src/register_bg_img.png'); ?>');">
    <div class="container pt-5 pb-5">
        <div class="d-flex justify-content-center align-items-center">
            <?php require_once 'assets/components/signup-form.php'; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>