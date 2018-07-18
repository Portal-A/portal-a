<?php
namespace PA\Core;


function setup() {
    $n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};
    
    add_action( 'after_setup_theme', $n('theme_setup') );
    add_action( 'wp_enqueue_scripts', $n('scripts') );
    add_action( 'wp_enqueue_scripts', $n('styles') );
    add_action( 'init', $n( 'add_menus' ) );
    add_action( 'pre_get_posts', $n( 'custom_queries' ) );
    
    remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_generator' );
}

function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('post-excerpt');
    add_theme_support('automatic-feed-links');
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		) );
	
	add_image_size( 'hero', 1440, 810, true );

	add_post_type_support( 'page', array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ));
	remove_post_type_support( 'page', 'comments' );
	remove_post_type_support( 'page', 'revisions' );
	remove_post_type_support( 'page', 'author' );
}


function scripts() {
	global $wp_query;
	
	if ( is_home() && ! is_front_page() ) {
		wp_enqueue_script('slick', PA_ASSETS . 'js/slick.min.js', array('jquery'), '', true);
	}
	wp_enqueue_script('theme_scripts', PA_ASSETS . 'js/scripts.js', '', '', true);

	wp_localize_script( 'theme_scripts', 'PA', array(
		'api' => get_rest_url( null, 'wp/v2/' ),
		'wp_query' => ( is_home() && ! is_front_page() ) ? $wp_query : array()
	) );
	
	wp_deregister_script('comment-reply');
}


function styles() {
	$min = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min';

	if ( is_home() && ! is_front_page() ) {
		wp_enqueue_style( 'slick', PA_ASSETS . "css/slick.css", array(), PA_VERSION );
	}

	wp_enqueue_style(
		'style',
		PA_ASSETS . "css/style{$min}.css",
		array(),
		PA_VERSION
	);
}


function add_menus() {
    register_nav_menus( array(
        'header' => 'Header'
    ) );
}


function custom_queries($query) {
	if ( ! is_admin() && $query->is_main_query() ) {

		if ( $query->is_home() || is_archive() ) {
			$query->set( 'posts_per_page', 9 );
		}

	}
}