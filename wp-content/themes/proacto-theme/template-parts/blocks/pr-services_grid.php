<?php
//main class name for block
$className = 'services_grid';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$services_grid = get_field('services_grid');


if ($services_grid['choose'] && !empty($services_grid['services'])){
	$posts = $services_grid['service_centres'];
} else {
	$posts = get_posts(array(
		'post_type' => 'services',
		'numberposts' => 8,
	));
}

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<h2 class="headline headline-h2 bold">
			<?= $services_grid['title'] ?>
		</h2>
		<div class="services_grid__wrap">
			<?php foreach ($posts as $post) : ?>
				<?php
				setup_postdata($post);
				$service_title = get_the_title($post);
				$service_options = get_field('service_options', $post);
				$thumb_url = esc_url(get_the_post_thumbnail_url($post));
				$thumb_alt = esc_attr(get_the_post_thumbnail_caption($post));
                $service_link = get_the_permalink($post)
				?>

				<div class="service_card">
					<h3 class="service_card__title body body-xl regular">
						<?= $service_title ?>
					</h3>
					<img src="<?= $thumb_url ?>" alt="<?= $thumb_alt ?>">
                    <div class="arrow-link">
                        <span>
                            <?= __('від ', 'proacto') ?>
                            <b><?= $service_options['price'] ?></b>
                        </span>
                    </div>
                    <a href="<?= $service_link ?>" class="link-overlay"></a>
				</div>

			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>