#!/bin/bash
set -e

THEME_DIR="/var/www/html/wp-content/themes/iput-circle-hp"
SEEDERS="$THEME_DIR/seeders"

echo "=== Running WordPress Seeders ==="

wp eval-file "$SEEDERS/SettingsSeeder.php"
wp eval-file "$SEEDERS/PagesSeeder.php"
wp eval-file "$SEEDERS/CirclesSeeder.php"
wp eval-file "$SEEDERS/ActivitiesSeeder.php"
wp eval-file "$SEEDERS/NewsSeeder.php"

echo "=== All seeders completed ==="
