<?php

// Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
function whitelabel_customize_preview_js() {
	wp_enqueue_script( 'whitelabel-customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'customize-preview' ), '', true );
}
add_action( 'customize_preview_init', 'whitelabel_customize_preview_js' );

// Add postMessage support for site title and description for the Theme Customizer.
function whitelabel_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'whitelabel_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'whitelabel_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'whitelabel_customize_register' );

// Render the site title for the selective refresh partial.
function whitelabel_customize_partial_blogname() {
	bloginfo( 'name' );
}

// Render the site tagline for the selective refresh partial.
function whitelabel_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function whitelabel_header_customize_register( $wp_customize ) {
	// Add the section
	$wp_customize->add_section( 'whitelable_header_options' , array(
		'title'      => __( 'Header', 'whitelabel' ),
		'priority'   => 30,
	) );

	// Add the setting
	$wp_customize->add_setting( 'header_position' , array(
		'default'   => 'top',
		'transport' => 'refresh',
	) );

	// Add the control
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

    // Add the setting for color picker
    $wp_customize->add_setting( 'header_color' , array(
        'default'     => '#ffffff',
        'transport'   => 'refresh',
    ) );

    // Add the color control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
        'label'        => __( 'Header Color', 'whitelabel' ),
        'section'      => 'whitelable_header_options',
        'settings'     => 'header_color',
    ) ) );
}
add_action( 'customize_register', 'whitelabel_header_customize_register' );

function whitelabel_footer_customize_register( $wp_customize ) {
	// Add the section
	$wp_customize->add_section( 'whitelable_footer_options' , array(
		'title'      => __( 'Footer', 'whitelabel' ),
		'priority'   => 30,
	) );

	// Add the setting
	$wp_customize->add_setting( 'footer_text' , array(
		'default'   => '',
		'transport' => 'refresh',
	) );

	// Add the control
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_text', array(
		'label'      => __( 'Footer Text', 'whitelabel' ),
		'section'    => 'whitelable_footer_options',
		'settings'   => 'footer_text',
		'type'       => 'textarea',
	) ) );

    // Add the setting for color picker
    $wp_customize->add_setting( 'footer_color' , array(
        'default'     => '#ffffff',
        'transport'   => 'refresh',
    ) );

    // Add the color control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
        'label'        => __( 'Header Color', 'whitelabel' ),
        'section'      => 'whitelable_footer_options',
        'settings'     => 'footer_color',
    ) ) );
}
add_action( 'customize_register', 'whitelabel_footer_customize_register' );