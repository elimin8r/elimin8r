<?php

// Include all files in the /customizer directory
foreach ( glob( __DIR__ . '/customizer/*.php' ) as $file ) {
	include $file;
}