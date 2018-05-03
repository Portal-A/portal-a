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
    
    remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_generator' );
}

function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}


function scripts() {
    wp_enqueue_script('theme_scripts', PA_ASSETS . 'js/scripts.js', 'jquery', '', true);
    wp_deregister_script('comment-reply');
}


function styles() {
	$min = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min';

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