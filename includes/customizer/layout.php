<?php

function whitelabel_layout_customize_register( $wp_customize ) {
	// Add the layout section
	$wp_customize->add_section( 'whitelable_layout_options' , array(
		'title'      => __( 'Content Layout', 'whitelabel' ),
		'priority'   => 30,
	) );

	// Add the setting for the layout position
	$wp_customize->add_setting( 'blog_layout' , array(
		'default'   => 'full',
		'transport' => 'refresh',
	) );

	// Add the control for the layout position
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blog_layout', array(
		'label'      => __( 'Blog Layout', 'whitelabel' ),
		'section'    => 'whitelable_layout_options',
		'settings'   => 'blog_layout',
		'type'       => 'select',
		'choices'    => array(
			'full' => 'Full',
			'compact' => 'Compact',
			'grid' => 'Grid',
		),
	) ) );

	// Add the setting for enabling the sidebar
	$wp_customize->add_setting( 'enable_sidebar' , array(
		'default'   => false,
		'transport' => 'refresh',
	) );

	// Add the control for enabling the sidebar
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_sidebar', array(
		'label'      => __( 'Enable Sidebar', 'whitelabel' ),
		'section'    => 'whitelable_layout_options',
		'settings'   => 'enable_sidebar',
		'type'       => 'checkbox',
	) ) );
}
add_action( 'customize_register', 'whitelabel_layout_customize_register' );