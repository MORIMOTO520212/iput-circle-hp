<?php

class PostTypeHook
{
    public function register()
    {
        add_action('init', array($this, 'post_type_circle'));
        add_action('init', array($this, 'post_tag_to_checkbox'), 1);
        add_filter('intermediate_image_sizes_advanced', array($this, 'not_create_image'), 10, 2);
        add_action('wp_handle_upload', array($this, 'otocon_resize_at_upload'));
    }

    /**
     * カスタム投稿タイプ サークル
     */
    public function post_type_circle()
    {
        register_post_type(
            'circle',
            array(
                'labels' => array(
                    'name'          => 'サークル',
                    'singular_name' => 'circle'
                ),
                'public'        => true,
                'menu_position' => 5,
                'show_in_rest'  => true,
            )
        );
    }

    /**
     * 投稿画面にタグ一覧をチェックボックスで表示する
     */
    public function post_tag_to_checkbox()
    {
        $args = get_taxonomy('post_tag');
        $args->hierarchical = true;
        $args->meta_box_cb  = 'post_categories_meta_box';
        register_taxonomy('post_tag', 'post', $args);
    }

    /**
     * リサイズ画像を生成しない
     */
    public function not_create_image($new_sizes, $image_meta)
    {
        unset($new_sizes['thumbnail']);
        unset($new_sizes['medium']);
        unset($new_sizes['medium_large']);
        unset($new_sizes['large']);
        unset($new_sizes['1536x1536']);
        unset($new_sizes['2048x2048']);
        return $new_sizes;
    }

    /**
     * 容量が大きい画像の圧縮
     */
    public function otocon_resize_at_upload($file)
    {
        global $compression_file_size_threshold, $upload_post_name;

        if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/gif' || $file['type'] == 'image/png') {
            if ($_FILES[$upload_post_name]['size'] > $compression_file_size_threshold) {
                $w     = 1200;
                $h     = 0;
                $image = wp_get_image_editor($file['file']);
                if (!is_wp_error($image)) {
                    $size = getimagesize($file['file']);
                    if ($size[0] > $w || $size[1] > $h) {
                        $image->resize($w, $h, false);
                        $image->save($file['file']);
                    }
                } else {
                    echo $image->get_error_message();
                }
            }
        }
        return $file;
    }
}
