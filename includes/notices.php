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

            <h2>Thank you for choosing Elimin8r!</h2>

            <p>We hope you're enjoying Elimin8r. If you are please feel free to buy me a coffee. You contribution will support further development of Elimin8r and help with the late nights spent working on new features, when caffeine is needed.</p>

            <a href="https://buymeacoffee.com/elimin8r" target="_blank" rel="nofollow noreferrer" style="align-items:center;color:#fff;display:flex;background:linear-gradient(135deg,rgb(20,236,224) 0%,rgb(81,112,254) 50%,rgb(236,13,250) 100%);height:40px;width:140px;justify-content:center;text-decoration:none;border-radius:40px;margin:20px 0;">Buy me a coffee</a>

            <p>Stay up-to-date with the latest news and theme updates by visiting <a href="https://www.elimin8r.com" target="_blank" rel="nofollow noreferrer">elimin8r.com</a>.</p>
        </div>

        <?php 
    }
}

new Notices();
