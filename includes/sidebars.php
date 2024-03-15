<?php

// Add a menu item under the "Settings" menu
add_action( 'admin_menu', 'whitelabel_register_sidebar_settings_menu' );
function whitelabel_register_sidebar_settings_menu() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    add_options_page( 'Sidebars', 'Sidebars', 'manage_options', 'sidebar_settings', 'whitelabel_sidebar_settings_page' );
}

// Render the settings page
function whitelabel_sidebar_settings_page() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    ?>
    <div class="wrap">
        <h1>Sidebar Settings</h1>
        <form method="post">
            <?php
            settings_fields( 'sidebar_settings' );
            do_settings_sections( 'sidebar_settings' );
            submit_button( 'Add Sidebar' );
            ?>
        </form>

        <form method="post">
            <?php
            whitelabel_sidebar_delete_callback();
            submit_button( 'Delete', 'delete', 'delete', true, array( 'id' => 'delete-button' ) );
            ?>
        </form>
    </div>

    <script>
    document.getElementById('delete-button').addEventListener('click', function(event) {
        if (!confirm('Are you sure you want to delete the sidebar?')) {
            event.preventDefault();
        }
    });
    </script>
    <?php
}

// Register the settings and fields
add_action( 'admin_init', 'whitelabel_register_sidebar_settings' );
function whitelabel_register_sidebar_settings() {
    // Register the settings section
    add_settings_section( 'sidebar_section', 'Add a new sidebar', '', 'sidebar_settings' );

    // Register the input fields
    add_settings_field( 'sidebar_name', 'Sidebar Name', 'whitelabel_sidebar_name_callback', 'sidebar_settings', 'sidebar_section' );
    add_settings_field( 'sidebar_id', 'Sidebar ID', 'whitelabel_sidebar_id_callback', 'sidebar_settings', 'sidebar_section' );

    // Register the settings
    register_setting( 'sidebar_settings', 'sidebar_name' );
    register_setting( 'sidebar_settings', 'sidebar_id' );
    register_setting( 'sidebar_settings', 'sidebar_delete' );
}

// Callback functions for the input fields
function whitelabel_sidebar_name_callback() {
    ?>
    <input type="text" name="sidebar_name" value="" class="regular-text" placeholder="E.g. Main Sidebar" required/>
    <?php
}

function whitelabel_sidebar_id_callback() {
    ?>
    <input type="text" name="sidebar_id" value="" class="regular-text" placeholder="E.g. main-sidebar" required/>
    <?php
}

function whitelabel_sidebar_delete_callback() {
    global $wp_registered_sidebars;
    ?>
    <h2>Delete a sidebar</h2>

    <select type="text" name="sidebar_delete" value="" class="regular-text"/>
       <option value="">Select a sidebar to delete</option>
        <?php foreach ( $wp_registered_sidebars as $sidebar ) : ?>
            <option value="<?php echo esc_attr( $sidebar['id'] ) ?>"><?php echo esc_html( $sidebar['name'] ) ?></option>
        <?php endforeach; ?>
    </select>
    <p><strong>Warning:</strong> This cannot be undone.</p>
    <?php
}

// Handle sidebar registration
add_action('widgets_init', 'whitelabel_handle_sidebar_registration');
function whitelabel_handle_sidebar_registration() {
    $sidebars = get_option( 'whitelabel_custom_sidebars', array() );

    foreach ( $sidebars as $sidebar ) {
        if ( isset( $sidebar['sidebar_name'] ) && isset( $sidebar['sidebar_id'] ) ) {
            $args = array(
                'name' => $sidebar['sidebar_name'],
                'id' => $sidebar['sidebar_id'],
                'before_widget' => '<div>',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="rounded">',
                'after_title' => '</h2>',
            );
            register_sidebar( $args );
        }
    }
}

// Handle form submission
add_action( 'admin_init', 'whitelabel_handle_sidebar_form_submission' );
function whitelabel_handle_sidebar_form_submission() {
    if ( isset( $_POST['sidebar_name'] ) && isset( $_POST['sidebar_id'] ) && !empty( $_POST['sidebar_name'] ) && !empty( $_POST['sidebar_id'] ) ) {
        // Check if sidebar already exists
        global $wp_registered_sidebars;
        foreach ( $wp_registered_sidebars as $registered_sidebar ) {
            if ( $registered_sidebar['id'] === $_POST['sidebar_id'] ) {
                // Add an error message
                add_settings_error( 'sidebar_settings', 'sidebar_exists', 'The sidebar you\'re trying to create already exists', 'error' );
                return;
            }
        }
        
        $sidebars = get_option( 'whitelabel_custom_sidebars', array() );

        // Add the new sidebar to the array
        $sidebars[] = array(
            'sidebar_name' => sanitize_text_field( $_POST['sidebar_name'] ),
            'sidebar_id' => sanitize_text_field( $_POST['sidebar_id'] ),
        );

        update_option( 'whitelabel_custom_sidebars', $sidebars );

        // Refresh the page
        wp_redirect( admin_url( 'options-general.php?page=sidebar_settings' ) );
    }

    if ( isset( $_POST['sidebar_delete'] ) && !empty( $_POST['sidebar_delete'] ) ) {
        $sidebars = get_option( 'whitelabel_custom_sidebars', array() );

        // Loop through the sidebars and remove the one that was selected for deletion
        foreach ( $sidebars as $key => $sidebar ) {
            if ( $sidebar['sidebar_id'] === $_POST['sidebar_delete'] ) {
                unset( $sidebars[$key] );
            }
        }

        update_option( 'whitelabel_custom_sidebars', $sidebars );

        // Refresh the page
        wp_redirect( admin_url( 'options-general.php?page=sidebar_settings' ) );
    }
}