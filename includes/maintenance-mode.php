<?php

function enable_maintenance_mode() {
    if ( ! get_option( 'maintenance_mode_checkbox' ) === false ) {
        if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
            wp_die( '<h1>Maintenance Mode</h1><p>Sorry, we are currently undergoing maintenance. Please check back later.</p>', 'Maintenance Mode' );
        }
    }
}
add_action( 'wp', 'enable_maintenance_mode' );

function add_maintenance_mode_meta_box() {
    if ( ! get_option( 'maintenance_mode_checkbox' ) === false) {
        add_meta_box( 'maintenance_mode', 'Maintenance Mode', 'maintenance_mode_meta_box_callback', 'dashboard', 'side', 'high' );
    }
}

function maintenance_mode_meta_box_callback() {
    echo '<p>WordPress is currently in maintenance mode.</p>';
}
add_action( 'wp_dashboard_setup', 'add_maintenance_mode_meta_box' );

function add_maintenance_mode_checkbox() {
    add_settings_field( 'maintenance_mode_checkbox', 'Enable Maintenance Mode', 'maintenance_mode_checkbox_callback', 'reading', 'default' );
    register_setting( 'reading', 'maintenance_mode_checkbox' );
}

function maintenance_mode_checkbox_callback() {
    $maintenance_mode = get_option( 'maintenance_mode_checkbox' );
    echo '<input type="checkbox" name="maintenance_mode_checkbox" value="1" ' . checked( 1, $maintenance_mode, false ) . ' />';
}
add_action( 'admin_init', 'add_maintenance_mode_checkbox' );
