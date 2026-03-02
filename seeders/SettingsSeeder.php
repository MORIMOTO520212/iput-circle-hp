<?php
/**
 * SettingsSeeder — サイト設定・パーマリンク・テーマ有効化
 */

// サイト基本設定（本番環境に合わせた値）
update_option('blogname', 'IPUT ONE');
update_option('blogdescription', 'IPUTのサークル活動を盛り上げるため、他校との交流を促進させるために立ち上げました');
update_option('admin_email', 'admin@example.com');

// サイト言語を日本語に設定
update_option('WPLANG', 'ja');
require_once ABSPATH . 'wp-admin/includes/translation-install.php';
wp_download_language_pack('ja');
echo "✓ Language set to ja\n";

// 1ページあたりの投稿表示件数
update_option('posts_per_page', 50);
echo "✓ posts_per_page set to 50\n";

// パーマリンク構造
update_option('permalink_structure', '/index.php/%year%/%monthnum%/%day%/%postname%/');
flush_rewrite_rules();
echo "✓ Permalink structure set\n";

// テーマ有効化
switch_theme('iput-circle-hp');

echo "✓ Settings seeded\n";
