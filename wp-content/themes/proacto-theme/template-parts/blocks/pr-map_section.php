<?php
//main class name for block
$className = 'map_section';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$map_section = get_field('map_section');
$img_url = esc_url($map_section['image']['url']);
$img_alt = esc_url($map_section['image']['alt']);

if ($map_section['choose'] && !empty($map_section['posts'])){
	$posts = $map_section['posts'];
} else {
	$posts = get_posts(array(
		'post_type' => 'service_centres',
		'numberposts' => 3,
	));
}

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<h2 class="headline headline-h2 bold">
			<?= $map_section['title'] ?>
		</h2>
		<div class="map_section__wrap">
			<div class="map_section__cards">
				<?php foreach($posts as $post): ?>
					<?php
					setup_postdata($post);
					$post_title = get_the_title($post);
					$post_link = get_the_permalink($post);
					$service_options = get_field('service_centre', $post);
					?>

					<div class="map_service_card">
						<div class="map_service_card__row">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M18 9C18 13.4183 13 19 10 19C7 19 2 13.4183 2 9C2 4.58172 5.58172 1 10 1C14.4183 1 18 4.58172 18 9Z" stroke="#B52929" stroke-width="1.5"/>
								<path d="M12.6667 9.1C12.6667 10.5912 11.4728 11.8 10 11.8C8.52724 11.8 7.33333 10.5912 7.33333 9.1C7.33333 7.60883 8.52724 6.4 10 6.4C11.4728 6.4 12.6667 7.60883 12.6667 9.1Z" stroke="#B52929" stroke-width="1.5"/>
							</svg>
							<p class="body body-s regular"><?= $service_options['address'] ?></p>
						</div>
						<div class="map_service_card__row">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_382_2499)">
									<path d="M4.16667 3.33337H7.5L9.16667 7.50004L7.08333 8.75004C7.9758 10.5596 9.44039 12.0242 11.25 12.9167L12.5 10.8334L16.6667 12.5V15.8334C16.6667 16.2754 16.4911 16.6993 16.1785 17.0119C15.866 17.3244 15.442 17.5 15 17.5C11.7494 17.3025 8.68346 15.9221 6.38069 13.6194C4.07792 11.3166 2.69754 8.25065 2.5 5.00004C2.5 4.55801 2.67559 4.13409 2.98816 3.82153C3.30072 3.50897 3.72464 3.33337 4.16667 3.33337" stroke="#B52929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</g>
								<defs>
									<clipPath id="clip0_382_2499">
										<rect width="20" height="20" fill="white"/>
									</clipPath>
								</defs>
							</svg>
							<p class="body body-s regular"><?= $service_options['phone'] ?></p>
						</div>
						<div class="map_service_card__row">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 5.83333V10H14.1667M10 17.5C5.85786 17.5 2.5 14.1421 2.5 10C2.5 5.85786 5.85786 2.5 10 2.5C14.1421 2.5 17.5 5.85786 17.5 10C17.5 14.1421 14.1421 17.5 10 17.5Z" stroke="#B52929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<p class="body body-s regular">
								<?= __('Графік роботи:', 'proacto') ?>
								<br>
								<span class=""><?= $service_options['schedule'] ?></span>
							</p>
						</div>
						<a href="<?= $post_link ?>" class="arrow-link">
							<?= __('Перейти до сторінки філії') ?>
						</a>
					</div>

				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			</div>
			<div class="map_section__image">
				<img src="<?= $img_url ?>" alt="<?= $img_alt ?>">
			</div>
		</div>
	</div>
</section>