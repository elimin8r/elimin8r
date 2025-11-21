<?php

use Elimin8r\Helpers\Helpers;

/**
 * This class is used to add default customizer settings to the theme.
 * 
 * @package elimin8r
 */

if (! defined( 'DISABLE_CUSTOMIZER' ) || ! constant( 'DISABLE_CUSTOMIZER' ) ) {
	// Include all files in the /customizer directory
	foreach ( glob( __DIR__ . '/customizer/*.php' ) as $file ) {
		require_once $file;
	}
}

class Customizer {
	public function __construct()
	{
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueueCustomizerScripts' ) );
		add_action( 'wp_head', array( $this, 'addCustomizerCss' ) );
	}

	public function enqueueCustomizerScripts()
	{
		wp_enqueue_script( 'elimin8r-customizer', get_template_directory_uri() . '/includes/customizer/js/customizer-controls.js', array( 'customize-preview' ), '', true );
	}

	// Output customizer CSS
	public function addCustomizerCss()
	{
		$background_tint = get_theme_mod( 'background_tint', 'false' );
		$header_color = get_theme_mod( 'header_color', '#282839' );
		$header_text_color = get_theme_mod( 'header_text_color', '#ffffff' );
		$mobile_menu_color = get_theme_mod( 'mobile_menu_color', '#1c1c2b' );
		$mobile_menu_text_color = get_theme_mod( 'mobile_menu_text_color', '#ffffff' );
		$submenu_color = get_theme_mod( 'submenu_color', '#1c1c2b' );
		$submenu_text_color = get_theme_mod( 'submenu_text_color', '#ffffff' );
		$hamburger_color = get_theme_mod( 'hamburger_color', '#ffffff' );
		$content_link_color = get_theme_mod( 'content_link_color', '#EC0DFA' );
		$footer_color = get_theme_mod( 'footer_color', '#282839' );
		$footer_text_color = get_theme_mod( 'footer_text_color', '#ffffff' );

		$css = '
			body.custom-background {
				background-blend-mode: ' . ( $background_tint ? 'overlay' : 'initial' ) . ';
			}
			
			body .site-header {
				background-color: ' . $header_color . ';
			}
			
			body .site-description,
			body .site-title a {
				color: ' . $header_text_color . ';
			}

			body .main-navigation ul li a {
				color: ' . $submenu_text_color . ';
			}

			body .main-navigation li.page_item_has_children>a:after,
			body .main-navigation li.menu-item-has-children>a:after {
				background: ' . $header_text_color . ';
			}
			body .main-navigation li.page_item_has_children ul li a:after,
			body .main-navigation li.menu-item-has-children ul li a:after {
				background: ' . $submenu_text_color . ';
			}

			body .site-main a {
				color: ' . $content_link_color . ';
			}
			
			@media screen and (max-width: 767px) {
				body .main-navigation.toggled > div,
				body .main-navigation > div {
					background: ' . $mobile_menu_color . ';
				}
				body .main-navigation ul li a {
					color: ' . $mobile_menu_text_color . ';
				}
				body .main-navigation ul li.page_item_has_children>a:after,
				body .main-navigation ul li.menu-item-has-children>a:after {
					background: ' . $mobile_menu_text_color . ';
				}
			}
			
			@media screen and (min-width: 768px) {
				body .main-navigation ul li a {
					color: ' . $header_text_color . ';
				}
				body .site-page .main-navigation ul li ul li a {
					color: ' . $submenu_text_color . ';
				}
				body .main-navigation .children,
				body .main-navigation .sub-menu {
					background: ' . $submenu_color . ';
				}
			}

			body .main-navigation #menu-bottom,
			body .main-navigation #menu-middle,
			body .main-navigation #menu-top {
				fill: ' . $hamburger_color . ';
			}
			
			body .site-footer {
				background-color: ' . $footer_color . ';
			}
			
			body .site-footer,
			body .site-footer a {
				color: ' . $footer_text_color . ';
			}
		';

		// Output the styles
		if ( ! empty( $css ) ) {
			echo '<style>' . Helpers::minifyCss( $css ) . '</style>' . PHP_EOL;
		}
	}
}

new Customizer();