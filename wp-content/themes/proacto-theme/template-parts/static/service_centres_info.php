<?php
$title = __('Сервісні центри', 'proacto');
$options = get_field('service_centre');

$posts = get_posts([
	'numberposts' => -1,
	'post_type' => 'service_centres',
	'status' => 'publish'
]);
$location = $options['map'];
?>

<section class="service-centers-info">
	<div class="container">
		<h2 class="headline headline-h2 bold">
			<?= $title ?>
		</h2>
		<nav class="service-centers-menu">
			<?php foreach ($posts as $post): ?>
				<?php
				setup_postdata($post);
				$post_title = get_the_title($post);
				$parts = explode(" ", $post_title, 3);

				$country = isset($parts[0]) ? trim($parts[0]) : '';
				$city = isset($parts[1]) ? trim($parts[2]) : '';
                $link = get_the_permalink($post)
				?>
				<div class="service-center-menu-card">
					<p class="body body-xl bold">
                        <?= $country ?>
                    </p>
                    <p class="body body-m regular">
	                    <?= $city ?>
                    </p>
                    <a href="<?= $link ?>" class="link-overlay"></a>
				</div>
			<?php endforeach; ?>
            <?php wp_reset_postdata() ?>
		</nav>
        <div class="single_center_info">
            <div class="single_center_texts">
                <p class="body body-m bold title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 11C20 15.4183 15 21 12 21C9 21 4 15.4183 4 11C4 6.58172 7.58172 3 12 3C16.4183 3 20 6.58172 20 11Z" stroke="#B52929" stroke-width="1.5"/>
                        <path d="M14.6667 11.1C14.6667 12.5912 13.4728 13.8 12 13.8C10.5272 13.8 9.33333 12.5912 9.33333 11.1C9.33333 9.60883 10.5272 8.4 12 8.4C13.4728 8.4 14.6667 9.60883 14.6667 11.1Z" stroke="#B52929" stroke-width="1.5"/>
                    </svg>
                    <?= __("Адреса", "proacto") ?>
                </p>
                <p class="body body-m regular text">
                    <?= $options['address'] ?>
                </p>
                <p class="body body-m bold title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_183_17798)">
                            <path d="M5 4H9L11 9L8.5 10.5C9.57096 12.6715 11.3285 14.429 13.5 15.5L15 13L20 15V19C20 19.5304 19.7893 20.0391 19.4142 20.4142C19.0391 20.7893 18.5304 21 18 21C14.0993 20.763 10.4202 19.1065 7.65683 16.3432C4.8935 13.5798 3.23705 9.90074 3 6C3 5.46957 3.21071 4.96086 3.58579 4.58579C3.96086 4.21071 4.46957 4 5 4" stroke="#B52929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_183_17798">
                                <rect width="24" height="24" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <?= __("Телефон", "proacto") ?>
                </p>
                <p class="body body-m regular text">
                    <?= $options['phone'] ?>
                </p>
                <p class="body body-m bold title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 7V12H17M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z" stroke="#B52929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?= __("Графік роботи:", "proacto") ?>
                </p>
                <p class="body body-m regular text">
		            <?= $options['schedule'] ?>
                </p>
            </div>
	        <?php if( $location ): ?>
                <div class="single_center_map acf-map" data-zoom="16">
                    <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
                </div>
	        <?php endif; ?>
        </div>
    </div>
</section>
