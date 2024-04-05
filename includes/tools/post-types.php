<?php

// Add a menu item under the "Settings" menu
add_action( 'admin_menu', 'elimin8r_register_post_types_settings_menu' );
function elimin8r_register_post_types_settings_menu() {
    // Check if administrator
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    add_management_page( 'Post Types', 'Post Types', 'manage_options', 'post_types_settings', 'elimin8r_post_types_settings_page' );
}

// Render the settings page
function elimin8r_post_types_settings_page() {
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
            elimin8r_post_type_delete_callback();
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
add_action( 'admin_init', 'elimin8r_register_post_types_settings' );
function elimin8r_register_post_types_settings() {
    // Register the settings section
    add_settings_section( 'post_types_section', 'Add a new post type', '', 'post_types_settings' );

    // Register the input fields
    add_settings_field( 'plural_label', 'Plural Label', 'elimin8r_plural_label_callback', 'post_types_settings', 'post_types_section' );
    add_settings_field( 'singular_label', 'Singular Label', 'elimin8r_singular_label_callback', 'post_types_settings', 'post_types_section' );
    add_settings_field( 'post_type_slug', 'Post Type Slug', 'elimin8r_post_type_slug_callback', 'post_types_settings', 'post_types_section' );
    add_settings_field( 'taxonomies', 'Taxonomies', 'elimin8r_taxonomies_callback', 'post_types_settings', 'post_types_section' );

    // Register the settings
    register_setting( 'post_types_settings', 'plural_label' );
    register_setting( 'post_types_settings', 'singular_label' );
    register_setting( 'post_types_settings', 'post_type_slug' );
    register_setting( 'post_types_settings', 'post_type_delete' );
    register_setting( 'post_types_settings', 'post_type_migrate' );
    register_setting( 'post_types_settings', 'taxonomies' );
}

// Callback functions for the input fields
function elimin8r_plural_label_callback() {
    ?>
    <input type="text" name="plural_label" value="" class="regular-text" placeholder="E.g. Games" required/>
    <?php
}

function elimin8r_singular_label_callback() {
    ?>
    <input type="text" name="singular_label" value="" class="regular-text" placeholder="E.g. Game" required/>
    <?php
}

function elimin8r_post_type_slug_callback() {
    ?>
    <input type="text" name="post_type_slug" value="" class="regular-text" placeholder="E.g. games" required/>
    <?php
}

function elimin8r_post_type_delete_callback() {
    $post_types = get_option( 'elimin8r_custom_post_types', array() );
    
    ?>
    <h2>Delete a post type</h2>

    <select type="text" name="post_type_delete" value="" class="regular-text"/>
       <option value="">Select a post type to delete</option>
        <?php foreach ( $post_types as $post_type ) : ?>
            <option value="<?php echo esc_attr( $post_type['post_type_slug'] ) ?>"><?php echo esc_html( $post_type['plural_label'] ) ?></option>
        <?php endforeach; ?>
    </select>

    <p>Choose what happens to posts from the deleted post type:</p>

    <?php
        $registered_post_types = get_post_types( array( 'public' => true ), 'object' );
        unset( $registered_post_types['attachment'] );
        unset( $registered_post_types['page'] );
    ?>
    <select type="text" name="post_type_migrate" value="" class="regular-text" required>
       <option value="delete_posts" selected>Delete posts</option>
        <?php foreach ( $registered_post_types as $registered_post_type ) : ?>
            <option value="<?php echo esc_attr( $registered_post_type->name ) ?>">Migrate to: <?php echo esc_html( $registered_post_type->label ) ?></option>
        <?php endforeach; ?>
    </select>

    <p><strong>Warning:</strong> This cannot be undone.</p>
    <?php
}

function elimin8r_taxonomies_callback() {
    $taxonomies = get_taxonomies( array('public' => true ), 'names' );
    $selected_taxonomies = get_option( 'taxonomies' );
    $exclude_taxonomies = array( 'post_tag', 'post_format' );

    // Check if $selected_taxonomies is an array, if not convert it to an array
    if (!is_array( $selected_taxonomies ) ) {
        $selected_taxonomies = explode( ',', $selected_taxonomies ); // assuming it's a comma-separated string
    }

    ?>
    <select name="taxonomies[]" class="regular-text">
        <option value="">Select a taxonomy</option>
        <?php if ( !empty( $taxonomies ) ) : ?>
            <?php foreach ( $taxonomies as $taxonomy ) : ?>
                <?php if ( in_array( $taxonomy, $exclude_taxonomies ) ) continue; ?>
                <?php $selected = in_array( $taxonomy, $selected_taxonomies ) ? 'selected' : ''; ?>
                    <option value="<?php echo esc_attr( $taxonomy ) ?>" <?php echo $selected ?>><?php echo esc_html( $taxonomy ) ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?php
}

// Handle post type registration
add_action('init', 'elimin8r_handle_post_type_registration');
function elimin8r_handle_post_type_registration() {
    $post_types = get_option( 'elimin8r_custom_post_types', array() );

    foreach ( $post_types as $post_type ) {
        if ( isset( $post_type['plural_label'] ) && isset( $post_type['singular_label'] ) && isset( $post_type['post_type_slug'] ) ) {
            $plural = $post_type['plural_label'];
            $singular = $post_type['singular_label'];
            $labels = array(
                'name' => _x( $plural, 'Post type general name', 'elimin8r' ),
                'singular_name' => _x( $singular, 'Post type singular name', 'elimin8r' ),
                'menu_name' => _x( $plural, 'Admin Menu text', 'elimin8r' ),
                'name_admin_bar' => _x( $singular, 'Add New on Toolbar', 'elimin8r' ),
                'add_new' => __( 'Add New', 'elimin8r' ),
                'add_new_item' => __( 'Add New ' . $singular, 'elimin8r' ),
                'new_item' => __( 'New ' . $singular, 'elimin8r' ),
                'edit_item' => __( 'Edit ' . $singular, 'elimin8r' ),
                'view_item' => __( 'View ' . $singular, 'elimin8r' ),
                'all_items' => __( 'All ' . $plural, 'elimin8r' ),
                'search_items' => __( 'Search ' . $plural, 'elimin8r' ),
                'parent_item_colon' => __( 'Parent ' . $plural . ': ', 'elimin8r' ),
                'not_found' => __( 'No ' . $plural . ' found.', 'elimin8r' ),
                'not_found_in_trash' => __( 'No ' . $plural . ' found in Trash.', 'elimin8r' )
            );
            $args = array(
                'label' => $plural,
                'labels' => $labels,
                'public' => true,
                'has_archive' => true,
                'show_in_rest' => true,
                'supports' => array( 'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'post-formats' ),
                'taxonomies' => isset( $post_type['taxonomies'] ) ? $post_type['taxonomies'] : array(),
                'rewrite' => array( 'slug' => $post_type['post_type_slug'] ),
            );
            register_post_type( $post_type['post_type_slug'], $args );
        }
    }
}

// Handle form submission
add_action( 'admin_init', 'elimin8r_handle_form_submission' );
function elimin8r_handle_form_submission() {
    if ( isset( $_POST['plural_label'] ) && isset( $_POST['singular_label'] ) && isset( $_POST['post_type_slug'] ) && !empty( $_POST['plural_label'] ) && !empty( $_POST['singular_label'] ) && !empty( $_POST['post_type_slug'] ) ) {
        // Check if the post type already exists
        $registered_post_types = get_post_types( array(), 'objects' );
        foreach ( $registered_post_types as $registered_post_type ) {
            if ( $registered_post_type->name === $_POST['post_type_slug'] ) {
                // Add an error message
                add_settings_error( 'post_types_settings', 'post_type_exists', 'The post type you\'re trying to create already exists', 'error' );
                return;
            }
        }

        $post_types = get_option( 'elimin8r_custom_post_types', array() );

        // Add the new post type to the array
        $post_types[] = array(
            'plural_label' => sanitize_text_field( $_POST['plural_label'] ),
            'singular_label' => sanitize_text_field( $_POST['singular_label'] ),
            'post_type_slug' => sanitize_text_field( $_POST['post_type_slug'] ),
        );

        update_option( 'elimin8r_custom_post_types', $post_types );

        // Set a transient to indicate that the rewrite rules need to be flushed
        set_transient( 'flush_rewrite_rules', true );

        // Refresh the page
        wp_redirect( admin_url( 'tools.php?page=post_types_settings' ) );
    }

    if ( isset( $_POST['post_type_delete'] ) && !empty( $_POST['post_type_delete'] ) ) {
        $post_types = get_option( 'elimin8r_custom_post_types', array() );

        // if isset( $_POST['post_type_migrate'] ) then migrate the posts to the selected post type
        if ( isset( $_POST['post_type_migrate'] ) && !empty( $_POST['post_type_migrate'] ) ) {
            $migrate_to = $_POST['post_type_migrate'];
            $posts = get_posts( array( 'post_type' => $_POST['post_type_delete'], 'numberposts' => -1 ) );

            foreach ( $posts as $post ) {
                wp_update_post( array( 'ID' => $post->ID, 'post_type' => $migrate_to ) );
            }
        } else {
            // Delete the posts
            $posts = get_posts( array( 'post_type' => $_POST['post_type_delete'], 'numberposts' => -1 ) );

            foreach ( $posts as $post ) {
                wp_delete_post( $post->ID, true );
            }
        }

        // Loop through the post types and remove the one that was selected for deletion
        foreach ( $post_types as $key => $post_type ) {
            if ( $post_type['post_type_slug'] === $_POST['post_type_delete'] ) {
                unset( $post_types[$key] );
            }
        }

        update_option( 'elimin8r_custom_post_types', $post_types );

        // Refresh the page
        wp_redirect( admin_url( 'tools.php?page=post_types_settings' ) );
    }
}

function elimin8r_my_flush_rewrite_rules() {
    // If the 'flush_rewrite_rules' transient is set flush the rewrite rules
    if ( get_transient( 'flush_rewrite_rules' ) ) {
        flush_rewrite_rules();

        // Delete the transient
        delete_transient( 'flush_rewrite_rules' );
    }
}
add_action('wp_loaded', 'elimin8r_my_flush_rewrite_rules');

// Remove Archives: prefix from archive titles
add_filter( 'get_the_archive_title', function ( $title ) {
    if ( strpos( $title, 'Archives:' ) !== false ) {
        $title = str_replace( 'Archives: ', '', $title );
    }

    return $title;
});
