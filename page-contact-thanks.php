<!-- お問い合わせ完了ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('contact-thanks', 'お問い合わせ完了 | IPUT学生団体');
?>

<!-- コンテンツ -->
<div class="main">
    <div class="contact-message-container">
    <div class="contact-message-wrapper">
        <h1 class="contact-main-message">お問い合わせありがとうございました！</h1>
        <h4 class="contact-body-message">
            <span>
                この度は、IPUTに関するお問い合わせをいただき<br>
                誠にありがとうございます。<br>
                3日以内に、担当者よりご連絡いたします。                    
            </span>
        </h4>
        <img src="src/thanks.png" alt="Thank You!!">
    </div>
    </div>
</div>

<!-- フッター -->
<?php footer('index'); ?>