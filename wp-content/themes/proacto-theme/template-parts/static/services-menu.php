<?php
//main class name for block
$title = get_the_title();
$posts = get_posts(array(
	'post_type' => 'services',
	'numberposts' => -1,
	'status' => 'publish',
	'orderby' => 'date',
	'order' => 'DESC'
))

?>

<section class="services_menu">
	<div class="container">
		<h2 class="headline headline-h2 bold">
			<?= $title ?>
		</h2>
		<nav class="services_menu__wrap">
			<ul>
				<?php foreach ( $posts as $post ) : ?>
					<?php
					setup_postdata($post);
					$post_title = get_the_title($post);
					$post_thumb_url = get_the_post_thumbnail_url($post);
					$post_thumb_alt = get_the_post_thumbnail_caption($post);
					$post_link = get_the_permalink($post)
					?>

					<li class="service-menu-card">
						<div class="service-menu-card__img">
							<img src="<?= $post_thumb_url ?>" alt="<?= $post_thumb_alt ?>">
						</div>
						<p class="service-menu-card__title body body-s regular">
							<?= $post_title ?>
						</p>
						<a href="<?= $post_link ?>" class="link-overlay"></a>
					</li>

				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</nav>
	</div>
</section>