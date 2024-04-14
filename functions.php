<?php

// Get the current theme's version number
$theme = wp_get_theme();
$version = $theme->get( 'Version' );
define( 'ELIMIN8R_VERSION', $version );

// Include all files in the /includes directory
foreach ( glob( __DIR__ . '/includes/*.php' ) as $file ) {
	require_once $file;
}