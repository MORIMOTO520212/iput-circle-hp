<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('post_dashboard', '記事の管理 | IPUT学生団体');
?>


<main class="container" id="main">
    <!-- 全体 -->
    <div class="px-lg-4 px-0 py-4 mw-100"> 
        <!-- タイトル -->
        <div class="text-secondary text-center fs-2 p-lg-3"> 
            記事の管理
        </div>
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
            <div id="pageBody" class="d-none">
                <?php
                for($i = 1; $i < 300; $i++){
                    //<!-- 記事一覧 -->
                    echo("<form id=\"article-$i\" class=\"row py-3 px-lg-3 border-bottom border-2 border-secondary\">"); //  <!-- １つのページに表示する分だけループさせたい -->
                        // <!-- 記事タイトル -->
                        echo('<a href="" class="col-lg-10 col-7 text-decoration-none text-black text-start overflow-hidden fs-6 text-truncate">事務局よりご連絡・会員情報の変更は事務局までご連絡ください。</a>');
                        // <!-- オプションアイコン -->
                        echo('<div class="col-lg-2 col-5 row mx-auto justify-content-center">');
                            // <!-- 記事編集ボタン bootstrap icons pencil -->
                            echo('<button class="col-6 p-0 me-lg-3 me-2 btn btn-secondary"><a href="https://www.youtube.com/watch?v=Cg2kLDbltIw"><img src="./src/pencil.svg" class="align-middle"></a></button>');
                            // <!-- 記事削除ボタン bootstrap icons trash -->
                            echo('<button class="col-6 p-0 ms-1 btn btn-danger"><a href="https://www.youtube.com/watch?v=dbGCrX_zPfs"><img src="./src/trash.svg" class=""></a></button>');
                        echo('</div>');
                    echo('</form>');
                }?>
            </div>
        </div>
        <!-- ページバー bootstrap pagination -->
        <nav><ul class="pagination pt-3 justify-content-center" id="pagination"></ul></nav>
    </div>
</main>
<script>
    //define functions
    function setPage(){
        const allArticle = document.getElementById('pageBody').getElementsByTagName('form'); //記事の数
        const articleParPage = 10; //1ページに表示する記事の数
        let articleArray = []; //全ての記事を格納配列
        let pageArray = []; //ページごとに表示する記事の番号を格納した配列

        for(let i=0; i<allArticle.length; i++){
            articleArray[i] = allArticle[i]; 
        }
        for(let i = 0; i<Math.ceil(allArticle.length/articleParPage); i++){
            let j = i* articleParPage;
            let p = articleArray.slice(j, j + articleParPage);
            pageArray.push(p);
        }
        return pageArray;  // ページの最大数を返す
    }
    function createPage(page, pageArray){
        if(page != 0){
            for(let i=0; i<pageArray.length; i++){ 
                for(let j=0; j<pageArray[i].length; j++){ // クエリの番号とページ番号の照合
                    if(i != page - 1) // 不一致の場合
                        pageArray[i][j].className += " d-none";
                    else // 一致の場合
                        pageArray[i][j].className += " d-flex";
                }
            }
            return true;
        }
        else
            return false;
    }
    function CreatePagination(page, maxPageNum){ // ページネーションを作る
        // ページネーション
        let html = ' ';
        // 前へ
        if (page > 1)
            html += `<li class="page-item"><a class="page-link" href="?page=${page - 1}">前へ</a></li>`; 
        // 最初のページ
        if (page > 2)
            html += `<li class="page-item"><a class="page-link" href="?page=1">1</a></li>`; 
        // page=1
        if (page == 1){
            for (let i = page-1; i<page+3 && i<maxPageNum+1; i++){
                if (i < 1) continue;
                if (i == page) {
                    html += `<li class="page-item active"><a class="page-link" href="?page=${i}" >${i}</a></li>`;
                    continue;
                }
                html += `<li class="page-item"><a class="page-link" href="?page=${i}">${i}</a></li>`; 
            }
        }
        // そのた
        if (page != 1 && page != maxPageNum){
            for (let i = page-1; i<page+2 && i<maxPageNum+1; i++){
                if (i < 1) continue;
                if (i == page) {
                    html += `<li class="page-item active"><a class="page-link" href="?page=${i}" >${i}</a></li>`;
                    continue;
                }
                html += `<li class="page-item"><a class="page-link" href="?page=${i}">${i}</a></li>`; 
                }
        }
        // page = 最後
        if (page == maxPageNum){
            for (let i = page-2; i<page+2 && i<maxPageNum+1; i++){
                if (i < 1) continue;
                if (i == page) {
                    html += `<li class="page-item active"><a class="page-link" href="?page=${i}" >${i}</a></li>`;
                    continue;
                }
                html += `<li class="page-item"><a class="page-link" href="?page=${i}">${i}</a></li>`; 
            }
        }
        // 最後のページ
        if(page < maxPageNum - 1)
            html += `<li class="page-item"><a class="page-link" href="?page=${maxPageNum}">${maxPageNum}</a></li>`;
        // 次へ
        if (page != maxPageNum)
            html += `<li class="page-item"><a class="page-link" href="?page=${page + 1}">次へ</a></li>`; //

        document.getElementById('pagination').innerHTML = html;
        return 0;
    }




    //start
    const url = new URL(location);
    const mainPage = document.getElementById('main'); //全体
    const pageBody = document.getElementById('pageBody'); //記事の一覧
    pageBody.className = "d-none"; //pageBodyをd-noneにする
    // ページ数取得
    let page = Number(url.searchParams.get('page')); // 現在のページ番号
    const allArticleArray = setPage();
    const maxPage = allArticleArray.length; // ページの最大数を取得
    if (page < 1 ){ 
        mainPage.className = "d-none";
        url.searchParams.set('page', '1'); //クエリパラメータを設定
        location.href = url.toString(); // 遷移
    }
    else
        console.log("クエリパラメータ: " + url.searchParams.get('page') + "| 現在のページ: " + page + "| 最大ページ数: " + maxPage);
        let canCreatPage = createPage(page, allArticleArray);
        if(canCreatPage == true){
            pageBody.className = "d-block"; //pageBodyをd-blcokにする
            CreatePagination(page, maxPage);
        }
        else
            console.error("管理者にご連絡ください。");
    

</script>