<?php

function whitelabel_header_customize_register( $wp_customize ) {
	// Add the header section
	$wp_customize->add_section( 'whitelabel_header_options' , array(
		'title'      => __( 'Header', 'whitelabel' ),
		'priority'   => 30,
	) );

	// Add the setting for the header position
	$wp_customize->add_setting( 'header_position' , array(
		'default'   => 'top',
		'transport' => 'refresh',
	) );

	// Add the control for the header position
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_position', array(
		'label'      => __( 'Header Position', 'whitelabel' ),
		'section'    => 'whitelabel_header_options',
		'settings'   => 'header_position',
		'type'       => 'select',
		'choices'    => array(
			'top' => 'Top',
			'side' => 'Side',
		),
	) ) );

	// Add the setting for enabling search
	$wp_customize->add_setting( 'enable_search' , array(
		'default'   => true,
		'transport' => 'refresh',
	) );

	// Add the control for enabling search
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_search', array(
		'label'      => __( 'Enable Search', 'whitelabel' ),
		'section'    => 'whitelabel_header_options',
		'settings'   => 'enable_search',
		'type'       => 'checkbox',
	) ) );

	// Add the setting for header transparency
	$wp_customize->add_setting( 'header_transparency' , array(
		'default'   => '0',
		'transport' => 'refresh',
	) );

	// Add the control for header transparency
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_transparency', array(
		'label'      => __( 'Header Transparency', 'whitelabel' ),
		'section'    => 'whitelabel_header_options',
		'settings'   => 'header_transparency',
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
        'section'      => 'whitelabel_header_options',
        'settings'     => 'header_color',
    ) ) );

    // Add the setting for the header text color picker
    $wp_customize->add_setting( 'header_text_color' , array(
        'default'     => '#000000',
        'transport'   => 'refresh',
    ) );

    // Add the control for the header text color picker
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
        'label'        => __( 'Header Text Colour', 'whitelabel' ),
        'section'      => 'whitelabel_header_options',
        'settings'     => 'header_text_color',
    ) ) );

    // Add the setting for the sub menu color picker
    $wp_customize->add_setting( 'submenu_color' , array(
        'default'     => '#ffffff',
        'transport'   => 'refresh',
    ) );

    // Add the control for the sub menu color picker
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_color', array(
        'label'        => __( 'Submenu Colour', 'whitelabel' ),
        'section'      => 'whitelabel_header_options',
        'settings'     => 'submenu_color',
    ) ) );

    // Add the setting for the sub menu text color picker
    $wp_customize->add_setting( 'submenu_text_color' , array(
        'default'     => '#ffffff',
        'transport'   => 'refresh',
    ) );

    // Add the control for the sub menu text color picker
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_text_color', array(
        'label'        => __( 'Submenu Text Colour', 'whitelabel' ),
        'section'      => 'whitelabel_header_options',
        'settings'     => 'submenu_text_color',
    ) ) );

    // Add the setting for the sub menu text color picker
    $wp_customize->add_setting( 'hamburger_color' , array(
        'default'     => '#ffffff',
        'transport'   => 'refresh',
    ) );

    // Add the control for the hamburger color picker
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hamburger_color', array(
        'label'        => __( 'Hamburger Colour', 'whitelabel' ),
        'section'      => 'whitelabel_header_options',
        'settings'     => 'hamburger_color',
    ) ) );
}
add_action( 'customize_register', 'whitelabel_header_customize_register' );