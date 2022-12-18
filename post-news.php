<?php
/**
 * Template Name: ニュース投稿ページ
*/
?>

<?php
require_once( get_theme_file_path('assets/components/trix_file_upload_to_wordpress.php') );

get_header();
?>

<!-- 非対応のファイル添付時に表示するモーダル -->
<?php require_once( get_theme_file_path("assets/components/trix_file_type_caution_modal.php") ); ?>
<div class="main mx-2">
    <h2 class="txt-subject text-center">ニュースを投稿する</h2>
    <form class="container g-3 mb-5 max-width-sm needs-validation" enctype="multipart/form-data" action="" method="post" style="padding: 30px 40px;" novalidate>
        
        <div class="mb-3">
          <label class="form-label" for="input">記事タイトル<span>*</span></label>
          <input type="text" maxlength="50" class="form-control" id="title" name="title" value="" placeholder="タイトルを入力" required>
          <div class="invalid-feedback">
              50文字以内で入力してください。
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label" for="input">活動内容<span>*</span></label>
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
            <?php 
            $tag_array = get_tags();
            $tagNum = 1;
            foreach($tag_array as $tag){
              display_checkbox($tag, true, $tagNum);
              $tagNum++;
            }
            ?>
          </div>
          <div class="form-text mb-1">
              タグを選択すると、記事を見つけやすくなります。複数選択可。
          </div>
        </div>
        
        <div class="mb-3">
          <label class="form-label" for="input">ファーストビューへクリップ</label>
          <div id="Help" class="form-text mb-3">
            クリップすると、トップページの一番初めに見える部分に、ギャラリーとして期間中に記事の情報が大きく掲載されます。これにより多くの人に記事を見せることができます。イベント告知などの重要な投稿にお使いください。
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="clipCk" type="checkbox" name="clip" value="true">
            <label class="form-check-label" for="clipCk">クリップする</label>
          </div>
        </div>
        
        <div class="mb-3">
          <label class="form-label" for="input">掲載期限</label>
          <input type="date" id="post-limite" name="limit-date" value="<?php echo date_i18n('Y-m-d')?>" min="2022-12-01" max="2024-12-31">          
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
                <button type="submit" class="btn btn-primary" name="submit_type" value="post_activity">投稿する</button>
            </div>
        </div>
        <?php wp_nonce_field( 'Mw8mgUz5', 'post_activity_nonce' ); ?>
    </form>
</div>

<?php
  function display_checkbox($tag, $isChecked,$tagNum){
  ?>
    <div class="form-check form-check-inline">
      <input class="form-check-input" id="chk<?php echo $tagNum ?>" type="checkbox" name="tags[]" value="<?php echo $tag->name ?>">
      <label class="form-check-label" for="chk<?php echo $tagNum ?>"><?php echo $tag->name ?></label>
    </div>
  <?php
  }
?>

<?php trix_file_upload_to_wordpress(); ?>

<?php get_footer(); ?>