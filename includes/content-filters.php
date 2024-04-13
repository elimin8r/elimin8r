<?php

namespace Elimin8r\ContentFilters;

/**
 * This class is used to add custom content filters to the theme.
 * 
 * @package Elimin8r
 */

class ContentFilters {
    public function __construct()
    {
        add_filter( 'post_class', array( $this, 'blog_compact_class' ) );
        add_filter('excerpt_more',  array( $this, 'excerpt_more' ) );
        add_filter( 'excerpt_length',  array( $this, 'excerpt_length' ), 999 );
    }

    // Add blog-* class to the post_class for each blog template
    public function blog_compact_class( $classes )
    {
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
    
    // Add link to end of excerpt
    public function excerpt_more( $more )
    {
        return ' <a href="' . get_permalink() . '">' . __('Continue reading', 'elimin8r') . '</a>';
    }
    
    // Change excerpt length based on blog template
    public function excerpt_length( $length )
    {
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
}

new ContentFilters();