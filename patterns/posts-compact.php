<?php
/**
 * Title: Posts - Compact
 * Slug: twentytwentythree/my-block-pattern
 * Post Types: post
 * Categories: posts
 * Viewport Width: 800
 * Keywords: posts, compact, elimin8r
 * Block Types: core/posts
 */
?>

<!-- wp:query {"queryId":8,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
    <div class="wp-block-query block-posts-compact">
    <!-- wp:post-template -->
        <!-- wp:columns {"align":"wide"} -->
        <div class="wp-block-columns">
            <!-- wp:column -->
            <div class="wp-block-column">
            <!-- wp:post-featured-image {"isLink":true} /-->
            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column">
            <!-- wp:post-title {"isLink":true} /-->

            <!-- wp:post-excerpt /-->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    <!-- /wp:post-template -->
    </div>
<!-- /wp:query -->