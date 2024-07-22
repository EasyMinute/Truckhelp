<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="pr-checkout">
    <div class="container">

        <div class="pr-checkout__head">
            <h1 class="headline headline-h3 bold">
                <?= __('Оформлення замовлення') ?>
            </h1>
        </div>

        <?php
        do_action( 'woocommerce_before_checkout_form', $checkout );

        // If checkout registration is disabled and not logged in, the user cannot checkout.
        if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
            echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
            return;
        }

        ?>


        <form name="checkout" method="post" class="pr-checkout__main checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

            <?php if ( $checkout->get_checkout_fields() ) : ?>

                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <div class="pr-checkout__fields" >
                    <div class="pr-checkout__fields-contact" id="customer_details">
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>

                    <div class="pr-checkout__fields-payment">
                        <?php do_action( 'proacto_checkout_payments' ); ?>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>

            <div class="pr-checkout__order">

                <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

                <div class="pr-checkout__order-head">
                    <h3 class= "order_review_heading body body-xxl bold" id="order_review_heading">
                        <?= __('Замовлення', 'proacto') ?>
                    </h3>
                    <a href="<?= wc_get_cart_url() ?>" class="checkout-back-cart">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.66672 13.9998H13.6665M12.8246 2.60927L13.3906 3.17527C13.9113 3.69597 13.9113 4.54019 13.3906 5.06089L5.90001 12.5514C5.75365 12.6978 5.57521 12.8081 5.37884 12.8735L2.63248 13.789C2.3719 13.8758 2.12398 13.6279 2.21085 13.3673L3.1263 10.621C3.19176 10.4246 3.30204 10.2462 3.4484 10.0998L10.939 2.60927C11.4597 2.08857 12.3039 2.08858 12.8246 2.60927Z" stroke="#D3D0D0" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="body body-xs regular">
                            <?= __('Редагувати', 'proacto') ?>
                        </span>
                    </a>
                </div>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

            </div>

        </form>

        <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
    </div>
</section>