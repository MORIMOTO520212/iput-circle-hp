# IPUT学生団体ホームページ

## Directory Configuration
```
.
├── assets/
    ├── style-footer.css
    ├── style-header.css
    ├── style-index.css
    ├── style-login.css
    ├── style-news.css
├── images/
├── js/
    ├── author.js
├── .htaccess - サイト設定ファイル
├── screenshot.png - テーマのヘッダー画像
├── style.css - テーマのCSS
├── author.php
├── post.php - 記事投稿プログラム
```

## 固定ページ
|タイトル|スラッグ|ファイル|
|--|--|--|
|トップ|index|front-page.php|
|ログイン|login|page-login.php|
|登録|register|page-register.php|
|活動一覧|activity|page-activity.php|
|ニュース一覧|news|page-news.php|
|FAQ|faq|page-faq.php|
|記事テンプレート|ID|single.php|
|サークル作成&編集|circle-post|page-circle-post.php|
|メディアアップロード|media-upload|media_upload.php|
|サークル&記事管理ページ|dashboard|dashboard.php|

> **Note**\
> Wordpressのホームページは`設定 > 表示設定 > ホームページの表示 > 固定ページ`からドロップダウンで選択して変更できる

## 使用する関数一覧
`the_author()`  
ユーザー名を取得する。  
`wp_get_current_user()`  
WP_Userオブジェクトを返す。ログインしているユーザー情報を取得する。  
`media_handle_upload()`  
添付ファイルをデータベースへアップロードする。  
`count_user_posts()`  
ユーザーの投稿数を取得する。

## functions.php
### モーダルを使う
```php
modal($title, $message);
``` 
**引数**  
$title - モーダルのタイトル  
$message - モーダルの本文  
**戻り値**  
html形式でモーダルを出力する


## サークル作成&編集ページ
https://cly7796.net/blog/javascript/try-using-trix-of-wysiwyg-editor/

### 事前処理
```
ドラフト作成
↓
投稿ID取得
↓
wp field nonce生成
```

### メディアアップロード処理
```
画像が貼り付けられたら
↓
xhr生成
↓
nonce, Post ID, 画像データをmedia_upload.phpへPOST
↓
media_upload.php アップロード処理
↓
画像リンクを返す
↓
TrixEditorへ画像をリンクする
```