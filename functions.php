<?php

// Include all files in the /includes directory
foreach ( glob( __DIR__ . '/includes/*.php' ) as $file ) {
	require_once $file;
}

// Disable customizer settings
// define( 'DISABLE_CUSTOMIZER', true );