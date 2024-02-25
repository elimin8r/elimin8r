<?php

// If thumbnail is not present then add a placeholder image
function whitelabel_post_thumbnail( $size ) {
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