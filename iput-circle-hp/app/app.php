<?php
//ファイル読み込み
// 分割したファイルパスを配列に追加
$function_files = [
  '/Api/Activity/activity.php', //活動記録の処理
  '/Api/Circle/circle.php',     //サークルページの処理
  '/Api/News/news.php',         //ニュース記事の処理
  '/Api/User/user.php',         //ユーザーの処理（ログインとかサインインとか）
  '/Api/UseCases/use-cases.php',//各ページで共通で使える処理
  '/Dashboard/dashboard.php',   //管理画面に関連の処理
  '/Http/http.php',             //POSTリクエスト振り分け
  '/UseCases/use-cases.php',   //全体で共通で使える処理
];

foreach ($function_files as $file) {
  if ((file_exists(__DIR__ . $file))) { // ファイルが存在する場合
      // ファイルを読み込む
      require_once __DIR__ . $file;
  } else { // ファイルが見つからない場合
      // エラーメッセージを表示
      trigger_error("`$file`ファイルが見つかりません", E_USER_ERROR);
  }
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
