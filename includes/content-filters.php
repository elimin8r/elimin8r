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
        add_filter( 'post_class', array( $this, 'blogCompactClass' ) );
        add_filter( 'excerpt_more',  array( $this, 'excerptMore' ) );
        add_filter( 'excerpt_length',  array( $this, 'excerptLength' ), 999 );
    }

    // Add blog-* class to the post_class for each blog template
    public function blogCompactClass( $classes )
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
    public function excerptMore( $more )
    {
        return ' <a href="' . get_permalink() . '">' . __('Continue reading', 'elimin8r') . '</a>';
    }
    
    // Change excerpt length based on blog template
    public function excerptLength( $length )
    {
        global $current_template;
    
        if ( $current_template === 'blog-compact' ) {
            $length = 35;
        } elseif ( $current_template === 'blog-grid' ) {
            $length = 20;
        } elseif ( $current_template === 'blog-full' ) {
            $length = 55;
        } else {
            $length = 55;
        }
    
        return $length;
    }
}

new ContentFilters();