<?php

namespace Elimin8r\Breadcrumbs;

/**
 * This class is used to add breadcrumbs to single posts and pages.
 * 
 * @package elimin8r
 */

class Breadcrumbs {
    public static function getBreadcrumbs()
    {
        if ( is_single() || is_page() ) {
            $breadcrumbs = '<nav class="breadcrumbs">';
            $breadcrumbs .= '<a href="' . home_url() . '">' . __( 'Home', 'elimin8r' ) . '</a>';
            $breadcrumbs .= '<span class="separator"></span>';

            $post = get_post();
            $ancestors = get_post_ancestors( $post );

            // Get the ancestors of the current page/post
            if ( $ancestors ) {
                $ancestors = array_reverse( $ancestors );

                // For each ancestor, add a breadcrumb
                foreach ( $ancestors as $ancestor ) {
                    $breadcrumbs .= '<a href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a>';
                    $breadcrumbs .= '<span class="separator"></span>';
                }
            }

            // Add the current page/post
            $breadcrumbs .= '<span class="current-page">' . get_the_title() . '</span>';
            $breadcrumbs .= '</nav>';

            echo $breadcrumbs;
        }
    }
}