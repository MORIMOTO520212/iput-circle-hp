<?php
/**
 * ログインページ
*/
function user_login() {
  $user_login    = isset( $_POST['login'] )    ? sanitize_text_field( $_POST['login'] )    : '';
  $user_password = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';

  if ( $user_login === '' )    return;
  if ( $user_password === '' ) return;

  $creds = array();
  $creds += array( 'user_login'    => $user_login    );
  $creds += array( 'user_password' => $user_password );
  if( isset( $_POST['keep_loggedin'] ) ) {
      $creds += array( 'remember', true );
  }

  // ログイン処理
  $user = wp_signon($creds);
  if( is_wp_error($user) ) {
      modal( 'ログインに失敗しました', $user->get_error_message() );
      return;
  }
  // マイページへ遷移する
  wp_redirect( home_url( "index.php/author/{$user->user_login}" ) );
  exit;
  return true;
}

/**
 * サインアップページ アカウント作成
 * 
 * @return true|false 完了, 中断
 */
function user_signup() {
  $user_name       = isset( $_POST['username'] )  ? sanitize_text_field( $_POST['username'] )  : '';
  $user_pass       = isset( $_POST['password'] )  ? sanitize_text_field( $_POST['password'] )  : '';
  $user_email      = isset( $_POST['email'] )     ? sanitize_text_field( $_POST['email'] )     : '';
  $user_first_name = isset( $_POST['firstname'] ) ? sanitize_text_field( $_POST['firstname'] ) : '';
  $user_last_name  = isset( $_POST['lastname'] )  ? sanitize_text_field( $_POST['lastname'] )  : '';

  //すでにユーザー名が使われていないかチェック
  if ( username_exists( $user_name ) !== false ) {
      modal('登録できません', 'すでにユーザー名「'. $user_name .'」は登録されています。<br>他の名前を入力してください。');
      return "E01";
  }
  // ユーザー名の確認
  // 半角英数字+アンダーバー1～15文字
  if ( !(preg_match("/^[a-zA-Z0-9_]{1,15}$/iD", $user_name)) ) {
      modal('ユーザー名の入力', 'ユーザー名は半角英数字+アンダーバーのみです。');
      return "E02";
  }
  // メールチェック
  if ( email_exists( $user_email ) !== false ) {
      modal('登録できません', 'すでにメールアドレス「'. $user_email .'」は登録されています。');
      return "E03";
  }
  //メールの文字列確認
  // ユーザー名 - 半角英数字+プラス記号+マイナス記号+アンダーパス2~16文字
  // ドメイン名 - tokyo.iput.ac.jpまたはtks.iput.ac.jp
  // <正規表現>
  // TK20***@**.iput.ac.jpのみ："/^[a-z0-9+_-]{2,16}@(tokyo|tks).iput.ac.jp$/iD"
  // 
  if ( !(preg_match("/^[a-z0-9+._-]{2,16}@(.*)iput.ac.jp$/iD", $user_email)) ) {
      modal('登録できません', '学校のメールアドレスのみ登録可能です。使用できるドメインはiput.ac.jpのみです。');
      return "E04";
  }

  // パスワードの確認
  // 半角英数字+記号を6文字以上16文字以下
  if ( !(preg_match("/^[ -~]{6,16}$/iD", $user_pass)) ) {
      modal('パスワードの入力', 'パスワードは半角英数字+記号6～16文字以内で入力してください。');
      return "E05";
  }
  // 氏名の確認
  if ( !(preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $user_first_name)) ) {
      modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
      return "E06";
  }
  if ( !(preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $user_last_name)) ) {
      modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
      return "E07";
  }

  // ユーザー仮登録
  [$activation_key, $user_approval_url] = signup_provisional( $user_name, $user_email, $user_pass, $user_first_name, $user_last_name );
  if ( $user_approval_url ) {
      // 認証メール送信
      user_approval_sendmail( $user_email, $activation_key, $user_approval_url );
  } else {
      modal('エラー', 'ユーザーの仮登録に失敗しました');
      return "E08";
  }

  return true;
}

