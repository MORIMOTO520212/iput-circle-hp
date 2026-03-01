<?php

class ActivityController
{
    private $activityModel;
    private $imageModel;

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
        $this->imageModel    = new ImageModel();
    }

    /**
     * 活動記録の投稿・編集処理
     */
    public function handlePost()
    {
        if (!isset($_POST['title'], $_POST['contents'], $_POST['organizationId'])) {
            modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
            return;
        }

        if (mb_strlen($_POST['title'])    > 50) { input_value_error_exit(); return; }
        if (mb_strlen($_POST['contents']) <  1) { input_value_error_exit(); return; }

        if (isset($_POST['tags'])) {
            $allowed_tags = array('活動報告', '行事・イベント', '重要報告');
            foreach ($_POST['tags'] as $tag) {
                if (!in_array($tag, $allowed_tags, true)) {
                    modal('不正なリクエストです', '投稿を中断しました。もう一度お試しください。');
                    return;
                }
            }
        }

        $post_data = array(
            'post_title'    => $_POST['title'],
            'post_content'  => $_POST['contents'],
            'post_category' => array(get_cat_ID('activity'), $_POST['organizationId']),
            'tags_input'    => $_POST['tags'] ?? '',
            'post_status'   => 'publish',
        );

        if ($_POST['submit_type'] === 'post_activity') {
            $post_data['post_name'] = md5(time());
        } elseif ($_POST['submit_type'] === 'edit_activity' && isset($_POST['postID'])) {
            $author = get_userdata(get_post($_POST['postID'])->post_author);
            if (wp_get_current_user()->ID != $author->ID) {
                modal('エラー', '記事を更新できるのは本人のみです。');
                return;
            }
            $post_data['ID']        = $_POST['postID'];
            $post_data['post_date'] = get_post($_POST['postID'])->post_date;
        }

        $post_id = $this->activityModel->save($post_data);

        if (is_wp_error($post_id)) {
            modal('記事の投稿に失敗しました', "{$post_id->get_error_code()}<br>{$post_id->get_error_message()}<br>iputone.staff@gmail.comへ問い合わせてください。");
            return;
        }

        $this->activityModel->updateMeta($post_id, 'permission', isset($_POST['permission']) ? 'true' : 'false');

        $pattern      = (is_localhost() ? 'http:' : 'https:') . "\/\/(.*?)(.png|.jpg|.jpeg)";
        preg_match("/{$pattern}/", $_POST['contents'], $matches);
        $topImage_url = !empty($matches) ? esc_url($matches[0]) : '';

        if (!empty($topImage_url)) {
            $topImage_id = $this->imageModel->getAttachmentIdFromSrc($topImage_url);
            $this->activityModel->updateMeta($post_id, 'topImage', $topImage_id);
        } else {
            $this->activityModel->updateMeta($post_id, 'topImage', '');
        }

        wp_redirect(get_permalink($post_id));
        exit;
    }
}
