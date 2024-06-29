<?php

namespace Elimin8r\Patterns;

/**
 * This class is used to add or remove block patterns to Gutenberg.
 * 
 * @package elimin8r
 */

class Patterns {
    public function __construct()
    {
        add_action( 'init', array( $this, 'removeCoreBlockPatterns' ) );
    }

    // Remove core block patterns
    public function removeCoreBlockPatterns()
    {
        remove_theme_support( 'core-block-patterns' );
    }
}

new Patterns();
