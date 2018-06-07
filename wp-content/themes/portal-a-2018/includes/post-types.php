<?php
namespace PA\PostTypes;


function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n('cptui_register_my_cpts') );

}

function cptui_register_my_cpts() {

	register_extended_post_type( 'award', array(
		'menu_icon' => 'dashicons-awards'
	) );
	
	register_extended_post_type( 'press', array(
		'menu_icon' => 'dashicons-megaphone',
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes" ),				
	), array(
		"plural" => __( 'Press', '' ),
		"singular" => __( 'Press', '' ),
	) );
	
	register_extended_post_type( 'work', array(
		'menu_icon' => 'dashicons-hammer',
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes" ),				
	), array(
		"plural" => __( 'Work', '' ),
		"singular" => __( 'Work', '' ),
	) );
	
	register_extended_post_type( 'locations', array(
		'menu_icon' => 'dashicons-location',
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes" ),				
	), array(
		"plural" => __( 'Locations', '' ),
		"singular" => __( 'Location', '' ),
	) );
	
	register_extended_post_type( 'team', array(
		'menu_icon' => 'dashicons-admin-users',
		"exclude_from_search" => true,
		"supports" => array( "title", "editor", "excerpt", "custom-fields", "thumbnail", "page-attributes" ),
	), array(
		"plural" => __( 'Team', '' ),
		"singular" => __( 'Team Member', '' ),
	) );
	
	register_extended_post_type( 'client-partners', array(
		'menu_icon' => 'dashicons-groups',
		"supports" => array( "title", "thumbnail" ),
		"has_archive" => true,
		"rewrite" => array( "slug" => "client-partners", "with_front" => true ),
	), array(
		"plural" => __( 'Partners', '' ),
		"singular" => __( 'Partner', '' ),
	) );

}
