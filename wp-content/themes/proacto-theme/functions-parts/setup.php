<?php
/**
 * proacto functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package proacto
 */

if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function proacto_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'proacto_content_width', 640 );
}
add_action( 'after_setup_theme', 'proacto_content_width', 0 );

function proacto_disable_comments() {
    global $wpdb;

    // Disable comments on new articles
    update_option( 'default_comment_status', 'closed' );

    // Disable comment moderation
    update_option( 'comment_moderation', 0 );

    // Remove existing comments
    $wpdb->query( "DELETE FROM $wpdb->comments" );

    // Remove "Comments" from admin bar
    //remove_menu_page( 'edit-comments.php' );

}
add_action( 'after_setup_theme', 'proacto_disable_comments' );

function proacto_remove_menu_items() {
    remove_menu_page( 'edit-comments.php' );
    remove_submenu_page( 'edit.php', 'edit-comments.php' );
    remove_submenu_page( 'edit.php?post_type=page', 'edit-comments.php' );
}
add_action( 'admin_menu', 'proacto_remove_menu_items' );


function proacto_add_theme_support() {

    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support(
        'custom-logo',
        array(
            'height'      => 182,
            'width'       => 50,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    add_theme_support(
        'html5',
        array(
            'search-form',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );
}
add_action('init', 'proacto_add_theme_support');
function proacto_remove_posts_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'post', 'trackbacks');
    remove_post_type_support( 'page', 'comments' );
}
add_action('init', 'proacto_remove_posts_support');

//svg upload support
function proacto_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'proacto_svg_upload');

function proacto_svg_upload_override( $checked, $file, $filename, $mimes ) {
    if ( ! $checked['type'] ) {
        $wp_filetype = wp_check_filetype( $filename, $mimes );

        $ext = $wp_filetype['ext'];
        $type = $wp_filetype['type'];
        $proper_filename = $filename;

        return compact( 'ext', 'type', 'proper_filename' );
    }

    return $checked;
}
add_filter( 'wp_check_filetype_and_ext', 'proacto_svg_upload_override', 10, 4 );




?>