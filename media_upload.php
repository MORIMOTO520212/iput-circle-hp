<?php
/**
 * Template Name: メディアアップロード
 * サークル作成ページや、活動記録投稿ページの本文に画像を張り付けた際にWordPressへアップロードする
 */

// WordPress Nonceチェック
if ( 
	isset( $_POST['my_image_upload_nonce'] )
	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'P7chUSMY' )
) {	
	// WordPress にアップロードを処理させる
	$img_url = upload_image('my_image_upload')[1] ?? '';
	echo $img_url;

} else {
    // セキュリティチェック失敗
    echo false;
}
?>