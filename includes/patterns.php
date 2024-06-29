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
        add_action( 'init', array( $this, 'disableCoreBlockPatterns' ) );
        add_action( 'init', array( $this, 'removeCoreBlockPatternCategory' ) );
        add_action( 'init', array( $this, 'removeCoreBlockPatterns' ) );
    }

    // Disable core block patterns
    public function disableCoreBlockPatterns()
    {
        # Note: This does not currently remove the core block patterns from the inserter, which is a known issue -  https://github.com/WordPress/gutenberg/issues/55107
        remove_theme_support( 'core-block-patterns' );
    }

    // Remove core block patterns
    function removeCoreBlockPatterns() {
        $patterns = array(
			'query-standard-posts',
			'query-medium-posts',
			'query-small-posts',
			'query-grid-posts',
			'query-large-title-posts',
			'query-offset-posts'
        );

        foreach ( $patterns as $pattern ) {
            unregister_block_pattern( 'core/' . $pattern );
        }
    }

    // Remove core block pattern categories
    public function removeCoreBlockPatternCategory() {
        unregister_block_pattern_category( 'posts' );
    }
}

new Patterns();
