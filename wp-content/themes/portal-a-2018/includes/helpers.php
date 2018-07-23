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