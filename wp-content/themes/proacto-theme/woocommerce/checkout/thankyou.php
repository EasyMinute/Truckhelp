<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="success-order">
    <div class="container">
        <div class="success-order__wrap">
            <img class="success-order__image" src="<?= get_template_directory_uri() . '/assets/img/static/Success_Illustration.svg' ?>"
                 alt="<?= __( 'Succsess illustration', 'proacto' ) ?>">
            <p class="title headline headline-h3 bold">
				<?= __('Дякуємо за замовлення!', 'proacto') ?>
            </p>
            <p class="text body body-s regular">
				<?= __('Наші фахівці зв’яжуться з вами найближчим часом.', 'proacto') ?>
            </p>
            <a href="<?= get_home_url() ?>" class="button button-l primary">
				<?= __('Повернутись на головну', 'proacto') ?>
            </a>
        </div>
    </div>
</section>
