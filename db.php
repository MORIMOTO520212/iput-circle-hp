<?php
/**
 *  * * * このファイルはwp-content配下に配置してください。 * * *
 * 仮登録に使用するsignupsテーブルの設定です。
 */

// WordPress 6.1+ では class-wpdb.php に移行済み
require_once(ABSPATH . WPINC . '/class-wpdb.php');

class my_wpdb extends wpdb {
    public $tables = array(
        'posts',
        'comments', 
        'links', 
        'options', 
        'postmeta', 
        'terms', 
        'term_taxonomy', 
        'term_relationships', 
        'termmeta', 
        'commentmeta', 
        'signups'
    );
}
if ( !isset( $wpdb ) ) {
   $wpdb = new my_wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
}
