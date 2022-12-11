<?php
/* Template Name: 記事管理ページ */
?>

<?php
// クエリパラメータの確認
if ( isset( $_GET['type'], $_GET['d'] ) === false ) {
    echo "エラー";
    exit;
}

/** @var int $posts_length 記事の数をカウントする */
if ( $_GET['type'] === 'post' ) {
    $posts_length = intval( count_user_posts( wp_get_current_user()->id, 'post' ) );
    $title = '記事を管理する';
} elseif ( $_GET['type'] === 'circle' ) {
    $posts_length = intval( count_user_posts( wp_get_current_user()->id, 'circle' ) );
    $title = 'サークルを管理する';
}

// サイトタイトル変更
function change_title() {
    global $title;
    return $title;
}
add_filter( 'the_title', 'change_title', 10, 0 );

get_header();
?>

<main class="container" id="main">
    <!-- 全体 -->
    <div class="px-lg-4 px-0 py-4 mw-100"> 
        <!-- タイトル -->
        <div class="text-secondary text-center fs-2 p-lg-3"><?php echo $title; ?></div>
            <!-- 記事一覧 -->
        <div class="p-3" id="post-dashboard">
            <!-- 記事グリッドのタイトル -->
            <div class="row p-lg-3"> 
                <!-- タイトル -->
                <div class="col-lg-10 col-7 text-secondary text-start fs-6"> 
                    タイトル
                </div>
                <!-- オプション -->
                <div class="col-lg-2 col-5 text-secondary text-center fs-6"> 
                    オプション
                </div>
            </div>
            <!-- 遷移させたいページ -->
            <div id="pageBody">
                <?php
                if ( $posts_length ):
                for($i = 1; $i < 5; $i++):
                    //<!-- 記事一覧 -->
                ?>
                    <form id="<?php echo "article-{$i}" ?>" class="row py-3 px-lg-3 border-bottom border-2 border-secondary"> <!-- １つのページに表示する分だけループさせたい -->
                        <!-- 記事タイトル -->
                        <a href="" class="col-lg-10 col-7 text-decoration-none text-black text-start overflow-hidden fs-6 text-truncate">事務局よりご連絡・会員情報の変更は事務局までご連絡ください。</a>
                        <!-- オプションアイコン -->
                        <div class="col-lg-2 col-5 row mx-auto justify-content-center">
                            <!-- 記事編集ボタン -->
                            <button class="col-6 p-0 me-lg-3 me-2 btn btn-secondary"><a href="?_post=edit"><img src="<?php echo get_theme_file_uri("src/pencil.svg"); ?>" class="align-middle"></a></button>
                            <!-- 記事削除ボタン-->
                            <button class="col-6 p-0 ms-1 btn btn-danger"><a href="?_post=delete"><img src="<?php echo get_theme_file_uri("src/trash.svg"); ?>" class=""></a></button>
                        </div>
                    </form>
                <?php
                endfor;
                else:
                ?>
                    <p class="text-center">まだ記事がありません。</p>
                <?php
                endif;
                ?>
            </div>
        </div>
        <!-- ページバー bootstrap pagination -->
        <nav><ul class="pagination pt-3 justify-content-center" id="pagination"></ul></nav>
    </div>
</main>

<script>
    // define functions
    function setPage() {
        const allArticle = <?php echo $posts_length; ?>; // 記事の数
        const articleParPage = 5;      // 1ページに表示する記事の数
        let articleArray = [];          // 全ての記事を格納配列
        let pageArray = [];             // ページごとに表示する記事の番号を格納した配列

        for(let i=0; i<allArticle.length; i++){
            articleArray[i] = allArticle[i]; 
        }
        for(let i = 0; i<Math.ceil(allArticle.length / articleParPage); i++){
            let j = i * articleParPage;
            let p = articleArray.slice(j, j + articleParPage);
            pageArray.push(p);
        }
        return true;
    }

    // ページネーションを作る
    function CreatePagination(page, maxPageNum){
        // ページネーション
        let html = ' ';
        // 前へ
        if (page > 1)
            html += `<li class="page-item"><a class="page-link" href="?d=${page - 1}">前へ</a></li>`; 
        // 最初のページ
        if (page > 2)
            html += `<li class="page-item"><a class="page-link" href="?d=1">1</a></li>`; 
        // page=1
        if (page == 1){
            for (let i = page-1; i<page+3 && i<maxPageNum+1; i++){
                if (i < 1) continue;
                if (i == page) {
                    html += `<li class="page-item active"><a class="page-link" href="?d=${i}" >${i}</a></li>`;
                    continue;
                }
                html += `<li class="page-item"><a class="page-link" href="?d=${i}">${i}</a></li>`; 
            }
        }
        // そのた
        if (page != 1 && page != maxPageNum){
            for (let i = page-1; i<page+2 && i<maxPageNum+1; i++){
                if (i < 1) continue;
                if (i == page) {
                    html += `<li class="page-item active"><a class="page-link" href="?d=${i}" >${i}</a></li>`;
                    continue;
                }
                html += `<li class="page-item"><a class="page-link" href="?d=${i}">${i}</a></li>`; 
                }
        }
        // page = 最後
        if (page == maxPageNum){
            for (let i = page-2; i<page+2 && i<maxPageNum+1; i++){
                if (i < 1) continue;
                if (i == page) {
                    html += `<li class="page-item active"><a class="page-link" href="?d=${i}" >${i}</a></li>`;
                    continue;
                }
                html += `<li class="page-item"><a class="page-link" href="?d=${i}">${i}</a></li>`; 
            }
        }
        // 最後のページ
        if(page < maxPageNum - 1)
            html += `<li class="page-item"><a class="page-link" href="?d=${maxPageNum}">${maxPageNum}</a></li>`;
        // 次へ
        if (page != maxPageNum)
            html += `<li class="page-item"><a class="page-link" href="?d=${page + 1}">次へ</a></li>`;

        document.getElementById('pagination').innerHTML = html;
        return 0;
    }




    //start
    const url = new URL(location);
    const mainPage = document.getElementById('main'); //全体
    // ページ数取得
    let page = Number(url.searchParams.get('d')); // 現在のページ番号
    setPage();
    const maxPageNum = <?php echo $posts_length; ?>; // ページの最大数を取得
    if (page < 1 ) { // pageクエリ取得失敗
        mainPage.className = "d-none";
        url.searchParams.set('d', '1'); //クエリパラメータを設定
        console.log("set page param.");
        location.href = url.toString(); // 遷移
    }
    else
        console.log(`クエリパラメータ: ${url.searchParams.get('d')} | 現在のページ: ${page} | 最大ページ数: ${maxPageNum}`);
        let canCreatPage = createPage(page, allArticleArray);
        if(canCreatPage == true) {
            CreatePagination(page, maxPageNum);
        }
        else
            console.error("管理者にご連絡ください。");
    

</script>

<?php get_footer(); ?>