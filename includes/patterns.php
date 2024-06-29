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
        # Note: This does not currently remove the core block patterns from the inserter, which is a known issue -  https://github.com/WordPress/gutenberg/issues/55107
        remove_theme_support( 'core-block-patterns' );
    }
}

new Patterns();
