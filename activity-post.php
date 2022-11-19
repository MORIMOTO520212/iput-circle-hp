<!-- 活動記録投稿ページ -->
<?php
require_once 'header.php';
require_once 'footer.php';
?>

<?php
/* header.php 読み込み */
head('activity-post', '活動投稿 | IPUT学生団体');
?>

<div class="main container">
    <h2 class="txt-subject text-center">活動記録を投稿する</h2>
    <form class="rowtranslate-middle row-cols-1 g-3 mb-5 max-width-sm" novalidate style="padding: 30px 40px;">
        <p>活動のタイトル<span style="color: #FB0D0D;">*</span></p>
            <div class="mb-3">
                <input type="text" class="form-control" id="floatingInput1" value="タイトルを入力">
            </div>
        <p>活動内容<span style="color: #FB0D0D;">*</span></p>
        <input id="x" type="hidden" name="content">
        <trix-editor class="form-control mb-3" input="x"></trix-editor>
        <p>タグ付け</p>
        <div class="d-flex justify-content-start mb-1 flex-wrap">
           <div class="form-check form-check-inline">
               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
               <label class="form-check-label" for="defaultCheck1">
               行事・イベント
               </label>
           </div>
           <div class="form-check form-check-inline">
               <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
               <label class="form-check-label" for="defaultCheck2">
               活動報告
               </label>
           </div>
           <div class="form-check form-check-inline">
               <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
               <label class="form-check-label" for="defaultCheck2">
               重要報告
               </label>
           </div>
        </div>
        <div id="Help" class="form-text mb-3">
           タグを選択すると、記事を見つけやすくなります。複数選択可。
           </div>
        <p>内部公開</p>
        <div class="form-check mb-1">
               <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
               <label class="form-check-label" for="defaultCheck2">
               内部公開にする
               </label>
           </div>
           <div id="Help" class="form-text mb-5">
           ログインしているユーザーに記事が公開されないように設定できます。
           </div>
           <div class="d-flex justify-content-evenly g-3 mb-3">
           <button type="button" class="btn btn-primary">投稿する</button>
           </div>
    </form>
</div>

<!-- フッター -->
<?php footer('index'); ?>
