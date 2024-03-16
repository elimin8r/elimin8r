<?php

function whitelabel_sidebar_customize_register( $wp_customize ) {
	// Add the sidebar section
	$wp_customize->add_section( 'whitelabel_sidebar_options' , array(
		'title'      => __( 'Sidebars', 'whitelabel' ),
		'description' => 'Select the post types that you want to display each sidebar on',
		'priority'   => 30,
	) );

	// Get all post types
	$post_types = get_post_types( array( 'public' => true ), 'objects' );
	$choices = array();
	$choices[''] = 'Select a post type';

	foreach( $post_types as $post_type ) {
		$choices[$post_type->name] = $post_type->label;
	}

	// Get all registered sidebars
	global $wp_registered_sidebars;

	foreach( $wp_registered_sidebars as $sidebar ) {
		// Add the setting for the sidebar text
		$wp_customize->add_setting( 'sidebar_post_types_' . $sidebar['id'] , array(
			'default'   => array(),
			'transport' => 'refresh',
		) );

		// Add the control for the sidebar settings
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sidebar_post_types_' . $sidebar['id'], array(
			'label'      => __( $sidebar['name'], 'whitelabel' ),
			'section'    => 'whitelabel_sidebar_options',
			'settings'   => 'sidebar_post_types_' . $sidebar['id'],
			'type'       => 'select',
			'choices'    => $choices,
		) ) );
	}
}
add_action( 'customize_register', 'whitelabel_sidebar_customize_register' );