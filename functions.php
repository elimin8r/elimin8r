<?php

// Set up theme defaults and registers support for various WordPress features.
function lmn8r_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'lmn8r', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Disable the theme / plugin text editor
	define( 'DISALLOW_FILE_EDIT', true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'lmn8r' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'lmn8r_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add theme support for WooCommerce
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'lmn8r_setup' );

// Set the content width in pixels, based on the theme's design and stylesheet.
function lmn8r_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lmn8r_content_width', 640 );
}
add_action( 'after_setup_theme', 'lmn8r_content_width', 0 );

// Register widget area.
function lmn8r_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lmn8r' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lmn8r' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'lmn8r' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'lmn8r' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lmn8r_widgets_init' );

// Enqueue scripts and styles.
function lmn8r_scripts() {
	$manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
	wp_enqueue_style( 'lmn8r-style', get_template_directory_uri() . '/dist/css/' . $manifest['style.min.css'], array(), '' );

	wp_enqueue_script( 'lmn8r-script', get_template_directory_uri() . '/dist/js/' . $manifest['script.min.js'], array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lmn8r_scripts' );

// Enqueue admin scripts and styles.
function lmn8r_admin_scripts() {
	$manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
	wp_enqueue_style( 'lmn8r-admin-style', get_template_directory_uri() . '/dist/css/' . $manifest['admin.min.css'], array(), '' );
}
add_action( 'admin_enqueue_scripts', 'lmn8r_admin_scripts' );

// Add critical CSS to the head
function lmn8r_critical_css() {
	$manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
	$css = file_get_contents( get_template_directory_uri() . '/dist/css/' . $manifest['critical.min.css'] );
	echo '<style id="lmn8r-critical-style">' . $css . '</style>' . PHP_EOL;
}
add_action( 'wp_head', 'lmn8r_critical_css' );

// Dequeue scripts and styles.
function lmn8r_dequeue_scripts() {
	wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'lmn8r_dequeue_scripts', 100 );

// Add a pingback url auto-discovery header for single posts, pages, or attachments.
function lmn8r_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'lmn8r_pingback_header' );

// Shim for sites older than 5.2.
if ( ! function_exists( 'wp_body_open' ) ) :
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

// define( 'DISABLE_CUSTOMIZER', true );

// Include all files in the /includes directory
foreach ( glob( __DIR__ . '/includes/*.php' ) as $file ) {
	include $file;
}