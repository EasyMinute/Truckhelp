<?php
/**
 * This file is used to register ACF Gutenberg blocks
 *
 * @package Proacto
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * This class customizes and configures the plugin ACF
 */
class Acf_Config {

    /**
     * Constructor
     */
    public function __construct() {

        $this->int_add_option_pages();
        add_action( 'acf/init', array( $this, 'pr_register_acf_gutenberg_block_types' ), 10 );
        add_filter( 'block_categories_all', array( $this, 'pr_add_custom_block_category' ), 10, 2 );

    }
    protected function int_add_option_pages() {

        if( function_exists('acf_add_options_page') ) {

            acf_add_options_page(array(
                'page_title' 	=> 'Theme General Settings',
                'menu_title'	=> 'Theme settings',
                'menu_slug' 	=> 'theme-general-settings',
                'capability'	=> 'edit_posts',
                'redirect'		=> false
            ));

            acf_add_options_sub_page(array(
                'page_title' 	=> 'Theme Header Settings',
                'menu_title'	=> 'Header',
                'parent_slug'	=> 'theme-general-settings',
            ));

            acf_add_options_sub_page(array(
                'page_title' 	=> 'Theme Footer Settings',
                'menu_title'	=> 'Footer',
                'parent_slug'	=> 'theme-general-settings',
            ));

        }

    }

    /**
     * Register acf blocks for Gutenberg editor
     *
     * @return void
     */
    public function pr_register_acf_gutenberg_block_types() {
        //Set block names comma separated
	    $blocks = array(
			array(
				'name' => 'baner',
				'title' => __('Baner', 'proacto'),
				'description' => __('Main page baner', 'proacto'),
				'icon' => 'cover-image'
			),
		    array(
			    'name' => 'services_grid',
			    'title' => __('Services grid', 'proacto'),
			    'description' => __('Main services grid', 'proacto'),
			    'icon' => 'admin-tools'
		    ),
		    array(
			    'name' => 'cta_image',
			    'title' => __('CTA Image', 'proacto'),
			    'description' => __('Image on bg, text and cta', 'proacto'),
			    'icon' => 'welcome-view-site'
		    ),
		    array(
			    'name' => 'image_text',
			    'title' => __('Text & image', 'proacto'),
			    'description' => __('Image with text and button', 'proacto'),
			    'icon' => 'align-pull-left'
		    ),
		    array(
			    'name' => 'latest_news',
			    'title' => __('Latest news', 'proacto'),
			    'description' => __('Block with latest news', 'proacto'),
			    'icon' => 'sticky'
		    ),
		    array(
			    'name' => 'map_section',
			    'title' => __('Map Section', 'proacto'),
			    'description' => __('Block with map and service centers', 'proacto'),
			    'icon' => 'location'
		    ),
		    array(
			    'name' => 'links_slider',
			    'title' => __('Links Slider', 'proacto'),
			    'description' => __('Slider with images with links on different pages', 'proacto'),
			    'icon' => 'slides'
		    ),
		    array(
			    'name' => 'seo_text',
			    'title' => __('SEO text', 'proacto'),
			    'description' => __('Block with more text', 'proacto'),
			    'icon' => 'text'
		    ),
		    array(
			    'name' => 'price_table',
			    'title' => __('Price table', 'proacto'),
			    'description' => __('Price table', 'proacto'),
			    'icon' => 'editor-table'
		    ),
		    array(
			    'name' => 'gallery',
			    'title' => __('Gallery', 'proacto'),
			    'description' => __('Slider gallery', 'proacto'),
			    'icon' => 'format-gallery'
		    ),
		    array(
			    'name' => 'contact_form',
			    'title' => __('Contact form', 'proacto'),
			    'description' => __('Contact form', 'proacto'),
			    'icon' => 'format-chat'
		    ),
		    array(
			    'name' => 'products_grid',
			    'title' => __('Products grid', 'proacto'),
			    'description' => __('Products grid', 'proacto'),
			    'icon' => 'products'
		    ),
	    );
        $block_names = array(
            'default',
        );

        if ( function_exists( 'acf_register_block_type' ) ) {

            foreach ( $blocks as $block ) {
                acf_register_block_type(
                    array(
                        'name'            => $block['name'] . '-block',
                        'title'           => $block['title'] . ' | ' . __( ' Proacto', 'proacto' ),
                        'description'     => $block['description'] . __( ' : ACF block for Gutenberg Editor', 'proacto' ),
                        'render_template' => 'template-parts/blocks/pr-' . $block['name'] . '.php',
                        'category'        => 'proacto-custom-blocks',
                        'icon'            => $block['icon'],
                        'mode'            => 'edit',
                        'supports'        => array(
                            'mode' => false,
                        ),
                    )
                );
            }
        }
    }

    /**
     * Add custom block category
     */
    public function pr_add_custom_block_category( $categories, $post ) {
        $desired_position = 0;
        $pr_category = array(
            'slug'  => 'proacto-custom-blocks',
            'title' => 'Proacto Blocks',
            'icon'  => 'block-default',
        );

        array_splice( $categories, $desired_position, 0, array( $pr_category ) );

        return $categories;
    }
}

if ( class_exists( 'Acf_Config' ) ) {

    new Acf_Config();
}
