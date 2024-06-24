<?php

namespace Elimin8r\Setup;

/**
 * Set up theme defaults and registers support for various WordPress features.
 * 
 * @package elimin8r
 */

class Setup {
    public function __construct()
    {
        add_action( 'after_setup_theme', array( $this, 'setup' ) );
        add_action( 'wp_head', array( $this, 'pingbackHeader' ) );
        $this->shims();
        add_action( 'wp_head', array( $this, 'javascriptSiteData' ) );
    }

    public function setup()
    {
        // Make theme available for translation.
        load_theme_textdomain( 'elimin8r', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Enable wide alignment
        add_theme_support( 'align-wide' );

        // Disable the theme / plugin text editor
        define( 'DISALLOW_FILE_EDIT', true );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__( 'Primary', 'elimin8r' ),
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
                'elimin8r_custom_background_args',
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

        // Add theme support for responsive embeds
        add_theme_support( "responsive-embeds" );
    }

    // Add a pingback url auto-discovery header for single posts, pages, or attachments.
    public function pingbackHeader()
    {
        if ( is_singular() && pings_open() ) {
            printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
        }
    }

    public function shims()
    {
        // Shim for sites older than 5.2.
        if ( ! function_exists( 'wp_body_open' ) ) :
            function wp_body_open() {
                do_action( 'wp_body_open' );
            }
        endif;
    }

    public function javascriptSiteData()
    {
        // Get the post type
        $post_type = get_post_type();

        // Get the URL
        $url = home_url();

        // Get the 'Blog pages show at most' option
        $posts_per_page = get_option( 'posts_per_page' );

        $script = '<script id="elimin8r-data">
            const elimin8r = {
                url: "' . esc_url( $url ) . '",
                post_type: "' . $post_type . '",
                posts_per_page: "' . $posts_per_page . '"
            };
        </script>';

        echo $script;
    }
}

new Setup();