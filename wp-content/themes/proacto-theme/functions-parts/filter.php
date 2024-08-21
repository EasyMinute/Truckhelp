<?php
function filter_woocommerce_products_by_taxonomies($query) {
	if (!is_admin() && $query->is_main_query() && is_post_type_archive('product')) {
		$tax_query = array();

		// Handle product categories
		if (isset($_GET['prt_cat'])) {
			$product_cats = (array) $_GET['prt_cat']; // Ensure it's an array

			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => array_map('sanitize_text_field', $product_cats),
			);
		}

		// Handle product tags
		if (isset($_GET['prt_tag'])) {
			$product_tags = (array) $_GET['prt_tag']; // Ensure it's an array

			$tax_query[] = array(
				'taxonomy' => 'product_tag',
				'field'    => 'slug',
				'terms'    => array_map('sanitize_text_field', $product_tags),
			);
		}

		// Apply the tax query if it's not empty
		if (!empty($tax_query)) {
			$query->set('tax_query', $tax_query);
		}

		// Reset pagination if filters are applied
		if (isset($_GET['prt_cat']) || isset($_GET['prt_tag'])) {
			$query->set('paged', 1);
		}
	}
}
add_action('pre_get_posts', 'filter_woocommerce_products_by_taxonomies');

?>