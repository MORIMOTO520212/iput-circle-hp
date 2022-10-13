<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
head('detail', 'サークル詳細ページ | IPUT学生団体');
?>

<div class="top-image">
    <img src="src/detail-top.png" />
    <p class="top-text">Nectgramsプログラミングサークル</p>
</div>

<div class="top-sub-text">
    <ul>
        <li class="line">
            <h2>所属人数</h2>
            <p>40</p>
        </li>
        <li class="line">
            <h2>活動日程</h2>
            <p>毎週土曜日</p>
        </li>
        <li class="line">
            <h2>活動場所</h2>
            <p>コクーンタワー</p>
        </li>
        <li>
            <h2>カテゴリ</h2>
            <p>創造</p>
        </li>
    </ul>
</div>


<?php footer('detail'); ?>