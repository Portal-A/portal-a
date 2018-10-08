<?php

function pa_hero( $args = array(), $hero_post = 0 ) {
    global $post;

    if ( ! $hero_post && $post ) {
        $hero_post = $post;
    }

    $defaults = array(
        'align' => 'center',
        'image_id' => get_post_meta( $hero_post->ID, 'hero_image', true ),
        'bg_image_url' => get_the_post_thumbnail_url( $hero_post, 'hero' ),
        'scrim' => has_post_thumbnail( $hero_post ),
        'embed_url' => get_post_meta( $hero_post->ID, 'hero_embed', true ),
        'bg_color' => '',
        'title' => '',
        'content' => '',
    );

    $args = array_merge( $defaults, $args );
    extract($args);

    if ( $hero_post && ! $title ) {
        $title = $hero_post->post_excerpt ? nl2br( $hero_post->post_excerpt ) : apply_filters( 'the_title', $hero_post->post_title );
    }

    if ( $image_id ) {
        $bg_image_url = '';
    }

    $bg_color = $bg_color ?: get_post_meta( $hero_post->ID, 'hero_bg_color', true );
    $color = $bg_color ? pa_readable_color( $bg_color ) : '#000';
    // $color = ! $bg_color && ! $bg_image_url ? '#000' : $color;
    
    $has_media = $image_id || $embed_url;

    $class = array( 'pa-c-hero' );
    $class[] = $align === 'left' ? 'is-left-aligned' : '';
    $class[] = $bg_image_url ? 'has-bg-image' : '';
    $class[] = $has_media ? 'has-media' : '';
    $class[] = $scrim ? 'has-scrim' : '';
    $class = 'class="'.implode( ' ', $class ).'"';
    
    $style = array(
        "background-color: $bg_color",
        "color: $color",
    );
    if ( ! $image_id && ! $embed_url ) {
        $style[] = "background-image: url($bg_image_url)";
    }
    $style = 'style="'.implode( '; ', $style ).'"';
    
    ob_start(); ?>

    <div <?php echo $class .' '. $style ?> >   

        <?php if ( $scrim ) : ?>
            <span class="pa-c-hero__scrim" style="background-color:<?php echo $bg_color ?>"></span>
        <?php endif; ?>

        <div class="pa-c-hero__content">

            <div class="pa-l-container">
                
                <h1 class="pa-l-my-0 pa-l-mx-auto" style="max-width:830px"><?php echo $title ?></h1>
                <?php echo $content ?>

            </div>
        
        </div>

        <?php $gradient = "background-image: linear-gradient(to bottom, $bg_color 0, $bg_color 85%, white 85%, white 100%)" ?>

        <?php if ( $has_media ) : ?>

            <div class="pa-c-hero__media pa-l-mt-4" style="<?php echo $gradient ?>">

                <?php if ( $embed_url ) : ?>

                    <div class="pa-l-mx-auto" style="max-width:1100px">
                        <div class="pa-c-media--16x9">
                            <?php echo wp_oembed_get( $embed_url ) ?>
                        </div>
                    </div>

                <?php else : ?>
                
                    <?php echo wp_get_attachment_image($image_id, 'large', false, array( 'class' => 'pa-u-display-block pa-l-mx-auto', 'style' => 'max-width:1180px' )) ?>

                <?php endif; ?>

            </div>

        <?php endif; ?>
        
    </div>

    <?php
    echo ob_get_clean();

}