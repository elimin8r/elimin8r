<?php

namespace Elimin8r\Customizer;

/**
 * This class is used to add customizer settings for the sidebar of the theme.
 * 
 * @package elimin8r
 */

if ( defined( 'DISABLE_CUSTOMIZER' ) && DISABLE_CUSTOMIZER === true ) {
	return;
}

class CustomizerSidebar {
	public function __construct()
	{
		add_action( 'customize_register', array( $this, 'registerCustomizerSettings' ) );
	}

	public function registerCustomizerSettings( $wp_customize )
	{
		// Add the sidebar section
		$wp_customize->add_section( 'sidebar_options' , array(
			'title'      => __( 'Sidebars', 'elimin8r' ),
			'description' => 'Select which sidebar to display on each post type.',
			'priority'   => 30,
		) );

		// Get all post types
		$post_types = get_post_types( array( 'public' => true ), 'objects' );
		unset( $post_types['attachment'] );
		$choices = array();
		$choices[''] = 'Select a sidebar';

		// Get all registered sidebars
		global $wp_registered_sidebars;

		foreach( $wp_registered_sidebars as $sidebar ) {
			$choices[$sidebar['id']] = $sidebar['name'];
		}

		foreach( $post_types as $post_type ) {
			if ( $post_type->name == 'footer-1' ) {
				continue;
			}

			// Add the setting for the sidebar text
			$wp_customize->add_setting( 'sidebar_post_types_' . $post_type->name , array(
				'default'   => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_key',
			) );
			$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'sidebar_post_types_' . $post_type->name, array(
				'label'      => sprintf( __( '%s', 'elimin8r' ), $post_type->label ),
				'section'    => 'sidebar_options',
				'settings'   => sprintf( 'sidebar_post_types_%s', $post_type->name ),
				'type'       => 'select',
				'choices'    => $choices,
			) ) );
		}
	}
}

new CustomizerSidebar();