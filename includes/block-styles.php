<?php

namespace Elimin8r\BlockStyles;

/**
 * This class is used to add custom block styles to Gutenberg.
 * 
 * @package elimin8r
 */

class BlockStyles {
    public function __construct()
    {
        add_action( 'init', array( $this, 'register_block_styles' ) );
    }

    public function register_block_styles()
    {
        register_block_style(
            'core/image',
            array(
                'name'  => 'image-border',
                'label' => __( 'Border', 'elimin8r' ),
            )
        );
    }
}

new BlockStyles();