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

require_once( get_theme_file_path('assets/components/trix_file_upload_to_wordpress.php') );
require_once( get_theme_file_path('assets/components/form_loading.php') );

get_header();

/* サークル特色 */
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

// パラメータ取得
$param__post = get_params('_post'); // 投稿タイプ create-作成, edit-編集, delete-削除
$param_id    = get_params('id');    // 編集時の投稿ID

if ( isset( $param__post ) ) {

    /* サークル新規作成 */
    if ( $param__post === 'create' ) {
        /* PASS */

    /* サークル編集 */
    } elseif ( $param__post === 'edit' ) {
        // idパラメータの存在確認とマイナスの数値や文字記号はエラーとする
        if ( !isset( $param_id ) || !is_numeric( $param_id ) ) {
            echo "エラー";
            exit;
        }

        $post = get_post( $param_id ); // 記事取得

        // 投稿者かどうか確認
        $author = get_userdata($post->post_author);
        if ( wp_get_current_user()->ID != $author->ID ) {
            echo "エラー";
            exit;
        }
        
        $post_custom = get_post_custom( $post->ID ); // カスタムメタデータ取得

        /* 入力フォーム値の初期化 */
        $input = array(
            'circleName'         => $post->post_title, // サークル名
            'belongNum'          => $post_custom['belongNum'][0], // 所属人数
            'schedule'           => $post_custom['schedule'][0], // 活動日程
            'place'              => $post_custom['place'][0], // 活動場所
            'categoryRadio'      => $post_custom['categoryRadio'][0], // サークルカテゴリ
            'establishmentDate'  => $post_custom['establishmentDate'][0], // 設立日
            'activityFrequency'  => $post_custom['activityFrequency'][0], // 活動頻度
            'membershipFree'     => $post_custom['membershipFree'][0], // 会費
            'features'           => maybe_unserialize( $post_custom['features'][0] ), // 特色(array)
            'activitySummary'    => $post->post_content, // サークル概要
            'activityDetail'     => $post_custom['activityDetail'][0], // 活動内容
            'contactMailAddress' => $post_custom['contactMailAddress'][0], // 連絡先
            'representative'     => $post_custom['representative'][0], // 代表者氏名
            'twitterUserName'    => $post_custom['twitterUserName'][0], // 公式Twitterユーザー名
        );

    /* サークル削除 */
    } elseif ( $param__post === 'delete' ) {
        $post = get_post( $param_id );
        $author = get_userdata($post->post_author);
        if ( wp_get_current_user()->ID != $author->ID ) {
            echo "エラー";
            exit;
        }
        /* 削除処理 */

    } else {
        echo "エラー";
        exit;
    }
} else {
    modal('エラー', 'もう一度アクセスし直してください。');
}
?>

<!-- 非対応のファイル添付時に表示 -->
<?php require_once( get_theme_file_path("assets/components/trix_file_type_caution_modal.php") ); ?>

