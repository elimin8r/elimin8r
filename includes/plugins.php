<?php

// If the the function is not already defined, include the plugin.php file
if ( is_admin() && ! function_exists( 'is_plugin_active' ) ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

// Check if ACF is active
if ( ! is_plugin_active( 'advanced-custom-fields/acf.php' ) || ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {

    // Define path and URL to the ACF plugin.
    define( 'MY_ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
    define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );

    // Include the ACF plugin.
    include_once( MY_ACF_PATH . 'acf.php' );

    // Customize the URL setting to fix incorrect asset URLs.
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url( $url ) {
        return MY_ACF_URL;
    }

    // Hide the ACF admin menu item.
    // add_filter('acf/settings/show_admin', '__return_false');
}