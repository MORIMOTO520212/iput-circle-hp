<?php
/**
 *  Template Name: 基本情報ページ
 */
?>

<?php get_header(); ?>

<!-- コンテンツ -->
<div class="main">
    <h2 class="txt-subject text-center"><?php the_title(); ?></h2>
    <form class="container row-cols-1 g-3 mb-5 max-width-sm" novalidate style="padding: 30px 40px;">
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
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#accountDel">アカウントを削除する</button>
            <button type="button" class="btn btn-warning">ログアウトする</button>
        </div>
        <small class="text-secondary">一度削除すると元に戻せません</small>

    </form>

    <div class="modal fade" id="accountDel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">本当にアカウントを削除しますか？</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-dismiss="modal" style="font-size: 10px;"></button>
                </div>
                <div class="modal-body">
                    <label>一度削除したアカウントはもとに戻すことができません。</label>
                    <label>もう一度ご利用になるには、再登録してください。</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">アカウントを削除する</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                </div>
            </div>
        </div>
    </div>
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
            /* データ更新内容の送信 functions.phpに書く */
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

<?php get_footer(); ?>