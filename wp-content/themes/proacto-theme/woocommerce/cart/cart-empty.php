<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="cart-empty">
    <div class="container">
        <div class="cart-empty__head">
            <h1 class="headline headline-h3 bold">
                <?= __('Кошик', 'proacto') ?>
            </h1>
        </div>
        <div class="cart-empty__main">
            <p class="body body-xxl medium title">
	            <?= __('Ваш кошик порожній', 'proacto') ?>
            </p>
            <p class="body body-s regular message">
		        <?= __('Продовжіть покупки або огляньте інші розділи сайту', 'proacto') ?>
            </p>
            <?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
                <div class="cart-empty__buttons">
                    <a class="button button-l primary" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
	                    <?= __('Онлайн-магазин', 'proacto') ?>
                    </a>
                    <a class="button button-l secondary" href="<?= get_home_url() ?>">
		                <?= __('На головну', 'proacto') ?>
                    </a>
                </div>
        <?php endif; ?>
        </div>
    </div>
</section>
