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
$uncategorized_term_id = get_option( 'default_product_cat' );

$product_categories = get_terms( 'product_cat', array(
        'hide_empty' => false,
        'exclude' => $uncategorized_term_id
    )
);
$product_tags = get_terms( 'product_tag', array( 'hide_empty' => false ) );

$current_cats = isset($_GET['prt_cat']) ? (array) $_GET['prt_cat'] : array();
$current_tags = isset($_GET['prt_tag']) ? (array) $_GET['prt_tag'] : array();

?>
<section class="products-grid">
    <div class="container">
        <div class="products-grid__wrap">
            <button class="mobile button button-m primary button-opener" data-target="pr-products-filter">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.0001 7L5.0001 7.00002M16.5001 12L7.50009 12M13.5001 17H10.5001" stroke="white" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <?= __('Фільтрувати', 'proacto') ?>
            </button>
            <form id="pr-products-filter" class="products-grid__filter" method="GET">
                <input type="hidden" name="paged" value="1">
                <button class="close button-opener" data-action="remove" data-target="pr-products-filter"></button>
                <div class="products-grid__filter-block">
                    <h3 class="title body body-xl bold">
                        <?= __('Категорія', 'proacto')?>
                    </h3>
                    <?php foreach( $product_categories as $category ) { ?>
                        <label class="body body-m regular">
                            <input class="filter-checkbox" type="checkbox" name="prt_cat[]" value="<?php echo esc_attr($category->slug); ?>" <?php checked(in_array($category->slug, $current_cats)); ?>>
                            <?php echo esc_html( $category->name ) ?>
                        </label><br>
                    <?php } ?>
                </div>
                <div class="products-grid__filter-block">
                    <h3 class="title body body-xl bold">
                        <?= __('Марка авто', 'proacto')?>
                    </h3>
                    <?php
                    foreach( $product_tags as $tag ) { ?>
                        <label class="body body-m regular">
                            <input class="filter-checkbox" type="checkbox" name="prt_tag[]" value="<?php echo esc_attr($tag->slug); ?>" <?php checked(in_array($tag->slug, $current_tags)); ?>>
		                    <?php echo esc_html( $tag->name ) ?>
                        </label><br>
                    <?php } ?>
                </div>
                <button class="button button-m primary" type="submit">
                    <?= __('Застосувати', 'proacto') ?>
                </button>
                <a class="text-button" href="<?= get_permalink( wc_get_page_id( 'shop' ) ) ?>">
                    <?= __('Скинути всі параметри', 'proacto') ?>
                </a>
            </form>

            <ul class="products products-grid__grid">
