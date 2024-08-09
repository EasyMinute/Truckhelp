<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$img_name = 'bacs.svg';
if ($gateway->id == 'liqpay-webplus') {
	$img_name = 'liqpay.svg';
} elseif ($gateway->id == 'stripe_cc') {
	$img_name = 'stripe.svg';
} elseif ($gateway->id == 'ppcp') {
	$img_name = 'paypal.svg';
}

$img_url = get_template_directory_uri() . '/assets/img/static/' . $img_name;
?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">

	<label class="body body-s regular" for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
        <img src="<?= $img_url ?>" alt="">
	    <input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="payment_method_input input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" <?php echo $gateway->id=='bacs' ? 'checked' : '' ?> />
        <span><?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></span>
	</label>
</li>
