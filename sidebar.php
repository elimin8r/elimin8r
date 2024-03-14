<?php

$post_type = get_post_type();

global $wp_registered_sidebars;

// Get the post types for each sidebar
$sidebar_post_types = array();
foreach ( $wp_registered_sidebars as $sidebar ) {
    // $sidebar_post_types[$sidebar['id']] = get_theme_mod( 'sidebar_post_types_' . $sidebar['id'] );

	$sidebar_post_type = get_theme_mod( 'sidebar_post_types_' . $sidebar['id'] );
    $sidebar_post_types[$sidebar_post_type] = $sidebar['id'];
}

// Return if the current post type is not in the array
if ( ! array_key_exists( $post_type, $sidebar_post_types ) ) {
	return;
}

// Get the sidebar for the current post type
$sidebar_id = $sidebar_post_types[$post_type];

?>

<aside id="secondary" class="sidebar">
	<div class="sidebar-content">
		<?php dynamic_sidebar( $sidebar_id ); ?>
	</div>
</aside><!-- #secondary -->
