<?php

class ActivityModel
{
    /**
     * 活動記録を作成・更新する
     * @return int|WP_Error post_id
     */
    public function save($post_data)
    {
        return wp_insert_post($post_data, true);
    }

    /**
     * カスタムメタデータを更新する
     */
    public function updateMeta($post_id, $key, $value)
    {
        update_post_meta($post_id, $key, $value);
    }
}
