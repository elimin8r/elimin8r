<?php

namespace Elimin8r\Customizer;

/**
 * This class is used to add customizer settings for the footer of the theme.
 * 
 * @package elimin8r
 */

if ( defined( 'DISABLE_CUSTOMIZER' ) && DISABLE_CUSTOMIZER === true ) {
	return;
}

class CustomizerFooter {
	public function __construct()
	{
		add_action( 'customize_register', array( $this, 'registerCustomizerSettings' ) );
	}

	public function registerCustomizerSettings( $wp_customize )
	{
		// Add the footer section
		$wp_customize->add_section( 'footer_options' , array(
			'title'      => __( 'Footer', 'elimin8r' ),
			'priority'   => 30,
		) );

		// Add the setting for the footer text
		$wp_customize->add_setting( 'footer_text' , array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'wp_kses_post',
		) );
		$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'footer_text', array(
			'label'      => __( 'Footer Text', 'elimin8r' ),
			'section'    => 'footer_options',
			'settings'   => 'footer_text',
			'type'       => 'textarea',
		) ) );
        $wp_customize->get_setting( 'footer_text' )->transport = 'postMessage';
        if ( isset( $wp_customize->selective_refresh ) ) {
            $wp_customize->selective_refresh->add_partial(
                'footer_text',
                array(
                    'selector'        => '.site-footer',
                )
            );
        }

		// Add the setting for the footer color picker
		$wp_customize->add_setting( 'footer_color' , array(
			'default'     => '#ffffff',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
			'label'        => __( 'Footer Colour', 'elimin8r' ),
			'section'      => 'footer_options',
			'settings'     => 'footer_color',
		) ) );

		// Add the setting for the footer text color picker
		$wp_customize->add_setting( 'footer_text_color' , array(
			'default'     => '#000',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
			'label'        => __( 'Footer Text Colour', 'elimin8r' ),
			'section'      => 'footer_options',
			'settings'     => 'footer_text_color',
		) ) );
	}
}

new CustomizerFooter();