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
