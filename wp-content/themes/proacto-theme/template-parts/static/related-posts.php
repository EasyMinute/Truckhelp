<?php

$posts = get_posts(array(
	'post_type' => 'post',
	'numberposts' => 3,
	'order' => "DESC",
	'orderby' => 'date',
	'status' => 'publish',
));

?>

<div class="related-posts">
	<p class="related-posts_title body body-xxl bold">
		<?= __('Інші новини', 'proacto') ?>
	</p>
	<ul class="related-posts__list">
		<?php foreach ($posts as $post): ?>
			<?php
			setup_postdata($post);
			$post_title = get_the_title($post);
			$thumb_url = esc_url(get_the_post_thumbnail_url());
			$thumb_alt = esc_attr(get_the_post_thumbnail_caption());
			$post_link = get_the_permalink();
			$post_date = get_the_date('d.m.Y');
			?>

			<li class="related-card">
				<img src="<?= $thumb_url ?>" alt="<?= $thumb_alt ?>">
				<div class="related-card__texts">
					<p class="related-card_date body body-xxs bold">
						<?= $post_date ?>
					</p>
					<h3 class="related-card_title body body-s regular">
						<?= $post_title ?>
					</h3>
				</div>
				<a href="<?= $post_link ?>" class="link-overlay"></a>
			</li>

		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>
	</ul>
</div>
