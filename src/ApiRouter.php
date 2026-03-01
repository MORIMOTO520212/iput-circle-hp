<?php

class ApiRouter
{
    public function register()
    {
        add_action('rest_api_init', array($this, 'registerRoutes'));
    }

    public function registerRoutes()
    {
        register_rest_route('custom/v2', '/circle/list', array(
            'methods'  => 'GET',
            'callback' => array($this, 'getCircleList'),
        ));

        register_rest_route('custom/v2', '/discord/integrated/users', array(
            'methods'  => 'GET',
            'callback' => array($this, 'getDiscordIntegratedUsers'),
        ));
    }

    public function getCircleList()
    {
        $posts = get_posts();
        return rest_ensure_response($posts);
    }

    public function getDiscordIntegratedUsers()
    {
        $users      = array();
        $user_query = new WP_User_Query(array(
            'meta_query' => array(
                array(
                    'key'     => 'discord_user_id',
                    'compare' => 'EXISTS',
                ),
            ),
        ));

        foreach ($user_query->get_results() as $user) {
            $first_name = get_user_option('first_name', $user->data->ID);
            $last_name  = get_user_option('last_name',  $user->data->ID);

            $users[] = array(
                'user_id'              => $user->data->ID,
                'discord_user_id'      => get_user_meta($user->data->ID, 'discord_user_id', true),
                'email'                => $user->data->user_email,
                'user_name'            => $user->data->display_name,
                'user_display_name'    => "{$last_name} {$first_name}",
            );
        }

        return rest_ensure_response($users);
    }
}
