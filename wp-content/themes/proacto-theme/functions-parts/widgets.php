<?php 
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function proacto_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'News Widget', 'proacto' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'proacto' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Team widget', 'proacto' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'proacto' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Projects widget', 'proacto' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'proacto' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'proacto_widgets_init' );

?>