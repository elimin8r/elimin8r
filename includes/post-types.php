<?php

// Add a menu item under the "Settings" menu
add_action( 'admin_menu', 'register_post_types_settings_menu' );
function register_post_types_settings_menu() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    add_options_page( 'Post Types', 'Post Types', 'manage_options', 'post_types_settings', 'post_types_settings_page' );
}

// Render the settings page
function post_types_settings_page() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    ?>
    <div class="wrap">
        <h1>Post Types Settings</h1>
        <form method="post">
            <?php
            settings_fields( 'post_types_settings' );
            do_settings_sections( 'post_types_settings' );
            submit_button( 'Add Post Type' );
            ?>
        </form>

        <form method="post">
            <?php
            post_type_delete_callback();
            submit_button( 'Delete', 'delete', 'delete', true, array( 'id' => 'delete-button' ) );
            ?>
        </form>
    </div>

    <script>
    document.getElementById('delete-button').addEventListener('click', function(event) {
        if (!confirm('Are you sure you want to delete the post type?')) {
            event.preventDefault();
        }
    });
    </script>
    <?php
}

// Register the settings and fields
add_action( 'admin_init', 'register_post_types_settings' );
function register_post_types_settings() {
    // Register the settings section
    add_settings_section( 'post_types_section', 'Add a new post type', '', 'post_types_settings' );

    // Register the input fields
    add_settings_field( 'plural_label', 'Plural Label', 'plural_label_callback', 'post_types_settings', 'post_types_section' );
    add_settings_field( 'singular_label', 'Singular Label', 'singular_label_callback', 'post_types_settings', 'post_types_section' );
    add_settings_field( 'post_type_slug', 'Post Type Slug', 'post_type_slug_callback', 'post_types_settings', 'post_types_section' );
    // add_settings_field( 'taxonomies', 'Taxonomies', 'taxonomies_callback', 'post_types_settings', 'post_types_section' );

    // Register the settings
    register_setting( 'post_types_settings', 'plural_label' );
    register_setting( 'post_types_settings', 'singular_label' );
    register_setting( 'post_types_settings', 'post_type_slug' );
    register_setting( 'post_types_settings', 'post_type_delete' );
    // register_setting( 'post_types_settings', 'taxonomies' );
}

// Callback functions for the input fields
function plural_label_callback() {
    ?>
    <input type="text" name="plural_label" value="" class="regular-text" placeholder="E.g. Games"/>
    <?php
}

function singular_label_callback() {
    ?>
    <input type="text" name="singular_label" value="" class="regular-text" placeholder="E.g. Game"/>
    <?php
}

function post_type_slug_callback() {
    ?>
    <input type="text" name="post_type_slug" value="" class="regular-text" placeholder="E.g. games"/>
    <?php
}

function post_type_delete_callback() {
    $post_types = get_option( 'whitelabel_custom_post_types', array() );
    
    ?>
    <h2>Delete a post type</h2>

    <select type="text" name="post_type_delete" value="" class="regular-text"/>
       <option value="">Select a post type to delete</option>
        <?php foreach ( $post_types as $post_type ) : ?>
            <option value="<?php echo esc_attr( $post_type['post_type_slug'] ) ?>"><?php echo esc_html( $post_type['plural_label'] ) ?></option>
        <?php endforeach; ?>
    </select>
    <p><strong>Warning:</strong> This cannot be undone.</p>
    <?php
}

function taxonomies_callback() {
    $taxonomies = get_taxonomies();
    $selected_taxonomies = get_option( 'taxonomies' );

    // Check if $selected_taxonomies is an array, if not convert it to an array
    if (!is_array( $selected_taxonomies ) ) {
        $selected_taxonomies = explode( ',', $selected_taxonomies ); // assuming it's a comma-separated string
    }

    echo '<select name="taxonomies[]" multiple>';
    if ( !empty( $taxonomies ) ) {
        foreach ( $taxonomies as $taxonomy ) {
            $selected = in_array( $taxonomy, $selected_taxonomies ) ? 'selected' : '';
            echo '<option value="' . esc_attr( $taxonomy ) . '" ' . $selected . '>' . esc_html( $taxonomy ) . '</option>';
        }
    }
    echo '</select>';
}

// Handle post type registration
add_action('init', 'handle_post_type_registration');
function handle_post_type_registration() {
    $post_types = get_option( 'whitelabel_custom_post_types', array() );

    foreach ( $post_types as $post_type ) {
        if ( isset( $post_type['plural_label'] ) && isset( $post_type['singular_label'] ) && isset( $post_type['post_type_slug'] ) ) {
            $args = array(
                'label' => $post_type['plural_label'],
                'labels' => array(
                    'name'                  => _x( $post_type['plural_label'], 'Post type general name', 'textdomain' ),
                    'singular_name'         => _x( $post_type['singular_label'], 'Post type singular name', 'textdomain' ),
                    'menu_name'             => _x( $post_type['plural_label'], 'Admin Menu text', 'textdomain' ),
                    'name_admin_bar'        => _x( $post_type['singular_label'], 'Add New on Toolbar', 'textdomain' ),
                    'add_new'               => __( 'Add New', 'textdomain' ),
                    'add_new_item'          => __( 'Add New ' . $post_type['singular_label'], 'textdomain' ),
                    'new_item'              => __( 'New ' . $post_type['singular_label'], 'textdomain' ),
                    'edit_item'             => __( 'Edit ' . $post_type['singular_label'], 'textdomain' ),
                    'view_item'             => __( 'View ' . $post_type['singular_label'], 'textdomain' ),
                    'all_items'             => __( 'All ' . $post_type['plural_label'], 'textdomain' ),
                    'search_items'          => __( 'Search ' . $post_type['plural_label'], 'textdomain' ),
                    'parent_item_colon'     => __( 'Parent ' . $post_type['plural_label'] . ':', 'textdomain' ),
                    'not_found'             => __( 'No ' . $post_type['plural_label'] . ' found.', 'textdomain' ),
                    'not_found_in_trash'    => __( 'No ' . $post_type['plural_label'] . ' found in Trash.', 'textdomain' ),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => $post_type['post_type_slug']),
            );
            register_post_type( $post_type['post_type_slug'], $args );
        }
    }
}

// Handle form submission
add_action( 'admin_init', 'handle_form_submission' );
function handle_form_submission() {
    if ( isset( $_POST['plural_label'] ) && isset( $_POST['singular_label'] ) && isset( $_POST['post_type_slug'] ) && !empty( $_POST['plural_label'] ) && !empty( $_POST['singular_label'] ) && !empty( $_POST['post_type_slug'] ) ) {
        $post_types = get_option( 'whitelabel_custom_post_types', array() );

        // Add the new post type to the array
        $post_types[] = array(
            'plural_label' => sanitize_text_field( $_POST['plural_label'] ),
            'singular_label' => sanitize_text_field( $_POST['singular_label'] ),
            'post_type_slug' => sanitize_text_field( $_POST['post_type_slug'] ),
        );

        update_option( 'whitelabel_custom_post_types', $post_types );
    }

    if ( isset( $_POST['post_type_delete'] ) && !empty( $_POST['post_type_delete'] ) ) {
        $post_types = get_option( 'whitelabel_custom_post_types', array() );

        // Loop through the post types and remove the one that was selected for deletion
        foreach ( $post_types as $key => $post_type ) {
            if ( $post_type['post_type_slug'] === $_POST['post_type_delete'] ) {
                unset( $post_types[$key] );
            }
        }

        update_option( 'whitelabel_custom_post_types', $post_types );
    }
}