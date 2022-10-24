<!-- アカウント作成ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php head('signup', 'アカウント作成 | IPUT学生団体'); ?>

<main class="bg">
    <div class="container pt-5 pb-5">
        <div class="d-flex justify-content-center align-items-center">
            <?php require_once 'assets/components/signup-form.php'; ?>
        </div>
    </div>
</main>

<?php footer('index'); ?>