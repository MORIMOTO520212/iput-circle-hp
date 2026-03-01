<?php

class CircleController
{
    private $circleModel;
    private $imageModel;

    public function __construct()
    {
        $this->circleModel = new CircleModel();
        $this->imageModel  = new ImageModel();
    }

    /**
     * POST リクエスト処理（作成・ドラフト・編集）
     */
    public function handlePost()
    {
        if (!isset(
            $_POST['circleName'],
            $_POST['belongNum'],
            $_POST['schedule'],
            $_POST['place'],
            $_POST['categoryRadio'],
            $_POST['establishmentDate'],
            $_POST['activityFrequency'],
            $_POST['membershipFree'],
            $_POST['activitySummary'],
            $_POST['activityDetail'],
            $_POST['contactMailAddress'],
            $_POST['representative'],
            $_POST['twitterUserName'],
            $_POST['circle_post_nonce']
        )) {
            modal('エラー', '不正なリクエストです。');
            return;
        }

        $is_newpost = !isset($_POST['postID']);

        if (mb_strlen($_POST['circleName'])    > 19) { input_value_error_exit(); return; }
        if (mb_strlen($_POST['belongNum'])     >  3) { input_value_error_exit(); return; }
        if (mb_strlen($_POST['schedule'])      > 15) { input_value_error_exit(); return; }
        if (mb_strlen($_POST['twitterUserName']) > 30) { input_value_error_exit(); return; }

        $post_status = ($_POST['submit_type'] === 'draft_circle') ? 'draft' : 'publish';

        $post_data = array(
            'post_title'   => $_POST['circleName'],
            'post_type'    => 'circle',
            'post_status'  => $post_status,
            'post_content' => $_POST['activitySummary'],
        );

        if ($is_newpost) {
            $post_data['post_name'] = md5(time());

            if ($this->circleModel->existsByName($_POST['circleName'])) {
                modal('エラー', '既に同じ名前のサークルが存在しています。名前を変更してください。');
                return;
            }
        } else {
            $author = get_userdata(get_post($_POST['postID'])->post_author);
            if (wp_get_current_user()->ID != $author->ID) {
                echo "エラー2";
                exit;
            }
            $post_data['ID'] = $_POST['postID'];
            $this->circleModel->updateCategoryName($_POST['postID'], $_POST['circleName']);
        }

        $post_id = $this->circleModel->save($post_data);

        if (is_wp_error($post_id)) {
            modal('エラー', '投稿に失敗しました。');
            return;
        }

        if ($is_newpost) {
            $this->circleModel->createCategory($_POST['circleName'], $post_id);
        }

        $topImage_id    = $this->imageModel->upload('topImage')[0]    ?? '';
        $headerImage_id = $this->imageModel->upload('headerImage')[0] ?? '';

        if ($is_newpost || !empty($topImage_id)) {
            update_post_meta($post_id, 'topImage', $topImage_id);
        }
        if ($is_newpost || !empty($headerImage_id)) {
            if (!empty($headerImage_id)) {
                update_post_meta($post_id, 'headerImage', $headerImage_id);
            } else {
                update_post_meta($post_id, 'headerImage', $topImage_id);
            }
        }

        $this->circleModel->updateMeta($post_id, array(
            'belongNum'         => $_POST['belongNum'],
            'schedule'          => $_POST['schedule'],
            'place'             => $_POST['place'],
            'categoryRadio'     => $_POST['categoryRadio'],
            'establishmentDate' => $_POST['establishmentDate'],
            'activityFrequency' => $_POST['activityFrequency'],
            'membershipFree'    => $_POST['membershipFree'],
            'activityDetail'    => $_POST['activityDetail'],
            'contactMailAddress'=> $_POST['contactMailAddress'],
            'representative'    => $_POST['representative'],
            'twitterUserName'   => $_POST['twitterUserName'],
            'features'          => $_POST['features'] ?? array(),
        ));

        if ($_POST['submit_type'] === 'draft_circle') {
            wp_redirect(home_url('index.php/post-dashboard/?type=circle'));
        } else {
            wp_redirect(get_permalink($post_id));
        }
        exit;
    }
}
