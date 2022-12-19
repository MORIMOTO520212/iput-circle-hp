<?php
/**
 * Template Name: 活動記録投稿ページ
*/
?>

<?php
require_once( get_theme_file_path('assets/components/trix_file_upload_to_wordpress.php') );

get_header();
?>

<!-- 非対応のファイル添付時に表示するモーダル -->
<?php require_once( get_theme_file_path("assets/components/trix_file_type_caution_modal.php") ); ?>

<div class="main mx-2">
    <h2 class="txt-subject text-center">活動記録を書く</h2>
    <form class="container g-3 mb-5 max-width-sm needs-validation" enctype="multipart/form-data" action="" method="post" style="padding: 30px 40px;" novalidate>
        
        <div class="mb-3">
            <label class="form-label" for="input">見出し<span>*</span></label>
            <input type="text" maxlength="50" class="form-control" id="title" name="title" value="" placeholder="見出しを入力" required>
            <div class="invalid-feedback">
                50文字以内で入力してください。
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="input">活動内容<span>*</span></label>
            <input type="text" class="form-control" id="trixeditor" name="contents" value="" style="display:none;" required>
            <div>
                <button type="button" class="btn btn-outline-secondary btn-sm mb-2">テンプレートを使う</button>
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
                    <input class="form-check-input" id="chk2" type="checkbox" name="tags[]" value="活動報告" checked>
                    <label class="form-check-label" for="chk2">活動報告</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk1" type="checkbox" name="tags[]" value="行事・イベント">
                    <label class="form-check-label" for="chk1">行事・イベント</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk3" type="checkbox" name="tags[]" value="重要報告">
                    <label class="form-check-label" for="chk3">重要報告</label>
                </div>
            </div>
            <div class="form-text mb-1">
                タグを選択すると、記事を見つけやすくなります。複数選択可。
            </div>

            <div class="d-flex align-items-center">
                <p class="m-0 pe-1">サークル</p>
                <select class="form-select form-select-sm" name="organizationId" style="flex:1" aria-label="所属サークルを選択する">
                    <!-- set value post id -->
                    <option value="false" selected>なし</option>
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'circle',
                        'post_status' => 'publish',
                        'author' => wp_get_current_user()->id,
                    );
                    $posts = get_posts( $args );
                    
                    foreach( $posts as $post ):
                        $category_name = get_the_category( $post->ID )[0]->cat_name;
                        $category_id = get_the_category( $post->ID )[0]->cat_ID;
                    ?>
                    <option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
                <div style="flex:1"></div>
            </div>
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

<?php trix_file_upload_to_wordpress(); ?>

<?php get_footer(); ?>