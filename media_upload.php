<?php
/* Template Name: メディアアップロード */

// 参考にしたサイト：https://wpdocs.osdn.jp/関数リファレンス/media_handle_upload

// nonce が有効で、ユーザーがこの投稿を編集可能であるかチェック。
if ( 
	isset( $_POST['my_image_upload_nonce'], $_POST['post_id'] ) 
	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
	&& current_user_can( 'edit_post', $_POST['post_id'] )
) {
	// nonce が有効で、ユーザーが権限を持つので、続けて大丈夫。

	// 下記のファイルに依存するのでフロントエンドではインクルードする必要がある。
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	
	// WordPress にアップロードを処理させる。
	// 注意: 'my_image_upload' は上のフォームで file input 要素の name 属性。
	$attachment_id = media_handle_upload( 'my_image_upload', $_POST['post_id'] );
	
	if ( is_wp_error( $attachment_id ) ) {
		// 画像のアップロード中にエラーが起きた。
        echo $attachment_id.get_error_code();
	} else {
		// 画像のアップロードに成功 !
        echo wp_get_attachment_image_src($attachment_id, 'full')[0];
	}

} else {
    // セキュリティチェック失敗、例えばユーザーにエラーを提示。
    echo "<h1>Access Denied!</h1>";
}
?>