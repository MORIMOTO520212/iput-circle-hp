<!-- 基本情報ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('basic-info', '基本情報 | IPUT学生団体');
?>

<!-- コンテンツ -->
<div class="main">
    <h2 class="txt-subject">基本情報を確認する</h2>
    <form class="row row-cols-1 g-3 p-4 pb-5 max-width-md">
        <div class="wrapper-name">
            <div class="form-floating mb-3">
                <input type="text" name="family-name" autocomplete="family-name" class="form-control" id="floatingInput1" placeholder="" value="morimoto" disabled>
                <label for="floatingInput">姓</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="given-name" autocomplete="given-name" class="form-control" id="floatingInput2" placeholder="" value="morimoto" disabled>
                <label for="floatingPassword">名</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput3" placeholder="" value="morimoto" disabled>
            <label for="floatingInput">ユーザー名</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput4" placeholder="name@example.com" value="morimoto" >
            <label for="floatingInput">メールアドレス</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingInput5" placeholder="" value="morimoto" >
            <label for="floatingInput">パスワード</label>
        </div>

        <div class="container col col-md-8 d-flex justify-content-center">
            <button id="edit" class="btn btn-success" type="submit">編集する</button>
        </div>
        <div class="container col col-md-8 d-flex justify-content-center">
            <button type="button" class="btn btn-danger">アカウントを削除する</button>
        </div>
        <div class="container col col-md-8 d-flex justify-content-center">
            <button type="button" class="btn btn-warning">ログアウトする</button>
        </div>




    </form>

</div>

<script>
    var flug = 0;
    $("#edit").click(function(){
        if(flug == 0){
            $(this).text("更新する");
            // $("#floatingInput4").removeAttr("disabled");
            // $("#floatingInput5").removeAttr("disabled");
            flug = 1;
        }else{
            $(this).text("編集する");
            flug = 0;
        }
    });
</script>

<!-- フッター -->
<?php footer('index'); ?>