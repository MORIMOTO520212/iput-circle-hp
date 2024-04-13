# IPUT ONE

### 環境

- WordPress 6.5.0
- MySQL 8.0
- phpmyadmin latest

### 環境構築

- docker を動かす。

- 管理画面へ入る。
  - ID: staff
  - PASS: password

## ディレクトリ構成

- app/
  - Api/（具体的な処理 コントローラーの部分）
    - Activity/（活動記録の処理）
    - Circle/（サークルの処理）
    - News/（ニュース記事の処理）
    - User/（ユーザーの処理）
    - UseCases/（コントローラーの再利用できるやつ）
  - Dashboard/（管理画面に関するあれこれの処理）
  - Http/（リクエストのバリデーションチェック）
  - UseCases（再利用できるビジネスルール）
- bootstrap/（プログラムの一番初めに処理するところ）
- config/（WordPress に関する設定）
- routes/（リクエストを受け付ける処理 GraphQL の設定が入る）
