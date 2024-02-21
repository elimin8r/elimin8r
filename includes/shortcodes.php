<?php

// Add a menu item under the "Settings" menu
add_action( 'admin_menu', 'register_shortcode_settings_menu' );
function register_shortcode_settings_menu() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    add_options_page( 'Shortcodes', 'Shortcodes', 'manage_options', 'shortcode_settings', 'shortcode_settings_page' );
}

// Render the settings page
function shortcode_settings_page() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    ?>
    <div class="wrap">
        <h1>Shortcodes Settings</h1>
        <form method="post">
            <?php
            settings_fields( 'shortcode_settings' );
            do_settings_sections( 'shortcode_settings' );
            submit_button( 'Add Shortcode' );
            ?>
        </form>

        <form method="post">
            <?php
            shortcode_delete_callback();
            submit_button( 'Delete', 'delete', 'delete', true, array( 'id' => 'delete-button' ) );
            ?>
        </form>
    </div>

    <script>
    document.getElementById('delete-button').addEventListener('click', function(event) {
        if (!confirm('Are you sure you want to delete the shortcode?')) {
            event.preventDefault();
        }
    });
    </script>
    <?php
}

// Register the settings and fields
add_action( 'admin_init', 'register_shortcode_settings' );
function register_shortcode_settings() {
    // Register the settings section
    add_settings_section( 'shortcode_section', 'Add a new shortcode', '', 'shortcode_settings' );

    // Register the input fields
    add_settings_field( 'shortcode_name', 'Shortcode Name', 'shortcode_name_callback', 'shortcode_settings', 'shortcode_section' );
    add_settings_field( 'shortcode_content', 'Shortcode Content', 'shortcode_content_callback', 'shortcode_settings', 'shortcode_section' );

    // Register the settings
    register_setting( 'shortcode_settings', 'shortcode_name' );
    register_setting( 'shortcode_settings', 'shortcode_content' );
    register_setting( 'shortcode_settings', 'shortcode_delete' );
}

// Callback functions for the input fields
function shortcode_name_callback() {
    ?>
    <input type="text" name="shortcode_name" value="" class="regular-text" placeholder="E.g. my_shortcode"/>
    <p class="description">Use the shortcode by adding <code>[my_shortcode]</code> to posts and pages.</p>
    <?php
}

function shortcode_content_callback() {
    ?>
    <textarea name="shortcode_content" class="large-text" rows="10"></textarea>
    <?php
}

function shortcode_delete_callback() {
    $shortcodes = get_option( 'whitelabel_custom_shortcodes', array() );
    
    ?>
    <h2>Delete a shortcode</h2>

    <select type="text" name="shortcode_delete" value="" class="regular-text"/>
       <option value="">Select a shortcode to delete</option>
        <?php foreach ( $shortcodes as $shortcode ) : ?>
            <option value="<?php echo esc_attr( $shortcode['shortcode_name'] ) ?>"><?php echo esc_html( $shortcode['shortcode_name'] ) ?></option>
        <?php endforeach; ?>
    </select>

    <p><strong>Warning:</strong> This cannot be undone.</p>
    <?php
}

// Handle shortcode registration
add_action('init', 'handle_shortcode_registration');
function handle_shortcode_registration() {
    $shortcodes = get_option( 'whitelabel_custom_shortcodes', array() );

    foreach ( $shortcodes as $shortcode ) {
        if ( isset( $shortcode['shortcode_name'] ) && isset( $shortcode['shortcode_content'] ) ) {
            add_shortcode( $shortcode['shortcode_name'], function() use ($shortcode) {
                return $shortcode['shortcode_content'];
            });
        }
    }
}

// Handle form submission
add_action( 'admin_init', 'handle_shortcode_form_submission' );
function handle_shortcode_form_submission() {
    if ( isset( $_POST['shortcode_name'] ) && isset( $_POST['shortcode_content'] ) && !empty( $_POST['shortcode_name'] ) && !empty( $_POST['shortcode_content'] ) ) {
        $shortcodes = get_option( 'whitelabel_custom_shortcodes', array() );
        // Check if the shortcode already exists
        foreach ( $shortcodes as $shortcode ) {
            if ( $shortcode['shortcode_name'] === $_POST['shortcode_name'] ) {
                // Add an error message
                add_settings_error( 'shortcode_settings', 'shortcode_exists', 'The shortcode you\'re trying to create already exists', 'error' );
                return;
            }
        }

        // Add the new shortcode to the array
        $shortcodes[] = array(
            'shortcode_name' => sanitize_text_field( $_POST['shortcode_name'] ),
            'shortcode_content' => wp_kses_post( $_POST['shortcode_content'] ), // Allow HTML in shortcode content
        );

        update_option( 'whitelabel_custom_shortcodes', $shortcodes );
    }

    if ( isset( $_POST['shortcode_delete'] ) && !empty( $_POST['shortcode_delete'] ) ) {
        $shortcodes = get_option( 'whitelabel_custom_shortcodes', array() );

        // Loop through the shortcodes and remove the one that was selected for deletion
        foreach ( $shortcodes as $key => $shortcode ) {
            if ( $shortcode['shortcode_name'] === $_POST['shortcode_delete'] ) {
                unset( $shortcodes[$key] );
            }
        }

        update_option( 'whitelabel_custom_shortcodes', $shortcodes );
    }
}