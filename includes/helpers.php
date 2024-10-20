<?php

namespace Elimin8r\Helpers;

/**
 * This class is used to add helper functions to the theme.
 * 
 * @package Elimin8r
 */

class Helpers {
    public static function getManifest()
    {
        $manifest_path = get_template_directory() . '/public/.vite/manifest.json';

        if ( ! file_exists( $manifest_path ) ) {
            return false;
        }

        $manifest_content = file_get_contents( $manifest_path );
        $manifest = json_decode( $manifest_content, true );

        return is_array( $manifest ) ? $manifest : [];
    } 

    public static function sanitizeArray( $input )
    {
        // Initialize the new array that will hold the sanitize values
        $new_input = array();
    
        // Loop through the input and sanitize each of the values
        foreach ( $input as $key => $val ) {
            $new_input[ $key ] = sanitize_text_field( $val );
        }
    
        return $new_input;
    }

    public static function minifyCss( $css )
    {
        // Remove comments
        $css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
        // Remove space after colons
        $css = str_replace( ': ', ':', $css );
        // Remove whitespace
        $css = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
        
        return $css;
    }
}