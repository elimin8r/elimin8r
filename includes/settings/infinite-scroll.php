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
        add_action( 'admin_init', array( $this, 'addEnableInfiniteScrollCheckbox' ) );
        add_action( 'wp_head', array( $this, 'enableInfiniteScroll' ) );
    }

    // Add Enable infinite scroll checkbox to Reading settings
    public function addEnableInfiniteScrollCheckbox()
    {
        add_settings_field( 'enable_infinite_scroll_checkbox', 'Enable infinite scroll', array( $this, 'enableInfiniteScrollCheckboxCallback' ), 'reading', 'default' );
        register_setting( 'reading', 'enable_infinite_scroll_checkbox' );
    }

    // Enable infinite scroll checkbox callback
    public function enableInfiniteScrollCheckboxCallback()
    {
        $ifs = get_option( 'enable_infinite_scroll_checkbox' );
        echo '<input type="checkbox" name="enable_infinite_scroll_checkbox" value="1" ' . checked( 1, $ifs, false ) . ' />';
    }

    // Enable infinite scroll
    public function enableInfiniteScroll()
    {
        if ( get_option( 'enable_infinite_scroll_checkbox' ) !== '' && get_option( 'enable_infinite_scroll_checkbox' ) !== false ) {
            //  Get manifest file
            $manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
            
            // Enqueue infinite scroll script
            wp_enqueue_script( 'elimin8r-infinite-scroll', get_template_directory_uri() . '/dist/js/' . $manifest['infinitescroll.min.js'], '', ELIMIN8R_VERSION, true );
        }
    }
}

new InfiniteScroll();