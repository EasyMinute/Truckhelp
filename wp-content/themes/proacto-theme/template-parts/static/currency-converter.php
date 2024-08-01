<?php
// Get the current URL without query parameters
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL to modify query parameters
$url_components = parse_url($current_url);
parse_str($url_components['query'] ?? '', $params);

// Create UAH button URL
$params['currency'] = 'UAH';
$uah_query_string = http_build_query($params);
$uah_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'] . '?' . $uah_query_string;

// Create EUR button URL
$params['currency'] = 'EUR';
$eur_query_string = http_build_query($params);
$eur_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'] . '?' . $eur_query_string;

$uah_active = !isset($_GET['currency']) || isset($_GET['currency']) && $_GET['currency'] == "UAH" ? "active" : "";
$eur_active = isset($_GET['currency']) && $_GET['currency'] == "EUR" ? "active" : "";
?>

<div class="currency-converter">
    <a href="<?= $uah_url ?>" class="body body-s regular currency-converter__button <?= $uah_active ?>" data-target="UAH">
        <?= __('ГРН ₴', 'proacto') ?>
    </a>
    <a href="<?= $eur_url ?>" class="body body-s regular currency-converter__button <?= $eur_active ?>" data-target="EUR">
        <?= __('EUR €', 'proacto') ?>
    </a>
</div>