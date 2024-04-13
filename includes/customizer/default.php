<?php

/**
 * Customizer Default
 * 
 * This class is used to add default customizer settings to the theme.
 * 
 * @package elimin8r
 */

class CustomizerDefault {
	public function __construct()
	{
		add_action( 'customize_preview_init', array( $this, 'enqueueCustomizerScripts' ) );
		add_action( 'customize_register', array( $this, 'registerCustomizerSettings' ) );
		add_action( 'wp_head', array( $this, 'elimin8r_customizer_css' ) );
	}

	public function enqueueCustomizerScripts()
	{
		wp_enqueue_script( 'elimin8r-customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'customize-preview' ), '', true );
	}

	public function registerCustomizerSettings( $wp_customize )
	{
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

	// Output customizer CSS
	public function elimin8r_customizer_css()
	{
		$background_tint = get_theme_mod( 'background_tint', 'false' );
		$content_color = get_theme_mod( 'content_color', '#ffffff' );
		$content_text_color = get_theme_mod( 'content_text_color', '#000000' );
		$content_link_color = get_theme_mod( 'content_link_color', '#4169e1' );
		$content_transparency = get_theme_mod( 'content_transparency', '0' );
		$header_color = get_theme_mod( 'header_color', '#ffffff' );
		$header_text_color = get_theme_mod( 'header_text_color', '#000000' );
		$header_transparency = get_theme_mod( 'header_transparency', '0' );
		$submenu_color = get_theme_mod( 'submenu_color', '#ffffff' );
		$submenu_text_color = get_theme_mod( 'submenu_text_color', '#000000' );
		$hamburger_color = get_theme_mod( 'hamburger_color', '#000000' );
		$footer_color = get_theme_mod( 'footer_color', '#ffffff' );
		$footer_text_color = get_theme_mod( 'footer_text_color', '#000000' );
		$footer_transparency = get_theme_mod( 'footer_transparency', '0' );

		$css = '
			body.custom-background { background-blend-mode: ' . ( $background_tint ? 'overlay' : 'initial' ) . ';}
		
			body .site-main { background-color: ' . Elimin8r\Helpers\Helpers::hex_opacity( $content_color, $content_transparency ) . '; }
			
			body .site-main,
			body .site-main h1, h1, h3, h4, h5, h6,
			body .site-main p,
			body .site-main ol,
			body .site-main ul,
			body .site-main caption,
			body .site-main td { color: ' . $content_text_color . '; }

			body .site-main a { color: ' . $content_link_color . '; }
			
			body .site-header { background-color: ' . Elimin8r\Helpers\Helpers::hex_opacity( $header_color, $header_transparency ) . '; }
			
			body .site-description { color: ' . $header_text_color . '; }

			body .main-navigation .sub-menu { background: ' . $submenu_color . '; }
			body .main-navigation ul li a { color: ' . $submenu_text_color . '; }

			body .main-navigation li.menu-item-has-children>a:after { background: ' . $header_text_color . '; }
			body .main-navigation li.menu-item-has-children ul li a:after { background: ' . $submenu_text_color . '; }
			
			@media screen and (max-width: 767px) {
				body .main-navigation .menu-main-container { background: ' . $submenu_color . '; }
				body .main-navigation li.menu-item-has-children>a:after { background: ' . $submenu_text_color . '; }
			}
			
			@media screen and (min-width: 768px) {
				body .main-navigation ul li a { color: ' . $header_text_color . '; }
				body .site-page:has(.header-top) .main-navigation ul li ul li a { color: ' . $submenu_text_color . '; }
				body:has(.header-side) .main-navigation li.menu-item-has-children ul li a:after { background: ' . $header_text_color . '; }
			}

			body .main-navigation #menu-bottom,
			body .main-navigation #menu-middle,
			body .main-navigation #menu-top { fill: ' . $hamburger_color . '; }
			
			body .site-footer { background-color: ' . Elimin8r\Helpers\Helpers::hex_opacity( $footer_color, $footer_transparency ) . '; }
			
			body .site-footer { color: ' . $footer_text_color . '; }
		';

		// Output the styles
		if ( ! empty( $css ) ) {
			echo '<style>' . Elimin8r\Helpers\Helpers::minify_css( $css ) . '</style>' . PHP_EOL;
		}
	}
}

new CustomizerDefault();