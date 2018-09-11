<?php

function pa_cover_media( $args = array(), $echo = true ) {

    if ( empty( $args ) || ! $args['image'] ) {
        return;
    }

    $defaults = array(
        'classes' => array(),
        'image' => 0,
        'image_size' => 'medium',
        'parallax' => false
    );

    $args = array_merge( $defaults, $args );
    
    $image_url = wp_get_attachment_image_url( intval( $args['image'] ), $args['image_size'] );

    if ( $args['parallax'] ) {
        $args['classes'][] = 'js-parallax';
    }

    ob_start(); ?>
    
        <div class="pa-c-cover-media <?php echo implode( ' ', $args['classes'] ) ?>">
            <?php 
            ?>
            <div class="pa-c-cover-media__media <?php echo $args['parallax'] ? 'js-parallax-child' : '' ?>"
                style="background-image:url(<?php echo $image_url ?>)">
            </div>
        </div>

    <?php
    $html = ob_get_clean();

    if ( $echo ) {
        echo $html;
    } else {
        return $html;
    }
    
}