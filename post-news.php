<?php
/**
 * Template Name: ニュース投稿ページ
*/
?>

<?php
require_once( get_theme_file_path('assets/components/trix_file_upload_to_wordpress.php') );
require_once( get_theme_file_path('assets/components/form_loading.php') );

/* ログイン状態のチェック */
if ( !is_user_logged_in() ) {
    echo "ログインしてください。";
    exit;
}

get_header();
?>

<!-- 非対応のファイル添付時に表示するモーダル -->
<?php require_once( get_theme_file_path("assets/components/trix_file_type_caution_modal.php") ); ?>

<div class="main mx-2">
    <h2 class="txt-subject text-center">ニュースを投稿する</h2>
    <form class="container g-3 mb-5 max-width-sm needs-validation form-loading" enctype="multipart/form-data" action="" method="post" style="padding: 30px 40px;" novalidate>
        
        <div class="mb-3">
            <label class="form-label" for="input">記事タイトル<span>*</span></label>
            <input type="text" maxlength="50" class="form-control" id="title" name="title" value="" placeholder="タイトルを入力" required>
            <div class="invalid-feedback">
                50文字以内で入力してください。
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="input">内容<span>*</span></label>
            <input type="text" class="form-control" id="trixeditor" name="contents" value="" style="display:none;" required>
            <div>
                <!-- <button type="button" class="btn btn-outline-secondary btn-sm mb-2">テンプレートを使う</button> -->
                <trix-editor class="form-control" input="trixeditor"></trix-editor>
            </div>
            <div class="invalid-feedback">
                入力必須です。
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="input">タグ付け<span>*</span></label>
            <div class="d-flex justify-content-start mb-1">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk1" type="checkbox" name="tags[]" value="行事・イベント">
                    <label class="form-check-label" for="chk1">行事・イベント</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk2" type="checkbox" name="tags[]" value="レジャー">
                    <label class="form-check-label" for="chk2">レジャー</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk3" type="checkbox" name="tags[]" value="食事">
                    <label class="form-check-label" for="chk3">食事</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk3" type="checkbox" name="tags[]" value="お知らせ">
                    <label class="form-check-label" for="chk3">お知らせ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk4" type="checkbox" name="tags[]" value="重要連絡">
                    <label class="form-check-label" for="chk4">重要連絡</label>
                </div>
            </div>
            <div class="form-text mb-1">
                タグを選択すると、記事を見つけやすくなります。複数選択可。
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label" for="input">ファーストビューへクリップ　<span class="badge bg-warning text-dark">もうすぐ...</span></label>
            <div id="Help" class="form-text mb-3">
                クリップすると、トップページの一番初めに見える部分に、ギャラリーとして期間中に記事の情報が大きく掲載されます。これにより多くの人に記事を見せることができます。イベント告知などの重要な投稿にお使いください。
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="clipCk" type="checkbox" name="clip" value="true">
                <label class="form-check-label" for="clipCk">クリップする</label>
            </div>
        </div>
        
        <div class="mb-3 d-flex align-items-center">
            <label class="form-label m-0 pe-2" for="post-limite">掲載期限</label>
            <input type="date" id="post-limite" class="form-control" name="limit-date" value="<?php echo date_i18n('Y-m-d')?>" min="2022-12-01" max="2024-12-31" style="width:unset;">          
        </div>
          
        <div class="mb-3">
            <label class="form-label" for="input">内部公開</label>
            <div class="form-check mb-1">
                <input class="form-check-input" type="checkbox" name="permission" value="true" id="chk4">
                <label class="form-check-label" for="chk4">内部公開にする</label>
            </div>
            <div id="Help" class="form-text mb-3">
                ログインしていないユーザーに記事が公開されないようにします。
            </div>
            <div class="d-flex justify-content-evenly g-3 mb-3">
                <button type="submit" class="btn btn-primary" name="submit_type" value="post_news">投稿する</button>
            </div>
        </div>
        <?php wp_nonce_field( 'Fr4XZRu6', 'post_news_nonce' ); ?>
    </form>
</div>


<?php trix_file_upload_to_wordpress(); ?>

<?php form_loading(); ?>

<?php get_footer(); ?>