/**
 * 基本情報ページ　ユーザープロフィール更新
*/
function profile_update() {
    $display_name  = isset( $_POST['displayname'] ) ? sanitize_text_field( $_POST['displayname'] ) : null;
    $user_pass     = isset( $_POST['password'] )    ? sanitize_text_field( $_POST['password']    ) : null;
    $first_name    = isset( $_POST['firstname'] )   ? sanitize_text_field( $_POST['firstname']   ) : null;
    $last_name     = isset( $_POST['lastname'] )    ? sanitize_text_field( $_POST['lastname']    ) : null;

    $user_id = wp_get_current_user()->ID;

    // userdata初期化
    $userdata = array(
        'ID' => $user_id // ユーザーID
    );

    // user id チェック
    if ( $user_id == null ) {
        modal('更新できませんでした', 'もう一度試してください。E01');
        return;
    }
    // 表示名チェック
    if ( $display_name ) {
        // 半角英数字+アンダースコア4～12文字で入力されているか
        if ( preg_match("/^[a-z0-9_]{4,12}$/iD", $display_name) ) {
            $userdata += array('display_name' => $display_name);
        } else {
            modal('表示名の入力', '表示名は半角英数字+アンダースコア4～12文字で入力してください。');
            return;
        }
    }
    // パスワードチェック
    if ( $user_pass ) {
        // 半角英数字+記号を6文字以上16文字以下で入力されているか
        if ( preg_match("/^[ -~]{6,16}$/iD", $user_pass) ) {
            $userdata += array('user_pass' => $user_pass);
        } else {
            modal('パスワードの入力', 'パスワードは半角英数字+記号6～16文字以内で入力してください。');
            return;
        }
    }
    // 名チェック
    if ( $first_name ) {
        if ( preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $first_name) ) {
            $userdata += array('first_name' => $first_name);
        } else {
            modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
            return;
        }
    }
    // 姓チェック
    if ( $last_name ) {
        if ( preg_match("/^[a-zA-Zぁ-んーァ-ヶーｱ-ﾝﾞﾟ一-龠]{1,12}$/iD", $last_name) ) {
            $userdata += array('last_name' => $last_name);
        } else {
            modal('氏名の入力', '氏名は半角英字+日本語1～12文字以内で入力してください。');
            return;
        }
    }

    // ユーザー情報を更新
    $user_id = wp_update_user( $userdata );

    // ユーザーの作成に失敗
    if ( is_wp_error( $user_id ) ) {
        echo $user_id->get_error_code();
        echo $user_id->get_error_message();
        modal('ユーザーの更新に失敗しました', "{$user_id->get_error_code()}<br>{$user_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
    } else {
        modal('更新が完了しました', 'ユーザープロフィールの更新が正常に完了しました。');
    }
    return 1;
}


