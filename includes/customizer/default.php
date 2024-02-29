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