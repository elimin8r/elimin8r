<?php

// Add blog-* class to the post_class for each blog template
function elimin8r_blog_compact_class( $classes ) {
    global $current_template;

    if ( $current_template === 'blog-compact' ) {
        $classes[] = 'blog-compact';
    } elseif ( $current_template === 'blog-grid' ) {
        $classes[] = 'blog-grid';
    } else {
        $classes[] = 'blog-full';
    }

    return $classes;
}	
add_filter( 'post_class', 'elimin8r_blog_compact_class' );

// Add link to end of excerpt
function elimin8r_excerpt_more( $more ) {
    return ' <a href="' . get_permalink() . '">' . __('Continue reading', 'elimin8r') . '</a>';
}
add_filter('excerpt_more', 'elimin8r_excerpt_more');

// Change excerpt length based on blog template
function elimin8r_excerpt_length( $length ) {
    global $current_template;

    if ( $current_template === 'blog-compact' ) {
        $length = 35;
    } elseif ( $current_template === 'blog-grid' ) {
        $length = 0;
    } elseif ( $current_template === 'blog-full' ) {
        $length = 55;
    } else {
        $length = 55;
    }

    return $length;
}
add_filter( 'excerpt_length', 'elimin8r_excerpt_length', 999 );