<?php

namespace Elimin8r\Media;

/**
 * Media
 * 
 * @package elimin8r
 */

 class Media {
    public function __construct()
    {
        add_action( 'wp_head', array( $this, 'preload_image' ), 0 );
        add_action( 'add_meta_boxes', array( $this, 'add_featured_image_settings_meta_box' ) );
        add_action( 'save_post', array( $this, 'save_featured_image_checkbox' ) );
        add_filter( 'get_custom_logo', array( $this, 'custom_logo_output' ) );
        add_filter( 'wp_get_attachment_image_attributes', array( $this, 'add_featured_full_width_class' ) );
    }

    // Add class 'featured-full-width' to the post thumbnail
    function add_featured_full_width_class( $attr )
    {
        $header_position = get_theme_mod( 'header_position', 'top' );
    
        if ( get_post_meta( get_the_ID(), '_featured_image_checkbox', true ) && $header_position == 'top' ) {
            $attr['class'] .= ' featured-full-width';
        }

        return $attr;
    }

    // If thumbnail is not present then add a placeholder image
    public static function post_thumbnail( $size )
    {
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

    // Add preload for featured images
    public function preload_image()
    {
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

    // Add featured image settings meta box
    public function add_featured_image_settings_meta_box()
    {
        $post_types = get_post_types( array( 'public' => true ) );
        unset( $post_types['attachment'] );

        add_meta_box(
            'elimin8r_featured_image_settings', // Unique ID
            'Featured Image Settings', // Box title
            array( $this, 'featured_image_settings_meta_box_html' ), // Content callback
            $post_types, // Post type
            'side' // Position
        );
    }

    // Featured image settings meta box HTML
    public function featured_image_settings_meta_box_html( $post )
    {
        $value = get_post_meta( $post->ID, '_featured_image_checkbox', true );
        $checked = $value == '1' ? 'checked' : '';
        echo '<input type="checkbox" id="featured_image_checkbox" name="featured_image_checkbox" value="1" ' . $checked . '>';
        echo '<label for="featured_image_checkbox">Full width</label>';
    }

    // Save featured image settings
    public function save_featured_image_checkbox( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( isset( $_POST['featured_image_checkbox'] ) ) {
            update_post_meta( $post_id, '_featured_image_checkbox', $_POST['featured_image_checkbox'] );
        } else {
            delete_post_meta( $post_id, '_featured_image_checkbox' );
        }
    }

    // Get the width and height of an SVG file
    public function getSvgSize( $file )
    {
        $svgContent = file_get_contents( $file );
        if ( $svgContent === false ) {
            return [0, 0]; // Return default size if file can't be read
        }

        $svgElement = simplexml_load_string( $svgContent );
        if ( $svgElement === false ) {
            return [0, 0]; // Return default size if SVG can't be parsed
        }

        $attributes = $svgElement->attributes();
        $width = isset( $attributes->width) ? ( string )$attributes->width : 0;
        $height = isset( $attributes->height) ? ( string )$attributes->height : 0;

        return [$width, $height];
    }

    // Filter the_custom_logo() to add width and height attributes
    public function custom_logo_output( $html )
    {
        // Get the ID
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        if ( ! $custom_logo_id ) {
            return $html;
        }

        // Get the url
        $custom_logo_path = get_attached_file( $custom_logo_id );

        // Get the MIME type of the file
        $file_type = mime_content_type( $custom_logo_path );

        // Get the width and height
        if ( $file_type != 'image/svg+xml' ) {
            return $html;
        }
        
        $size = $this->getSvgSize( $custom_logo_path );
        $width = $size[0];
        $height = $size[1];

        // Add width and height attributes to the custom logo
        $html = str_replace( '<img', '<img width="' . $width . '" height="' . $height . '"', $html );

        return $html;
    }
}

new Media();