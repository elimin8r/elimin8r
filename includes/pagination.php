<?php

function elimin8r_pagination() {
    if ( get_option( 'enable_infinite_scroll_checkbox' ) !== '' ) {
        // Add button to load next page
        echo '<button id="load-more">Load more</button>';
    } else {
        global $wp_query;
    
        $big = 999999999; // need an unlikely integer
    
        echo '<div class="pagination">' . paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages
        ) ) . '</div>';
    }
}