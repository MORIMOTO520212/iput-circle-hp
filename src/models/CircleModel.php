<?php

class CircleModel
{
    /**
     * サークルを作成・更新する
     * @return int|WP_Error post_id
     */
    public function save($post_data)
    {
        return wp_insert_post($post_data, true);
    }

    /**
     * サークル名の重複チェック
     */
    public function existsByName($name)
    {
        $circles = get_posts(array(
            'posts_per_page' => -1,
            'post_type'      => 'circle',
        ));
        foreach ($circles as $circle) {
            if ($circle->post_title === $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * カスタムメタデータを一括更新する
     */
    public function updateMeta($post_id, $data)
    {
        foreach ($data as $key => $value) {
            update_post_meta($post_id, $key, $value);
        }
    }

    /**
     * カテゴリを作成してサークル投稿に紐付ける
     */
    public function createCategory($circle_name, $post_id)
    {
        $category_id = wp_create_category($circle_name);
        wp_set_post_categories($post_id, array($category_id), true);
        return $category_id;
    }

    /**
     * サークルのカテゴリ名を更新する
     */
    public function updateCategoryName($post_id, $new_name)
    {
        $cat_id = get_cat_ID(get_the_title($post_id));
        wp_update_term($cat_id, 'category', array(
            'name' => sanitize_text_field($new_name),
            'slug' => sanitize_text_field($new_name),
        ));
    }
}
