<?php

// If thumbnail is not present then add a placeholder image
function whitelabel_post_thumbnail() {
    ?>
    <figure class="post-thumbnail">
        <?php
            if ( ! has_post_thumbnail() ) {
                echo file_get_contents( get_template_directory_uri() . '/dist/images/placeholder-image.svg' );
            } else {
                the_post_thumbnail();
            }
        ?>
    </figure><!-- .post-thumbnail -->
    <?php
}