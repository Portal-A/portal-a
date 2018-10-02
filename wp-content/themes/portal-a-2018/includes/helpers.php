<?php

function pa_is_blog() {
	// global $post;

	// $page_for_posts = get_option( 'page_for_posts' );
	 
	if ( is_home() || is_category() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Calculate whether black or white is best for readability based upon the brightness of specified colour
 *
 * @param type $hex
 */
function pa_readable_color( $hex ) {

	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1), 2 );
	}

	$color_parts = str_split( $hex, 2 );

	$brightness = ( hexdec( $color_parts[0] ) * 0.299 ) + ( hexdec( $color_parts[1] ) * 0.587 ) + ( hexdec( $color_parts[2] ) * 0.114 );

	if ( $brightness > 128 ) {
		return '#000';
	} else {
		return '#fff';
	}

}