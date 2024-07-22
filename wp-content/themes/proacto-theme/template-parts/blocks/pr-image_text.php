<?php
//main class name for block
$className = 'image_text';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$image_text = get_field('image_text');

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<div class="image_text__wrap">
			<img src="<?= esc_url( $image_text['image']['url'] ) ?>"
			     alt="<?= esc_attr( $image_text['image']['alt'] ) ?>"
				class="image_text__image">
			<div class="image_text__texts">
				<h2 class="headline headline-h2 bold">
					<?= $image_text['title'] ?>
				</h2>
				<p class="body body-m regular">
					<?= $image_text['text'] ?>
				</p>
				<a href="<?= $image_text['button']['url'] ?>" class="button button-l primary">
					<?= $image_text['button']['title'] ?>
				</a>
			</div>
		</div>
	</div>
</section>
