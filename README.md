# IPUT ONE

## 環境

- WordPress 6.5.0
- MySQL 8.0
- phpmyadmin latest

## ログイン情報

- 管理画面
  - ID: staff
  - Pass: password
- mysql
  - User: root
  - Pass: yWcMY9GcwA972YiXEQCpTqid
  - User: wpuser
  - Pass: yWcMY9GcwA972YiXEQCpTqid

## 環境構築

### 依存関係のインストール

```bash
php composer.phar install
```

### 初期化する

```bash
make init
```

### 実行する

```bash
make run
```

## ディレクトリ構成

- `app/`
  - `Api/`（具体的な処理 コントローラーの部分）
    - `Activity/`（活動記録の処理）
    - `Circle/`（サークルの処理）
    - `News/`（ニュース記事の処理）
    - `User/`（ユーザーの処理）
    - `UseCases/`（コントローラーの再利用できるやつ）
  - `Dashboard/`（管理画面に関するあれこれの処理）
  - `Http/`（リクエスト来たらここでバリデーションチェック）
  - `UseCases/`（再利用できるビジネスルール）
  - `app.php`（ここで require_one で全てのファイルをインポートして、各ファイルでは名前空間でインポートしたい）
- `bootstrap/`（一番初めに処理するプログラムが入る）
- `config/`（WordPress に関する設定）
- `routes/`（リクエストを受け付ける処理 GraphQL の設定が入る）

## トラブルシューティング

- mysql のコンテナが再起動を繰り返す場合
  - プロジェクトの db ディレクトリを削除する
