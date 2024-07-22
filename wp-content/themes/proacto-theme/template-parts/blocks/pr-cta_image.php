<?php
//main class name for block
$className = 'cta_image';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$cta_image = get_field('cta_image');

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<div class="cta_image__wrap" style="background-image: url(<?= $cta_image['background']['url'] ?>);">
			<div class="cta_image__texts">
				<div class="headline headline-h2 heavy">
					<?= $cta_image['title'] ?>
				</div>
				<p class="body body-m regular">
					<?= $cta_image['text'] ?>
				</p>
				<a href="<?= $cta_image['button']['url'] ?>" class="button button-l primary">
					<?= $cta_image['button']['title'] ?>
				</a>
			</div>
		</div>
	</div>
</section>