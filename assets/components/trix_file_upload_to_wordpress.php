<?php
/**
 * Trix.jsで選択された画像ファイルをWordPressのメディアへアップロードする
*/
/* 画像アップロード用media_upload.phpのリンクを指定する */
$img_post_url = home_url('index.php/media-upload');


function trix_file_upload_to_wordpress() {
    global $img_post_url;
    wp_nonce_field( 'P7chUSMY', 'my_image_upload_nonce' );
?>
    <form enctype="multipart/form-data" method="post" name="trixImgUploadForm" id="trixImgUploadForm"></form>

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
        /*
        trix-file-accept → trix-attachment-add の順で
        イベントが実行されたとき、画像をアップロードする。
        これは、Redoのときに画像をアップロードさせないため。
        */
        var file_upload_flag = 0;
        addEventListener('trix-file-accept', function(event) {
            console.log("trix-file-accept");
            if( event['file']['type'] == "image/png" || event['file']['type'] == "image/jpeg" ) {
                file_upload_flag = 1;
            }else{
                fileTypeCaution.show(); // ファイル形式の警告表示
            }
        });
        // Ajax通信でmedia_upload.phpを呼び出してアップロード
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
                                href: imgPath,  // img > a
                            });
                        }
                    }
                };

                // エラー処理
                xhr.onerror = () => {
                    console.log("error!");
                }

                // フォーム作成
                var trixImgUploadForm = document.getElementById('trixImgUploadForm');
                var formData = new FormData(trixImgUploadForm);
                formData.append('my_image_upload', file);
                formData.append('my_image_upload_nonce', my_image_upload_nonce);

                attachment.setUploadProgress(50);

                // データ送信
                xhr.send(formData);
            }
        });
    </script>

<?php
}
?>