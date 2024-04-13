<?php

if ( ! defined( 'DISABLE_CUSTOMIZER' ) ) {
	// Include all files in the /customizer directory
	foreach ( glob( __DIR__ . '/customizer/*.php' ) as $file ) {
		require_once $file;
	}
}
