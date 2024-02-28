<?php

function whitelabel_footer_customize_register( $wp_customize ) {
	// Add the footer section
	$wp_customize->add_section( 'whitelable_footer_options' , array(
		'title'      => __( 'Footer', 'whitelabel' ),
		'priority'   => 30,
	) );

	// Add the setting for the footer text
	$wp_customize->add_setting( 'footer_text' , array(
		'default'   => '',
		'transport' => 'refresh',
	) );

	// Add the control for the footer text
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_text', array(
		'label'      => __( 'Footer Text', 'whitelabel' ),
		'section'    => 'whitelable_footer_options',
		'settings'   => 'footer_text',
		'type'       => 'textarea',
	) ) );
}
add_action( 'customize_register', 'whitelabel_footer_customize_register' );