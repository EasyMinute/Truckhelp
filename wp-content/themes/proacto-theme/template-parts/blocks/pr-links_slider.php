<?php
//main class name for block
$className = 'links_slider';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$links_slider = get_field('links_slider');

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
        <h2 class="headline headline-h2 bold">
            <?= $links_slider['title'] ?>
        </h2>
        <div class="links_slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($links_slider['slides'] as $slide): ?>

                    <div class="swiper-slide links_slider__slide">
                        <div class="links_slider__slide-wrap">
                            <img src="<?= esc_url( $slide['image']['url'] ) ?>"
                                 alt="<?= esc_attr( $slide['image']['alt'] ) ?>">
                            <a href="<?= $slide['link']['url'] ?>" class="body body-xl medium link-overlay">
                                <?= $slide['link']['title'] ?>
                            </a>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
	</div>
</section>
