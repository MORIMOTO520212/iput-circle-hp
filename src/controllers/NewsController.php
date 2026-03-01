<?php

class NewsController
{
    private $newsModel;
    private $imageModel;

    public function __construct()
    {
        $this->newsModel  = new NewsModel();
        $this->imageModel = new ImageModel();
    }

    /**
     * ニュースの投稿・編集処理
     */
    public function handlePost()
    {
        if (!isset($_POST['title'], $_POST['contents'])) {
            modal('エラー', '不正なリクエストです。');
            return;
        }

        if (mb_strlen($_POST['title'])    > 50) { input_value_error_exit(); return; }
        if (mb_strlen($_POST['contents']) <  1) { input_value_error_exit(); return; }

        if (isset($_POST['tags'])) {
            $allowed_tags = array('行事・イベント', 'レジャー', '食事', 'お知らせ', '重要連絡');
            foreach ($_POST['tags'] as $value) {
                if (!in_array($value, $allowed_tags, true)) {
                    modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
                    return;
                }
            }
        }

        $post_data = array(
            'post_title'    => $_POST['title'],
            'post_content'  => $_POST['contents'],
            'post_category' => array(get_cat_ID('news')),
            'tags_input'    => isset($_POST['tags']) ? $_POST['tags'] : '',
            'post_status'   => 'publish',
        );

        if ($_POST['submit_type'] === 'post_news') {
            $post_data['post_name'] = md5(time());
        } elseif ($_POST['submit_type'] === 'edit_news' && isset($_POST['postID'])) {
            $author = get_userdata(get_post($_POST['postID'])->post_author);
            if (wp_get_current_user()->ID != $author->ID) {
                modal('エラー', '記事を更新できるのは本人のみです。');
                return;
            }
            $post_data['ID']        = $_POST['postID'];
            $post_data['post_date'] = get_post($_POST['postID'])->post_date;
        }

        $post_id = $this->newsModel->save($post_data);

        if (is_wp_error($post_id)) {
            modal('記事の投稿に失敗しました', "{$post_id->get_error_code()}<br>{$post_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
            return;
        }

        $this->newsModel->updateMeta($post_id, 'clip',       isset($_POST['clip']) ? $_POST['limit_date'] : 'false');
        $this->newsModel->updateMeta($post_id, 'permission', isset($_POST['permission']) ? 'true' : 'false');

        $pattern = (is_localhost() ? 'http:' : 'https:') . "\/\/(.*?)(.png|.jpg|.jpeg)";
        preg_match("/{$pattern}/", $_POST['contents'], $matches);

        if (!empty($matches)) {
            $topImage_url = esc_url($matches[0]);
            $topImage_id  = $this->imageModel->getAttachmentIdFromSrc($topImage_url);
            $this->newsModel->updateMeta($post_id, 'topImage', $topImage_id);
        } else {
            $this->newsModel->updateMeta($post_id, 'topImage', '');
        }

        wp_redirect(get_permalink($post_id));
        exit;
    }
}
