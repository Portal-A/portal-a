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


// End cptui_register_my_taxes()
}
