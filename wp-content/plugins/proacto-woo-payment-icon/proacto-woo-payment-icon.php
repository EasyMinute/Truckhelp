<?php
/**
 * Plugin Name: Proacto Custom Payment icon
 * Description: Adding custom icon option for payment methods in woocomerce
 * Version: 1.0.1
 * Author: Yura Nykolyshyn
 * Text Domain: proacto-payicon
 * Domain Path: /i18n/languages/
 *
 */


// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}


// Check if WooCommerce is active
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

	// Add custom gateway icon field
	add_filter('woocommerce_payment_gateways', 'add_custom_gateway_icon_field');
	function add_custom_gateway_icon_field($methods) {
		foreach ($methods as $method) {
			// Get the full class name

			// Extract the last part of the class name (e.g., WC_Gateway_COD becomes COD)
			$method_id = strtolower(str_replace('WC_Gateway_', '', $method));
			add_filter('woocommerce_settings_api_form_fields_' . $method_id, 'add_icon_field_to_gateway');
		}
		return $methods;
	}


//	add_filter('woocommerce_settings_api_form_fields_cod', 'add_icon_field_to_gateway');
	function add_icon_field_to_gateway($settings) {
		$settings['icon'] = array(
			'title' => __('Payment Icon', 'woocommerce'),
			'type' => 'payicon',
			'description' => __('Select an icon for this payment method.', 'woocommerce'),
			'default' => '',
		);
		return $settings;
	}

	// Add custom field type icon
	add_action('woocommerce_form_field_payicon', 'woocommerce_admin_field_icon');
	function woocommerce_admin_field_icon($value) {
        echo
		$option_value = get_option($value['id'], $value['default']);
		?>
            <h1><br><br><br><br><br><br><br>jsdhfcksdjkjsdhcjkskjdljsl<br><br><br><br><br></h1>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_html($value['title']); ?></label>
			</th>
			<td class="forminp forminp-<?php echo sanitize_title($value['type']); ?>">
				<input type="hidden" id="<?php echo esc_attr($value['id']); ?>" name="<?php echo esc_attr($value['id']); ?>" value="<?php echo esc_attr($option_value); ?>" />
				<button type="button" class="button upload_icon_button" data-target="#<?php echo esc_attr($value['id']); ?>"><?php _e('Upload/Icon', 'woocommerce'); ?></button>
				<div class="icon-preview" id="icon-preview-<?php echo esc_attr($value['id']); ?>">
					<?php if ($option_value) : ?>
						<img src="<?php echo esc_url($option_value); ?>" style="max-width:100px;" />
					<?php endif; ?>
				</div>
				<p class="description"><?php echo esc_html($value['description']); ?></p>
			</td>
		</tr>
		<?php
	}

	// Enqueue custom admin scripts
	add_action('admin_enqueue_scripts', 'enqueue_custom_admin_scripts');
	function enqueue_custom_admin_scripts($hook) {
		if ('woocommerce_page_wc-settings' != $hook) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_script('custom-admin-script', plugin_dir_url(__FILE__) . 'js/admin.js', array('jquery'), null, true);
	}

	// Display custom payment method icon on checkout page
//	add_filter('woocommerce_gateway_icon', 'display_custom_payment_method_icon', 10, 2);
//	function display_custom_payment_method_icon($icon, $id) {
//		$gateway = WC()->payment_gateways()->get_gateway($id);
//		if ($gateway && !empty($gateway->settings['icon'])) {
//			$icon = '<img src="' . esc_url($gateway->settings['icon']) . '" alt="' . esc_attr($gateway->get_title()) . '">';
//		}
//		return $icon;
//	}
} else {
	add_action('admin_notices', 'woocommerce_not_active_notice');
	function woocommerce_not_active_notice() {
		?>
		<div class="error">
			<p><?php _e('WooCommerce Payment Icons requires WooCommerce to be installed and active.', 'woocommerce'); ?></p>
		</div>
		<?php
	}
}