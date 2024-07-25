<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package proacto
 */


$footer_options = get_field('footer_options', 'options');
$services = get_posts(array(
	'post_type' => 'services',
	'numberposts' => 8,
	'status' => 'publish',
	'orderby' => 'date',
	'order' => 'DESC'
));
$service_centres = get_posts(array(
	'post_type' => 'service_centres',
	'numberposts' => 8,
	'status' => 'publish',
	'orderby' => 'date',
	'order' => 'DESC'
));
?>
<?php get_template_part('template-parts/popups/added_to_cart'); ?>
    <footer id="colophon" class="footer">
        <div class="container">
            <div class="footer__wrap">
                <div class="footer__visuals">
                    <div class="footer__visuals_logo">
                        <img src="<?= esc_url( $footer_options['logo']['url'] ) ?>"
                             alt="<?= esc_attr( $footer_options['logo']['alt'] ) ?>">
                    </div>
	                <?php wp_nav_menu([
		                'menu' => 'footer_small',
		                'container' => 'div',
		                'container_class' => 'footer__visuals_menu'
	                ]) ?>
                    <div class="footer__visuals_payments">
                        <p class="body body-xxs regular">
                            <?= __('Приймаємо до оплати:', 'proacto') ?>
                        </p>
                        <div class="payment_cards">
	                        <?php if(!empty($footer_options['payments'])) : ?>
                                <?php foreach($footer_options['payments'] as $image) : ?>
                                    <img src="<?= esc_url( $image['url'] ) ?>" alt="<?= esc_attr( $image['alt'] ) ?>">
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
	            <?php wp_nav_menu([
		            'menu' => 'footer_big',
		            'container' => 'div',
		            'container_class' => 'footer__main'
	            ]) ?>
                <div class="footer__services">
                    <p class="body body-m medium">
                        <?= __('Послуги', 'proacto') ?>
                    </p>
                    <ul>
                        <?php foreach($services as $post): ?>
                            <?php
                            setup_postdata($post);
                            $service_title = get_the_title($post);
                            $service_link = get_the_permalink($post);
                            ?>

                            <li>
                                <a href="<?= $service_link ?>" class="body body-xs regular">
                                    <?= $service_title ?>
                                </a>
                            </li>

                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
                <div class="footer__services">
                    <p class="body body-m medium">
			            <?= __('Сервісні центри', 'proacto') ?>
                    </p>
                    <ul>
			            <?php foreach($service_centres as $post): ?>
				            <?php
				            setup_postdata($post);
                            $service_centre = get_field('service_centre', $post);
				            $center_title = $service_centre['address'] . ', </br>' . $service_centre['phone'];
				            $center_link = get_the_permalink($post);
				            ?>

                            <li>
                                <a href="<?= $center_link ?>" class="body body-xs regular">
						            <?= $center_title ?>
                                </a>
                            </li>

			            <?php endforeach; ?>
			            <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <div class="container">
                <p class="body body-xxs regular">
                    <?php echo !empty($footer_options['copyright']) ? $footer_options['copyright'] : '' ?>
                </p>
            </div>
        </div>
    </footer>
</div>
<?php wp_footer(); ?>

</body>
</html>
