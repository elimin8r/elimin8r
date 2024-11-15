<?php

namespace Elimin8r\Settings\EmojiDisabler;

/**
 * This class is used to add a setting to disable emojis.
 *
 * @package elimin8r
 */

class EmojiDisabler {
    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'addDisableEmojisCheckbox' ) );
        if ( get_option( 'disable_emojis_checkbox' ) !== "" ) {
            add_action( 'init', array( $this, 'disableEmojis' ) );
        }
    }

    // Add Disable Emojis checkbox to Reading settings
    public function addDisableEmojisCheckbox()
    {
        add_settings_field( 'disable_emojis_checkbox', 'Disable emojis', array( $this, 'disableEmojisCheckboxCallback' ), 'reading', 'default' );
        register_setting( 'reading', 'disable_emojis_checkbox' );
    }

    // Disable Emojis checkbox callback
    public function disableEmojisCheckboxCallback()
    {
        $emojis = get_option( 'disable_emojis_checkbox' );
        echo '<input type="checkbox" name="disable_emojis_checkbox" value="1" ' . checked( 1, $emojis, false ) . ' />';
    }

    // Filter function used to remove the tinymce emoji plugin
    public function elimin8rDisableEmojisTinymce( $plugins )
    {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }

    // Remove emoji CDN hostname from DNS prefetching hints
    public function disableEmojisRemoveDnsPrefetch( $urls, $relation_type )
    {
        if ( 'dns-prefetch' == $relation_type ) {
            $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

            $urls = array_diff( $urls, array( $emoji_svg_url ) );
        }

        return $urls;
    }

    // Disable Emojis
    public function disableEmojis()
    {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', array( $this, 'elimin8rDisableEmojisTinymce' ) );
        add_filter( 'wp_resource_hints', array( $this, 'disableEmojisRemoveDnsPrefetch' ), 10, 2 );
    }
}

new EmojiDisabler();