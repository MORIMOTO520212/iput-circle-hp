<?php
// 投稿カテゴリーの存在チェック（activity, news）
// なければ作成する.
function check_post_categories() {
  $cat_id = get_cat_ID('activity');
  if($cat_id != 0 || !$cat_id) {
      require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
      wp_create_category('activity');
  }
  $cat_id = get_cat_ID('news');
  if($cat_id != 0 || !$cat_id) {
      require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
      wp_create_category('news');
  }
}
check_post_categories();

/**
 * カスタム投稿タイプ サークル
 * 
 */
function post_type_circle() {
  register_post_type('circle', // 投稿タイプ名
  array(
      'labels' => array(
          'name'          => 'サークル',
          'singular_name' => 'circle'
      ),
      'public' => true,
      'menu_position' => 5,
  )
  );
}
add_action('init', 'post_type_circle');

/**
 * 容量が大きい画像の圧縮
 * 
 * 指定ファイルサイズ以上なら横幅1200pxで圧縮
*/
function otocon_resize_at_upload( $file ) {
  global $compression_file_size_threshold; // ファイルサイズ閾値
if ( $file['type'] == 'image/jpeg' || $file['type'] == 'image/gif' || $file['type'] == 'image/png') {
      if ( $_FILES[$GLOBALS['upload_post_name']]['size'] > $compression_file_size_threshold ) {
          $w = 1200;
          $h = 0;
          $image = wp_get_image_editor( $file['file'] );
          if ( ! is_wp_error( $image ) ) {
              $size = getimagesize( $file['file'] );
              if ( $size[0] > $w || $size[1] > $h ){
                  $image->resize( $w, $h, false );
                  $image->save( $file['file'] );
              }
          } else {
              echo $image->get_error_message();
          }
      }

}
return $file;
}
add_action( 'wp_handle_upload', 'otocon_resize_at_upload' );
?>