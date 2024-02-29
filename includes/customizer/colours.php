<?php

function whitelabel_color_customize_register( $wp_customize ) {
	// Add the setting. This will store the value of the color picker.
	$wp_customize->add_setting( 'content_color', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	) );

	// Add the color control. This will display the color picker.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'whitelabel_color_control', array(
		'label'    => __( 'Content Area Colour', 'whitelabel' ),
		'section'  => 'colors',
		'settings' => 'content_color',
	) ) );

	// Add the setting for content transparency
	$wp_customize->add_setting( 'content_transparency' , array(
		'default'   => '0',
		'transport' => 'refresh',
	) );

	// Add the control for content transparency
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'content_transparency', array(
		'label'      => __( 'Content Transparency', 'whitelabel' ),
		'section'    => 'colors',
		'settings'   => 'content_transparency',
		'type'       => 'range',
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	) ) );

	// Add the setting for the content text color picker
	$wp_customize->add_setting( 'content_text_color', array(
		'default'   => '#000000',
		'transport' => 'refresh',
	) );

	// Add the control for the content text color picker
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_text_color', array(
		'label'    => __( 'Content Area Text Colour', 'whitelabel' ),
		'section'  => 'colors',
		'settings' => 'content_text_color',
	) ) );

	// Add the setting for the content link color picker
	$wp_customize->add_setting( 'content_link_color', array(
		'default'   => '#000000',
		'transport' => 'refresh',
	) );

	// Add the control for the content link color picker
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_link_color', array(
		'label'    => __( 'Content Area Link Colour', 'whitelabel' ),
		'section'  => 'colors',
		'settings' => 'content_link_color',
	) ) );
}
add_action( 'customize_register', 'whitelabel_color_customize_register' );