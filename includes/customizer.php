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
	$opacity = 1 - ($opacity / 100);
	list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
	return "rgba({$r}, {$g}, {$b}, {$opacity})";
}