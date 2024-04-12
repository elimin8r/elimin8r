<?php

/**
 * Customizer Default
 * 
 * @package elimin8r
 */

class CustomizerDefault {
	public function __construct()
	{
		add_action( 'customize_preview_init', array( $this, 'enqueueCustomizerScripts' ) );
		add_action( 'customize_register', array( $this, 'registerCustomizerSettings' ) );
	}

	public function enqueueCustomizerScripts()
	{
		wp_enqueue_script( 'elimin8r-customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'customize-preview' ), '', true );
	}

	public function registerCustomizerSettings( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => array( $this, 'customizerPartialBlogname' ),
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => array( $this, 'customizePartialBlogDescription' ),
				)
			);
		}
	}

	public function customizerPartialBlogname()
	{
		bloginfo( 'name' );
	}

	public function customizePartialBlogDescription()
	{
		bloginfo( 'description' );
	}
}

$customizer_default = new CustomizerDefault();