<?php

function pa_hero( $args = array() ) {
    global $post;

    $defaults = array(
        'align' => 'center',
        'image_id' => get_post_meta( get_the_ID(), 'hero_image', true ),
        'bg_image_url' => get_the_post_thumbnail_url( $post, 'hero' ),
        'scrim' => has_post_thumbnail( $post ),
        'embed_url' => get_post_meta( get_the_ID(), 'hero_embed', true ),
        'bg_color' => ''
    );

    $args = array_merge( $defaults, $args );
    extract($args);

    $bg_color = $bg_color ?: get_post_meta( get_the_ID(), 'hero_bg_color', true );
    $color = $bg_color ? pa_readable_color( $bg_color ) : '#000';
    
    $has_media = $image_id || $embed_url;

    $class = array( 'pa-c-hero' );
    $class[] = $align === 'left' ? 'is-left-aligned' : '';
    $class[] = $has_media ? 'has-media' : '';
    $class[] = $scrim ? 'has-scrim' : '';
    $class = 'class="'.implode( ' ', $class ).'"';
    
    $style = array(
        "background-image: url($bg_image_url)",
        "background-color: $bg_color",
        "color: $color",
    );
    $style = 'style="'.implode( '; ', $style ).'"';
    
    ob_start(); ?>

    <div <?php echo $class .' '. $style ?> >   

        <?php if ( $scrim ) : ?>
            <span class="pa-c-hero__scrim" style="background-color:<?php echo $bg_color ?>"></span>
        <?php endif; ?>

        <div class="pa-c-hero__content">

            <div class="pa-l-container">
                
                <h1 class="pa-l-my-0 pa-l-mx-auto" style="max-width:830px"><?php echo $post->post_excerpt ?: get_the_title() ?></h1>

            </div>
        
        </div>

        <?php $gradient = "background-image: linear-gradient(to bottom, $bg_color 0, $bg_color 85%, white 85%, white 100%)" ?>

        <?php if ( $has_media ) : ?>

            <div class="pa-c-hero__media pa-l-mt-5" style="<?php echo $gradient ?>">

                <?php if ( $embed_url ) : ?>

                    <div class="pa-c-media--16x9 pa-l-mx-auto" style="max-width:1180px">
                        <?php echo wp_oembed_get( $embed_url ) ?>
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