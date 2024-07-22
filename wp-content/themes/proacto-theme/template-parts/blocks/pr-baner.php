<?php
//main class name for block
$className = 'baner';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$baner = get_field('baner');
$bg = esc_url($baner['background']['url']);

if ($baner['choose_centres'] && !empty($baner['service_centres'])){
    $posts = $baner['service_centres'];
} else {
    $posts = get_posts(array(
       'post_type' => 'service_centres',
       'numberposts' => 3,
    ));
}

?>

<section class="<?php echo  esc_attr($className)?>" style="background-image: url(<?= $bg ?>)">
	<div class="container">
		<div class="baner__wrap">
            <div class="baner__texts">
                <h1 class="title headline headline-h1 bold">
                    <?= $baner['title'] ?>
                </h1>
                <p class="text body body-m regular">
                    <?= $baner['text'] ?>
                </p>
                <a href="<?= $baner['button']['url'] ?>" class="button button-m primary">
                    <?= $baner['button']['title'] ?>
                </a>
            </div>
            <ul class="baner__offices">
				<?php foreach ($posts as $post) : ?>
					<?php
					setup_postdata($post);
					$service_centre = get_field('service_centre', $post)
					?>

                    <li class="baner__offices-item">
                        <p>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 9C18 13.4183 13 19 10 19C7 19 2 13.4183 2 9C2 4.58172 5.58172 1 10 1C14.4183 1 18 4.58172 18 9Z" stroke="#B52929" stroke-width="1.5"/>
                                <path d="M12.6667 9.1C12.6667 10.5912 11.4728 11.8 10 11.8C8.52724 11.8 7.33333 10.5912 7.33333 9.1C7.33333 7.60883 8.52724 6.4 10 6.4C11.4728 6.4 12.6667 7.60883 12.6667 9.1Z" stroke="#B52929" stroke-width="1.5"/>
                            </svg>
                            <span class="body body-xs regular">
                            <?= $service_centre['address'] ?>
                        </span>
                        </p>
                        <p>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_338_4040)">
                                    <path d="M4.16667 3.33325H7.5L9.16667 7.49992L7.08333 8.74992C7.9758 10.5595 9.44039 12.0241 11.25 12.9166L12.5 10.8333L16.6667 12.4999V15.8333C16.6667 16.2753 16.4911 16.6992 16.1785 17.0118C15.866 17.3243 15.442 17.4999 15 17.4999C11.7494 17.3024 8.68346 15.922 6.38069 13.6192C4.07792 11.3165 2.69754 8.25053 2.5 4.99992C2.5 4.55789 2.67559 4.13397 2.98816 3.82141C3.30072 3.50885 3.72464 3.33325 4.16667 3.33325" stroke="#B52929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_338_4040">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <a class="body body-xs regular" href="tel:<?= $service_centre['phone'] ?>">
								<?= $service_centre['phone'] ?>
                            </a>
                        </p>
                    </li>

				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
            </ul>
        </div>
	</div>
</section>