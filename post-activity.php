<?php
/**
 * Template Name: 活動記録投稿ページ
*/
?>

<?php
require_once( get_theme_file_path('assets/components/form_loading.php') );
require_once( get_theme_file_path('assets/components/trix_file_upload_to_wordpress.php') );

/* ログイン状態のチェック */
if ( !is_user_logged_in() ) {
    echo "ログインしてください。";
    exit;
}

get_header();

$param__post = get_params('_post'); // 投稿タイプ create-作成, edit-編集, delete-削除
$param_id    = get_params('id');    // 編集時の投稿ID

$tags = array();

if ( isset( $param__post ) ) {
    
    /* 記事新規作成 */
    if ( $param__post === 'create' ) {
        /* PASS */

    /* 記事編集 */
    } elseif ( $param__post === 'edit' ) {
        // idパラメータの存在確認とマイナスの数値や文字記号はエラーとする
        if ( !isset( $param_id ) || !is_numeric( $param_id ) ) {
            echo "エラー1";
            exit;
        }

        $post = get_post( $param_id ); // 記事取得

        // 投稿者かどうか確認
        $author = get_userdata($post->post_author);
        if ( wp_get_current_user()->ID != $author->ID ) {
            echo "エラー2";
            exit;
        }

        $post_custom = get_post_custom( $post->ID ); // カスタムメタデータ取得

        // タグ取得
        $tags = array_map( function($t){return $t->name;}, get_the_tags($param_id) );

    /* サークル削除 */
    } elseif ( $param__post === 'delete' ) {
        $post = get_post( $param_id );
        $author = get_userdata($post->post_author);
        if ( wp_get_current_user()->ID != $author->ID ) {
            echo "エラー3";
            exit;
        }

        $post_custom = get_post_custom( $post->ID );

        // トップ画像 削除
        $attachment_id = get_attachment_id_from_src( $post_custom['topImage'][0] );
        wp_delete_attachment( $attachment_id );

        // 投稿 削除
        wp_delete_post( $post->ID );

        // リダイレクト
        echo "<script>location.href = './index.php/post-dashboard/?type=post';</script>";

    } else {
        echo "エラー4";
        exit;
    }

} else {
    modal('エラー', 'もう一度アクセスし直してください。');
}
?>

<!-- 非対応のファイル添付時に表示するモーダル -->
<?php require_once( get_theme_file_path("assets/components/trix_file_type_caution_modal.php") ); ?>

<div class="main mx-2">
    <h2 class="txt-subject text-center">活動記録を書く</h2>
    <form class="container g-3 mb-5 max-width-sm needs-validation form-loading" enctype="multipart/form-data" action="" method="post" style="padding: 30px 40px;" novalidate>
        
        <div class="mb-3">
            <label class="form-label" for="input">見出し<span>*</span></label>
            <input type="text" maxlength="50" class="form-control" id="title" name="title" value="<?php echo isset($post->post_title) ? $post->post_title : '' ?>" placeholder="見出しを入力" required>
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
            <script>
                // trix editor フォームにコンテンツを配置する
                var activityDetail = '<?php echo $post->post_content ?? '' ?>';
                document.querySelector('trix-editor').innerHTML = activityDetail;
            </script>
        </div>

        <div class="mb-3">
            <label class="form-label" for="input">タグ付け<span>*</span></label>
            <div class="d-flex justify-content-start mb-1">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk2" type="checkbox" name="tags[]" value="活動報告" <?php echo in_array('活動報告', $tags) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="chk2">活動報告</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk1" type="checkbox" name="tags[]" value="行事・イベント" <?php echo in_array('行事・イベント', $tags) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="chk1">行事・イベント</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk3" type="checkbox" name="tags[]" value="重要報告" <?php echo in_array('重要報告', $tags) ? 'checked' : '' ?>>
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
                    <option value="false" <?php echo $param__post === 'create' ? 'checked' : '' ?>>なし</option>
                    <?php
                    // ログイン中のユーザーのサークル一覧
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
                <input class="form-check-input" type="checkbox" name="permission" 
                    value="true" id="chk4" <?php
                    // 内部公開
                    if ( isset( $post_custom['permission'][0] ) ) {
                        if ( $post_custom['permission'][0] === 'true' ) echo 'checked';
                    } ?> >
                <label class="form-check-label" for="chk4">内部公開にする</label>
            </div>
            <div id="Help" class="form-text mb-3">
                ログインしていないユーザーに記事が公開されないようにします。
            </div>
            <div class="d-flex justify-content-evenly g-3 mb-3">
                <?php
                if ( $param__post === 'create' ):
                ?>
                <button type="submit" class="btn btn-primary" name="submit_type" value="post_activity">投稿する</button>
                <?php
                elseif ( $param__post === 'edit' ):
                ?>
                <input type="hidden" name="postID" value="<?php echo $post->ID; ?>">
                <button type="submit" class="btn btn-success" name="submit_type" value="edit_activity">更新する</button>
                <?php endif; ?>
            </div>
        </div>
        <?php wp_nonce_field( 'Mw8mgUz5', 'post_activity_nonce' ); ?>
    </form>
</div>

<?php trix_file_upload_to_wordpress(); ?>

<?php form_loading(); ?>

<?php get_footer(); ?>