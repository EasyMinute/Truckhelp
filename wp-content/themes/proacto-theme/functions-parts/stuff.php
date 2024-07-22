<?php
	//file for extending functions php with custom code
	function my_theme_add_menu_page() {
		add_menu_page(
			__( 'Proacto Template', 'proacto]' ), // page title
			__( 'Proacto', 'proacto' ), // menu title
			'manage_options', // capability required to access the page
			'proacto', // menu slug
			'my_theme_options_page',
			'data:image/svg+xml;base64,' . base64_encode('<svg width="128" height="110" viewBox="0 0 128 110" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M50.8846 23.8897C50.8743 20.6547 53.4885 18.0239 56.7235 18.0136L77.7476 17.9469C80.9825 17.9367 83.6133 20.5508 83.6236 23.7858C83.6339 27.0208 81.0197 29.6516 77.7847 29.6618L62.6034 29.71C62.3985 32.7504 59.8722 35.1578 56.7779 35.1676C53.5429 35.1779 50.9121 32.5637 50.9019 29.3287L50.8846 23.8897Z" fill="#292F2E"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M99.3296 2.27302C102.565 2.26276 105.195 4.87691 105.206 8.11189L105.376 61.7627C105.386 64.9977 102.772 67.6284 99.537 67.6387L87.8513 67.6758L87.9158 88.0774C87.9244 90.794 86.0639 93.16 83.4219 93.7924C72.8175 96.3308 62.1317 97.483 52.2487 93.9205C42.1167 90.2683 33.9518 82.096 27.4894 68.4443C26.1053 65.5203 27.3535 62.028 30.2775 60.6438C33.2014 59.2597 36.6938 60.508 38.0779 63.4319C43.669 75.2431 49.8667 80.6091 56.2214 82.8997C61.795 84.9088 68.3097 84.8658 76.1859 83.3722L76.1179 61.8554C76.1077 58.6205 78.7218 55.9897 81.9568 55.9795L93.6424 55.9424L93.4907 8.14906C93.4805 4.91408 96.0946 2.28329 99.3296 2.27302Z" fill="#292F2E"/>
			</svg>') // callback function that will render the page
		);
	}
	add_action( 'admin_menu', 'my_theme_add_menu_page' );

	function my_theme_options_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Proacto Your Theme Charter', 'my-theme' ); ?></h1>

			<div class="nav-tab-wrapper">
				<a href="#about" class="nav-tab">About</a>
				<a href="#contacts" class="nav-tab">Contacts</a>
				<a href="#documentation" class="nav-tab">Documentation</a>
			</div>
			<div id="about" class="tab-content">
				<h2>About</h2>
				<!-- General settings fields go here -->
			</div>
			<div id="contacts" class="tab-content">
				<h2>Contacts</h2>
				<!-- Layout settings fields go here -->
			</div>
			<div id="documentation" class="tab-content">
				<h2>Documentation</h2>
				<!-- Color settings fields go here -->
			</div>
		</div>

		<style>
			.nav-tab-wrapper {
				margin-bottom: 20px;
			}
			.nav-tab {
				padding: 8px 12px;
				border-radius: 3px 3px 0 0;
				background-color: #f7f7f7;
				color: #333;
				font-weight: bold;
				margin-right: 10px;
			}
			.nav-tab.active {
				background-color: #fff;
				color: #0073aa;
				border-color: #ccc;
			}
			.tab-content {
				display: none;
				margin-top: 20px;
			}
			.tab-content.active {
				display: block;
			}
		</style>

		<script>
			jQuery(document).ready(function($) {
				// Activate first tab by default
				$('.nav-tab:first').addClass('active');
				$('.tab-content:first').addClass('active');

				// Switch tabs on click
				$('.nav-tab').on('click', function(e) {
					e.preventDefault();
					var target = $(this).attr('href');
					$('.nav-tab').removeClass('active');
					$('.tab-content').removeClass('active');
					$(this).addClass('active');
					$(target).addClass('active');
				});
			});
		</script>
		<?php
	}

	function my_theme_options_init() {
		register_setting(
			'my_theme_options_group', // option group
			'my_theme_options', // option name
			'my_theme_options_sanitize' // sanitize callback function
		);

	}
	
	add_action( 'admin_init', 'my_theme_options_init' );

    function my_acf_init() {
        acf_update_setting('google_api_key', 'AIzaSyDxjKA06MGliuBRnfRJhBgsb6IF-v50iPM');
    }
    add_action('acf/init', 'my_acf_init');

    add_filter('woocommerce_resize_images', static function() {
        return false;
    });
?>