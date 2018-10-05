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

	if ( $brightness > 150 ) {
		return '#000';
	} else {
		return '#fff';
	}

}

function pa_get_span( $columns = 0 ) {

	switch( $columns ) {
		case 'third':
			$columns = 4;
			break;
		case 'half':
			$columns = 6;
			break;
		default: 
			$columns = $columns;
	}

	$columns = intval( $columns );

	switch( $columns ) :
		case 3:
			$span = 'span-6-md span-3-lg';
			break;
		case 4:
			$span = 'span-6-md span-4-lg';
			break;
		case 5:
			$span = 'span-6-md span-5-lg';
			break;
		case 6:
			$span = 'span-6-md';
			break;
		case 7:
			$span = 'span-12-md span-7-lg';
			break;
		case 8:
			$span = 'span-12-md span-8-lg';
			break;
		case 9:
			$span = 'span-12-md span-9-lg';
			break;
		default :
			$span = 'span-12';
	endswitch;

	return $span;

}