<form class="container mt-4 pb-4 mb-4 needs-validation form-loading" id="form" enctype="multipart/form-data" action="" method="post" novalidate>
    <div class="row">
        <div class="col-lg-6">
            <div class="mt-5">
                <h5 class="ms-4">サークル基本情報</h5>
                <div class="mainarea">

                    <!-- サークル名 -->
                    <div class="mb-3">
                        <label class="form-label" for="email-input">サークル名</label>
                        <input type="text" maxlength="50" class="form-control" id="circle-name-input" name="circleName"
                            placeholder="サークル名を入力してください" value="<?php echo $input['circleName'] ?? ''; ?>"
                            aria-label="サークル名を入力してください" aria-describedby="circle-name-help" required>
                        <div class="invalid-feedback">
                            50文字以内で入力してください。
                        </div>
                    </div>

                    <!-- トップ画像 -->
                    <div class="mb-3">
                        <label class="form-label" for="top-image">トップ画像</label>
                        <input type="file" class="form-control" id="top-image" name="topImage" accept="image/png, image/jpeg">
                        <div class="form-text">
                            <?php
                            if ( $param__post === 'create' ) {
                                echo "5MB以下のファイルをアップロードできます。";
                            }
                            elseif ( $param__post === 'edit' ) {
                                echo "画像を更新する場合は、アップロードしてください。";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- ヘッダー画像 -->
                    <div class="mb-3">
                        <label class="form-label" for="header-image">ヘッダー画像</label>
                        <input type="file" class="form-control" id="header-image" name="headerImage" accept="image/png, image/jpeg">
                        <div class="form-text">
                            <?php
                            if ( $param__post === 'create' ) {
                                echo "5MB以下のファイルをアップロードできます。";
                            }
                            elseif ( $param__post === 'edit' ) {
                                echo "画像を更新する場合は、アップロードしてください。";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- 所属人数 -->
                    <div class="mb-3">
                        <label class="form-label" for="input-belongr">所属人数</label>
                        <input type="number" min="1" max="999" class="form-control" id="input-belong" name="belongNum"
                            placeholder="10" value="<?php echo $input['belongNum'] ?? ''; ?>" required>
                    </div>

                    <!-- 活動日程 -->
                    <div class="mb-3">
                        <label class="form-label" for="schedule">活動日程</label>
                        <input type="text" maxlength="15" class="form-control" id="schedule" name="schedule"
                            placeholder="例）月曜日、土曜日" value="<?php echo $input['schedule'] ?? ''; ?>" required>
                        <div class="invalid-feedback">
                            15文字以内で入力してください。<br>詳しい活動日程は活動内容へ記入するようにしてください。
                        </div>
                    </div>

                    <!-- 活動場所 -->
                    <div class="mb-3">
                        <label class="form-label" for="input">活動場所</label>
                        <input type="text" maxlength="13" class="form-control" id="place" name="place"
                            placeholder="例）コクーンタワー、Discord、LINE" value="<?php echo $input['place'] ?? ''; ?>" required>
                        <div class="invalid-feedback">
                            10文字以内で入力してください。<br>例えば、学校、カフェ、スタジオなど。詳しい活動日程は活動内容へ記入するようにしてください。
                        </div>
                    </div>

                    <div class="mb-3">
                        <p>サークルカテゴリ</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="radio1" value="運動" <?php echo ($input['categoryRadio'] ?? '') === '運動' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="radio1">運動</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="radio2" value="文化・学術" <?php echo ($input['categoryRadio'] ?? '') === '文化・学術' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="radio2">文化・学術</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="radio3" value="創造" <?php echo ($input['categoryRadio'] ?? '') === '創造' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="radio3">創造</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">設立日</label>
                        <input type="date" class="form-control" id="input-establishmentDate" name="establishmentDate"
                            aria-label="input-establishmentDate" value="<?php echo $input['establishmentDate'] ?? '2022-12-12'; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">活動頻度</label>
                        <input type="text" maxlength="10" class="form-control" id="activity-frequency" name="activityFrequency"
                            placeholder="例）毎週、不定期" aria-label="activity-frequency" value="<?php echo $input['activityFrequency'] ?? ''; ?>" required>
                        <div class="invalid-feedback">
                            10文字以内で入力してください。<br>詳しい活動日程は活動内容へ記入するようにしてください。
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">会費</label>
                        <input type="text" maxlength="30" class="form-control" id="membership-free" name="membershipFree"
                            placeholder="例）2000円/年、なし" aria-label="membership-free" value="<?php echo $input['membershipFree'] ?? ''; ?>" required>
                        <div class="invalid-feedback">
                            30文字以内で入力してください。
                        </div>
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
                            // editモードでは設定済みの特色にチェックを入れる
                            for( $i = 0; $i < count($features); $i++ ):
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="<?php echo "chkbox-$i"; ?>"
                                    name="features[]" value="<?php echo $features[$i]; ?>" <?php echo in_array( $features[$i], ($input['features'] ?? array()) ) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="<?php echo "chkbox-$i"; ?>"><?php echo $features[$i]; ?></label>
                            </div>
                            <?php
                            endfor;
                            ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">公式Twitterユーザー名</label>
                        <input type="text" maxlength="30" pattern="^[a-zA-Z0-9_]{1,40}$" class="form-control" id="twitter-username" name="twitterUserName"
                            placeholder="ユーザー名" aria-label="twitter-username" value="<?php echo $input['twitterUserName'] ?? '' ?>">
                        <div class="form-text">
                            サイドバーからTwitterにアクセスできるようになります。
                        </div>
                        <div class="invalid-feedback">
                            @などの記号は使えません。
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
                        <textarea maxlength="200" class="form-control" id="activity-summary" name="activitySummary" rows="3" required><?php echo $input['activitySummary'] ?? '' ?></textarea>
                        <div class="form-text">
                            100文字以内で簡潔にサークルの概要を書いてください。
                        </div>
                    </div>
                    
                    <!-- 活動内容 -->
                    <div class="mb-3">
                        <p>活動内容</p>
                        <input id="trixeditor" class="form-control" type="text"  name="activityDetail" style="display:none;" value="" required>
                        <div>
                            <button type="button" class="btn btn-outline-secondary btn-sm mb-2">テンプレートを使う</button>
                            <trix-editor class="form-control" input="trixeditor"></trix-editor>
                        </div>
                        <div class="invalid-feedback">
                            入力必須です
                        </div>
                        <script>
                            // trix editor フォームにコンテンツを配置する
                            var activityDetail = '<?php echo $input['activityDetail'] ?? '' ?>';
                            document.querySelector('trix-editor').innerHTML = activityDetail;
                        </script>
                    </div>

                    <!-- アルバム画像 -->
                    <div class="mb-3">
                        <p>アルバム画像<br>
                            <small>
                                必須ではありませんが、サークルの印象が伝わる部分です。
                                お手元に画像がない場合でも、後に追加することは可能です。
                            </small>
                        </p>
                        <input type="file" class="form-control mb-3" aria-label="アルバム1" disabled>
                        <input type="file" class="form-control mb-3" aria-label="アルバム2" disabled>
                        <input type="file" class="form-control mb-3" aria-label="アルバム3" disabled>
                        <input type="file" class="form-control mb-3" aria-label="アルバム4" disabled>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h5 class="ms-4">管理者情報</h5>
                <div class="mainarea">
                    <div class="mb-3">
                        <label class="form-label" for="input">連絡先メールアドレス</label>
                        <input type="text" maxlength="50" class="form-control" id="contact-mailaddress" name="contactMailAddress"
                        value="<?php echo $input['contactMailAddress'] ?? wp_get_current_user()->user_email; ?>" placeholder="taro.yamada@gmail.com" aria-describedby="help" required>
                        <div id="help" class="form-text">
                            指定されたメールアドレスへサークルの参加申請や、お問い合わせのメールを送信します。gmailにも対応しています。
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="input">代表者氏名</label>
                        <input type="text" maxlength="30" class="form-control" id="representative" name="representative"
                            placeholder="山田太郎" aria-describedby="help" value="<?php echo $input['representative'] ?? ''; ?>" required>
                        <div id="help" class="form-text">
                            本サイトへ登録していないユーザーには公開されません。
                        </div>
                        <div class="invalid-feedback">
                            入力してください。
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around mt-5">
                    <?php
                    if ( $param__post === 'create' ):
                    ?>
                    <button type="submit" name="submit_type" value="circle_draft" class="btn btn-secondary btn-lg" disabled>下書き保存する</button>
                    <button type="submit" name="submit_type" value="circle_post" class="btn btn-primary btn-lg">サークルを作成する</button>
                    <?php
                    elseif ( $param__post === 'edit' ):
                    ?>
                    <input type="hidden" name="postID" value="<?php echo $post->ID; ?>">
                    <a class="btn btn-secondary btn-lg" href="<?php echo home_url("index.php/author/" . wp_get_current_user()->user_login); ?>" role="button">キャンセル</a>
                    <button type="submit" name="submit_type" value="circle_edit" class="btn btn-success btn-lg">サークルを更新する</button>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php wp_nonce_field( 'n4Uyh98k', 'circle_post_nonce' ); ?>
</form>


<script>
    // submitボタン押下時に上にスクロールする
    // 入力エラーだった場合に上から見直してもらう
    $('form').submit( () => {
        $(window).scrollTop(0);
    });
</script>

<?php trix_file_upload_to_wordpress(); ?>

<?php form_loading(); ?>

<?php get_footer(); ?>