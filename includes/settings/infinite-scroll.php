<?php

namespace Elimin8r\Settings\InfiniteScroll;

/**
 * This class is used to add a setting to enable infinite scroll.
 *
 * @package elimin8r
 */

class InfiniteScroll {
    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'add_enable_infinite_scroll_checkbox' ) );
        add_action( 'wp_head', array( $this, 'enable_infinite_scroll' ) );
    }

    // Add Enable infinite scroll checkbox to Reading settings
    public function add_enable_infinite_scroll_checkbox()
    {
        add_settings_field( 'enable_infinite_scroll_checkbox', 'Enable infinite scroll', array( $this, 'enable_infinite_scroll_checkbox_callback' ), 'reading', 'default' );
        register_setting( 'reading', 'enable_infinite_scroll_checkbox' );
    }

    // Enable infinite scroll checkbox callback
    public function enable_infinite_scroll_checkbox_callback()
    {
        $ifs = get_option( 'enable_infinite_scroll_checkbox' );
        echo '<input type="checkbox" name="enable_infinite_scroll_checkbox" value="1" ' . checked( 1, $ifs, false ) . ' />';
    }

    // Enable infinite scroll
    public function enable_infinite_scroll()
    {
        if ( get_option( 'enable_infinite_scroll_checkbox' ) !== '' ) {
            // Enqueue infinite scroll script
            wp_enqueue_script( 'elimin8r-infinite-scroll', get_template_directory_uri() . '/dist/js/infinite-scroll.min.js', '', '1.0', true );
        }
    }
}

new InfiniteScroll();