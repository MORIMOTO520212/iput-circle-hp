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
    <h2 class="txt-subject text-center">基本情報を確認する</h2>
    <form class="rowtranslate-middle row-cols-1 g-3 mb-5 max-width-sm" novalidate style="padding: 30px 40px;">
        <div class="wrapper-name" style="width: 100%;">
            <div class="form-floating mb-3" style="width: 49%;">
                <input type="text" name="family-name" autocomplete="family-name" class="form-control" id="floatingInput1" placeholder="" value="morimoto" disabled>
                <label for="floatingInput">姓</label>
            </div>
            <div class="form-floating mb-3" style="width: 49%;">
                <input type="text" name="given-name" autocomplete="given-name" class="form-control" id="floatingInput2" placeholder="" value="morimoto" disabled>
                <label for="floatingPassword">名</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput3" placeholder="" value="morimoto" disabled>
            <label for="floatingInput">ユーザー名</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput4" placeholder="name@example.com" value="morimoto" disabled>
            <label for="floatingInput">メールアドレス</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingInput5" placeholder="" value="morimoto" disabled>
            <label for="floatingInput">パスワード</label>
        </div>

        <!-- button -->
        <div class="botton-edit d-flex justify-content-end">
            <button id="edit" class="btn btn-success" type="submit">編集する</button>
        </div>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#testModal">アカウントを削除する</button>
            <button type="button" class="btn btn-warning">ログアウトする</button>
        </div>
        <p>一度削除すると元に戻せません</p>

    </form>

    <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="myModalLabel">本当にアカウントを削除しますか？</div>
                </div>
                <div class="modal-body">
                    <label>一度削除したアカウントはもとに戻すことができません。</label>
                    <label>もう一度ご利用になるには、再登録してください。</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">アカウントを削除する</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</div>

<script>
    var flug = 0;
    $("form").submit(function(){
        if(flug == 0){
            $("#edit").text("更新する");
            $("#floatingInput1").prop("disabled", false);
            $("#floatingInput2").prop("disabled", false);
            $("#floatingInput3").prop("disabled", false);
            $("#floatingInput4").prop("disabled", false);
            $("#floatingInput5").prop("disabled", false);
            flug = 1;
            return false;
        }else{
            $("#edit").text("編集する");
            $("#floatingInput1").prop("disabled", true);
            $("#floatingInput2").prop("disabled", true);
            $("#floatingInput3").prop("disabled", true);
            $("#floatingInput4").prop("disabled", true);
            $("#floatingInput5").prop("disabled", true);
            flug = 0;
        }
    });
</script>

<!-- フッター -->
<?php footer('index'); ?>