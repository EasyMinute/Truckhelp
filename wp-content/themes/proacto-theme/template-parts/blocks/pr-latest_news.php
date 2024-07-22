<?php
//main class name for block
$className = 'latest_news';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$latest_news = get_field('latest_news');

if ($latest_news['choose'] && !empty($latest_news['news'])){
	$posts = $latest_news['news'];
} else {
	$posts = get_posts(array(
		'post_type' => 'post',
		'numberposts' => 4,
	));
}

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<div class="latest_news__header">
			<h2 class="headline headline-h2 bold">
				<?= $latest_news['title'] ?>
			</h2>
			<a href="<?= $latest_news['button']['url'] ?>" class="text-button">
				<?= $latest_news['button']['title'] ?>
			</a>
		</div>
        <div class="latest_news__wrap">
            <?php foreach ($posts as $post) : ?>
                <?php
                setup_postdata($post);
                $post_title = get_the_title($post);
	            $thumb_url = esc_url(get_the_post_thumbnail_url($post));
	            $thumb_alt = esc_attr(get_the_post_thumbnail_caption($post));
	            $post_link = get_the_permalink($post);
                $post_excerpt = get_the_excerpt($post);
                $post_date = get_the_date('d.m.Y', $post);
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

            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
	</div>
</section>