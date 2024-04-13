<?php

namespace Elimin8r\Enqueue;

/**
 * Enqueue scripts and styles.
 *
 * @package elimin8r
 */

class Enqueue {
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
        add_action( 'wp_head', array( $this, 'critical_css' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_scripts' ), 100 );
    }

    // Enqueue scripts and styles.
    function scripts() {
        $manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
        wp_enqueue_style( 'elimin8r-style', get_template_directory_uri() . '/dist/css/' . $manifest['style.min.css'], array(), '' );

        wp_enqueue_script( 'elimin8r-script', get_template_directory_uri() . '/dist/js/' . $manifest['script.min.js'], array(), '', true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    // Enqueue admin scripts and styles.
    function admin_scripts() {
        $manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
        wp_enqueue_style( 'elimin8r-admin-style', get_template_directory_uri() . '/dist/css/' . $manifest['admin.min.css'], array(), '' );
    }

    // Add critical CSS to the head
    function critical_css() {
        $manifest = json_decode( file_get_contents( get_template_directory_uri() . '/dist/manifest.json' ), true );
        $css = file_get_contents( get_template_directory_uri() . '/dist/css/' . $manifest['critical.min.css'] );
        echo '<style id="elimin8r-critical-style">' . $css . '</style>' . PHP_EOL;
    }

    // Dequeue scripts and styles.
    function dequeue_scripts() {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
    }
}

new Enqueue();