<?php

// If thumbnail is not present then add a placeholder image
function whitelabel_post_thumbnail( $size ) {
    $header_position = get_theme_mod( 'header_position', 'top' );

    if ( get_post_meta( get_the_ID(), '_featured_image_checkbox', true ) &&         $header_position == 'top' ) {
        // Add class 'featured-full-width' to the post thumbnail
        function add_featured_full_width_class( $attr ) {
            $attr['class'] .= ' featured-full-width';
            return $attr;
        }
        add_filter( 'wp_get_attachment_image_attributes', 'add_featured_full_width_class' );
    }
    ?>
    <figure class="post-thumbnail">
        <?php
            if ( ! has_post_thumbnail() && ! is_singular() ) {
                global $current_template;

                if ( $current_template == 'blog-grid' ) {
                    echo file_get_contents( get_template_directory_uri() . '/dist/images/placeholder-square.svg' );
                } else {
                    echo file_get_contents( get_template_directory_uri() . '/dist/images/placeholder-image.svg' );
                }
            } else {
                the_post_thumbnail( $size );
            }
        ?>
    </figure><!-- .post-thumbnail -->
    <?php
}

// Add SVG support
function whitelabel_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'whitelabel_mime_types' );

// Add preload for featured images
function whitelabel_preload_image() {
    if ( is_singular() && has_post_thumbnail() ) {
        // Get the featured image
        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

        // Get the srcset
        $srcset = wp_get_attachment_image_srcset( get_post_thumbnail_id(), 'full' );

        // Get the sizes
        $sizes = wp_get_attachment_image_sizes( get_post_thumbnail_id(), 'full' );

        // Output the preload tag
        echo '<link rel="preload" href="' . esc_url( $image[0] ) . '" as="image" imagesrcset="' . esc_attr( $srcset ) . '" imagesizes="' . esc_attr( $sizes ) . '">';
    }
}
add_action( 'wp_head', 'whitelabel_preload_image', 0 );

function whitelabel_add_featured_image_settings_meta_box() {
    add_meta_box(
        'whitelabel_featured_image_settings', // Unique ID
        'Featured Image Settings', // Box title
        'whitelabel_featured_image_settings_meta_box_html', // Content callback
        'page', // Post type
        'side' // Position
    );
}
add_action( 'add_meta_boxes', 'whitelabel_add_featured_image_settings_meta_box' );

function whitelabel_featured_image_settings_meta_box_html( $post ) {
    $value = get_post_meta( $post->ID, '_featured_image_checkbox', true );
    $checked = $value == '1' ? 'checked' : '';
    echo '<input type="checkbox" id="featured_image_checkbox" name="featured_image_checkbox" value="1" ' . $checked . '>';
    echo '<label for="featured_image_checkbox">Full width</label>';
}

function whitelabel_save_featured_image_checkbox( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['featured_image_checkbox'] ) ) {
        update_post_meta( $post_id, '_featured_image_checkbox', $_POST['featured_image_checkbox'] );
    } else {
        delete_post_meta( $post_id, '_featured_image_checkbox' );
    }
}
add_action( 'save_post', 'whitelabel_save_featured_image_checkbox' );