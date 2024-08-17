<?php

namespace Elimin8r\Customizer;

/**
 * This class is used to add customizer settings for the designs.
 * 
 * @package elimin8r
 */

class CustomizerDesigns {
	public function __construct()
	{
		add_action( 'customize_register', array( $this, 'registerCustomizerSettings' ) );
	}
	
	public function registerCustomizerSettings( $wp_customize )
	{
		// Add the design section
		$wp_customize->add_section( 'design_options' , array(
			'title'      => __( 'Designs', 'elimin8r' ),
			'priority'   => 30,
		) );
	
		// Add the setting for the design choices
		$wp_customize->add_setting( 'designs' , array(
			'default'   => 'modern',
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

        // Add the setting for enabling view transitions
        $wp_customize->add_setting( 'enable_transitions' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',
        ) );
        $wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'enable_transitions', array(
            'label'      => __( 'Enable View Transitions', 'elimin8r' ),
            'section'    => 'design_options',
            'settings'   => 'enable_transitions',
            'type'       => 'checkbox',
        ) ) );
	}
}

new CustomizerDesigns();