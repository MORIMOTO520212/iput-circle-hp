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

## CSS Bootstrap互換表
| CSS | Bootstrap Class |
| --- | --- |
| margin-top: 0     | mt-0 |
| margin-bottom: 0  | mb-0 |
| margin-left: 0    | ms-0 |
| margin-right: 0   | me-0 |
| --- | --- |
| padding-top: 0    | pt-0 |
| padding-bottom: 0 | pb-0 |
| padding-left: 0   | ps-0 |
| padding-right: 0  | pe-0 |
| --- | --- |
| justify-content: start  | justify-content-start  |
| justify-content: center | justify-content-center |
| justify-content: end    | justify-content-end    |
| --- | --- |
| width: 100, 75, 50, 25%  | w-100<br>w-75<br>w-50<br>w-25 |
| height: 100, 75, 50, 25% | h-100<br>h-75<br>h-50<br>h-25 |
| --- | --- |
| display: inline-block | d-inline |
| display: block        | d-block  |
| display: none         | d-none   |
| --- | --- |
| border: none | border-0 |


## Bootstrap 基本色
- [Color (カラー)](https://getbootstrap.jp/docs/5.0/utilities/colors/)
- [Background](https://getbootstrap.jp/docs/5.0/utilities/background/)
- [Borders (ボーダー)](https://getbootstrap.jp/docs/5.0/utilities/borders/)
- [Badges (バッジ)](https://getbootstrap.jp/docs/5.0/components/badge/)

## Bootstrap レスポンシブ
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Grid system (グリッドシステム)](https://getbootstrap.jp/docs/5.0/layout/grid/)
- [Display property (ディスプレイ)](https://getbootstrap.jp/docs/5.0/utilities/display/)
- [Flex (フレックス)](https://getbootstrap.jp/docs/5.0/utilities/flex/)

## カスタムスタイル
- `style-header.css`

### 各サイズ(xl, lg, md, sm)に対応するmax-widthクラス
```css
.max-width-sm {
    max-width: 576px !important;
}
.max-width-md {
    max-width: 768px !important;
}
.max-width-lg {
    max-width: 992px !important;
}
.max-width-xl {
    max-width: 1200px !important;
}
```

### アスペクト比固定クラス
> **Warning**\
> `height: 100%`を基準にする際は使わないこと！
```css
.ratio-1x1 {
    width: 100%;
    aspect-ratio: 1 / 1;
    object-fit: cover;
}
.ratio-3x2 {
    width: 100%;
    aspect-ratio: 3 / 2;
    object-fit: cover;
}
.ratio-16x9 {
    width: 100%;
    aspect-ratio: 16 / 9;
    object-fit: cover;
}
.ratio-16x10 {
    width: 100%;
    aspect-ratio: 16 / 10;
    object-fit: cover;
}
.ratio-16x5 {
    width: 100%;
    aspect-ratio: 16 / 5;
    object-fit: cover;
}
.ratio-21x5 {
    width: 100%;
    aspect-ratio: 21 / 5;
    object-fit: cover;
}
```

### 3点リーダー省略 (クランプ)
```css
.line-clamp-1 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    overflow: hidden;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    overflow: hidden;
}
```

### Bootstrap Cards リンクのスタイルを無効化
> **Note**\
> [Bootstrap Cards](https://getbootstrap.jp/docs/5.0/components/card/)
```css
.card a {
    color: #000;
    text-decoration: none;
}
```

***

## ヘッダー (Navbar)
[Bootstrap Navbar Icon](https://getbootstrap.jp/docs/5.0/components/navbar/#external-content)の透過度50%を無効にするため\
[Bootstrap Listアイコン](https://icons.getbootstrap.jp/icons/list/)に`fill="#fff"`を指定し、CSSからBase64の`background-image`として`class="navbar-toggler-icon"`に適用
```html
<header>
    <nav>...
```
- [Navbar(ナビゲーションバー)](https://getbootstrap.jp/docs/5.0/components/navbar/)
- [Bootstrap アイコン](https://icons.getbootstrap.jp/)
- [Buttons (ボタン)](https://getbootstrap.jp/docs/5.0/components/buttons/)

***

## Bootstrap 頻繫に使うコンポーネント
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Navs and tabs(ナブとタブ)](https://getbootstrap.jp/docs/5.0/components/navs-tabs/)
- [List group (リストグループ)](https://getbootstrap.jp/docs/5.0/components/list-group/)
- [Cards (カード)](https://getbootstrap.jp/docs/5.0/components/card/)
- [Images (イメージ)](https://getbootstrap.jp/docs/5.0/content/images/)

## その他
- [Lists Unstyled](https://getbootstrap.jp/docs/5.0/content/typography/#lists)
- [Google Fonts Icons](https://fonts.google.com/icons?icon.style=Rounded)
> **Note**\
> `Google Fonts Icons`は`Rounded & Variable`のstyle-sheetを使用\
> 以下のCSS(例)を定義後に使用すること
```css
/* デフォルト */
.material-symbols-rounded {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 48
}
```

***

## ログインフォーム
```html
<main class="contents">
    <div id="form-login">...
```
- [Validation(バリデーション)](https://getbootstrap.jp/docs/5.0/forms/validation/#server-side)
> **Warning**\
> 背景をブラー加工済みの画像にする際は、下記elementを削除またはコメントアウト
```html
<div class="bg-blur"></div>
```
> なお、ブラーのサイズは`9px`とする