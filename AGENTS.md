# IPUT 学生団体ホームページ — プロジェクト概要

## 概要

IPUT（東京国際工科専門職大学）の学生団体（サークル）を管理・紹介するホームページ。
WordPress カスタムテーマとして実装されており、一部のページに React を導入している。

## 主な機能

| 機能                 | 説明                                   |
| -------------------- | -------------------------------------- |
| サークル管理         | サークルの作成・編集・閲覧             |
| 活動記録             | 活動記録の投稿・一覧表示               |
| ニュース             | ニュース記事の投稿・一覧表示           |
| ユーザー認証         | 会員登録（メール認証）・ログイン       |
| 参加申請             | サークルへの参加申請・承認             |
| Discord 連携         | Discord アカウントとの紐付け           |
| メディアアップロード | Trix.js エディタからの画像アップロード |

## 技術スタック

| カテゴリ               | 技術                                       |
| ---------------------- | ------------------------------------------ |
| CMS                    | WordPress（カスタムテーマ）                |
| バックエンド           | PHP（MVC アーキテクチャ）                  |
| フロントエンド         | React 19 + TypeScript（一部ページ）        |
| スタイリング           | Tailwind CSS v4、Bootstrap                 |
| ビルドツール           | Vite                                       |
| フォームバリデーション | Zod + conform                              |
| リッチテキストエディタ | Trix.js                                    |
| インフラ               | Docker / Docker Compose                    |
| DB                     | MySQL（WordPress 標準 + カスタムテーブル） |

## ディレクトリ構造

```
iput-circle-hp/
├── functions.php        # WordPress エントリポイント（11行・ローダーのみ）
├── routes.php           # 廃止済み（ApiRouter に移行）
├── db.php               # カスタム signups テーブル定義
├── front-page.php       # トップページ
├── header.php / footer.php
├── login.php            # ログインページ
├── signup.php           # 新規登録ページ
├── profile.php          # プロフィールページ
├── author.php           # マイページ
├── post-circle.php      # サークル作成・編集ページ
├── post-activity.php    # 活動記録投稿ページ
├── post-news.php        # ニュース投稿ページ
├── post-dashboard.php   # 記事管理ページ
├── search-activity.php  # 活動一覧ページ
├── search-news.php      # ニュース一覧ページ
├── single-circle.php    # サークル詳細テンプレート
├── single.php           # 記事詳細テンプレート
├── contact.php          # お問い合わせページ
├── faq.php              # FAQ ページ
├── media_upload.php     # 画像アップロード処理
├── assets/              # JS・CSS アセット（ページ別）
│   └── components/      # PHP コンポーネント（Trix Editor 関連）
├── public/
│   ├── image/           # テーマ画像（PNG・SVG・JPG・WebP）
│   │   └── background/  # 背景画像
│   └── src/             # React/TypeScript ソース（Vite エントリ）
│       ├── components/
│       ├── features/
│       ├── hooks/
│       └── pages/
├── src/                 # PHP クラス（MVC）
│   ├── bootstrap.php        # オートローダー + Hook/Router 登録
│   ├── ApiRouter.php        # REST API ルーティング
│   ├── controllers/
│   │   ├── AuthController.php      # ログイン・サインアップ・プロフィール
│   │   ├── CircleController.php    # サークル作成・編集
│   │   ├── ActivityController.php  # 活動記録投稿・編集
│   │   ├── NewsController.php      # ニュース投稿・編集
│   │   └── DiscordController.php   # Discord 認証・参加申請・お問い合わせ
│   ├── models/
│   │   ├── UserModel.php       # signups テーブル・wp_usermeta 操作
│   │   ├── ImageModel.php      # 画像アップロード・attachment ID 取得
│   │   ├── CircleModel.php     # circle 投稿の DB 操作
│   │   ├── ActivityModel.php   # 活動記録の DB 操作
│   │   └── NewsModel.php       # ニュースの DB 操作
│   ├── services/
│   │   ├── MailService.php         # GAS 経由メール送信
│   │   ├── DiscordService.php      # Discord API HTTP 通信
│   │   └── ValidationService.php   # 入力バリデーション
│   ├── hooks/
│   │   ├── PostTypeHook.php    # add_action('init', ...) 系
│   │   ├── AdminHook.php       # 管理画面カスタムフィールド
│   │   └── RequestHook.php     # after_setup_theme での POST ディスパッチ
│   └── helpers/
│       ├── FunctionsHelper.php # get_params(), is_localhost(), date_formatting(), user_activation()
│       ├── UrlHelper.php       # page_url クラス・init_page_url()
│       └── ViewHelper.php      # modal(), input_value_error_exit()
├── docker/              # Docker Compose 設定
├── db/                  # MySQL データ
└── dist/                # Vite ビルド成果物
```

