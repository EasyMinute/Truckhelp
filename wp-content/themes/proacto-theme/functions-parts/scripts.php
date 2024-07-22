<?php
//    define('ROOT', $_SERVER['DOCUMENT_ROOT']);
//    define('THEME', get_theme_root());
//    function enqueue_css_files_in_folder() {
//
//        $css_folder = get_template_directory_uri() . '/dist/css/libs/';
//        $css_files = scandir( get_template_directory() . '/dist/css/libs/' );
//
//
//        if ( $css_files ) {
//            foreach ( $css_files as $file ) {
//                if ( pathinfo( $file, PATHINFO_EXTENSION ) === 'css' ) {
//                    $css_path = $css_folder . $file;
//                    wp_enqueue_style( 'custom-style-' . pathinfo( $file, PATHINFO_FILENAME ), $css_path, array(), _S_VERSION );
//                }
//            }
//        }
//    }


	function proacto_style() {
        wp_enqueue_style( 'proacto-style', get_stylesheet_uri(), array(), _S_VERSION );
        wp_enqueue_style( 'proacto-main', get_template_directory_uri() . '/dist/css/main.min.css', array(), 1.0, 'all' );

	}
	function proacto_scripts() {
		wp_enqueue_script( 'proacto-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDxjKA06MGliuBRnfRJhBgsb6IF-v50iPM&callback=Function.prototype', '', 1.0, true );
		wp_enqueue_script( 'proacto-main', get_template_directory_uri() . '/dist/js/main.min.js', '', 1.0, true );
		wp_localize_script('proacto-main', 'proacto_vars', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce('cart_quantity_nonce')
		));

	}

	//enqueue styles
	add_action( 'wp_enqueue_scripts', 'proacto_style' );
	//enqueue scripts
	add_action( 'wp_enqueue_scripts', 'proacto_scripts' );

?>