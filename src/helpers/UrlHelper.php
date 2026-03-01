<?php

/**
 * 各ページリンクのグローバル変数
 */
class page_url
{
    public $signup;
    public $login;
    public $mypage;
    public $activity;
    public $news;
    public $faq;
    public $contact;
}

function init_page_url()
{
    global $page_url;
    $page_url          = new page_url;
    $page_url->signup   = home_url('index.php/signup');
    $page_url->login    = home_url('index.php/login');
    $page_url->mypage   = home_url("index.php/author/" . wp_get_current_user()->user_nicename);
    $page_url->activity = home_url('index.php/search-activity');
    $page_url->news     = home_url('index.php/search-news');
    $page_url->faq      = home_url('index.php/faq');
    $page_url->contact  = home_url('index.php/contact');
}