/**
 * サークル 作成, 編集
 * 
 * # データベースに記録されるデータ
 * ## 基本データ一覧
 * - post_title    - タイトル
 * - post_name     - スラッグ名（時間をmd5でハッシュ化したものを用いる）
 * - post_type     - 投稿タイプ（circle）
 * - post_status   - 公開状態（draft | publish）
 * - post_content  - 投稿の全文
 * - post_category - 投稿カテゴリには投稿サークルのカテゴリを作成して追加する。
 * 
 * ## カスタムメタデータ一覧
 * - topImage    - トップ画像のattachment id
 * - headerImage - ヘッダー画像のattachment id
*/
function post_circle() {
    // パラメータのチェック
    if ( isset(
        $_POST['circleName'        ], // サークル名
        $_POST['belongNum'         ], // 所属人数
        $_POST['schedule'          ], // 活動日程
        $_POST['place'             ], // 活動場所
        $_POST['categoryRadio'     ], // サークルカテゴリ
        $_POST['establishmentDate' ], // 設立日
        $_POST['activityFrequency' ], // 活動頻度
        $_POST['membershipFree'    ], // 会費
        $_POST['activitySummary'   ], // サークル概要
        $_POST['activityDetail'    ], // 活動内容
        $_POST['contactMailAddress'], // 連絡先
        $_POST['representative'    ], // 代表者氏名
        $_POST['twitterUserName'   ], // 公式Twitterユーザー名
        $_POST['circle_post_nonce' ], // WordPressNonce
        ) )
    {
        // 新規投稿のフラグ
        $is_newpost = isset( $_POST['postID'] ) ? false : true;

        // 文字数チェック
        if ( mb_strlen( $_POST['circleName']      ) > 19 ) input_value_error_exit();
        if ( mb_strlen( $_POST['belongNum']       ) > 3  ) input_value_error_exit();
        if ( mb_strlen( $_POST['schedule']        ) > 15 ) input_value_error_exit();
        if ( mb_strlen( $_POST['twitterUserName'] ) > 30 ) input_value_error_exit();

        // 公開状態
        $post_status = 'publish';

        if ( $_POST['submit_type'] === 'draft_circle' ) {
            $post_status = 'draft';
        }

        // 投稿データの配列を作成
        $post_data = array(
            'post_title'     => $_POST['circleName'],      // 投稿のタイトル
            'post_type'      => 'circle',                  // 投稿タイプ
            'post_status'    => $post_status,              // 公開ステータス
            'post_content'   => $_POST['activitySummary'], // 投稿の全文
        );

        /* 新規投稿の場合 */
        if ( $is_newpost ) {

            // スラッグ名を作成する（時間をmd5でハッシュ化したもの）
            $post_data['post_name'] = md5( time() );

            // 既存のサークル名ではないかチェック
            $args = array(
                'posts_per_page' => -1,
                'post_type'      => 'circle',
            );
            $circles = get_posts( $args );
            foreach ( $circles as $circle ) {
                if ( $circle->post_title === $_POST['circleName'] ) {
                    modal('エラー', '既に同じ名前のサークルが存在しています。名前を変更してください。');
                    return;
                }
            }

        /* 更新の場合 */
        } else {

            // 投稿者かどうか確認
            $author = get_userdata(get_post( $_POST['postID'] )->post_author);
            if ( wp_get_current_user()->ID != $author->ID ) {
                echo "エラー2";
                exit;
            }

            // postIDを指定する
            $post_data['ID'] = $_POST['postID'];

            // カテゴリ名を更新する
            $cat_id = get_cat_ID( get_the_title( $_POST['postID'] ) );
            wp_update_term( $cat_id, 'category', array(
                'name' => sanitize_text_field( $_POST['circleName'] ),
                'slug' => sanitize_text_field( $_POST['circleName'] ),
            ) );
        }

        // 投稿を作成する
        $post_id = wp_insert_post( $post_data, true ); // 投稿を作成　自動サニタイズ

        if (  is_wp_error( $post_id ) ) {
            modal('エラー', '投稿に失敗しました。');
            return;
        }

        // サークルのカテゴリを作成する
        if ( $is_newpost ) {
            $category_id = wp_create_category( $_POST['circleName'] );
            wp_set_post_categories( $post_id, array($category_id), true );
        }
        

        // トップ画像のアップロード
        $topImage_id = upload_image('topImage')[0] ?? '';

        // ヘッダー画像のアップロード
        $headerImage_id = upload_image('headerImage')[0] ?? '';

        // アルバム画像
        // ～ここへ処理～


        // カスタムフィールド（自動サニタイズ、add_post_meta関数は禁止）
        // 更新時に画像をアップしない場合はスルー
        if ( $is_newpost || !empty( $topImage_id ) ) {
            update_post_meta( $post_id, 'topImage', $topImage_id ); // トップ画像

        }
        if ( $is_newpost || !empty( $headerImage_id ) ) {

            if ( !empty( $headerImage_id ) ) {
                update_post_meta( $post_id, 'headerImage', $headerImage_id ); // ヘッダー画像 設定

            } else {
                update_post_meta( $post_id, 'headerImage', $topImage_id ); // ヘッダー画像が無い場合、代わりにトップ画像を設定する
            }
        }

        // 自動サニタイズ、add_post_meta関数は禁止
        update_post_meta( $post_id, 'belongNum',          $_POST['belongNum']          ); // 所属人数
        update_post_meta( $post_id, 'schedule',           $_POST['schedule']           ); // 活動日程
        update_post_meta( $post_id, 'place',              $_POST['place']              ); // 活動場所
        update_post_meta( $post_id, 'categoryRadio',      $_POST['categoryRadio']      ); // サークルカテゴリ
        update_post_meta( $post_id, 'establishmentDate',  $_POST['establishmentDate']  ); // 設立日
        update_post_meta( $post_id, 'activityFrequency',  $_POST['activityFrequency']  ); // 活動頻度
        update_post_meta( $post_id, 'membershipFree',     $_POST['membershipFree']     ); // 会費
        update_post_meta( $post_id, 'activityDetail',     $_POST['activityDetail']     ); // 活動内容
        update_post_meta( $post_id, 'contactMailAddress', $_POST['contactMailAddress'] ); // 連絡先
        update_post_meta( $post_id, 'representative',     $_POST['representative']     ); // 代表者氏名
        update_post_meta( $post_id, 'twitterUserName',    $_POST['twitterUserName']    ); // 公式Twitterユーザー名
        update_post_meta( $post_id, 'features',           $_POST['features'] ?? array()); // 特色（配列をシリアル化して文字列で保存）

    } else {
        modal('エラー', '不正なリクエストです。');
        return;
    }

    // サークルページへリダイレクト
    if ( $_POST['submit_type'] === 'draft_circle' ) {
        wp_redirect( home_url('index.php/post-dashboard/?type=circle') );
    } else {
        wp_redirect( get_permalink( $post_id ) );
    }
    exit;
    return 1;
}
