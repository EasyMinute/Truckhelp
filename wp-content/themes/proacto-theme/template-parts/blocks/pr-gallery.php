<?php
//main class name for block
$className = 'gallery';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$gallery = get_field('gallery');

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<h2 class="headline headline-h2 bold">
			<?= $gallery['title'] ?>
		</h2>

		<div class="gallery_slider swiper">
			<div class="swiper-wrapper">
				<?php foreach($gallery['images'] as $slide): ?>

					<div class="swiper-slide gallery_slider__slide">
						<div class="gallery_slider__slide-wrap">
							<img src="<?= esc_url( $slide['url'] ) ?>" alt="<?= esc_attr($slide['alt']) ?>">
						</div>
					</div>

				<?php endforeach; ?>
			</div>
            <div class="swiper_nav">
                <button class="swiper-button swiper-button-prev"></button>
                <button class="swiper-button swiper-button-next"></button>
            </div>
		</div>
	</div>
</section>
