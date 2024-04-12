<?php

/**
 * Disable Emojis
 *
 * @package elimin8r
 */

class EmojiDisabler {
    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'add_disable_emojis_checkbox' ) );
        if ( get_option( 'disable_emojis_checkbox' ) !== "" ) {
            add_action( 'init', array( $this, 'disable_emojis' ) );
        }
    }

    // Add Disable Emojis checkbox to Reading settings
    public function add_disable_emojis_checkbox()
    {
        add_settings_field( 'disable_emojis_checkbox', 'Disable emojis', array( $this, 'disable_emojis_checkbox_callback' ), 'reading', 'default' );
        register_setting( 'reading', 'disable_emojis_checkbox' );
    }

    // Disable Emojis checkbox callback
    public function disable_emojis_checkbox_callback()
    {
        $emojis = get_option( 'disable_emojis_checkbox' );
        echo '<input type="checkbox" name="disable_emojis_checkbox" value="1" ' . checked( 1, $emojis, false ) . ' />';
    }

    // Filter function used to remove the tinymce emoji plugin
    public function elimin8r_disable_emojis_tinymce( $plugins )
    {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }

    // Remove emoji CDN hostname from DNS prefetching hints
    public function elimin8r_disable_emojis_remove_dns_prefetch( $urls, $relation_type )
    {
        if ( 'dns-prefetch' == $relation_type ) {
            $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

            $urls = array_diff( $urls, array( $emoji_svg_url ) );
        }

        return $urls;
    }

    // Disable Emojis
    public function disable_emojis()
    {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', array( $this, 'elimin8r_disable_emojis_tinymce' ) );
        add_filter( 'wp_resource_hints', array( $this, 'elimin8r_disable_emojis_remove_dns_prefetch' ), 10, 2 );
    }
}

new EmojiDisabler();