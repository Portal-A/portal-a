<?php
/**
 * Taxonomies
 */

add_action( 'init', 'cptui_register_my_taxes' );

function cptui_register_my_taxes() {

	$labels = array(
		"name" => __( 'Press Types', '' ),
		"singular_name" => __( 'Press Type', '' ),
		);

	$args = array(
		"label" => __( 'Press Types', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => 1,
		"label" => "Press Types",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'press-types', 'with_front' => false ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "press-types", array( "press" ), $args );



	$labels = array(
		"name" => __( 'Work Featured', '' ),
		"singular_name" => __( 'Work Featured', '' ),
		);

	$args = array(
		"label" => __( 'Work Featured', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => 1,
		"label" => "Work Featured",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'work-featured', 'with_front' => false ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "work-featured", array( "work" ), $args );

// End cptui_register_my_taxes()
}
