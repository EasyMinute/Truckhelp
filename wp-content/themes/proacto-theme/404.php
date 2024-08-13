<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package proacto
 */

get_header();

?>

	<section class="block-404">
        <div class="container">
            <div class="block-404__wrap">
                <h2 class="headline headline-h2 bold">
                    <?= __('Сторінку не знайдено', 'proacto') ?>
                </h2>
                <p class="body body-s regular">
                    <?= __('Можливо, ця сторінка була видалена або припущена помилка в адресі.', 'proacto') ?>
                </p>
                <a href="<?= get_home_url() ?>" class="button button-l primary">
	                <?= __('Перейти на головну сторінку', 'proacto') ?>
                </a>
                <img src="<?= get_template_directory_uri() . '/assets/img/static/404.png' ?>" alt="">
            </div>
        </div>
    </section>

<?php
get_footer();
