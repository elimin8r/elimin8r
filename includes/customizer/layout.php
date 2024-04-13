<?php

/**
 * Customizer Layout
 * 
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
		$wp_customize->add_section( 'elimin8r_layout_options' , array(
			'title'      => __( 'Content', 'elimin8r' ),
			'priority'   => 30,
		) );
	
		// Add the setting for the layout position
		$wp_customize->add_setting( 'blog_layout' , array(
			'default'   => 'full',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_key',
		) );
	
		// Add the control for the layout position
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blog_layout', array(
			'label'      => __( 'Blog Layout', 'elimin8r' ),
			'section'    => 'elimin8r_layout_options',
			'settings'   => 'blog_layout',
			'type'       => 'select',
			'choices'    => array(
				'full' => 'Full',
				'compact' => 'Compact',
				'grid' => 'Grid',
			),
		) ) );
	
		// Add the setting for content transparency
		$wp_customize->add_setting( 'content_transparency' , array(
			'default'   => '0',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint',
		) );
	
		// Add the control for content transparency
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'content_transparency', array(
			'label'      => __( 'Content Transparency', 'elimin8r' ),
			'section'    => 'elimin8r_layout_options',
			'settings'   => 'content_transparency',
			'type'       => 'range',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
		) ) );
	
		// Add the setting. This will store the value of the color picker.
		$wp_customize->add_setting( 'content_color', array(
			'default'   => '#ffffff',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		// Add the color control. This will display the color picker.
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'elimin8r_color_control', array(
			'label'    => __( 'Content Area Colour', 'elimin8r' ),
			'section'  => 'elimin8r_layout_options',
			'settings' => 'content_color',
		) ) );
	
		// Add the setting for the content text color picker
		$wp_customize->add_setting( 'content_text_color', array(
			'default'   => '#000000',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		// Add the control for the content text color picker
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_text_color', array(
			'label'    => __( 'Content Area Text Colour', 'elimin8r' ),
			'section'  => 'elimin8r_layout_options',
			'settings' => 'content_text_color',
		) ) );
	
		// Add the setting for the content link color picker
		$wp_customize->add_setting( 'content_link_color', array(
			'default'   => '#000000',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		// Add the control for the content link color picker
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_link_color', array(
			'label'    => __( 'Content Area Link Colour', 'elimin8r' ),
			'section'  => 'elimin8r_layout_options',
			'settings' => 'content_link_color',
		) ) );
	}
}

new CustomizerLayout();