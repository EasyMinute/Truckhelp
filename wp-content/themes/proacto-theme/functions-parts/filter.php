<?php


function custom_pre_get_posts( $query ) {
	if ( !is_admin() && $query->is_main_query() && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		if ( isset( $_GET['product_cat'] ) ) {
			$query->set( 'tax_query', array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => explode( ',', $_GET['product_cat'] ),
				),
			));
		}

		if ( isset( $_GET['product_tag'] ) ) {
			$query->set( 'tax_query', array(
				array(
					'taxonomy' => 'product_tag',
					'field'    => 'slug',
					'terms'    => explode( ',', $_GET['product_tag'] ),
				),
			));
		}
	}
}
add_action( 'pre_get_posts', 'custom_pre_get_posts' );


?>