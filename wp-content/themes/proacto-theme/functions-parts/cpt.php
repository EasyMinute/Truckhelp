<?php 
//Register CPT and taxonomies for website 


function register_service_centres_cpt() {
	$labels = array(
		'name'                  => _x( 'Service Centres', 'Post type general name', 'proacto' ),
		'singular_name'         => _x( 'Service Centre', 'Post type singular name', 'proacto' ),
		'menu_name'             => _x( 'Service Centres', 'Admin Menu text', 'proacto' ),
		'name_admin_bar'        => _x( 'Service Centre', 'Add New on Toolbar', 'proacto' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'service-centres' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-admin-site',
		'supports'           => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'revisions',
			'custom-fields',
			'page-attributes'
		),
		'show_in_rest'       => true, // Enables Gutenberg editor support
	);

	register_post_type( 'service_centres', $args );
}

function register_services_cpt() {
	$labels = array(
		'name'                  => _x( 'Services', 'Post type general name', 'proacto' ),
		'singular_name'         => _x( 'Service', 'Post type singular name', 'proacto' ),
		'menu_name'             => _x( 'Services', 'Admin Menu text', 'proacto' ),
		'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'proacto' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-admin-tools',
		'supports'           => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'revisions',
			'custom-fields',
			'page-attributes'
		),
		'show_in_rest'       => true, // Enables Gutenberg editor support
	);

	register_post_type( 'services', $args );
}

add_action( 'init', 'register_service_centres_cpt' );
add_action( 'init', 'register_services_cpt' );


?>