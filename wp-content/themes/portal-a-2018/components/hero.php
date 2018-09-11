<?php

function pa_hero( $args = array() ) {
    global $post;

    $defaults = array(
        'align' => 'center',
        'image_url' => get_the_post_thumbnail_url($post, 'hero'),
        'scrim' => has_post_thumbnail($post)
    );

    $args = array_merge( $defaults, $args );
    extract($args);

    $class = array( 'pa-c-hero' );
    $class[] = $align === 'left' ? 'is-left-aligned' : '';
    $class[] = $scrim ? 'has-scrim' : '';
    $class = 'class="'.implode( ' ', $class ).'"';
    
    $media_class = array( 'pa-c-hero__media' );
    $media_class = 'class="'.implode( ' ', $media_class ).'"';

    ob_start(); ?>

    <div <?php echo $class ?> style="background-image:url(<?php echo $image_url ?>)">   

        <div class="pa-c-hero__content pa-l-px-1">
            <h1 class="pa-l-my-0 pa-l-mx-auto" style="max-width:830px"><?php echo $post->post_excerpt ?: get_the_title() ?></h1>
        </div>
        
    </div>

    <?php
    echo ob_get_clean();

}