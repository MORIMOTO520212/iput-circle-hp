<?php
/**
 * 画像アップロード処理 関数
 * 
 * @param string $input_name 画像が添付されたinputタグのname属性
 * @return array $attachment_id, $img_url
*/
function upload_image( $input_name ) {
  global $max_file_size;

  // ファイルの存在確認
  if ( isset( $_FILES[$input_name] ) === false ) {
      return '';
  }

  // ファイルサイズが5MB以上はアップロードしない
  if ( $_FILES[$input_name]['size'] > $max_file_size ) {
      return '';
  }

  // アップロード処理
  $GLOBALS['upload_post_name'] = $input_name;
  $attachment_id = media_handle_upload( $input_name, 0 );

  // アップロードエラーチェック
  if ( is_wp_error( $attachment_id ) ) {
      // 何もしない
      return '';
  } else {
      // アップロードした画像リンク
      $img_url = wp_get_attachment_image_src( $attachment_id, 'full' )[0];
  }

  return array( $attachment_id, $img_url );
}
?>