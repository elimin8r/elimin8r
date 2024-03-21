<?php

// Include all files in the /tools directory
foreach ( glob( __DIR__ . '/tools/*.php' ) as $file ) {
	include $file;
}