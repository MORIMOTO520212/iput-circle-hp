<?php
/**
 * Template Name: ニュース投稿ページ
*/
?>

<?php
require_once( get_theme_file_path('assets/components/trix_file_upload_to_wordpress.php') );

/* ログイン状態のチェック */
if ( !is_user_logged_in() ) {
    echo "ログインしてください。";
    exit;
}

get_header();

$param__post = get_params('_post'); // 投稿タイプ create-作成, edit-編集, delete-削除
$param_id    = get_params('id');    // 編集時の投稿ID

$input = array(
    'ID' => $param_id,
    'post_title' => '',
    'post_content' => '',
    'tags' => array(),
    'clip' => false,
    'limit_date' => date_i18n('Y-m-d'),
    'permission' => 'false'
);

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

        // 記事取得
        $post = get_post( $param_id );

        // 投稿者かどうか確認
        $author = get_userdata($post->post_author);
        if ( wp_get_current_user()->ID != $author->ID ) {
            echo "エラー2";
            exit;
        }

        $post_custom = get_post_custom( $post->ID ); // カスタムメタデータ取得

        // タグ取得
        $tags = array_map( function($t){return $t->name;}, get_the_tags($param_id) );

        $input['post_title']   = $post->post_title;
        $input['post_content'] = $post->post_content;
        $input['tags']         = $tags;
        $input['clip']         = ($post_custom['clip'][0] !== 'false') ? true : false;
        $input['limit_date']   = ($post_custom['clip'][0] !== 'false') ? $post_custom['clip'][0] : date_i18n('Y-m-d');
        $input['permission']   = $post_custom['permission'][0];

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
    <h2 class="txt-subject text-center">ニュースを投稿する</h2>
    <form class="container g-3 mb-5 max-width-sm needs-validation form-loading" enctype="multipart/form-data" action="" method="post" style="padding: 30px 40px;" novalidate>
        
        <div class="mb-3">
            <label class="form-label" for="input">記事タイトル<span>*</span></label>
            <input type="text" maxlength="50" class="form-control" id="title" name="title" 
                value="<?php echo $input['post_title']; ?>" placeholder="タイトルを入力" required>
            <div class="invalid-feedback">
                50文字以内で入力してください。
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="input">内容<span>*</span></label>
            <input type="hidden" class="form-control" id="trixeditor" name="contents" value="" required>
            <div>
                <!-- <button type="button" class="btn btn-outline-secondary btn-sm mb-2">テンプレートを使う（未実装）</button> -->
                <trix-editor class="trix-content form-control" input="trixeditor"></trix-editor>
            </div>
            <div class="invalid-feedback">
                入力必須です。
            </div>
            <script>
                // trix editor フォームにコンテンツを配置する
                var activityDetail = '<?php echo $input['post_content']; ?>';
                document.querySelector('trix-editor').innerHTML = activityDetail;
            </script>
        </div>

        <div class="mb-3">
            <label class="form-label" for="input">タグ付け<span>*</span></label>
            <div class="d-flex justify-content-start mb-1">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk1" type="checkbox" name="tags[]" value="行事・イベント" <?php echo in_array('行事・イベント', $input['tags']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="chk1">行事・イベント</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk2" type="checkbox" name="tags[]" value="レジャー" <?php echo in_array('レジャー', $input['tags']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="chk2">レジャー</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk3" type="checkbox" name="tags[]" value="食事" <?php echo in_array('食事', $input['tags']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="chk3">食事</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk4" type="checkbox" name="tags[]" value="お知らせ" <?php echo in_array('お知らせ', $input['tags']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="chk4">お知らせ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="chk5" type="checkbox" name="tags[]" value="重要連絡" <?php echo in_array('重要連絡', $input['tags']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="chk5">重要連絡</label>
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
                <input class="form-check-input" id="clipCk" type="checkbox" name="clip" value="true" <?php echo $input['clip'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="clipCk">クリップする</label>
            </div>
        </div>
        
        <div class="mb-3 d-flex align-items-center">
            <label class="form-label m-0 pe-2" for="post-limite">掲載期限</label>
            <input type="date" id="post-limite" class="form-control" name="limit-date" value="<?php echo $input['limit_date']; ?>" min="2022-12-01" max="2024-12-31" style="width:unset;">          
        </div>
          
        <div class="mb-3">
            <label class="form-label" for="input">内部公開</label>
            <div class="form-check mb-1">
                <input class="form-check-input" type="checkbox" name="permission" value="true" id="chk4" <?php ($input['permission'] === 'true') ? 'checked' : '' ?> >
                <label class="form-check-label" for="chk4">内部公開にする</label>
            </div>
            <div id="Help" class="form-text mb-3">
                ログインしていないユーザーに記事が公開されないようにします。
            </div>
            <div class="d-flex justify-content-evenly g-3 mb-3">
                <?php
                if ( $param__post === 'create' ):
                ?>
                <button type="submit" class="btn btn-primary" name="submit_type" value="post_news">投稿する</button>
                <?php
                elseif ( $param__post === 'edit' ):
                ?>
                <input type="hidden" name="postID" value="<?php echo $input['ID']; ?>">
                <button type="submit" class="btn btn-success" name="submit_type" value="edit_news">更新する</button>
                <?php endif; ?>
            </div>
        </div>
        <?php wp_nonce_field( 'Fr4XZRu6', 'post_news_nonce' ); ?>
    </form>
</div>


<?php trix_file_upload_to_wordpress(); ?>

<?php get_footer(); ?>