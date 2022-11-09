<?php
/* Template Name: メディアアップロード */
// サークル作成ページや、活動記録投稿ページの本文に画像を張り付ける際に実行される処理
// 参考：https://wpdocs.osdn.jp/関数リファレンス/media_handle_upload

// WordPress Nonceチェック
if ( 
	isset( $_POST['my_image_upload_nonce'] )
	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
) {
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	
	// WordPress にアップロードを処理させる
	// 注意: 'my_image_upload' は上のフォームで file input 要素の name 属性
	$attachment_id = media_handle_upload( 'my_image_upload', 0 );
	
	if ( is_wp_error( $attachment_id ) ) {
		// アップロード中にエラー
        echo $attachment_id.get_error_code();
	} else {
		// アップロードに成功 
        echo wp_get_attachment_image_src($attachment_id, 'full')[0];
	}

} else {
    // セキュリティチェック失敗。
    echo "<h1>Access Denied!</h1>";
}
?>