<?php

// Include all files in the /customizer directory
foreach ( glob( __DIR__ . '/customizer/*.php' ) as $file ) {
	include $file;
}

// Handle customizer transparency
function whitelabel_hex_opacity( $color, $opacity ) {
	$opacity = absint( $opacity );
	if ( $opacity > 100 ) {
		$opacity = 100;
	}
	$opacity = 1 - ( $opacity / 100 );
	list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
	return "rgba({$r}, {$g}, {$b}, {$opacity})";
}

// Output customizer CSS
function whitelabel_customizer_css() {
	$content_color = get_theme_mod( 'content_color', '#ffffff' );
	$content_transparency = get_theme_mod( 'content_transparency', '0' );
	$header_color = get_theme_mod( 'header_color', '#ffffff' );
	$header_transparency = get_theme_mod( 'header_transparency', '0' );
	$footer_color = get_theme_mod( 'footer_color', '#ffffff' );
	$footer_transparency = get_theme_mod( 'footer_transparency', '0' );

	$css = '';

	// Content
	$css .= 'body .site-main { background-color: ' . whitelabel_hex_opacity( $content_color, $content_transparency ) . '; }';

	// Header
	$css .= 'body .site-header { background-color: ' . whitelabel_hex_opacity( $header_color, $header_transparency ) . '; }';

	// Footer
	$css .= 'body .site-footer { background-color: ' . whitelabel_hex_opacity( $footer_color, $footer_transparency ) . '; }';

	// Output the styles
	if ( ! empty( $css ) ) {
		echo '<style>' . $css . '</style>';
	}
}
add_action( 'wp_head', 'whitelabel_customizer_css' );