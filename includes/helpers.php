<?php

function sanitize_array( $input ) {
    // Initialize the new array that will hold the sanitize values
    $new_input = array();

    // Loop through the input and sanitize each of the values
    foreach ( $input as $key => $val ) {
        $new_input[ $key ] = sanitize_text_field( $val );
    }

    return $new_input;
}