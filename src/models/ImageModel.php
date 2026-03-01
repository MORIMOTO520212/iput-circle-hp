<?php

class ImageModel
{
    /**
     * 画像のリンクからattachment idを取得する
     */
    public function getAttachmentIdFromSrc($image_src)
    {
        global $wpdb;
        $src   = esc_sql($image_src);
        $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$src'";
        return $wpdb->get_var($query);
    }

    /**
     * 画像アップロード処理
     * @return array|string array($attachment_id, $img_url) | ''
     */
    public function upload($input_name)
    {
        global $max_file_size, $upload_post_name;

        if (isset($_FILES[$input_name]) === false) {
            return '';
        }

        if ($_FILES[$input_name]['size'] > $max_file_size) {
            return '';
        }

        $upload_post_name  = $input_name;
        $attachment_id     = media_handle_upload($input_name, 0);

        if (is_wp_error($attachment_id)) {
            return '';
        }

        $img_url = wp_get_attachment_image_src($attachment_id, 'full')[0];
        return array($attachment_id, $img_url);
    }
}

/**
 * 後方互換ラッパー
 */
function upload_image($input_name)
{
    return (new ImageModel())->upload($input_name);
}

function get_attachment_id_from_src($image_src)
{
    return (new ImageModel())->getAttachmentIdFromSrc($image_src);
}
