<?php
/* Template Name: サークル作成編集ページ */

/**
 * TODO
 * ・ドラフト投稿機能を付ける
 * ・画像アップロードの投稿IDを設定する　260行目
 * ・下書き保存
 * ・
 * 
 * フロー図：https://docs.google.com/drawings/d/1_D9srwDlzHAwPy2sCkck6nT2wg6cu_afPSiU9KdmMNo/edit?usp=sharing
*/

get_header();

/* media_upload.phpのリンクを指定する */
$img_post_url = home_url('index.php/media-upload');

/* サークル特色変数 */
$features = [
    "のんびり",
    "掛け持ちOK",
    "掛け持ち非推奨",
    "しっかり",
    "オンライン活動",
    "飲み会あり",
    "顧問在籍",
    "土日活動",
    "平日活動",
    "設立1年未満",
];

/* 投稿の初期化 */
if( isset( $_GET['edit'] ) ){
    /* 投稿編集 */
} else {

/* ドラフト作成 */
/*
$post = array(
    'post_title'     => '', // 投稿のタイトル。
    'post_content'   => '', // 投稿の全文。
    'post_status'    => 'draft', // 公開ステータス。デフォルトは 'draft'。
    'post_type'      => 'circle', // 投稿タイプ。デフォルトは 'post'。
    'post_author'    => '', // 作成者のユーザー ID。デフォルトはログイン中のユーザーの ID。
    'post_category'  => array(), // 投稿カテゴリー。デフォルトは空（カテゴリーなし）。
);
$post_id = wp_insert_post()
*/
}
?>

