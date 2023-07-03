<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class asheUpdateToProNotice {
    private $compare_date;

    public function __construct() {
        global $pagenow;
        $this->compare_date = (int) strtotime('now');

        if ( current_user_can('administrator') ) {
            if ( empty(get_option('ashe_update_to_pro_dismiss_notice', false)) ) {
                add_action( 'admin_init', [$this, 'check_theme_install_time'] );
            }
        }

        if ( is_admin() ) {
            add_action( 'admin_head', [$this, 'enqueue_scripts' ] );
        }

        add_action( 'wp_ajax_ashe_update_to_pro_dismiss_notice', [$this, 'ashe_update_to_pro_dismiss_notice'] );
        add_action( 'wp_ajax_ashe_update_to_pro_maybe_later', [$this, 'ashe_update_to_pro_maybe_later'] );
    }

    public function check_theme_install_time() {   
        $install_date = (int) get_option('ashe_activation_time_update_to_pro');

        if ( get_option('ashe_update_to_pro_maybe_later_time') != false && !(($this->compare_date - $install_date) >= 172800) ) {
            return;
        }

        add_action( 'admin_notices', [$this, 'render_update_to_pro_notice' ]);

        if ( get_option('ashe_update_to_pro_maybe_later_time') != false && (($this->compare_date - $install_date) >= 172800) ) {
            delete_option('ashe_update_to_pro_maybe_later_time');
        }
    }
    
    public function ashe_update_to_pro_dismiss_notice() {
        update_option( 'ashe_update_to_pro_dismiss_notice', true );
    }

    public function ashe_update_to_pro_maybe_later() {
        update_option('ashe_update_to_pro_maybe_later_time', true);
        delete_option('ashe_activation_time_update_to_pro');
    }

    public function render_update_to_pro_notice() {
        global $pagenow;

        if ( is_admin() ) {

            echo '<div class="notice ashe-update-to-pro-notice is-dismissible" style="border-left-color: #0073aa!important; display: flex; align-items: center;">
                        <div class="ashe-update-to-pro-notice-logo">
                        <img class="ashe-logo" src="'.get_theme_file_uri().'/assets/images/ashe-blog.png">
                        </div>
                        <div>
                            <h3>Important Information!</a></h3>
                            <p>
                                Dear Ashe Theme users, our website <strong>wp-royal-themes.com</strong> is currently not available, we are migrating our servers to much better and faster infrastructure and this might take a few days. During this period if you will need support you can post your questions <a target="_blank" href="https://wordpress.org/support/theme/ashe/"><strong>here</strong></a>, or if you are a PRO user you can contact us via this email <strong>info.wproyal@gmail.com</strong>.
                            </p>
                            <p>
                                If you are interested to <strong>Upgrade to the Ashe PRO</strong> version just follow the button below. After purchasing you will get the Ashe PRO theme and License key via your email.
                                <br>
                                Thanks for Understanding.
                            </p>

                            <p>
                                <a href="https://checkout.freemius.com/mode/dialog/theme/1802/plan/2643/" target="_blank" class="ashe-you-deserve-it button button-primary">Upgrade to Pro</a>
                                <a class="ashe-maybe-later"><span class="dashicons dashicons-clock"></span> Remind Me In 2 Days</a>
                                <a class="ashe-notice-dismiss-2"></a>
                            </p>
                        </div>
                </div>';
        }
    }

    public function enqueue_scripts() { 
        echo "
        <script>
        jQuery( document ).ready( function() {

            jQuery(document).on( 'click', '.ashe-notice-dismiss-2', function() {
                jQuery(document).find('.ashe-update-to-pro-notice').slideUp();
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'ashe_update_to_pro_dismiss_notice',
                    }
                })
            });
        });

        jQuery(document).on( 'click', '.ashe-maybe-later', function() {
            jQuery(document).find('.ashe-update-to-pro-notice').slideUp();
            jQuery.post({
                url: ajaxurl,
                data: {
                    action: 'ashe_update_to_pro_maybe_later',
                }
            })
        });
        </script>

        <style>
            .ashe-update-to-pro-notice {
              padding: 0 15px;
            }

            .ashe-update-to-pro-notice-logo {
                margin-right: 20px;
            }

            .ashe-update-to-pro-notice-logo img {
                max-width: 100%;
            }

            .ashe-update-to-pro-notice h3 {
              margin-bottom: 10px;
            }

            ashe-update-to-pro-notice h3 a {
                text-decoration: none;
            }

            .ashe-update-to-pro-notice p {
              margin-top: 3px;
              margin-bottom: 10px;
            }

            .ashe-update-to-pro-notice .ashe-notice-dismiss-2:before {
                content: '\\f153';
                background: 0 0;
                color: #787c82;
                display: block;
                font: normal 16px/20px dashicons;
                speak: never;
                text-align: center;
                height: 20px;
                width: 20px;
            }

            .ashe-update-to-pro-notice {
                position: relative;
            }

            .ashe-update-to-pro-notice .ashe-notice-dismiss-2 {
                position: absolute;
                top: 0;
                right: 0;
                padding: 9px;
            }

            .ashe-already-rated,
            .ashe-need-support,
            .ashe-notice-dismiss-2,
            .ashe-maybe-later {
              text-decoration: none;
              margin-left: 12px;
              font-size: 14px;
              cursor: pointer;
            }

            .ashe-already-rated .dashicons,
            .ashe-need-support .dashicons,
            .ashe-maybe-later .dashicons {
              vertical-align: sub;
            }

            .ashe-notice-dismiss-2 .dashicons {
              vertical-align: middle;
            }

            .ashe-update-to-pro-notice .notice-dismiss {
                display: none;
            }

        </style>
        ";
    }
}

if ( 'Ashe' === wp_get_theme()->get('Name')) {
    new asheUpdateToProNotice();
}