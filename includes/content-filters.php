<?php

// Add link to end of excerpt
function whitelabel_excerpt_more( $more ) {
    return ' <a href="' . get_permalink() . '">' . __('Continue reading', 'whitelabel') . '</a>';
}
add_filter('excerpt_more', 'whitelabel_excerpt_more');