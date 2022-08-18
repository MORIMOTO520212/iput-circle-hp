# IPUT学生団体ホームページ

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

## Bootstrap レスポンシブ
切り替えは`lg`(≥992px)に統一
```html
<element class="...-lg(-...)">
```
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Grid system (グリッドシステム)](https://getbootstrap.jp/docs/5.0/layout/grid/)
- [Display property (ディスプレイ)](https://getbootstrap.jp/docs/5.0/utilities/display/)
- [Flex (フレックス)](https://getbootstrap.jp/docs/5.0/utilities/flex/)
> **Note**\
> 最大幅を制限するため、各サイズ(xl, lg, md, sm)のmax-widthクラスを追加
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
***

# トップページ
- `index.html`
- `assets/sytle.css`

## トップ (登録フォーム)
```html
<main class="contents">
    <div class="top">...
```
- [Input group(インプットグループ)](https://getbootstrap.jp/docs/5.0/forms/input-group/)
- [Bootstrap アイコン](https://icons.getbootstrap.jp/)
- [Buttons (ボタン)](https://getbootstrap.jp/docs/5.0/components/buttons/)

***

## トップ カテゴリ
```html
<main class="contents">
    <div id="top-category">...
```
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Display property (ディスプレイ)](https://getbootstrap.jp/docs/5.0/utilities/display/)
- [Flex (フレックス)](https://getbootstrap.jp/docs/5.0/utilities/flex/)

***

## メイン
```html
<main class="contents">
    <div class="main">...
```

### インフォメーション
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Borders (ボーダー)](https://getbootstrap.jp/docs/5.0/utilities/borders/)
- [Navs and tabs(ナブとタブ)](https://getbootstrap.jp/docs/5.0/components/navs-tabs/)
- [Display property (ディスプレイ)](https://getbootstrap.jp/docs/5.0/utilities/display/)
- [List group (リストグループ)](https://getbootstrap.jp/docs/5.0/components/list-group/)
- [Badges (バッジ)](https://getbootstrap.jp/docs/5.0/components/badge/)
- [Flex (フレックス)](https://getbootstrap.jp/docs/5.0/utilities/flex/)
- [Buttons (ボタン)](https://getbootstrap.jp/docs/5.0/components/buttons/)


### サークル
#### サークル カテゴリ 一覧
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Display property (ディスプレイ)](https://getbootstrap.jp/docs/5.0/utilities/display/)
- [Grid system (グリッドシステム)](https://getbootstrap.jp/docs/5.0/layout/grid/)
- [Images (イメージ)](https://getbootstrap.jp/docs/5.0/content/images/#responsive-images)

#### サークル 一覧 (カテゴリ別)
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Grid system (グリッドシステム)](https://getbootstrap.jp/docs/5.0/layout/grid/)
- [Cards (カード)](https://getbootstrap.jp/docs/5.0/components/card/)
- [Lists Unstyled](https://getbootstrap.jp/docs/5.0/content/typography/#lists)
- [Google Fonts Icons](https://fonts.google.com/icons)

***
***

# ログインページ
- `login.html`
- `assets/sytle-login.css`

## ログインフォーム
```html
<main class="contents">
    <div id="form-login">...
```
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Grid system (グリッドシステム)](https://getbootstrap.jp/docs/5.0/layout/grid/)
- [Flex (フレックス)](https://getbootstrap.jp/docs/5.0/utilities/flex/)
- [Validation(バリデーション)](https://getbootstrap.jp/docs/5.0/forms/validation/#server-side)
> **Warning**\
> 背景をブラー加工済みの画像にする際は、下記elementを削除またはコメントアウト
```html
<div class="bg-blur"></div>
```
> なお、ブラーのサイズは`9px`とする

***
***

# ニュース一覧ページ
- `news.html`
- `assets/sytle-news.css`

## トップ バナー
```html
<main class="contents">
    <div class="top-banner">...
```
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)

***

## メイン
```html
<main class="contents">
    <div class="main">...
```

### ニュース一覧
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Grid system (グリッドシステム)](https://getbootstrap.jp/docs/5.0/layout/grid/)
- [Cards (カード)](https://getbootstrap.jp/docs/5.0/components/card/)
