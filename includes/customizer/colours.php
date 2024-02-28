<?php

function whitelabel_color_customize_register( $wp_customize ) {
	// Add the setting. This will store the value of the color picker.
	$wp_customize->add_setting( 'content_color', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	) );

	// Add the color control. This will display the color picker.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'whitelabel_color_control', array(
		'label'    => __( 'Content Background Colour', 'whitelabel' ),
		'section'  => 'colors',
		'settings' => 'content_color',
	) ) );
}
add_action( 'customize_register', 'whitelabel_color_customize_register' );