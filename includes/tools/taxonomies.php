<?php

// Add a menu item under the "Settings" menu
add_action( 'admin_menu', 'lmn8r_register_taxonomy_settings_menu' );
function lmn8r_register_taxonomy_settings_menu() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    add_management_page( 'Taxonomies', 'Taxonomies', 'manage_options', 'taxonomy_settings', 'lmn8r_taxonomy_settings_page' );
}

// Render the settings page
function lmn8r_taxonomy_settings_page() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    ?>
    <div class="wrap">
        <h1>Taxonomy Settings</h1>
        <form method="post">
            <?php
            settings_fields( 'taxonomy_settings' );
            do_settings_sections( 'taxonomy_settings' );
            submit_button( 'Add Taxonomy' );
            ?>
        </form>

        <form method="post">
            <?php
            lmn8r_taxonomy_delete_callback();
            submit_button( 'Delete', 'delete', 'delete', true, array( 'id' => 'delete-button' ) );
            ?>
        </form>
    </div>

    <script>
    document.getElementById('delete-button').addEventListener('click', function(event) {
        if (!confirm('Are you sure you want to delete the taxonomy?')) {
            event.preventDefault();
        }
    });
    </script>
    <?php
}

// Register the settings and fields
add_action( 'admin_init', 'lmn8r_register_taxonomy_settings' );
function lmn8r_register_taxonomy_settings() {
    // Register the settings section
    add_settings_section( 'taxonomy_section', 'Add a new taxonomy', '', 'taxonomy_settings' );

    // Register the input fields
    add_settings_field( 'taxonomy_label', 'Taxonomy Label', 'lmn8r_taxonomy_label_callback', 'taxonomy_settings', 'taxonomy_section' );
    add_settings_field( 'taxonomy_slug', 'Taxonomy Slug', 'lmn8r_taxonomy_slug_callback', 'taxonomy_settings', 'taxonomy_section' );
    add_settings_field( 'taxonomy_post_type', 'Post Type', 'lmn8r_taxonomy_post_type_callback', 'taxonomy_settings', 'taxonomy_section' );

    // Register the settings
    register_setting( 'taxonomy_settings', 'taxonomy_label' );
    register_setting( 'taxonomy_settings', 'taxonomy_slug' );
    register_setting( 'taxonomy_settings', 'taxonomy_post_type' );
    register_setting( 'taxonomy_settings', 'taxonomy_delete' );
}

// Callback functions for the input fields
function lmn8r_taxonomy_label_callback() {
    ?>
    <input type="text" name="taxonomy_label" value="" class="regular-text" placeholder="E.g. Genres" require/>
    <?php
}

function lmn8r_taxonomy_slug_callback() {
    ?>
    <input type="text" name="taxonomy_slug" value="" class="regular-text" placeholder="E.g. genres" required/>
    <?php
}

function lmn8r_taxonomy_post_type_callback() {
    $post_types = get_post_types( array( 'public' => true ), 'names' );
    ?>
    <select name="taxonomy_post_type" class="regular-text" required>
        <option value="">Select a post type</option>
        <?php foreach ( $post_types as $post_type ) : ?>
            <?php if ( $post_type === 'attachment' ) { continue; } ?>
            <option value="<?php echo esc_attr( $post_type ); ?>"><?php echo esc_html( $post_type ); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}

function lmn8r_taxonomy_delete_callback() {
    $taxonomies = get_option( 'lmn8r_custom_taxonomies', array() );
    
    ?>
    <h2>Delete a taxonomy</h2>

    <select type="text" name="taxonomy_delete" value="" class="regular-text"/>
       <option value="">Select a taxonomy to delete</option>
        <?php foreach ( $taxonomies as $taxonomy ) : ?>
            <option value="<?php echo esc_attr( $taxonomy['taxonomy_slug'] ) ?>"><?php echo esc_html( $taxonomy['taxonomy_label'] ) ?></option>
        <?php endforeach; ?>
    </select>
    <p><strong>Warning:</strong> This cannot be undone.</p>
    <?php
}

// Handle taxonomy registration
add_action('init', 'lmn8r_handle_taxonomy_registration');
function lmn8r_handle_taxonomy_registration() {
    $taxonomies = get_option( 'lmn8r_custom_taxonomies', array() );

    foreach ( $taxonomies as $taxonomy ) {
        if ( isset( $taxonomy['taxonomy_label'] ) && isset( $taxonomy['taxonomy_slug'] ) && isset( $taxonomy['taxonomy_post_type'] ) ) {
            $args = array(
                'label' => $taxonomy['taxonomy_label'],
                'rewrite' => array('slug' => $taxonomy['taxonomy_slug']),
                'hierarchical' => true,
            );
            register_taxonomy( $taxonomy['taxonomy_slug'], $taxonomy['taxonomy_post_type'], $args );
        }
    }
}

// Handle form submission
add_action( 'admin_init', 'lmn8r_handle_taxonomy_form_submission' );
function lmn8r_handle_taxonomy_form_submission() {
    if ( isset( $_POST['taxonomy_label'] ) && isset( $_POST['taxonomy_slug'] ) && isset( $_POST['taxonomy_post_type'] ) && !empty( $_POST['taxonomy_label'] ) && !empty( $_POST['taxonomy_slug'] ) && !empty( $_POST['taxonomy_post_type'] ) ) {
        // Check if taxonomy already exists
        $registered_taxonomies = get_taxonomies( array(), 'objects' );
        foreach ( $registered_taxonomies as $registered_taxonomy ) {
            if ( $registered_taxonomy->name === $_POST['taxonomy_slug'] ) {
                // Add an error message
                add_settings_error( 'taxonomy_settings', 'taxonomy_exists', 'The taxonomy you\'re trying to create already exists', 'error' );
                return;
            }
        }
        
        $taxonomies = get_option( 'lmn8r_custom_taxonomies', array() );

        // Add the new taxonomy to the array
        $taxonomies[] = array(
            'taxonomy_label' => sanitize_text_field( $_POST['taxonomy_label'] ),
            'taxonomy_slug' => sanitize_text_field( $_POST['taxonomy_slug'] ),
            'taxonomy_post_type' => sanitize_text_field( $_POST['taxonomy_post_type'] ),
        );

        update_option( 'lmn8r_custom_taxonomies', $taxonomies );

        // Refresh the page
        wp_redirect( admin_url( 'tools.php?page=taxonomy_settings' ) );
    }

    if ( isset( $_POST['taxonomy_delete'] ) && !empty( $_POST['taxonomy_delete'] ) ) {
        $taxonomies = get_option( 'lmn8r_custom_taxonomies', array() );

        // Loop through the taxonomies and remove the one that was selected for deletion
        foreach ( $taxonomies as $key => $taxonomy ) {
            if ( $taxonomy['taxonomy_slug'] === $_POST['taxonomy_delete'] ) {
                unset( $taxonomies[$key] );
            }
        }

        update_option( 'lmn8r_custom_taxonomies', $taxonomies );

        // Refresh the page
        wp_redirect( admin_url( 'tools.php?page=taxonomy_settings' ) );
    }
}