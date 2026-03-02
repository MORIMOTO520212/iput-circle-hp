COMPOSE = docker compose -f docker/docker-compose.yml

# 初回セットアップ（WordPress インストール + 全シーダー実行）
setup:
	$(COMPOSE) run --rm cli bash /var/www/html/wp-content/themes/iput-circle-hp/setup.sh

# シーダーのみ再実行
seed:
	$(COMPOSE) run --rm cli bash /var/www/html/wp-content/themes/iput-circle-hp/seeders/run.sh

# 特定シーダーを指定実行
# 例: make seed-one SEEDER=CirclesSeeder
# 例: make seed-one SEEDER=NewsSeeder
seed-one:
	$(COMPOSE) run --rm cli wp eval-file /var/www/html/wp-content/themes/iput-circle-hp/seeders/$(SEEDER).php
