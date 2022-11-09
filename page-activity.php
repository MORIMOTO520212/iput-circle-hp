<?php
/**
 * Template Name: 活動一覧
 */
?>

<?php get_header(); ?>

<div class="top">
    <div class="title">
        <h1>活動一覧</h1>
    </div>
    <div class="filter">
        <!-- 検索フォーム -->
        <input type="text" class="search-input form-control" placeholder="検索する文字を入力してください"
        aria-label="search" aria-describedby="basic-addon1">
        <!-- Flex -->
        <div class="search-settings">
            <!-- サークルを選択する -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button"
                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    サークルを選択する
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">サークル名1</a></li>
                    <li><a class="dropdown-item" href="#">サークル名2</a></li>
                    <li><a class="dropdown-item" href="#">サークル名3</a></li>
                </ul>
            </div>
            <input type="checkbox" class="btn-check" id="btn-check1" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check1">行事・イベント</label>
            <input type="checkbox" class="btn-check" id="btn-check2" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check2">活動記録</label>
            <input type="checkbox" class="btn-check" id="btn-check3" autocomplete="off">
            <label class="tag btn btn-outline-secondary" for="btn-check3">重要連絡</label>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <button type="button" class="btn btn-primary">この条件で検索する</button>
        </div>
    </div>
</div>

<div class="container pt-4 pb-4" style="max-width: 750px !important;">
    <div class="row row-cols-1  row-cols-lg-3 g-2 g-lg-3">

        <?php for($i = 0; $i < 6; $i++): ?>
        <div class="col h-100 card-link">
            <a href="#"></a>
            <div class="card h-100">
                <div class="row g-0">
                    <div class="col-4  col-lg-12">
                        <img src="https://via.placeholder.com/468x200?text=Sample+Image"
                        class="card-img-top ratio h-100" alt="...">
                    </div>
                    <div class="col-8  col-lg-12">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span class="line-clamp-3">学生が地元を取材し、Uターンをの形を探すインスタマガジン「梨パック」が最高</span>
                            </h5>
                            <span class="badge bg-secondary">地元活性化サークル</span>
                            <p class="card-text"><small class="text-muted">2022.09.05</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor; ?>

    </div>
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

<?=get_footer()?>