<?php

namespace Elimin8r\Notices;

/**
 * This class is used to add admin notices to the dashboard.
 * 
 * @package elimin8r
 */

class Notices {
    public function __construct()
    {
        add_action( 'admin_notices', array( $this, 'addNotice' ) );
    }

    // Add admin notice
    public function addNotice()
    {
        // Get the elimin8r logo from the theme directory
        $logo = get_template_directory_uri() . '/dist/images/elimin8r-logo.svg';

        // Check if logo exists
        if ( ! file_exists( get_template_directory() . '/dist/images/elimin8r-logo.svg' ) ) {
            $logo = false;
        }

        ?>
        
        <div class="notice notice-info is-dismissible">
            <?php if ( $logo ): ?>
                <img src="<?php echo esc_url( $logo ); ?>" alt="Elimin8r Logo" style="max-width:200px;height:auto;margin-top:10px;">
            <?php endif; ?>

            <h2>Thank you for choosing the <span style="color:#ec0dfa;">Elimin8r free WordPress theme!</span></h2>

            <p>Stay up-to-date with the latest news and theme updates by visiting <a href="https://www.elimin8r.com" target="_blank" rel="nofollow noreferrer">elimin8r.com</a>.</p>
        </div>

        <?php 
    }
}

new Notices();
