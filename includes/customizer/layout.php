<?php

namespace Elimin8r\Customizer;

/**
 * This class is used to add customizer settings for the layout of the
 * main content area.
 * 
 * @package elimin8r
 */

if ( defined( 'DISABLE_CUSTOMIZER' ) && DISABLE_CUSTOMIZER === true ) {
	return;
}

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
	}
}

new CustomizerLayout();