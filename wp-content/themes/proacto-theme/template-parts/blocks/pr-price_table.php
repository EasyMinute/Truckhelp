<?php
//main class name for block
$className = 'price_table';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$price_table = get_field('price_table');

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<ul class="price_table__wrap">
			<?php foreach ($price_table as $item):  ?>
				<li class="price_table__row">
					<p class="price_title body body-s medium">
						<?= $item['title'] ?>
					</p>
					<p class="price_value">
						<span class="body body-s medium"><?= __('від ') ?></span>
						<span class="body body-xl bold"><?= $item['price'] ?></span>
					</p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>