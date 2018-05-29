<?php

/** 
 * Template Name: Dynamic Child Page
 */

if ( $post->post_parent ) {
    wp_redirect( get_permalink( $post->post_parent ) . "?pa_redirect_to={$post->post_type}-{$post->ID}" );
}

?>
