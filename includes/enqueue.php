<?php

namespace Elimin8r\Enqueue;

use Elimin8r\Helpers\Helpers;

/**
 * This class is used to enqueue scripts and styles.
 *
 * @package elimin8r
 */

class Enqueue {
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'adminScripts' ) );
        add_action( 'wp_head', array( $this, 'criticalCss' ) );
        // add_action( 'wp_enqueue_scripts', array( $this, 'dequeueScripts' ), 100 );
    }
    
    // Enqueue scripts and styles.
    public function scripts()
    {
        $manifest = Helpers::getManifest();

        wp_enqueue_style( 'elimin8r-style', get_template_directory_uri() . '/public/' . $manifest['resources/scss/style.scss']['file'], array(), ELIMIN8R_VERSION );

        wp_enqueue_script( 'elimin8r-script', get_template_directory_uri() . '/public/' . $manifest['resources/js/scripts.js']['file'], array(), ELIMIN8R_VERSION, true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    // Enqueue admin scripts and styles.
    public function adminScripts()
    {
        $manifest = Helpers::getManifest();

        wp_enqueue_style( 'elimin8r-admin-style', get_template_directory_uri() . '/public/' . $manifest['resources/scss/admin.scss']['file'], array(), '' );
    }

    // Add critical CSS to the head
    public function criticalCss()
    {
        $manifest = Helpers::getManifest();

        $css = file_get_contents( get_template_directory() . '/public/' . $manifest['resources/scss/critical.scss']['file'] );
        echo '<style id="elimin8r-critical-style">' . $css . '</style>' . PHP_EOL;
    }

    // Dequeue scripts and styles.
    public function dequeueScripts()
    {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
    }
}

new Enqueue();