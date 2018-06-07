<?php

/** 
 * Template Name: Dynamic Child Page
 */

if ( $post->post_parent ) {
    wp_redirect( get_permalink( $post->post_parent ) . "?active_view={$post->post_type}-{$post->ID}" );
}

?>
