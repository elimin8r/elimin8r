<?php

// Add link to end of excerpt
function whitelabel_excerpt_more( $more ) {
    return ' <a href="' . get_permalink() . '">' . __('Continue reading', 'whitelabel') . '</a>';
}
add_filter('excerpt_more', 'whitelabel_excerpt_more');

// Add blog-* class to the post_class for each blog template
function whitelabel_blog_compact_class( $classes ) {
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
add_filter( 'post_class', 'whitelabel_blog_compact_class' );

// Change excerpt length based on blog template
function custom_excerpt_length( $length ) {
    global $current_template;

    if ( $current_template === 'blog-compact' ) {
        $length = 20;
    } elseif ( $current_template === 'blog-grid' ) {
        $length = 0;
    } else {
        $length = 100;
    }

    return $length;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );