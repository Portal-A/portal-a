<?php
/**
 * Post Types
 */

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_cpts() {

	$labels = array(
		"name" => __( 'Press', '' ),
		"singular_name" => __( 'Press', '' ),
		);

	$args = array(
		"label" => __( 'Press', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => true,
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes" ),				
	);
	register_post_type( "press", $args );

	$labels = array(
		"name" => __( 'Work', '' ),
		"singular_name" => __( 'Work', '' ),
		);

	$args = array(
		"label" => __( 'Work', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => true,
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes" ),				
	);
	register_post_type( "work", $args );


	$labels = array(
		"name" => __( 'Locations', '' ),
		"singular_name" => __( 'Location', '' ),
		);

	$args = array(
		"label" => __( 'Locations', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => true,
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes" ),				
	);
	register_post_type( "locations", $args );


	$labels = array(
		"name" => __( 'Team', '' ),
		"singular_name" => __( 'Team Member', '' ),
		);

	$args = array(
		"label" => __( 'Team', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"publicly_queryable" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => true,
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "custom-fields", "thumbnail", "page-attributes" ),				
	);
	register_post_type( "team", $args );


	$labels = array(
		"name" => __( 'Home Projects', '' ),
		"singular_name" => __( 'Home Project', '' ),
		);

	$args = array(
		"label" => __( 'Home Projects', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => true,
		"query_var" => true,
				
		"supports" => array( "title", "editor", "thumbnail" ),				
	);
	register_post_type( "home-projects", $args );

	$labels = array(
		"name" => __( 'Leadership', '' ),
		"singular_name" => __( 'Leader', '' ),
		);

	$args = array(
		"label" => __( 'Leadership', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "partners", "with_front" => true ),
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes" ),				
	);
	register_post_type( "partners", $args );

	$labels = array(
		"name" => __( 'Partners', '' ),
		"singular_name" => __( 'Partner', '' ),
		);

	$args = array(
		"label" => __( 'Partners', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "client-partners", "with_front" => true ),
		"query_var" => true,
				
		"supports" => array( "title", "thumbnail" ),				
	);
	register_post_type( "client-partners", $args );

	$labels = array(
		"name" => __( 'Capabilities', '' ),
		"singular_name" => __( 'Capability', '' ),
		);

	$args = array(
		"label" => __( 'Capabilities', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "service", "with_front" => true ),
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),				
	);
	register_post_type( "service", $args );

	// $labels = array(
	// 	"name" => __( 'About', '' ),
	// 	"singular_name" => __( 'About', '' ),
	// 	);

	// $args = array(
	// 	"label" => __( 'About', '' ),
	// 	"labels" => $labels,
	// 	"description" => "",
	// 	"public" => true,
	// 	"show_ui" => true,
	// 	"show_in_rest" => false,
	// 	"rest_base" => "",
	// 	"has_archive" => false,
	// 	"show_in_menu" => true,
	// 	"exclude_from_search" => false,
	// 	"capability_type" => "post",
	// 	"map_meta_cap" => true,
	// 	"hierarchical" => false,
	// 	"rewrite" => array( "slug" => "about", "with_front" => true ),
	// 	"query_var" => true,
				
	// 	"supports" => array( "title", "editor", "thumbnail" ),				
	// );
	// register_post_type( "about", $args );

// End of cptui_register_my_cpts()
}
