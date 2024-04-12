<?php

/**
 * Maintenance Mode
 *
 * @package elimin8r
 */

class Elimin8r_Maintenance_Mode {
    public function __construct()
    {
        add_action( 'wp', array( $this, 'enable_maintenance_mode' ) );
        add_action( 'wp_dashboard_setup', array( $this, 'add_maintenance_mode_meta_box' ) );
        add_action( 'admin_init', array( $this, 'add_maintenance_mode_checkbox' ) );
    }

    public function enable_maintenance_mode()
    {
        if ( ! get_option( 'maintenance_mode_checkbox' ) === false ) {
            if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
                wp_die( '<h1>Maintenance Mode</h1><p>Sorry, we are currently undergoing maintenance. Please check back later.</p>', 'Maintenance Mode' );
            }
        }
    }

    public function add_maintenance_mode_meta_box()
    {
        if ( ! get_option( 'maintenance_mode_checkbox' ) === false ) {
            add_meta_box( 'maintenance_mode', 'Maintenance Mode', array( $this, 'maintenance_mode_meta_box_callback' ), 'dashboard', 'side', 'high' );
        }
    }

    public function maintenance_mode_meta_box_callback()
    {
        echo '<p><span class="dashicons dashicons-hammer"></span> WordPress is currently in maintenance mode.</p>';
    }

    public function add_maintenance_mode_checkbox()
    {
        add_settings_field( 'maintenance_mode_checkbox', 'Enable maintenance mode', array( $this, 'maintenance_mode_checkbox_callback' ), 'reading', 'default' );
        register_setting( 'reading', 'maintenance_mode_checkbox' );
    }

    public function maintenance_mode_checkbox_callback()
    {
        $maintenance_mode = get_option( 'maintenance_mode_checkbox' );
        echo '<input type="checkbox" name="maintenance_mode_checkbox" value="1" ' . checked( 1, $maintenance_mode, false ) . ' />';
    }
}

new Elimin8r_Maintenance_Mode();
