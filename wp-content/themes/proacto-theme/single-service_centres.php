<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package proacto
 */

get_header();
?>

	<main class="page-template">
		<?php get_template_part('template-parts/static/service_centres_info') ?>
		<?php the_content(); ?>
	</main>


<?php
get_footer();
