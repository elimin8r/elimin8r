<?php

function get_sticky_posts( $post_type ) {
    $sticky_posts = get_option( 'sticky_posts' );
    
    $args = array(
        'post_type' => $post_type,
        'post__in' => $sticky_posts,
        'ignore_sticky_posts' => 1
    );
    $query = new WP_Query( $args );

    $post_ids = array();
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            
            // Get the ID of the post
            $post_id = get_the_ID();
            
            // Add the ID to the array
            array_push( $post_ids, $post_id );
        }

        return $post_ids;
    }
    
    wp_reset_postdata();

    return false;
}