<?php

/**
 * Theme support woocommerce
 */
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 1,
			'max_rows'        => 3,
			'default_columns' => 3,
		),
	) );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//Currency
add_filter('woocommerce_currency_symbol', 'custom_woocommerce_currency_symbol', 10, 2);

function custom_woocommerce_currency_symbol($currency_symbol, $currency) {
	switch ($currency) {
		case 'UAH': // Change 'USD' to the currency code you want to modify
			$currency_symbol = __('грн', 'proacto'); // Change 'US$' to your desired symbol
			break;
	}
	return $currency_symbol;
}



/**
 * Set WooCommerce image dimensions upon theme activation
 */
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
//	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
//	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}
// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );




/**
 * SHOP ARCHIVE ACTIONS
 */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
// Remove the default WooCommerce shop header
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

// Add custom shop header
add_action('woocommerce_archive_description', 'custom_woocommerce_shop_header', 10);

function custom_woocommerce_shop_header() {
	// Load custom template part
	get_template_part('/template-parts/woo/shop-header');
}

//------product card
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);




/**
 * SINGLE PRODUCT
 */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20);
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );

add_action('prt_single_prod_head', 'woocommerce_template_single_title', 5);

add_action('prt_single_prod_visuals', 'woocommerce_show_product_images', 10);

add_action('prt_single_prod_add', 'woocommerce_template_single_price', 10);
add_action('prt_single_prod_add', 'woocommerce_template_single_add_to_cart', 20);

add_action('prt_single_prod_description', 'woocommerce_output_product_data_tabs', 10);

add_action('prt_single_prod_notices', 'woocommerce_output_all_notices', 10);

add_filter('wc_add_to_cart_message_html', 'custom_add_to_cart_button_class', 10, 2);

function custom_add_to_cart_button_class($message, $products) {
	// Look for the "View cart" button in the message
	if (strpos($message, 'class="button wc-forward"') !== false) {
		// Add your custom class
		$message = str_replace('class="button wc-forward"', 'class="button wc-forward button button-m primary"', $message);
	}

	return $message;
}
//remove_action('', '', 10);


/*
 * CART
 */
remove_action( 'woocommerce_cart_is_empty', 'woocommerce_cross_sell_display' );

/*
 * CHECKOUT
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action('proacto_checkout_payments', 'woocommerce_checkout_payment', 10);

add_filter( 'woocommerce_checkout_fields', 'customize_checkout_fields' );

function customize_checkout_fields( $fields ) {
	// Unset all fields except surname, name, telephone, and email
	$fields['billing']['billing_country']['priority'] = 5;
	$fields['billing'] = array(
		'billing_country' => $fields['billing']['billing_country'],
		'billing_last_name' => array(
			'label'       => false,
            'placeholder' => __('Ваше прізвище*', 'proacto'),
			'required'    => true,
			'class'       => array('form-row-wide'),
			'priority'    => 10,
		),
		'billing_first_name' => array(
			'label'       => false,
			'placeholder' => __('Ваше ім’я*', 'proacto'),
			'required'    => true,
			'class'       => array('form-row-wide'),
			'priority'    => 20,
		),
		'billing_phone' => array(
			'label'       => false,
			'placeholder' => __('Ваш телефон*', 'proacto'),
			'required'    => true,
			'class'       => array('form-row-wide'),
			'priority'    => 30,
		),
		'billing_email' => array(
			'label'       => false,
			'placeholder' => __('Електронна пошта*', 'proacto'),
			'required'    => true,
			'class'       => array('form-row-wide'),
			'priority'    => 40,
		),
	);

	// Unset shipping fields if needed
	unset($fields['shipping']);

	// Unset order fields if needed
	unset($fields['order']['order_comments']);

	return $fields;
}



/**
 * Update Cart Automatically on Quantity Change
 *
 * @author Misha Rudrastyh
 * @url https://rudrastyh.com/woocommerce/remove-update-cart-button.html
 */
add_action( 'wp_head', function() {

	?><style>
        .woocommerce button[name="update_cart"],
        .woocommerce input[name="update_cart"] {
            /*display: none;*/
            visibility: hidden;
        }</style><?php

} );

// Remove the default place order button
add_action('wp', 'custom_remove_default_place_order_button');
function custom_remove_default_place_order_button() {
	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
}

// Add the custom place order button to the review order section
add_action( 'woocommerce_checkout_order_review', 'custom_place_order_button' );

function custom_place_order_button() {
	?>
    <div class="form-row place-order">
		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button button-l primary alt' . esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) . '" name="woocommerce_checkout_place_order" id="place_order" value="' . __('Підтвердити замовлення', 'proacto') . '" data-value="' . __('Підтвердити замовлення', 'proacto') . '">' . __('Підтвердити замовлення', 'proacto') . '</button>' ); // @codingStandardsIgnoreLine ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
    </div>
	<?php
}

