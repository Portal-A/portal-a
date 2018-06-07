<?php
/**
 * Taxonomies
 */

add_action( 'init', 'pa_register_taxos' );

function pa_register_taxos() {

	register_extended_taxonomy( "work-featured", "work", array(
		"show_admin_column" => true,
	), array(
		"plural" => "Work Featured",
		"singular" => "Work Featured",
		"slug" => "work-featured",
	) );	

	register_extended_taxonomy( 'work_type', 'work', array(
		"show_admin_column" => true,
	) );
	
	register_extended_taxonomy( "press-types", "press", array(
		"show_admin_column" => true,
		'publicly_queryable' => false
	), array(
		"plural" => "Press Types",
		"singular" => "Press Type",
		"slug" => "press-types",
	) );
	
	register_extended_taxonomy( "award-types", "award", array(
		"show_admin_column" => true,
		'publicly_queryable' => false
	), array(
		"plural" => "Award Types",
		"singular" => "Award Type",
		"slug" => "award-types",
	) );


// End cptui_register_my_taxes()
}
