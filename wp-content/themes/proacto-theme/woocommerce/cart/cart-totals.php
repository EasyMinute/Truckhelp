<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<?php if(WC()->cart->get_fees()): ?>
	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <div class="cart-total subtotal">
            <p class="cart-total__title body body-m medium"><?php echo esc_html( $fee->name ); ?></p>
            <span class="cart-total__price headline body-m bold"><?php wc_cart_totals_fee_html( $fee ); ?></span>
        </div>
	<?php endforeach; ?>
<?php endif; ?>

<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
    <p class="body body-s regular">
        <?php printf( 'Всього %s товарів на суму:', WC()->cart->get_cart_contents_count()); ?>
    </p>
    <p class="headline headline-h5 heavy">
	    <?= wc_price(WC()->cart->cart_contents_total) ?>
    </p>
    <a href="<?= wc_get_checkout_url() ?>" class="button button-l primary">
        <?= __('Перейти до оплати', 'proacto') ?>
    </a>

</div>
