<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$product_categories = get_terms( 'product_cat', array( 'hide_empty' => false ) );
$product_tags = get_terms( 'product_tag', array( 'hide_empty' => false ) );
?>
<section class="products-grid">
    <div class="container">
        <div class="products-grid__wrap">
            <div class="products-grid__filter">
                <div class="products-grid__filter-block">
                    <h3 class="title body body-xl bold">
                        <?= __('Категорія', 'proacto')?>
                    </h3>
                    <?php
                    foreach( $product_categories as $category ) {
                        echo '<label class="body body-m regular"><input type="checkbox" class="filter-checkbox" data-type="category" value="' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . '</label><br>';
                    }
                    ?>
                </div>
                <div class="products-grid__filter-block">
                    <h3 class="title body body-xl bold">
                        <?= __('Марка авто', 'proacto')?>
                    </h3>
                    <?php
                    foreach( $product_tags as $tag ) {
                        echo '<label class="body body-m regular"><input type="checkbox" class="filter-checkbox" data-type="tag" value="' . esc_attr( $tag->slug ) . '">' . esc_html( $tag->name ) . '</label><br>';
                    }
                    ?>
                </div>
                <a class="text-button" href="<?= get_permalink( wc_get_page_id( 'shop' ) ) ?>">
                    <?= __('Скинути всі параметри', 'proacto') ?>
                </a>
            </div>

            <ul class="products products-grid__grid">
