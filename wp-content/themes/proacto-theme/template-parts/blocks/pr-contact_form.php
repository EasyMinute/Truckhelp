<?php
//main class name for block
$className = 'contact_form';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$contact_form = get_field('contact_form');

?>

<section class="<?php echo  esc_attr($className)?>">
	<div class="container">
		<div class="contact_form__wrap">
			<div class="contact_form__texts">
				<h2 class="headline headline-h3 bold">
					<?= $contact_form['title'] ?>
				</h2>
				<p class="body body-s regular">
					<?= $contact_form['text'] ?>
				</p>
			</div>
			<div class="contact_form__form">
				<p class="contact_form__form-title body body-xxl semibold">
					<?= $contact_form['form_title'] ?>
				</p>
				<?= do_shortcode('[contact-form-7 id="'. strval($contact_form['form']).'"]') ?>
			</div>
		</div>
	</div>
</section>