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

    <main class="single-post">
        <div class="container">
            <div class="single-post__wrap">
                <div class="single-post__content">
                    <p class="single-post_date body body-s medium">
                        <?= get_the_date() ?>
                    </p>
                    <h2 class="single-post_title headline headline-h2 bold">
                        <?= get_the_title() ?>
                    </h2>
		            <?php the_content(); ?>
                </div>
                <div class="single-post__related">
                    <?php get_template_part('template-parts/static/related-posts') ?>
                </div>
            </div>
        </div>
    </main>


<?php
get_footer();
