<?php

namespace Elimin8r\Customizer;

if ( DISABLE_CUSTOMIZER !== true ) {
	// Include all files in the /customizer directory
	foreach ( glob( __DIR__ . '/customizer/*.php' ) as $file ) {
		require_once $file;
	}
}
