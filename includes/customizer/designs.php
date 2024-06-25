<?php

namespace Elimin8r\Customizer;

/**
 * This class is used to add customizer settings for the designs.
 * 
 * @package elimin8r
 */

if ( defined( 'DISABLE_CUSTOMIZER' ) && DISABLE_CUSTOMIZER === true ) {
	return;
}

class CustomizerDesigns {
	public function __construct()
	{
		add_action( 'customize_register', array( $this, 'registerCustomizerSettings' ) );
	}
	
	public function registerCustomizerSettings( $wp_customize )
	{
		// Add the layout section
		$wp_customize->add_section( 'design_options' , array(
			'title'      => __( 'Designs', 'elimin8r' ),
			'priority'   => 30,
		) );
	
		// Add the setting for the layout position
		$wp_customize->add_setting( 'designs' , array(
			'default'   => 'none',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_key',
		) );
		$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'designs', array(
			'label'      => __( 'Designs', 'elimin8r' ),
			'section'    => 'design_options',
			'settings'   => 'designs',
			'type'       => 'select',
			'choices'    => array(
				'none' => 'None',
				'modern' => 'Modern',
			),
		) ) );
	}
}

new CustomizerDesigns();