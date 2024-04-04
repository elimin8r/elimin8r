<?php

if ( ! defined( 'DISABLE_CUSTOMIZER' ) ) {
	// Include all files in the /customizer directory
	foreach ( glob( __DIR__ . '/customizer/*.php' ) as $file ) {
		include $file;
	}
}

// Handle customizer transparency
function lmn8r_hex_opacity( $color, $opacity ) {
	$opacity = absint( $opacity );
	if ( $opacity > 100 ) {
		$opacity = 100;
	}
	$opacity = 1 - ( $opacity / 100 );
	list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
	return "rgba({$r}, {$g}, {$b}, {$opacity})";
}

function lmn8r_minify_css($css) {
    // Remove comments
    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
    // Remove space after colons
    $css = str_replace(': ', ':', $css);
    // Remove whitespace
    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
    
	return $css;
}

// Output customizer CSS
function lmn8r_customizer_css() {
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
	
		body .site-main { background-color: ' . lmn8r_hex_opacity( $content_color, $content_transparency ) . '; }
		
		body .site-main,
		body .site-main h1, h1, h3, h4, h5, h6,
		body .site-main p,
		body .site-main ol,
		body .site-main ul,
		body .site-main caption,
		body .site-main td { color: ' . $content_text_color . '; }

		body .site-main a { color: ' . $content_link_color . '; }
		
		body .site-header { background-color: ' . lmn8r_hex_opacity( $header_color, $header_transparency ) . '; }
		
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
		
		body .site-footer { background-color: ' . lmn8r_hex_opacity( $footer_color, $footer_transparency ) . '; }
		
		body .site-footer { color: ' . $footer_text_color . '; }
	';

	// Output the styles
	if ( ! empty( $css ) ) {
		echo '<style>' . lmn8r_minify_css( $css ) . '</style>' . PHP_EOL;
	}
}
add_action( 'wp_head', 'lmn8r_customizer_css' );