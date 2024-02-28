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
}
add_action( 'customize_register', 'whitelabel_color_customize_register' );