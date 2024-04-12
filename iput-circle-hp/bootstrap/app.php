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
?>