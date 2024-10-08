<?php
if (!class_exists('EH_Stripe_Uninstall_Feedback')) :

    /**
     * Class for catch Feedback on uninstall
     */
    class EH_Stripe_Uninstall_Feedback {
        
        public function __construct() {
            
            add_action('admin_footer', array($this, 'deactivate_scripts'));
            add_action('wp_ajax_stripe_submit_uninstall_reason', array($this, "send_uninstall_reason"));
        }

        private function get_uninstall_reasons() {

            $reasons = array(
                 
                array(
                    'id' => 'upgraded-to-premium',
                    'text' => __('Upgraded to Premium.', 'payment-gateway-stripe-and-woocommerce-integration'),
                    'type' => 'reviewhtml',
                ),
                array(
                    'id' => 'no-country-support',
                    'text' => __('Doesn\'t have support in my country.', 'payment-gateway-stripe-and-woocommerce-integration'),
                    'type' => 'info',
                    'placeholder' => __('You can check the <a href="https://stripe.com/global">Stripe-supported country list</a>. Unfortunately, we cannot help if it’s not supported by Stripe.', 'payment-gateway-stripe-and-woocommerce-integration')
                ),
                array(
                    'id' => 'temporary-debug',
                    'text' => __('Temporary deactivation for debugging.', 'payment-gateway-stripe-and-woocommerce-integration'),
                ),

                array(
                    'id' => 'feature-not-found',
                    'text' => __('Couldn’t find a feature I am looking for.', 'payment-gateway-stripe-and-woocommerce-integration'),
                    'type' => 'textarea',
                    'placeholder' => __('Could you tell us about it?', 'payment-gateway-stripe-and-woocommerce-integration')
                ),
                array(
                    'id' => 'payment-method-not-found',
                    'text' => __('Doesn\'t support the payment method I am looking for.', 'payment-gateway-stripe-and-woocommerce-integration'),
                    'type' => 'text',
                    'placeholder' => __('Please name the payment method.','payment-gateway-stripe-and-woocommerce-integration')
                ),
                array(
                    'id' => 'found-better-plugin',
                    'text' => __('I found a better plugin', 'payment-gateway-stripe-and-woocommerce-integration'),
                    'type' => 'text',
                    'placeholder' => __('Could you please mention the plugin?', 'payment-gateway-stripe-and-woocommerce-integration')
                ),
               array(
                    'id' => 'unable-to-enter-card-details',
                    'text' => __('Unable to enter data in the credit card fields.', 'payment-gateway-stripe-and-woocommerce-integration'),
                    'type' => 'info',
                    'placeholder' => __('Please make sure the SSL is enabled on the site and the site is running in HTTPS.', 'payment-gateway-stripe-and-woocommerce-integration')
                ),
                array(
                    'id' => 'other',
                    'text' => __('Other', 'payment-gateway-stripe-and-woocommerce-integration'),
                    'type' => 'textarea',
                    'placeholder' => __('Could you tell us a bit more?', 'payment-gateway-stripe-and-woocommerce-integration')
                ),
            );

            return $reasons;
        }

        public function deactivate_scripts() {
             
            global $pagenow;
            if ('plugins.php' != $pagenow) {
                return;
            }
            $reasons = $this->get_uninstall_reasons();
            ?>
            <div class="ehstripe-modal" id="ehstripe-ehstripe-modal">
                <div class="ehstripe-modal-wrap">
                    <div class="ehstripe-modal-header">
                        <h3><?php _e('If you have a moment, please let us know why you are deactivating:', 'payment-gateway-stripe-and-woocommerce-integration'); ?></h3>
                    </div>
                    <div class="ehstripe-modal-body">
                        <ul class="reasons">
                            <?php foreach ($reasons as $reason) { ?>
                                <li <?php if(isset($reason['type'])){ ?> data-type="<?php echo esc_attr($reason['type']); ?>" <?php } if(isset($reason['placeholder'])) { ?> data-placeholder="<?php echo esc_attr($reason['placeholder']); ?>" <?php } ?> >
                                    <label><input type="radio" name="selected-reason" value="<?php echo $reason['id']; ?>"> <?php echo $reason['text']; ?></label>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="wt-uninstall-feedback-privacy-policy">
                            <?php _e("We do not collect any personal data when you submit this form. It's your feedback that we value.", "payment-gateway-stripe-and-woocommerce-integration"); ?>
                            <a href="https://www.webtoffee.com/privacy-policy/" target="_blank"><?php _e('Privacy Policy', 'payment-gateway-stripe-and-woocommerce-integration'); ?></a>
                        </div>
                    </div>
                    <div class="ehstripe-modal-footer">

                        <a class="button-primary" href="https://wordpress.org/support/plugin/payment-gateway-stripe-and-woocommerce-integration/#bbp_topic_title" target="_blank">
                        <span class="dashicons dashicons-external" style="margin-top:3px;"></span>
                        <?php _e('Go to support', 'payment-gateway-stripe-and-woocommerce-integration'); ?></a>
                        <button class="button-primary ehstripe-model-submit"><?php _e('Submit & Deactivate', 'payment-gateway-stripe-and-woocommerce-integration'); ?></button>
                        <button class="button-secondary ehstripe-model-cancel"><?php _e('Cancel', 'payment-gateway-stripe-and-woocommerce-integration'); ?></button>
                        <a href="#" class="dont-bother-me"><?php _e('I rather wouldn\'t say', 'payment-gateway-stripe-and-woocommerce-integration'); ?></a>
                    </div>
                </div>
            </div>

            <style type="text/css">
                .ehstripe-modal {
                    position: fixed;
                    z-index: 99999;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;
                    background: rgba(0,0,0,0.5);
                    display: none;
                }
                .ehstripe-modal.modal-active {display: block;}
                .ehstripe-modal-wrap {
                    width: 50%;
                    position: relative;
                    margin: 10% auto;
                    background: #fff;
                }
                .ehstripe-modal-header {
                    border-bottom: 1px solid #eee;
                    padding: 8px 20px;
                }
                .ehstripe-modal-header h3 {
                    line-height: 150%;
                    margin: 0;
                }
                .ehstripe-modal-body {padding: 5px 20px 20px 20px;}
                .ehstripe-modal-body .input-text,.ehstripe-modal-body textarea {width:75%;}
                .ehstripe-modal-body .reason-input {
                    margin-top: 5px;
                    margin-left: 20px;
                }
                .ehstripe-modal-footer {
                    border-top: 1px solid #eee;
                    padding: 12px 20px;
                    text-align: left;
                }
                .reviewlink, .support_link, .info-class{
                    padding:10px 0px 0px 35px !important;
                    font-size: 15px;
                }
                .review-and-deactivate, .reach-via-support{
                    padding:5px;
                }
                .wt-uninstall-feedback-privacy-policy {
                    text-align: left;
                    font-size: 12px;
                    color: #aaa;
                    line-height: 14px;
                    margin-top: 20px;
                    font-style: italic;
                }

                .wt-uninstall-feedback-privacy-policy a {
                    font-size: 11px;
                    color: #4b9cc3;
                    text-decoration-color: #99c3d7;
                }
            </style>
            <script type="text/javascript">
                (function ($) {
                    $(function () {
                        var modal = $('#ehstripe-ehstripe-modal');
                        var deactivateLink = '';
                        $('#the-list').on('click', 'a.ehstripe-deactivate-link', function (e) {
                            e.preventDefault();
                            modal.addClass('modal-active');
                            deactivateLink = $(this).attr('href');
                            modal.find('a.dont-bother-me').attr('href', deactivateLink).css('float', 'right');
                        });
                        
                        $('#ehstripe-ehstripe-modal').on('click', 'a.review-and-deactivate', function (e) {
                                e.preventDefault();
                                window.open("https://wordpress.org/support/plugin/payment-gateway-stripe-and-woocommerce-integration/reviews/?filter=5#new-post");
                                window.location.href = deactivateLink;
                            });
                        
                        modal.on('click', 'button.ehstripe-model-cancel', function (e) {
                            e.preventDefault();
                            modal.removeClass('modal-active');
                        });
                        modal.on('click', 'input[type="radio"]', function () {
                            var parent = $(this).parents('li:first');
                            modal.find('.reason-block').remove();
                            var inputType = parent.data('type'),
                                    inputPlaceholder = parent.data('placeholder');

                            if ($('.reviewlink').length) {
                                $('.reviewlink').hide();
                            }
                            if ($('.info-class').length) {
                                $('.info-class').hide();
                            }
                            if ($('.reason-input').length) {
                                $('.reason-input').hide();
                            }

                            if ('reviewhtml' === inputType) {
                                var reasonInputHtml = '<div class="reviewlink"><?php _e('Deactivate and ', 'express-checkout-paypal-payment-gateway-for-woocommerce'); ?> <a href="#" target="_blank" class="review-and-deactivate"><?php _e('leave a review', 'express-checkout-paypal-payment-gateway-for-woocommerce'); ?> <span class="xa-ehpypl-rating-link"> &#9733;&#9733;&#9733;&#9733;&#9733; </span></a></div>';
                            }
                            else if('info' === inputType){
                                var reasonInputHtml = '<div class="info-class">' + inputPlaceholder + '</div>';
                            }
                             else if('text' === inputType || 'textarea' === inputType ) {
                                    var reasonInputHtml = '<div class="reason-input reason-block">' + (('text' === inputType) ? '<input type="text" class="input-text" size="40" />' : '<textarea rows="5" cols="45"></textarea>') + '</div>';
                            }
                            if (inputType !== '') {
                                parent.append($(reasonInputHtml));
                                parent.find('input, textarea').attr('placeholder', inputPlaceholder).focus();
                            }
                        });

                        modal.on('click', 'button.ehstripe-model-submit', function (e) {
                            e.preventDefault();
                            var button = $(this);
                            if (button.hasClass('disabled')) {
                                return;
                            }
                            var $radio = $('input[type="radio"]:checked', modal);
                            var $selected_reason = $radio.parents('li:first'),
                                    $input = $selected_reason.find('textarea, input[type="text"]');
                                    $reason_info = (0 !== $input.length) ? $input.val().trim() : '';
                                    $reason_id = (0 === $radio.length) ? 'none' : $radio.val()

                            $.ajax({
                                url: ajaxurl,
                                type: 'POST',
                                data: {
                                    action: 'stripe_submit_uninstall_reason',
                                    reason_id: $reason_id,
                                    reason_info: $reason_info
                                },
                                beforeSend: function () {
                                    button.addClass('disabled');
                                    button.text('Processing...');
                                },
                                complete: function () {
                                    window.location.href = deactivateLink;
                                }
                            });
                        });
                    });
                }(jQuery));
            </script>
            <?php
        }

        public function send_uninstall_reason() {

            global $wpdb;

            if (!isset($_POST['reason_id'])) {
                wp_send_json_error();
            }

            $data = array(
                'reason_id' => sanitize_text_field($_POST['reason_id']),
                'plugin' => "ehstripe",
                'auth' => 'ehstripe_uninstall_1234#',
                'date' => gmdate("M d, Y h:i:s A"),
                'url' => '',
                'user_email' => '',
                'reason_info' => isset($_REQUEST['reason_info']) ? trim(stripslashes($_REQUEST['reason_info'])) : '',
                'software' => $_SERVER['SERVER_SOFTWARE'],
                'php_version' => phpversion(),
                'mysql_version' => $wpdb->db_version(),
                'wp_version' => get_bloginfo('version'),
                'wc_version' => (!defined('WC_VERSION')) ? '' : WC_VERSION,             
                'locale' => get_locale(),
                'languages' => implode( ",", get_available_languages() ),
                'theme' => wp_get_theme()->get('Name'),                   
                'multisite' => is_multisite() ? 'Yes' : 'No',
                'ehstripe_version' => EH_STRIPE_VERSION
            );
            // Write an action/hook here in webtoffe to recieve the data
            $resp = wp_remote_post('https://feedback.webtoffee.com/wp-json/ehstripe/v1/uninstall', array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => false,
                'body' => $data,
                'cookies' => array()
                    )
            );

            wp_send_json_success();
        }

    }
    new EH_Stripe_Uninstall_Feedback();

endif;