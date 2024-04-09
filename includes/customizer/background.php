<?php

function elimin8r_background_customize_register( $wp_customize ) {
    // Change the section of the background color setting
    $background_color = $wp_customize->get_control( 'background_color' );
    if ( ! empty( $background_color ) ) {
        $background_color->section = 'background_image';
    }

	// Add the setting for enabling tint
	$wp_customize->add_setting( 'background_tint' , array(
		'default'   => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'absint',
	) );

	// Add the control for enabling tint
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'background_tint', array(
		'label'      => __( 'Enable Tint', 'elimin8r' ),
		'section'    => 'background_image',
		'settings'   => 'background_tint',
		'type'       => 'checkbox',
	) ) );

    // Change the title of the background image section
    $background_image_section = $wp_customize->get_section( 'background_image' );
    if ( ! empty( $background_image_section ) ) {
        $background_image_section->title = 'Background';
    }
}
add_action( 'customize_register', 'elimin8r_background_customize_register' );