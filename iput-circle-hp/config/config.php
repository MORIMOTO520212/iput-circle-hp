<?php
/* * * * 変数の初期化 * * * */

// アップロード可能な画像の最大ファイルサイズ（byte）
$max_file_size = 5242880; //5MB
// 圧縮するファイルサイズ閾値（byte）
$compression_file_size_threshold = 1048576; //1MB

$upload_post_name = "";

/* 各ページリンクのグローバル変数 */
class page_url {
    public $signup;
    public $login;
    public $mypage;
    public $activity;
    public $news;
    public $faq;
    public $contact;
}
$page_url = new page_url;
$page_url->signup   = home_url('index.php/signup');
$page_url->login    = home_url('index.php/login');
$page_url->mypage   = home_url( "index.php/author/" . wp_get_current_user()->user_nicename );
$page_url->activity = home_url('index.php/search-activity');
$page_url->news     = home_url('index.php/search-news');
$page_url->faq      = home_url('index.php/faq');
$page_url->contact  = home_url('index.php/contact');