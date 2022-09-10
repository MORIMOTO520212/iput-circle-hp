<!-- ニュース一覧ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('page-activity', 'ニュース一覧');
?>

<div class="top">
    <div class="title">
        <h1>ニュース一覧</h1>
    </div>
    <div class="filter">
        <!-- 検索フォーム -->
        <input type="text" class="search-input form-control" placeholder="検索する文字を入力してください"
        aria-label="search" aria-describedby="basic-addon1">
        <!-- Flex -->
        <div class="search-settings">
            <input type="checkbox" class="btn-check" id="btn-check1" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check1">調査</label>
            <input type="checkbox" class="btn-check" id="btn-check2" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check2">行事・イベント</label>
            <input type="checkbox" class="btn-check" id="btn-check3" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check3">レジャー</label>
            <input type="checkbox" class="btn-check" id="btn-check3" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check3">食事</label>
        </div>
        <div class="search-button">
            <button type="button" class="btn btn-primary">この条件で検索する</button>
        </div>
    </div>
</div>

<div class="container max-width-lg main">
    <?php for($i = 0; $i < 6; $i++): ?>
    <div class="card activity-card">
        <a href="#"></a>
        <div class="row g-0 content">
            <img src="https://via.placeholder.com/468x200?text=Sample+Image">
            <div class="card-body" style="flex:1;">
                <h5 class="card-title text-overflow">学生が地元を取材し、Uターンをの形を探すインスタマガジン「梨パック」が最高</h5>
                <span class="badge bg-secondary">地元活性化サークル</span>
                <p class="card-text"><small class="text-muted">2022.09.05</small></p>
            </div>
        </div>
    </div>
    <?php endfor; ?>
</div>

<div class="page">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item disabled"><a class="page-link" href="#">戻る</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">次へ</a></li>
        </ul>
    </nav>
</div>

<!-- フッター -->
<?php footer('index'); ?>