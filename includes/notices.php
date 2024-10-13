<?php

namespace Elimin8r\Notices;

/**
 * This class is used to add admin notices to the dashboard.
 * 
 * @package elimin8r
 */

class Notices {
    public $user_id;

    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'noticeDismissed' ) );
        add_action( 'admin_notices', array( $this, 'addNotice' ) );
        add_action( 'admin_head', array( $this, 'noticeStyles' ) );
    }

    // Dismiss notice
    function noticeDismissed()
    {
        $this->user_id = get_current_user_id();

        if ( isset( $_GET['elimin8r-notice-dismissed'] ) ) {
            add_user_meta( $this->user_id, 'noticeDismissed', 'true', true );
        }
    }

    // Add admin notice
    public function addNotice()
    {
        // Don't show notice if dismissed
        if ( get_user_meta( $this->user_id, 'noticeDismissed' ) ) {
            return;
        }

        // Get the elimin8r logo from the theme directory
        $logo = get_template_directory_uri() . '/public/images/elimin8r-logo.svg';

        // Check if logo exists
        if ( ! file_exists( get_template_directory() . '/public/images/elimin8r-logo.svg' ) ) {
            $logo = false;
        }

        ?>
        
        <div class="notice notice-info">
            <?php if ( $logo ): ?>
                <img src="<?php echo esc_url( $logo ); ?>" alt="Elimin8r Logo">
            <?php endif; ?>

            <h2>Thank you for choosing Elimin8r!</h2>

            <p>I hope you're enjoying the Elimin8r starter theme. If you are, please feel free to buy me a coffee to help support the theme's development.</p>

            <p>Don't forget to visit <a href="https://www.elimin8r.com" target="_blank" rel="nofollow noreferrer">elimin8r.com</a> to stay up-to-date with the latest news and theme updates.</p>
            
            <a href="https://buymeacoffee.com/elimin8r" target="_blank" rel="nofollow noreferrer" class="notice-button">Buy me a coffee</a>

            <a href="?elimin8r-notice-dismissed" class="notice-close">Don't show me again</a>
        </div>

        <?php 
    }

    public function noticeStyles()
    {
        ?>
        <style>
            .notice-info {
                position: relative;
            }

            .notice-info img {
                height: auto;
                margin-top: 10px;
                max-width: 200px;
            }

            .notice-button {
                align-items: center;
                background: linear-gradient(135deg,rgb(20,236,224) 0%,rgb(81,112,254) 50%,rgb(236,13,250) 100%);
                border-radius: 40px;
                color: #fff;
                display: flex;
                height: 40px;
                justify-content: center;
                margin: 20px 0 12px 0;
                position: relative;
                text-decoration: none;
                width: 140px;
                z-index: 20;
            }

            .notice-button:hover,
            .notice-button:focus,
            .notice-button:active {
                color: #fff;
            }

            .notice-close {
                bottom: 15px;
                position: absolute;
                right: 15px;
            }
        </style>
        <?php
    }
}

new Notices();