<form class="container mt-4 pb-4 mb-4 needs-validation" id="form" enctype="multipart/form-data" action="" method="post" novalidate>
    <div class="row">
        <div class="col-lg-6">
            <div class="mt-5">
                <h5 class="ms-4">サークル基本情報</h5>
                <div class="mainarea">

                    <!-- サークル名 -->
                    <div class="mb-3">
                        <label class="form-label" for="email-input">サークル名</label>
                        <input type="text" class="form-control" id="circle-name-input" name="circleName"
                            value="" placeholder="サークル名を入力してください"
                            aria-label="サークル名を入力してください" aria-describedby="circle-name-help" required>
                    </div>

                    <!-- トップ画像 -->
                    <div class="mb-3">
                        <p>トップ画像</p>
                        <input type="file" class="form-control" id="top_image" name="topImage" aria-label="file example">
                    </div>

                    <!-- 所属人数 -->
                    <div class="mb-3">
                        <label class="form-label" for="input-belongr">所属人数</label>
                        <input type="number" class="form-control" id="input-belong" name="belongNum"
                            value="" placeholder="10" aria-label="10" min="1" max="999" required>
                    </div>

                    <!-- 活動日程 -->
                    <div class="mb-3">
                        <label class="form-label" for="input">活動日程</label>
                        <input type="text" class="form-control" id="schedule" name="schedule"
                        value="" placeholder="例）月曜日、土曜日" aria-label="10" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">活動場所</label>
                        <input type="text" class="form-control" id="place" name="place"
                        value="" placeholder="例）コクーンタワー、Discord、LINE" aria-label="place" required>
                    </div>

                    <div class="mb-3">
                        <p>サークルカテゴリ</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="radio1" value="運動" required>
                            <label class="form-check-label" for="radio1">運動</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="radio2" value="文化・学術" required>
                            <label class="form-check-label" for="radio2">文化・学術</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="radio3" value="創造" required>
                            <label class="form-check-label" for="radio3">創造</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">設立日</label>
                        <input type="date" class="form-control" id="input-establishmentDate" name="establishmentDate"
                        value="2022-10-09" aria-label="input-establishmentDate" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">活動頻度</label>
                        <input type="text" class="form-control" id="activity-frequency" name="activityFrequency"
                        value="" placeholder="例）毎週、不定期" aria-label="activity-frequency" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">会費</label>
                        <input type="text" class="form-control" id="membership-free" name="membershipFree"
                        value="" placeholder="例）2000円/年、なし" aria-label="membership-free" required>
                    </div>

                    <div class="mb-3">
                        <p>
                            特色<br>
                            <small>
                                サークルの雰囲気が伝わる特色タグです。該当するタグにチェックを入れてください。
                            </small>
                        </p>
                        <div class="d-flex justify-content-around flex-wrap">
                            <?php
                            for( $i = 0; $i < count($features); $i++ ) {
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="<?php echo "chkbox-$i"; ?>" name="features[]" value="<?php echo $features[$i]; ?>">
                                <label class="form-check-label" for="<?php echo "chkbox-$i"; ?>"><?php echo $features[$i]; ?></label>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mt-5">
                <h5 class="ms-4">サークル説明</h5>
                <div class="mainarea">
                    <!-- サークル概要 -->
                    <div class="mb-3">
                    <label for="activity-summary" class="form-label">サークル概要</label>
                        <textarea class="form-control" id="activity-summary" name="activitySummary" rows="3" required></textarea>
                    </div>
                    
                    <!-- 活動内容 -->
                    <div class="mb-3">
                        <p>活動内容</p>
                        <input id="trixeditor" class="form-control" type="text"  name="activityDetail" style="display:none;" required>
                        <trix-editor class="form-control" input="trixeditor"></trix-editor>
                        <div class="invalid-feedback">
                            入力必須です
                        </div>
                    </div>

                    <!-- アルバム画像 -->
                    <div class="mb-3">
                        <p>アルバム画像<br>
                            <small>
                                この項目は必須ではありませんが、サークルの印象が伝わる部分です。
                                お手元に画像がない場合でも、後に追加することは可能です。
                            </small>
                        </p>
                        <input type="file" class="form-control mb-3" aria-label="file example">
                        <input type="file" class="form-control mb-3" aria-label="file example">
                        <input type="file" class="form-control mb-3" aria-label="file example">
                        <input type="file" class="form-control mb-3" aria-label="file example">
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h5 class="ms-4">管理者情報</h5>
                <div class="mainarea">
                    <div class="mb-3">
                        <label class="form-label" for="input">連絡先メールアドレス</label>
                        <input type="text" class="form-control" id="contact-mailaddress" name="contactMailAddress"
                        value="<?php echo wp_get_current_user()->user_email; ?>" placeholder="taro.yamada@gmail.com" aria-label="contact-mailaddress" aria-describedby="help" required>
                        <div id="help" class="form-text">
                            指定されたメールアドレスへサークルの参加申請や、お問い合わせのメールを送信します。gmailにも対応しています。
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">代表者氏名</label>
                        <input type="text" class="form-control" id="representative" name="representative"
                        value="" placeholder="山田太郎" aria-label="representative" aria-describedby="help" required>
                        <div id="help" class="form-text">
                            本サイトへ登録していないユーザーには公開されません。
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around mt-5">
                    <button type="submit" name="submit_type" value="circle_draft" class="btn btn-secondary btn-lg">下書き保存する</button>
                    <button type="submit" name="submit_type" value="circle_post" class="btn btn-primary btn-lg">サークルを作成する</button>
                </div>
            </div>
        </div>
    </div>
    <?php wp_nonce_field( 'circle_post_nonce_action', 'circle_post_nonce' ); ?>
</form>

<!-- 活動記録 画像アップロード -->
<?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
<form enctype="multipart/form-data" method="post" name="imgUploadForm" id="imgUploadForm"></form>

<script>
    // submitボタン押下時に上にスクロールする
    // 入力エラーだった場合に上から見直してもらう
    $('form').submit( () => {
        $(window).scrollTop(0);
    });
</script>

<script>
    /**
     * 活動内容 画像アップロード処理
    */

    // フィールドnonce取得
    var my_image_upload_nonce = document.getElementById('my_image_upload_nonce').value;
    var attachment;

    // 画像ID格納
    var img_id_list = [];

    /* upload media to WordPress */
    // trix-file-accept → trix-attachment-add の順で
    // イベントが実行されたとき、画像をアップロードする。
    // これは、Redoのときに画像をアップロードさせないため。
    var file_upload_flag = 0;
    addEventListener('trix-file-accept', function(){
        console.log("trix-file-accept");
        file_upload_flag = 1;
    });
    addEventListener('trix-attachment-add', function(event) {
        console.log("trix-attachment-add");

        // アップロードされた時
        if(file_upload_flag) {
            file_upload_flag = 0;

            // ファイル情報取得
            attachment = event.attachment;
            var file = attachment.file;
            var id = attachment.id;
            console.log(attachment);

            // 画像ID格納
            img_id_list.push(id);

            /* 通信設定 */
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo $img_post_url; ?>', true);

            // 通信完了時のアクション
            xhr.onreadystatechange = () => {
                console.log(xhr.readyState);
                if(xhr.status == 200){
                    console.log("readystatechange");
                    if(xhr.response){
                        var imgPath = xhr.responseText;
                        console.log(imgPath);
                        attachment.setUploadProgress(70);
                        // TrixEditorに画像をリンクする
                        attachment.setAttributes({
                            url: imgPath,  // img > src
                            href: imgPath  // img > a
                        });
                    }
                }
            };

            // エラー処理
            xhr.onerror = () => {
                console.log("error!");
            }

            // フォーム作成
            var imgUploadForm = document.getElementById('imgUploadForm');
            var formData = new FormData(imgUploadForm);
            formData.append('my_image_upload', file);
            formData.append('my_image_upload_nonce', my_image_upload_nonce);
            formData.append('_wp_http_referer', '/wordpress/index.php/circle-edit/');

            attachment.setUploadProgress(50);

            // データ送信
            xhr.send(formData);
        }
    });
</script>

<?php get_footer(); ?>