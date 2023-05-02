# IPUT学生団体ホームページ

記事のサークルタグは記事のカテゴリーに追加している。get_the_category()で取得可能。  

## ディレクトリ構造
```
iput-circle-hp
│  author.php  -- マイページ
│  contact.php -- お問い合わせページ
│  db.php      -- 独自のsignupsテーブルの指定。メール認証時にユーザー情報をデータベースに仮保存する
│  faq.php     -- FAQページ
│  footer.php
│  front-page.php -- トップページ
│  functions.php -- サイトの設定や主な処理を行う
│  header.php
│  index.php
│  login.php         -- ログインページ
│  media_upload.php  -- Trix.jsでアップロードされた画像をWordPressのメディアに保存するプログラム
│  post-activity.php -- 活動記録投稿ページ
│  post-circle.php   -- サークル作成ページ
│  post-dashboard.php -- 記事管理ページ
│  post-news.php      -- ニュース投稿ページ
│  profile.php        -- 基本情報ページ
│  README.md
│  screenshot.png
│  search-activity.php -- 活動記録一覧ページ
│  search-news.php     -- ニュース一覧ページ
│  signup.php          -- 新規登録ページ
│  single-circle.php   -- サークルページテンプレート
│  single.php          -- 記事ページテンプレート
│  style.css
│  TODO.txt
│  wordpress_export.xml
│  wordpress_export2022-11-23.xml
│
├─assets
│  │  author.js
│  │  base.js
│  │  contact.js
│  │  style-author.css
│  │  style-contact-thanks.css
│  │  style-contact.css
│  │  style-faq.css
│  │  style-footer.css
│  │  style-index.css
│  │  style-login.css
│  │  style-post-activity.css
│  │  style-post-circle.css
│  │  style-post-dashboard.css
│  │  style-post-news.css
│  │  style-profile.css
│  │  style-search-activity.css
│  │  style-search-news.css
│  │  style-signup.css
│  │  style-single-circle.css
│  │  style-single.css
│  │
│  └─components
│          trix_file_type_caution_modal.php -- Trix Editorにドロップされたファイルの形式が対応外な場合に警告を表示するコンポーネント
│          trix_file_upload_to_wordpress.php -- Trix Editorにドロップされた画像をWordPressにアップロードするコンポーネント
│
└─src
    │  banner_1080p.png
    │  chevron_right.svg
    │  faq-top-img.jpg
    │  firstView_Image.jpg
    │  girl.png
    │  iputone_logo.svg
    │  iputone_logo_white.svg
    │  keyboard.png
    │  line.png
    │  man.png
    │  nectgrams.jpg
    │  no_image.png
    │  no_image_activity.png
    │  no_image_circle_header.png
    │  ogp.jpg
    │  pencil.svg
    │  register_bg_img.png
    │  thanks.png
    │  trash.svg
    │
    └─background
            cocoon-tower2.webp
            room1.webp
            room2.webp
            student-salon-blue.webp
```

## データベース
wp_wordpresssignupsテーブルを作成している。  

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
|アカウント情報|profile|profile.php|

> **Note**\
> Wordpressのホームページは`設定 > 表示設定 > ホームページの表示 > 固定ページ`からドロップダウンで選択して変更できる

## データベースに記録されるデータ
### サークル
- 基本データ一覧
  - 
- カスタムメタデータ一覧
  - 

### 活動記録
- 基本データ一覧
  - post_title - タイトル
  - post_content - コンテンツ
  - post_category - 活動のカテゴリID
  - tags_input - タグ
  - post_status - 公開設定
- カスタムメタデータ一覧
  - organization  - 所属サークル名
  - permission    - 内部公開設定 true-内部公開, false-外部公開

### ニュース

## 使用する関数一覧
`the_author()`  
ユーザー名を取得する。  
`wp_get_current_user()`  
WP_Userオブジェクトを返す。ログインしているユーザー情報を取得する。  
`media_handle_upload()`  
添付ファイルをデータベースへアップロードする。  
`count_user_posts()`  
ユーザーの投稿数を取得する。
`wp_redirect()`  
引数に指定したページへリダイレクトする。  
> **Warning**  
> header関数より手前に書かなければならない。


## ファイルの説明

**functions.php**

モーダルを使う
```php
modal($title, $message);
``` 
引数  
$title - モーダルのタイトル  
$message - モーダルの本文  
戻り値  
html形式でモーダルを出力する

**post-circle.php**  
説明  
サークルを作成するページ。  
サークルの参加承認も受け付ける。





## WordPress Nonce
`wp_nonce_field`関数を使ってformに設置する。  
IDは推測されないようにランダムな文字列にする。  

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

## エラーコード

形式：`E_xxx`  
プレフィックス：`E_`  
例えば、`E_001`のようにゼロ埋めで3桁の一意な数値で表す。  

## 使用技術についての説明
### Bootstrap
以下は活動記録投稿ページのタイトルを表示するコードだが、ここではUIフレームワークのBootstrapが使われている。クラスに指定されているtext-centerはBootstrapのクラスである。
```html
<h2 class="text-center">活動記録を投稿する</h2>
```

## エラー
### アップロードした画像が圧縮されない場合
GD拡張機能が無効になっている可能性がある。
