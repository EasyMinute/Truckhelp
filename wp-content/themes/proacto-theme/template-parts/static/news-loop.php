<?php
// Define the query parameters
$front_page_id = get_option('page_for_posts');
$page_title = get_the_title($front_page_id);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => 'post', // Change this if you want to query custom post types
	'posts_per_page' => 0,
	'paged' => $paged,
);

// Create a new query
$the_query = new WP_Query($args);
?>

<section class="news-loop">
	<div class="container">
		<h2 class="headline headline-h2 bold">
			<?= $page_title ?>
		</h2>
		<?php if ($the_query->have_posts()) : ?>
			<div class="news-loop__grid">
				<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<?php
					$post_title = get_the_title();
					$thumb_url = esc_url(get_the_post_thumbnail_url());
					$thumb_alt = esc_attr(get_the_post_thumbnail_caption());
					$post_link = get_the_permalink();
					$post_excerpt = get_the_excerpt();
					$post_date = get_the_date('d.m.Y');
					?>
					<div class="news_card">
						<img src="<?= $thumb_url ?>" alt="<?= $thumb_alt ?>">
						<div class="news_card__texts">
							<p class="date body body-xs medium">
								<?= $post_date ?>
							</p>
							<h3 class="title body body-m bold">
								<?= $post_title ?>
							</h3>
							<p class="excerpt body body-m regular">
								<?= $post_excerpt ?>
							</p>
							<a href="<?= $post_link ?>" class="button button-m primary">
								<?= __('Читати далі', 'proacto') ?>
							</a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div class="pagination news-loop__pagination">
				<?php
				echo paginate_links(array(
					'total' => $the_query->max_num_pages,
					'current' => $paged,
					'prev_text' => '',
					'next_text' => '',
				));
				?>
			</div>

		<?php endif; ?>

	<?php wp_reset_postdata(); ?>

	</div>
</section>
