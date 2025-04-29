<?php

function get_list_circle()
{
  // $posts = [];
  // $args = array(
  //   'post_type' => 'circle',
  // );

  // $the_query = new WP_Query($args);
  // if ($the_query->have_posts()) {
  //   while ($the_query->have_posts()) {
  //     $posts[] = $the_query->the_post();
  //   };
  //   wp_reset_postdata();
  // };
  $posts = get_posts();
  return rest_ensure_response($posts);
}

function register_get_list_circle()
{
  register_rest_route(
    'custom/v2',
    '/circle/list',
    array(
      'methods' => 'GET',
      'callback' => 'get_list_circle'
    )
  );
}
add_action('rest_api_init', 'register_get_list_circle');


function get_discord_integrated_users()
{
  $users = [];
  $args = array(
    'meta_query' => array(
      array(
        'key'     => 'discord_user_id',
        'compare' => 'EXISTS',
      ),
    ),
  );
  $user_query = new WP_User_Query($args);

  if (!empty($user_query->get_results())) {
    foreach ($user_query->get_results() as $user) {
      $first_name = get_user_option('first_name', $user->data->ID);
      $last_name = get_user_option('last_name', $user->data->ID);

      $users[] = [
        'user_id' => $user->data->ID,
        'discord_user_id' => get_user_meta($user->data->ID, 'discord_user_id', true),
        'email' => $user->data->user_email,
        'user_name' => $user->data->display_name,
        'user_display_name' => "{$last_name} {$first_name}",
      ];
    }
  }
  return rest_ensure_response($users);
}


function register_get_discord_integrated_users()
{
  register_rest_route(
    'custom/v2',
    '/discord/integrated/users',
    array(
      'methods' => 'GET',
      'callback' => 'get_discord_integrated_users'
    )
  );
}
add_action('rest_api_init', 'register_get_discord_integrated_users');
