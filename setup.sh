#!/bin/bash
set -e

# WordPress がインストール済みか確認
if ! wp core is-installed 2>/dev/null; then
  wp core install \
    --url="http://localhost:10090" \
    --title="IPUT Circle HP" \
    --admin_user="admin" \
    --admin_password="password" \
    --admin_email="admin@example.com" \
    --skip-email
  echo "WordPress installed."
fi

# プラグイン有効化
wp plugin activate --all 2>/dev/null || true

# シーダー実行
bash /var/www/html/wp-content/themes/iput-circle-hp/seeders/run.sh
