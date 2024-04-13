<?php

// Set the content width in pixels, based on the theme's design and stylesheet.
function elimin8r_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'elimin8r_content_width', 640 );
}
add_action( 'after_setup_theme', 'elimin8r_content_width', 0 );

// Enqueue scripts and styles.
function elimin8r_scripts() {
	$manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
	wp_enqueue_style( 'elimin8r-style', get_template_directory_uri() . '/dist/css/' . $manifest['style.min.css'], array(), '' );

	wp_enqueue_script( 'elimin8r-script', get_template_directory_uri() . '/dist/js/' . $manifest['script.min.js'], array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elimin8r_scripts' );

// Enqueue admin scripts and styles.
function elimin8r_admin_scripts() {
	$manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
	wp_enqueue_style( 'elimin8r-admin-style', get_template_directory_uri() . '/dist/css/' . $manifest['admin.min.css'], array(), '' );
}
add_action( 'admin_enqueue_scripts', 'elimin8r_admin_scripts' );

// Add critical CSS to the head
function elimin8r_critical_css() {
	$manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
	$css = file_get_contents( get_template_directory_uri() . '/dist/css/' . $manifest['critical.min.css'] );
	echo '<style id="elimin8r-critical-style">' . $css . '</style>' . PHP_EOL;
}
add_action( 'wp_head', 'elimin8r_critical_css' );

// Dequeue scripts and styles.
function elimin8r_dequeue_scripts() {
	wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'elimin8r_dequeue_scripts', 100 );

// Add a pingback url auto-discovery header for single posts, pages, or attachments.
function elimin8r_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'elimin8r_pingback_header' );

// Shim for sites older than 5.2.
if ( ! function_exists( 'wp_body_open' ) ) :
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

// define( 'DISABLE_CUSTOMIZER', true );

// Include all files in the /includes directory
foreach ( glob( __DIR__ . '/includes/*.php' ) as $file ) {
	require_once $file;
}