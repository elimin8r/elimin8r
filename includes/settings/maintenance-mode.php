<?php

namespace Elimin8r\Settings\MaintenanceMode;

/**
 * This class is used to add a setting to enable maintenance mode.
 *
 * @package elimin8r
 */

class MaintenanceMode {
    public function __construct()
    {
        add_action( 'wp', array( $this, 'enableMaintenanceMode' ) );
        add_action( 'wp_dashboard_setup', array( $this, 'addMaintenanceModeMetaBox' ) );
        add_action( 'admin_init', array( $this, 'addMaintenanceModeCheckbox' ) );
    }

    public function enableMaintenanceMode()
    {
        if ( ! get_option( 'maintenance_mode_checkbox' ) === false ) {
            if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
                wp_die( '<h1>Maintenance Mode</h1><p>Sorry, we are currently undergoing maintenance. Please check back later.</p>', 'Maintenance Mode' );
            }
        }
    }

    public function addMaintenanceModeMetaBox()
    {
        if ( ! get_option( 'maintenance_mode_checkbox' ) === false ) {
            add_meta_box( 'maintenance_mode', 'Maintenance Mode', array( $this, 'maintenanceModeMetaBoxCallback' ), 'dashboard', 'side', 'high' );
        }
    }

    public function maintenanceModeMetaBoxCallback()
    {
        echo '<p><span class="dashicons dashicons-hammer"></span> WordPress is currently in maintenance mode.</p>';
    }

    public function addMaintenanceModeCheckbox()
    {
        add_settings_field( 'maintenance_mode_checkbox', 'Enable maintenance mode', array( $this, 'maintenanceModeCheckboxCallback' ), 'reading', 'default' );
        register_setting( 'reading', 'maintenance_mode_checkbox' );
    }

    public function maintenanceModeCheckboxCallback()
    {
        $maintenance_mode = get_option( 'maintenance_mode_checkbox' );
        echo '<input type="checkbox" name="maintenance_mode_checkbox" value="1" ' . checked( 1, $maintenance_mode, false ) . ' />';
    }
}

new MaintenanceMode();
