<?php
//main class name for block
$className = 'seo_text';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$seo_text = get_field('seo_text');

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<h2 class="headline headline-h2 bold">
			<?= $seo_text['title'] ?>
		</h2>
		<div class="seo_text__body body body-m regular">
			<?= $seo_text['text'] ?>
		</div>
		<button class="seo_text__button text-button seo_text__switcher">
			<span class="open"><?= __('Показати більше', 'proacto') ?></span>
			<span class="close"><?= __('Сховати', 'proacto') ?></span>
		</button>
	</div>
</section>