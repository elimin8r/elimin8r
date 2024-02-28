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

    // Add the setting for the header color picker
    $wp_customize->add_setting( 'header_color' , array(
        'default'     => '#ffffff',
        'transport'   => 'refresh',
    ) );

    // Add the control for the header color picker
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
        'label'        => __( 'Header Colour', 'whitelabel' ),
        'section'      => 'colors',
        'settings'     => 'header_color',
    ) ) );
	
	// Add the setting for header transparency
	$wp_customize->add_setting( 'header_transparency' , array(
		'default'   => '0',
		'transport' => 'refresh',
	) );

	// Add the control for header transparency
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_transparency', array(
		'label'      => __( 'Header Transparency', 'whitelabel' ),
		'section'    => 'colors',
		'settings'   => 'header_transparency',
		'type'       => 'range',
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	) ) );

    // Add the setting for the footer color picker
    $wp_customize->add_setting( 'footer_color' , array(
        'default'     => '#ffffff',
        'transport'   => 'refresh',
    ) );

    // Add the control for the footer color picker
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
        'label'        => __( 'Footer Colour', 'whitelabel' ),
        'section'      => 'colors',
        'settings'     => 'footer_color',
    ) ) );

	// Add the setting for footer transparency
	$wp_customize->add_setting( 'footer_transparency' , array(
		'default'   => '0',
		'transport' => 'refresh',
	) );

	// Add the control for footer transparency
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_transparency', array(
		'label'      => __( 'Footer Transparency', 'whitelabel' ),
		'section'    => 'colors',
		'settings'   => 'footer_transparency',
		'type'       => 'range',
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	) ) );
}
add_action( 'customize_register', 'whitelabel_color_customize_register' );