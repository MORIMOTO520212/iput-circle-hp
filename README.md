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


## Bootstrap 基本色
- [Color (カラー)](https://getbootstrap.jp/docs/5.0/utilities/colors/)
- [Background](https://getbootstrap.jp/docs/5.0/utilities/background/)

## Bootstrap レスポンシブ
lg(≥992px)に統一 (一部smを使用)
```html
<element class="...-lg(-...)">
```
- [Containers (コンテナ)](https://getbootstrap.jp/docs/5.0/layout/containers/)
- [Grid system (グリッドシステム)](https://getbootstrap.jp/docs/5.0/layout/grid/)
- [Display property (ディスプレイ)](https://getbootstrap.jp/docs/5.0/utilities/display/)
- [Flex (フレックス)](https://getbootstrap.jp/docs/5.0/utilities/flex/)

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