add_action( 'wp_footer', function() {

	?><script>
        jQuery( function( $ ) {
            let timeout;
            $('.woocommerce').on('change', 'input.qty', function(){
                if ( timeout !== undefined ) {
                    clearTimeout( timeout );
                }
                timeout = setTimeout(function() {
                    $("[name='update_cart']").trigger("click"); // trigger cart update
                    console.log('sdjgfjkds')

                }, 1000 ); // 1 second delay, half a second (500) seems comfortable too
            });

            $(document.body).on('updated_wc_div', function() {
                console.log('sdjgfjkds2')
                if ($('main').html().trim() === '') {
                    console.log('sdjgfjkds3')
                    location.reload(); // reload the page if <main> is empty
                }
            });
        } );
	</script><?php

} );


add_action('wp_ajax_get_cart_quantity', 'get_cart_quantity');
add_action('wp_ajax_nopriv_get_cart_quantity', 'get_cart_quantity');

function get_cart_quantity() {
	// Check if WooCommerce is active
	if (!class_exists('WC_Cart')) {
		wp_send_json_error('WooCommerce is not active.');
	}

	// Get cart items quantity
	$cart_quantity = WC()->cart->get_cart_contents_count();

	// Return the quantity as a JSON response
	wp_send_json_success(array('quantity' => $cart_quantity));

	wp_die();
}

//ACCOUNT
function custom_woocommerce_account_menu_items( $items ) {
	// Only keep these menu items
	$items = array(
		'dashboard'       => __( 'Dashboard', 'woocommerce' ),
		'orders'          => __( 'Orders', 'woocommerce' ),
		'edit-account'    => __( 'Особисті дані', 'woocommerce' ),
		'customer-logout' => __( 'Logout', 'woocommerce' ),
	);

	return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_woocommerce_account_menu_items' );




// Save phone field
function custom_woocommerce_save_account_details($user_id) {
	if (isset($_POST['phone'])) {
		update_user_meta($user_id, 'phone', sanitize_text_field($_POST['phone']));
	}
}
add_action('woocommerce_save_account_details', 'custom_woocommerce_save_account_details');

// Save phone field in admin user profile
function custom_woocommerce_save_user_profile($user_id) {
	if (isset($_POST['phone'])) {
		update_user_meta($user_id, 'phone', sanitize_text_field($_POST['phone']));
	}
}
add_action('personal_options_update', 'custom_woocommerce_save_user_profile');
add_action('edit_user_profile_update', 'custom_woocommerce_save_user_profile');

// Prepopulate checkout phone field with the custom phone field from My Account
function custom_woocommerce_checkout_get_phone( $input, $key ) {
	if ( 'billing_phone' === $key ) {
		$user_id = get_current_user_id();
		if ( $user_id ) {
			$phone = get_user_meta( $user_id, 'phone', true );
			if ( $phone ) {
				$input = $phone;
			}
		}
	}
	return $input;
}
add_filter( 'woocommerce_checkout_get_value', 'custom_woocommerce_checkout_get_phone', 10, 2 );


// Display bank transfer details on the Thank You page
add_action('prt_woocommerce_thankyou_bacs', 'display_bacs_payment_instructions', 20);

function display_bacs_payment_instructions($order_id) {
	// Get the order
	global $wp;

	// Get the order ID from the query variables
	$order_id = isset($wp->query_vars['order-received']) ? $wp->query_vars['order-received'] : 0;

	// Get the order
	$order = wc_get_order($order_id);

	// Check if the order exists and is valid
	if (!$order) {
		return; // Exit the function if the order is not valid
	}

	// Check if the payment method is BACS
	if ($order->get_payment_method() === 'bacs') {
		// Get BACS account details
		$bacs_accounts = get_option('woocommerce_bacs_accounts');
		if (!empty($bacs_accounts)) {
            echo "<div class='bacs_table'>";
			foreach ($bacs_accounts as $account) {
				echo '<h2 class="body body-l medium">' . __('Bank Transfer Instructions') . '</h2>';
				echo '<p class="body body-s regular">' . __('Please transfer the total amount to the following bank account.') . '</p>';
				echo '<ul class="bacs_details">';
				echo '<li class="body body-s medium">' . __('Account Name:') . ' ' . '<span>' . esc_html($account['account_name']) . '</span>' . '</li>';
				echo '<li class="body body-s medium">' . __('Account Number:') . ' ' . '<span>' . esc_html($account['account_number']) . '</span>' . '</li>';
				echo '<li class="body body-s medium">' . __('Sort Code:') . ' ' . '<span>' . esc_html($account['sort_code']) . '</span>' . '</li>';
				echo '<li class="body body-s medium">' . __('Bank Name:') . ' ' . '<span>' . esc_html($account['bank_name']) . '</span>' . '</li>';
				echo '<li class="body body-s medium">' . __('IBAN:') . ' ' . '<span>' . esc_html($account['iban']) . '</span>' . '</li>';
				echo '<li class="body body-s medium">' . __('BIC:') . ' ' . '<span>' . esc_html($account['bic']) . '</span>' . '</li>';
				echo '</ul>';
			}
			echo "</div>";
		}
	}
}
