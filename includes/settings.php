<?php

// Include all files in the /settings directory
foreach ( glob( __DIR__ . '/settings/*.php' ) as $file ) {
	require_once $file;
}