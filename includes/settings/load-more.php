<?php

namespace Elimin8r\Settings\LoadMore;

use Elimin8r\Helpers\Helpers;

/**
 * This class is used to add a setting to enable the load more posts button.
 *
 * @package elimin8r
 */

class LoadMore {
    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'addEnableLoadMoreCheckbox' ) );
        add_action( 'wp_head', array( $this, 'enableLoadMore' ) );
    }

    // Add Enable load more checkbox to Reading settings
    public function addEnableLoadMoreCheckbox()
    {
        add_settings_field( 'enable_load_more_checkbox', 'Enable load more button', array( $this, 'enableLoadMoreCheckboxCallback' ), 'reading', 'default' );
        register_setting( 'reading', 'enable_load_more_checkbox' );
    }

    // Enable load more checkbox callback
    public function enableLoadMoreCheckboxCallback()
    {
        $ifs = get_option( 'enable_load_more_checkbox' );
        echo '<input type="checkbox" name="enable_load_more_checkbox" value="1" ' . checked( 1, $ifs, false ) . ' />';
    }

    // Enable load more
    public function enableLoadMore()
    {
        $manifest = Helpers::getManifest();

        if ( get_option( 'enable_load_more_checkbox' ) !== '' && get_option( 'enable_load_more_checkbox' ) !== false ) {            
            wp_enqueue_script( 'elimin8r-load-more', get_template_directory_uri() . '/public/' . $manifest['resources/js/loadmore.js']['file'], '', ELIMIN8R_VERSION, true );
        }
    }
}

new LoadMore();