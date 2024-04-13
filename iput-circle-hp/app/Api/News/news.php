<?php
/**
 * ニュース投稿ページ 投稿処理
*/
function post_news() {
  if ( isset(
      $_POST['title'],       // 記事のタイトル
      $_POST['contents'],    // 記事の内容
  ) )
  {
      // 文字数チェック
      if ( mb_strlen( $_POST['title'] )    > 50 ) input_value_error_exit();
      if ( mb_strlen( $_POST['contents'] ) <  1 ) input_value_error_exit();

      // タグが規定の名前であるかチェック
      if ( isset( $_POST['tags'] ) ) {
          array_map( function ( $value ) {
              if ( !in_array( $value, array('行事・イベント', 'レジャー', '食事', 'お知らせ', '重要連絡'), true ) ) {
                  modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
                  return;
              }
          }, $_POST['tags'] );
      }

      $post_data = array(
          'post_title'    => $_POST['title'],    // タイトル
          'post_content'  => $_POST['contents'], // コンテンツ
          'post_category' => array( get_cat_ID('news') ),  // カテゴリID
          'tags_input'    => isset( $_POST['tags'] ) ? $_POST['tags'] : '', // タグ
          'post_status'   => 'publish', // 公開設定
      );

      /* 新規投稿 */
      if ( $_POST['submit_type'] === 'post_news' ) {
          // スラッグ名を作成する（時間をmd5でハッシュ化したもの）
          $post_data['post_name'] = md5( time() );
      }

      /* 更新 */
      elseif ( $_POST['submit_type'] === 'edit_news' ) {

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
      
      // クリップ 設定
      if ( isset( $_POST['clip'] ) ) {
          update_post_meta( $post_id, 'clip', $_POST['limit_date'] );
      } else {
          update_post_meta( $post_id, 'clip', 'false' );
      }

      // 内部公開 設定
      if ( isset( $_POST['permission'] ) ) {
          update_post_meta( $post_id, 'permission', 'true' );
      } else {
          update_post_meta( $post_id, 'permission', 'false' );
      }

      // 記事内容からアイキャッチ画像 設定
      $pattern = (is_localhost() ? 'http:' : 'https:') . "\/\/(.*?)(.png|.jpg|.jpeg)";

      preg_match( "/{$pattern}/", $_POST['contents'], $matches ); // 画像URLのマッチ

      if ( !empty($matches) ) {
          $topImage_url = esc_url( $matches[0] );
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
      modal('エラー', '不正なリクエストです。');
      return;
  }
}