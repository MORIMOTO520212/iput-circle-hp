<?php
/**
 * 活動記録投稿ページ 投稿処理
 * 
 * # データベースに記録されるデータ
 * ## 記事データ一覧
 * - post_title    - タイトル
 * - post_content  - 本文(ボディ)
 * - post_category - 活動のカテゴリIDとサークルカテゴリID
 * - tags_input    - タグ
 * - post_status   - 公開設定
 * 
 * ## カスタムメタデータ一覧
 * - organization  - 所属サークル名
 * - permission    - 内部公開設定 true-内部公開, false-外部公開
*/
function post_activity() {
  if ( isset(
      $_POST['title'],       // 記事のタイトル
      $_POST['contents'],    // 記事の内容
      $_POST['organizationId'] // 所属しているサークルのカテゴリID
  ) )
  {
      // 文字数チェック
      if ( mb_strlen( $_POST['title'] )    > 50 ) input_value_error_exit();
      if ( mb_strlen( $_POST['contents'] ) <  1 ) input_value_error_exit();

      // タグが規定の名前であるかチェック
      if ( isset( $_POST['tags'] ) ) {
          array_map( function ($tag) {
              if ( !in_array( $tag, array('活動報告', '行事・イベント', '重要報告') ) ) {
                  modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
                  return;
              }
          }, $_POST['tags'] );
      }

      $post_data = array(
          'post_title'    => $_POST['title'],    // タイトル
          'post_content'  => $_POST['contents'], // コンテンツ
          'post_category' => array( get_cat_ID('activity'),  $_POST['organizationId'] ),  // カテゴリID
          'tags_input'    => $_POST['tags'] ?? '', // タグ
          'post_status'   => 'publish', // 公開設定
      );

      /* 新規投稿の場合の処理 */
      if ( $_POST['submit_type'] === 'post_activity' ) {
          // スラッグ名を作成する（時間をmd5でハッシュ化したもの）
          $post_data['post_name'] = md5( time() );
      }

      /* 編集の場合の処理 */
      elseif ( $_POST['submit_type'] === 'edit_activity' ) {

          if ( isset( $_POST['postID'] ) ) {

              // 投稿者かどうか確認
              $author = get_userdata(get_post( $_POST['postID'] )->post_author);
              if ( wp_get_current_user()->ID != $author->ID ) {
                  modal('エラー', '記事を更新できるのは本人のみです。');
                  return;
              }
              // postIDを指定する
              $post_data['ID'] = $_POST['postID'];

              // post_dateは更新させない
              $post_data['post_date'] = get_post( $_POST['postID'] )->post_date;
          }
      }

      $post_id = wp_insert_post( $post_data, true );

      if ( is_wp_error( $post_id ) ) {
          echo $post_id->get_error_code();
          echo $post_id->get_error_message();
          modal('記事の投稿に失敗しました', "{$post_id->get_error_code()}<br>{$post_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
          return;
      }
      
      // 内部公開 設定
      if ( isset( $_POST['permission'] ) ) {
          update_post_meta( $post_id, 'permission', 'true' );
      } else {
          update_post_meta( $post_id, 'permission', 'false' );
      }

      // 記事内容から画像リンクを取得し、アイキャッチ画像を設定する
      $pattern = (is_localhost() ? 'http:' : 'https:') . "\/\/(.*?)(.png|.jpg|.jpeg)";
      preg_match( "/{$pattern}/", $_POST['contents'], $matches ); // 画像URLのパターンマッチ
      $topImage_url = !empty( $matches ) ? esc_url( $matches[0] ) : '';

      if ( !empty( $topImage_url ) ) {
          $topImage_id = get_attachment_id_from_src( $topImage_url ); // urlからサムネイルIDを取得
          update_post_meta( $post_id, 'topImage', $topImage_id );

      } else {
          update_post_meta( $post_id, 'topImage', '' );
      }

      // リダイレクト
      wp_redirect( get_permalink( $post_id ) );
      exit;
      return true;

  } else {
      modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
      return;
  }
}