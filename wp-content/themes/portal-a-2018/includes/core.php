<?php
namespace PA\Core;


function setup() {
    $n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    
    add_action( 'after_setup_theme', $n('theme_setup') );
    add_action( 'wp_enqueue_scripts', $n('scripts') );
    add_action( 'wp_enqueue_scripts', $n('styles') );
    
}

function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
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

