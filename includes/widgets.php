<?php

namespace Elimin8r\Widgets;

/**
 * This class is used to add widget functionality to the theme.
 *
 * @package elimin8r
 */

class Widgets {
    public function __construct()
    {
        add_action( 'widgets_init', array( $this, 'widgetsInit' ) );
    }

    // Register widget area.
    public function widgetsInit()
    {
        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'elimin8r' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Add widgets here.', 'elimin8r' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }
}

new Widgets();