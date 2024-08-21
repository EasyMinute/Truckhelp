<?php
// Start output buffering
ob_start();

// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Call the geolocation API to get the user's country
$geolocation_data = @file_get_contents("https://ipinfo.io/{$user_ip}/json");
$geolocation_data = json_decode($geolocation_data, true);

// Determine the country and set the default currency
$default_currency = 'EUR'; // Default currency for non-UA countries
if (isset($geolocation_data['country']) && $geolocation_data['country'] === 'UA') {
	$default_currency = 'UAH';
}

// Get the current URL without query parameters
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL to modify query parameters
$url_components = parse_url($current_url);
parse_str($url_components['query'] ?? '', $params);

// Redirect if the currency is not set or incorrect
if (!isset($params['currency']) || $params['currency'] !== $default_currency) {
	$params['currency'] = $default_currency;
	$redirect_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'] . '?' . http_build_query($params);
	header("Location: $redirect_url");
	exit;
}

// Create UAH and EUR button URLs
$uah_query_string = http_build_query(array_merge($params, ['currency' => 'UAH']));
$eur_query_string = http_build_query(array_merge($params, ['currency' => 'EUR']));

$uah_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'] . '?' . $uah_query_string;
$eur_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'] . '?' . $eur_query_string;

// Determine active currency
$uah_active = $params['currency'] == "UAH" ? "active" : "";
$eur_active = $params['currency'] == "EUR" ? "active" : "";

// End output buffering and send output
ob_end_flush();
?>


<div class="currency-converter">
    <a href="<?= $uah_url ?>" class="body body-s regular currency-converter__button <?= $uah_active ?>" data-target="UAH">
		<?= __('ГРН ₴', 'proacto') ?>
    </a>
    <a href="<?= $eur_url ?>" class="body body-s regular currency-converter__button <?= $eur_active ?>" data-target="EUR">
		<?= __('EUR €', 'proacto') ?>
    </a>
</div>
