<?php

// Add blog-* class to the post_class for each blog template
function lmn8r_blog_compact_class( $classes ) {
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
add_filter( 'post_class', 'lmn8r_blog_compact_class' );

// Add link to end of excerpt
function lmn8r_excerpt_more( $more ) {
    return ' <a href="' . get_permalink() . '">' . __('Continue reading', 'lmn8r') . '</a>';
}
add_filter('excerpt_more', 'lmn8r_excerpt_more');

// Change excerpt length based on blog template
function lmn8r_excerpt_length( $length ) {
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
add_filter( 'excerpt_length', 'lmn8r_excerpt_length', 999 );