<?php

function elimin8r_layout_customize_register( $wp_customize ) {
	// Add the layout section
	$wp_customize->add_section( 'elimin8r_layout_options' , array(
		'title'      => __( 'Content', 'elimin8r' ),
		'priority'   => 30,
	) );

	// Add the setting for the layout position
	$wp_customize->add_setting( 'blog_layout' , array(
		'default'   => 'full',
		'transport' => 'refresh',
	) );

	// Add the control for the layout position
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blog_layout', array(
		'label'      => __( 'Blog Layout', 'elimin8r' ),
		'section'    => 'elimin8r_layout_options',
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
		'label'      => __( 'Enable Sidebar', 'elimin8r' ),
		'section'    => 'elimin8r_layout_options',
		'settings'   => 'enable_sidebar',
		'type'       => 'checkbox',
	) ) );

	// Add the setting for content transparency
	$wp_customize->add_setting( 'content_transparency' , array(
		'default'   => '0',
		'transport' => 'refresh',
	) );

	// Add the control for content transparency
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'content_transparency', array(
		'label'      => __( 'Content Transparency', 'elimin8r' ),
		'section'    => 'elimin8r_layout_options',
		'settings'   => 'content_transparency',
		'type'       => 'range',
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	) ) );

	// Add the setting. This will store the value of the color picker.
	$wp_customize->add_setting( 'content_color', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	) );

	// Add the color control. This will display the color picker.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elimin8r_color_control', array(
		'label'    => __( 'Content Area Colour', 'elimin8r' ),
		'section'  => 'elimin8r_layout_options',
		'settings' => 'content_color',
	) ) );

	// Add the setting for the content text color picker
	$wp_customize->add_setting( 'content_text_color', array(
		'default'   => '#000000',
		'transport' => 'refresh',
	) );

	// Add the control for the content text color picker
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_text_color', array(
		'label'    => __( 'Content Area Text Colour', 'elimin8r' ),
		'section'  => 'elimin8r_layout_options',
		'settings' => 'content_text_color',
	) ) );

	// Add the setting for the content link color picker
	$wp_customize->add_setting( 'content_link_color', array(
		'default'   => '#000000',
		'transport' => 'refresh',
	) );

	// Add the control for the content link color picker
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_link_color', array(
		'label'    => __( 'Content Area Link Colour', 'elimin8r' ),
		'section'  => 'elimin8r_layout_options',
		'settings' => 'content_link_color',
	) ) );
}
add_action( 'customize_register', 'elimin8r_layout_customize_register' );