<?php

namespace Elimin8r\Customizer;

/**
 * This class is used to add customizer settings for the layout of the
 * main content area.
 * 
 * @package elimin8r
 */

class CustomizerLayout {
	public function __construct()
	{
		add_action( 'customize_register', array( $this, 'registerCustomizerSettings' ) );
	}
	
	public function registerCustomizerSettings( $wp_customize )
	{
		// Add the layout section
		$wp_customize->add_section( 'layout_options' , array(
			'title'      => __( 'Content', 'elimin8r' ),
			'priority'   => 30,
		) );
	
		// Add the setting for the layout position
		$wp_customize->add_setting( 'blog_layout' , array(
			'default'   => 'full',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_key',
		) );
		$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'blog_layout', array(
			'label'      => __( 'Blog Layout', 'elimin8r' ),
			'section'    => 'layout_options',
			'settings'   => 'blog_layout',
			'type'       => 'select',
			'choices'    => array(
				'full' => 'Full',
				'compact' => 'Compact',
				'grid' => 'Grid',
			),
		) ) );
        $wp_customize->get_setting( 'blog_layout' )->transport = 'postMessage';
        if ( isset( $wp_customize->selective_refresh ) ) {
            $wp_customize->selective_refresh->add_partial(
                'blog_layout',
                array(
                    'selector'        => '.site-main',
                )
            );
        }

		// Add the setting for the content link color picker
		$wp_customize->add_setting( 'content_link_color', array(
			'default'   => '#EC0DFA',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'content_link_color', array(
			'label'    => __( 'Content Area Link Colour', 'elimin8r' ),
			'section'  => 'layout_options',
			'settings' => 'content_link_color',
		) ) );

        // Add the setting for enabling view transitions
        $wp_customize->add_setting( 'enable_transitions' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',
        ) );
        $wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'enable_transitions', array(
            'label'      => __( 'Enable View Transitions', 'elimin8r' ),
            'section'    => 'layout_options',
            'settings'   => 'enable_transitions',
            'type'       => 'checkbox',
        ) ) );
	}
}

new CustomizerLayout();