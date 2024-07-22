<?php
//This file Include styles and jsgi from blocks automaticaly to WordPress
    if ( ! function_exists( 'enqueue_blocks_styles' ) ) {
        function enqueue_blocks_styles() {

//                $blocks = get_gutenberg_block_names();
//                foreach ( $blocks as $block ) {
//                    var_dump('<pre>');
//                    var_dump($block);
//                    var_dump('</pre>');
//                }
                $CSS = get_template_directory() . '/dist/css/blocks/';
                $CSS_FILES = scandir($CSS);

                $JS  = get_template_directory() . '/dist/js/blocks/';
                $JS_FILES  = scandir($JS);


                foreach ($CSS_FILES as $CSS_FILE) {
                    if (strpos($CSS_FILE, '.min.css') !== false) {
                        $file_name = str_replace('.min.css', '', $CSS_FILE);
                        wp_enqueue_style('proacto-' . $file_name, get_template_directory_uri() . '/dist/css/blocks/' . $CSS_FILE, array(), _S_VERSION, 'all');

                    }
                }
                foreach ($JS_FILES as $JS_FILE) {
                    if (strpos($JS_FILE, '.min.js') !== false) {
                        $file_name = str_replace('.min.js', '', $JS_FILE);
                        wp_enqueue_script('proacto-' . $file_name, get_template_directory_uri() . '/dist/js/blocks/' . $JS_FILE, array(), _S_VERSION, true);
                    }
                }
        };
    }

    add_action('wp_enqueue_scripts', 'enqueue_blocks_styles');
    add_action('enqueue_block_editor_assets', 'enqueue_blocks_styles');

?>