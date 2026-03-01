<?php

class AdminHook
{
    public function register()
    {
        add_action('admin_menu', array($this, 'set_custom_fields'));
        add_action('save_post',  array($this, 'save_custom_fields'));
    }

    /**
     * カスタム投稿タイプ　カスタムフィールドを設置
     */
    public function set_custom_fields()
    {
        add_meta_box('cf_01', 'サークル基本情報', array($this, 'form_01_custom_fields'), 'circle', 'normal', 'default');
        add_meta_box('cf_02', 'サークル説明',     array($this, 'form_02_custom_fields'), 'circle', 'normal', 'default');
        add_meta_box('cf_03', '管理者情報',       array($this, 'form_03_custom_fields'), 'circle', 'normal', 'default');
        add_meta_box('author', '作成者',           'post_author_meta_box',               'circle', 'normal', 'default');

        add_meta_box('gas_deploy_id',      'メール送信用GASデプロイID', array($this, 'gas_deploy_id_fields'),      'dashboard', 'normal', 'default');
        add_meta_box('discordbot_api_base', 'Discord Bot API Base',    array($this, 'discordbot_api_base_fields'), 'dashboard', 'normal', 'default');
    }

    /* サークル基本情報フォームHTML */
    public function form_01_custom_fields()
    {
        global $post;
?>
        <p>
            <input type="hidden" name="officialCheck" value="unofficial">
            <input type="checkbox" name="officialCheck" value="official" <?php if (get_post_meta($post->ID, 'officialCheck', true) == "official") echo 'checked'; ?>>大学公認
        </p>
        <p>トップ画像ID <input type="text" name="topImage" value="<?php echo get_post_meta($post->ID, 'topImage', true); ?>" size="30"></p>
        <p>ヘッダー画像ID <input type="text" name="headerImage" value="<?php echo get_post_meta($post->ID, 'headerImage', true); ?>" size="30"></p>
        <p>所属人数 <input type="text" name="belongNum" value="<?php echo get_post_meta($post->ID, 'belongNum', true); ?>" size="30"></p>
        <p>活動日程 <input type="text" name="schedule" value="<?php echo get_post_meta($post->ID, 'schedule', true); ?>" size="30"></p>
        <p>活動場所 <input type="text" name="place" value="<?php echo get_post_meta($post->ID, 'place', true); ?>" size="30"></p>
        <p>サークルカテゴリ <input type="text" name="categoryRadio" value="<?php echo get_post_meta($post->ID, 'categoryRadio', true); ?>" size="30"></p>
        <p>設立日 <input type="date" name="establishmentDate" value="<?php echo get_post_meta($post->ID, 'establishmentDate', true); ?>" size="30"></p>
        <p>活動頻度 <input type="text" name="activityFrequency" value="<?php echo get_post_meta($post->ID, 'activityFrequency', true); ?>" size="30"></p>
        <p>会費 <input type="text" name="membershipFree" value="<?php echo get_post_meta($post->ID, 'membershipFree', true); ?>" size="30"></p>
        <p>公式Twitterユーザー名 <input type="text" name="twitterUserName" value="<?php echo get_post_meta($post->ID, 'twitterUserName', true); ?>" size="30"></p>
        <input type="hidden" name="is_post" value="">
<?php
    }

    /* サークル説明フォームHTML */
    public function form_02_custom_fields()
    {
        global $post;
        echo '<p>管理番号 <input type="text" name="contents_num" value="' . get_post_meta($post->ID, 'contents_num', true) . '" size="30"></p>';
    }

    /* 管理者情報フォームHTML */
    public function form_03_custom_fields()
    {
        global $post;
        echo '<p>管理番号 <input type="text" name="contents_num" value="' . get_post_meta($post->ID, 'contents_num', true) . '" size="30"></p>';
    }

    /* カスタムフィールドの値を保存 */
    public function save_custom_fields($post_id)
    {
        if (isset($_POST['is_post'])) {
            update_post_meta($post_id, 'officialCheck',     $_POST['officialCheck']);
            update_post_meta($post_id, 'topImage',          $_POST['topImage']);
            update_post_meta($post_id, 'headerImage',       $_POST['headerImage']);
            update_post_meta($post_id, 'belongNum',         $_POST['belongNum']);
            update_post_meta($post_id, 'schedule',          $_POST['schedule']);
            update_post_meta($post_id, 'place',             $_POST['place']);
            update_post_meta($post_id, 'categoryRadio',     $_POST['categoryRadio']);
            update_post_meta($post_id, 'establishmentDate', $_POST['establishmentDate']);
            update_post_meta($post_id, 'activityFrequency', $_POST['activityFrequency']);
            update_post_meta($post_id, 'membershipFree',    $_POST['membershipFree']);
            update_post_meta($post_id, 'twitterUserName',   $_POST['twitterUserName']);
        }
    }

    /* メール送信用GASデプロイID */
    public function gas_deploy_id_fields()
    {
?>
        <style>
            #mybox .input-text-wrap { margin-bottom: 12px; }
            #mybox label { display: inline-block; margin-bottom: 4px; }
            #mybox .submit { display: flex; width: 100%; justify-content: end; }
        </style>
        <form id="mybox" action="" method="post">
            <div class="input-text-wrap">
                <label for="input1">GASデプロイID</label>
                <input type="text" id="input1" name="gas_deploy_id" value="<?php echo get_post_meta(1, 'gas_deploy_id', true); ?>" placeholder="">
            </div>
            <div class="submit">
                <input type="hidden" name="submit_type" value="gas_deploy_id">
                <input type="submit" class="button button-primary" value="保存する">
            </div>
        </form>
<?php
    }

    /* Discord Bot API Base */
    public function discordbot_api_base_fields()
    {
?>
        <style>
            #mybox .input-text-wrap { margin-bottom: 12px; }
            #mybox label { display: inline-block; margin-bottom: 4px; }
            #mybox .submit { display: flex; width: 100%; justify-content: end; }
        </style>
        <form id="mybox" action="" method="post">
            <div class="input-text-wrap">
                <label for="input1">Discord Bot API Base Url（*末尾にスラッシュを含めないでください）</label>
                <input type="text" id="input1" name="discordbot_api_base" value="<?php echo get_post_meta(1, 'discordbot_api_base', true); ?>" placeholder="Discord Bot API Base Url">
            </div>
            <div class="submit">
                <input type="hidden" name="submit_type" value="discordbot_api_base">
                <input type="submit" class="button button-primary" value="保存する">
            </div>
        </form>
<?php
    }
}
