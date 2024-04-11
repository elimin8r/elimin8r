<?php

// Endpoint URL: /wp-json/wp/v2/ifs/{post_type}?page={page}&per_page={per_page}
add_action( 'rest_api_init', function () {
    register_rest_route( 'wp/v2', '/ifs/(?P<post_type>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => function ( WP_REST_Request $request ) {
            $posts_data = [];
            $post_type = $request->get_param( 'post_type' );
            $paged = $request->get_param( 'page' );
            $per_page = $request->get_param( 'per_page' );

            $posts = get_posts( array(
                'post_type' => $post_type,
                'posts_per_page' => $per_page,
                'paged' => $paged,
            ) );

            foreach( $posts as $post ){
                $post_data = array(
                    'thumbnail' => get_the_post_thumbnail_url( $post ),
                    'permalink' => get_permalink( $post ),
                    'title' => get_the_title( $post ),
                    'excerpt' => get_the_excerpt( $post ),
                );
                $posts_data[] = $post_data;
            }
            return $posts_data;
        },
        'args' => array(
            'page' => array(
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric( $param );
                }
            ),
            'per_page' => array(
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric( $param );
                }
            ),
        ),
        'permission_callback' => '__return_true',
    ) );
} );