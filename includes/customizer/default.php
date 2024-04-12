<?php

/**
 * Customizer Default
 * 
 * @package elimin8r
 */

class CustomizerDefault {
	public function __construct()
	{
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	public function customize_preview_js()
	{
		wp_enqueue_script( 'elimin8r-customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'customize-preview' ), '', true );
	}

	public function customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => array( $this, 'customize_partial_blogname' ),
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => array( $this, 'customize_partial_blogdescription' ),
				)
			);
		}
	}

	public function customize_partial_blogname()
	{
		bloginfo( 'name' );
	}

	public function customize_partial_blogdescription()
	{
		bloginfo( 'description' );
	}
}

$customizer_default = new CustomizerDefault();