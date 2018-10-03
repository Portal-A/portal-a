<?php
function pa_work_preview() {
    global $post;

    ob_start(); ?>

        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="pa-c-cover-media does-scale with-scrim" style="min-height:400px">
            <?php the_post_thumbnail( 'hero' ) ?>
            <div class="pa-c-cover-media__content use-light-ui align-end" style="max-width:750px">
                <p>
                    <?php 
                    if ( $client_image_id = get_post_meta( get_the_ID(), 'client_image', true ) ) {
                        echo wp_get_attachment_image( $client_image_id, 'full', false, array( 'style' => 'width:auto;height:auto;max-width:70px;max-height:70px' ) );
                    } else {
                        echo get_post_meta( get_the_ID(), 'client', true );
                    } ?>
                </p>
                <p class="pa-h4 pa-l-mt-nudge"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></p>
            </div>
        </a>

    <?php
    echo ob_get_clean();

}