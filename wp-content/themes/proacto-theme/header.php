<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package proacto
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php $header = get_field('header_options', 'options') ?>

<body <?php  body_class(); ?> >
<?php wp_body_open(); ?>
	
<header id="header" class="header">
	<div class="container">
        <div class="header__wrap" id="header-navigation">
            <?php if(!is_front_page()): ?>
                <a href="<?= get_home_url()?>" class="header__logo">
                    <img src="<?= esc_url( $header['logo']['url'] ) ?>"
                     alt="<?= esc_attr( $header['logo']['alt'] ) ?>" class="header__logo">
                </a>
            <?php else: ?>
                <div class="header__logo">
                    <img src="<?= esc_url( $header['logo']['url'] ) ?>"
                         alt="<?= esc_attr( $header['logo']['alt'] ) ?>" class="header__logo">
                </div>
            <?php endif; ?>
            <div class="header-navigation">
                <a href="<?= $header['shop_button']['url'] ?>" class="button button-m primary mobile">
		            <?= $header['shop_button']['title'] ?>
                </a>
                <?php wp_nav_menu([
                    'menu' => 'Header',
                    'menu_class' => 'header_menu',
                    'container' => 'div',
                    'container_class' => 'header_nav'
                ]) ?>
                <div class="lang-switch-mobile mobile">
	                <?php echo do_shortcode('[wpml_language_selector_widget]') ?>
                </div>
            </div>
            <div class="header_service">
                <div class="desktop lang-switch">
                    <?php echo do_shortcode('[wpml_language_selector_widget]') ?>
                </div>
                <div class="header_buttons">
                    <a href="<?= $header['shop_button']['url'] ?>" class="button button-m primary desktop">
	                    <?= $header['shop_button']['title'] ?>
                    </a>
                    <a href="<?= wc_get_cart_url() ?>" class="button button-m primary header_cart">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 3H3.26835C3.74213 3 3.97943 3 4.17267 3.08548C4.34304 3.16084 4.48871 3.28218 4.59375 3.43604C4.71269 3.61026 4.75564 3.8429 4.84137 4.30727L7.00004 16L17.4218 16C17.875 16 18.1023 16 18.29 15.9199C18.4559 15.8492 18.5989 15.7346 18.7051 15.5889C18.8252 15.4242 18.8761 15.2037 18.9777 14.7631L18.9785 14.76L20.5477 7.95996L20.5481 7.95854C20.7023 7.29016 20.7796 6.95515 20.6947 6.69238C20.6202 6.46182 20.4635 6.26634 20.2556 6.14192C20.0184 6 19.6758 6 18.9887 6H5.5M18 21C17.4477 21 17 20.5523 17 20C17 19.4477 17.4477 19 18 19C18.5523 19 19 19.4477 19 20C19 20.5523 18.5523 21 18 21ZM8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20C9 20.5523 8.55228 21 8 21Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span id="header_cart-count">
                            <?=  WC()->cart->get_cart_contents_count(); ?>
                        </span>
                    </a>
                    <a href="<?= get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="button button-m primary header_user">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.7992 5.8C13.7992 8.45097 11.6501 10.6 8.99922 10.6C6.34825 10.6 4.19922 8.45097 4.19922 5.8C4.19922 3.14903 6.34825 1 8.99922 1C11.6501 1 13.7992 3.14903 13.7992 5.8Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 10.7773C4.58173 10.7773 1 13.5631 1 16.9995H17C17 13.5631 13.4183 10.7773 9 10.7773Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>


                    <button class="mobile button-opener burger" data-action="toggle" data-target="header-navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
	</div>
</header><!-- #masthead -->

