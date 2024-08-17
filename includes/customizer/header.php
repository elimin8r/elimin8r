<?php

namespace Elimin8r\Customizer;

/**
 * This class is used to add customizer settings for the header of the theme.
 * 
 * @package elimin8r
 */

class CustomizerHeader {
    public function __construct()
    {
        add_action( 'customize_register', array( $this, 'registerCustomizerSettings' ) );
    }

    public function registerCustomizerSettings( $wp_customize )
    {
        // Add the header section
        $wp_customize->add_section( 'header_options' , array(
            'title'      => __( 'Header', 'elimin8r' ),
            'priority'   => 30,
        ) );
    
        // Add the setting for the header position
        $wp_customize->add_setting( 'header_position' , array(
            'default'   => 'top',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_key',
        ) );
        $wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'header_position', array(
            'label'      => __( 'Header Position', 'elimin8r' ),
            'section'    => 'header_options',
            'settings'   => 'header_position',
            'type'       => 'select',
            'choices'    => array(
                'top' => 'Top',
                'side' => 'Side',
            ),
        ) ) );
        $wp_customize->get_setting( 'header_position' )->transport = 'postMessage';
        if ( isset( $wp_customize->selective_refresh ) ) {
            $wp_customize->selective_refresh->add_partial(
                'header_position',
                array(
                    'selector'        => '.site-search',
                )
            );
        }

        // Add the setting for the header width
        $wp_customize->add_setting( 'header_width' , array(
            'default'   => 'contained',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_key',
        ) );
        $wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'header_width', array(
            'label'      => __( 'Header Width', 'elimin8r' ),
            'section'    => 'header_options',
            'settings'   => 'header_width',
            'type'       => 'select',
            'choices'    => array(
                'full' => 'Full',
                'contained' => 'Contained',
            ),
        ) ) );
    
        // Add the setting for enabling search
        $wp_customize->add_setting( 'enable_search' , array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',
        ) );
        $wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'enable_search', array(
            'label'      => __( 'Enable Search', 'elimin8r' ),
            'section'    => 'header_options',
            'settings'   => 'enable_search',
            'type'       => 'checkbox',
        ) ) );
    
        // Add the setting for the header color picker
        $wp_customize->add_setting( 'header_color' , array(
            'default'     => '#282839',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'header_color', array(
            'label'        => __( 'Header Colour', 'elimin8r' ),
            'section'      => 'header_options',
            'settings'     => 'header_color',
        ) ) );
    
        // Add the setting for the header text color picker
        $wp_customize->add_setting( 'header_text_color' , array(
            'default'     => '#ffffff',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
            'label'        => __( 'Header Text Colour', 'elimin8r' ),
            'section'      => 'header_options',
            'settings'     => 'header_text_color',
        ) ) );
    
        // Add the setting for the sub menu color picker
        $wp_customize->add_setting( 'submenu_color' , array(
            'default'     => '#1c1c2b',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'submenu_color', array(
            'label'        => __( 'Submenu Colour', 'elimin8r' ),
            'section'      => 'header_options',
            'settings'     => 'submenu_color',
        ) ) );
    
        // Add the setting for the sub menu text color picker
        $wp_customize->add_setting( 'submenu_text_color' , array(
            'default'     => '#ffffff',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'submenu_text_color', array(
            'label'        => __( 'Submenu Text Colour', 'elimin8r' ),
            'section'      => 'header_options',
            'settings'     => 'submenu_text_color',
        ) ) );
    
        // Add the setting for the sub menu text color picker
        $wp_customize->add_setting( 'hamburger_color' , array(
            'default'     => '#ffffff',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'hamburger_color', array(
            'label'        => __( 'Hamburger Colour', 'elimin8r' ),
            'section'      => 'header_options',
            'settings'     => 'hamburger_color',
        ) ) );

        // Add the setting for the mobile menu color picker
        $wp_customize->add_setting( 'mobile_menu_color' , array(
            'default'     => '#1c1c2b',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'mobile_menu_color', array(
            'label'        => __( 'Mobile Menu Colour', 'elimin8r' ),
            'section'      => 'header_options',
            'settings'     => 'mobile_menu_color',
        ) ) );

        // Add the setting for the mobile menu text color picker
        $wp_customize->add_setting( 'mobile_menu_text_color' , array(
            'default'     => '#ffffff',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'mobile_menu_text_color', array(
            'label'        => __( 'Mobile Menu Text Colour', 'elimin8r' ),
            'section'      => 'header_options',
            'settings'     => 'mobile_menu_text_color',
        ) ) );
    }
}

new CustomizerHeader();