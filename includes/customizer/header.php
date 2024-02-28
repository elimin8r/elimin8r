<?php

function whitelabel_header_customize_register( $wp_customize ) {
	// Add the header section
	$wp_customize->add_section( 'whitelable_header_options' , array(
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
		'section'    => 'whitelable_header_options',
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
		'section'    => 'whitelable_header_options',
		'settings'   => 'enable_search',
		'type'       => 'checkbox',
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
}
add_action( 'customize_register', 'whitelabel_header_customize_register' );