## アーキテクチャ（MVC）

### 各層の責務

| 層 | 責務 | 禁止事項 |
| --- | --- | --- |
| Model | `WP_Query`・`wp_insert_post`・`update_post_meta` などの DB 操作のみ | `wp_redirect`・`echo` |
| Controller | `$_POST` 読み取り・バリデーション委譲・Model 呼び出し・リダイレクト | 直接 DB 操作 |
| Service | メール・Discord API などの外部 IO | WP テンプレート依存 |
| Hook | `add_action` / `add_filter` の登録のみ | ビジネスロジック |
| View（.php テンプレート） | `$view_data` を受け取って描画するだけ | POST 処理・DB 操作 |

### ローディングの流れ

```text
functions.php
  └── src/bootstrap.php
        ├── spl_autoload_register（クラス自動ロード）
        ├── helpers/*.php（グローバル関数を含むファイルを明示ロード）
        ├── models/ImageModel.php（upload_image() ラッパー）
        ├── services/MailService.php（my_sendmail() ラッパー）
        ├── services/DiscordService.php（join_application_send_discord() ラッパー）
        ├── グローバル変数初期化（$page_url, $max_file_size など）
        ├── (new PostTypeHook())->register()
        ├── (new AdminHook())->register()
        ├── (new RequestHook())->register()
        └── (new ApiRouter())->register()
```

### POST リクエストのフロー

```text
ブラウザ POST
  → after_setup_theme フック
  → RequestHook::dispatch()
  → nonce 検証
  → XxxController::handlePost() / login() / etc.
  → XxxModel::save() / XxxService::send()
  → wp_redirect() + exit
```

## REST API エンドポイント（ApiRouter）

| メソッド | パス                                          | 説明                             |
| -------- | --------------------------------------------- | -------------------------------- |
| GET      | `/wp-json/custom/v2/circle/list`              | サークル一覧取得                 |
| GET      | `/wp-json/custom/v2/discord/integrated/users` | Discord 連携済みユーザー一覧取得 |

## データベース

- WordPress 標準テーブルに加え、`wp_wordpresssignups` テーブルを追加
- メール認証フロー時のユーザー仮登録情報を保存するために使用
- DB 操作は各 Model クラスに集約する

## WordPress 固定ページ

| スラッグ           | ファイル            | 説明                 |
| ------------------ | ------------------- | -------------------- |
| `/`                | front-page.php      | トップ               |
| `/login`           | login.php           | ログイン             |
| `/signup`          | signup.php          | 新規登録             |
| `/search-activity` | search-activity.php | 活動一覧             |
| `/search-news`     | search-news.php     | ニュース一覧         |
| `/faq`             | faq.php             | FAQ                  |
| `/contact`         | contact.php         | お問い合わせ         |
| `/post-circle`     | post-circle.php     | サークル作成・編集   |
| `/post-dashboard`  | post-dashboard.php  | 記事管理             |
| `/profile`         | profile.php         | アカウント情報       |
| `/media-upload`    | media_upload.php    | メディアアップロード |

## カスタムメタデータ

### 活動記録（post）

- `organization` — 所属サークル名
- `permission` — 内部公開設定（`true`: 内部のみ）

### ユーザー

- `discord_user_id` — Discord アカウント ID

## エラーコード規則

形式: `E_xxx`（例: `E_001`）
プレフィックス `E_` + ゼロ埋め 3 桁の一意な数値。

## 開発環境

```bash
# Docker で起動
docker compose -f docker/docker-compose.yml up

# フロントエンド（Vite）ウォッチビルド
npm run dev

# プロダクションビルド
npm run build
```

## 注意事項

- WordPress Nonce は `wp_nonce_field` で生成し、ID は推測されにくいランダム文字列にする
- React を導入するページは `<div id="xxxPage">` + `<script id="__REACT_DATA__">` パターンで PHP から JSON を渡す
- 画像アップロード上限: **5MB**、**1MB** 超は自動圧縮（GD 拡張が必要）
- post category はサークル名の管理と記事タイプ（activity / news）の判別に使用
- テーマ画像のパスは `get_theme_file_uri('public/image/...')` を使用する（`src/` 直下は PHP クラス置き場）
- グローバル関数を含むファイル（ImageModel・MailService・DiscordService・helpers）は `bootstrap.php` で明示的にロードする（オートローダー非経由）
- Discord クライアントシークレットは現在 `DiscordService.php` にハードコードされている（TODO: `get_option()` 経由に改善）
