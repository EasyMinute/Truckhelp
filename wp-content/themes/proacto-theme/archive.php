<?php
/**
 * The template for displaying archive pages
 * Template Name: Archives
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package proacto
 */

get_header(); 

?>	

	<main class="archive-template">

        <?php if ( have_posts() ) : ?>


            <?php while ( have_posts() ) : ?>
                <?php the_post(); ?>
            <?php endwhile; ?>

        <?php endif; ?>
    </main>

<?php get_footer();
