<?php
/**
 * Awards
 */
function pa_block_awards( $data, $options = array(), $return = false ) {

    switch( $data['grid'] ) :
        case '4':
            $span = 'span-6-md span-4-lg';
            break;
        case '6':
            $span = 'span-6-md';
            break;
        default :
            $span = 'span-12';
    endswitch;

    $span = 'pa-l-flex ' . $span;

    ob_start();

    ?>

        <div class="pa-c-block--awards pa-l-container">
            
            <div class="pa-l-flexbox pa-l-flex-wrap pa-l-with-gutters">

            <?php foreach ( $data['awards'] as $award ) :
                
                $logo_id = get_post_thumbnail_id( $award ); ?>
                
                <div class="<?php echo $span ?> pa-l-my-2">
                
                    <div class="pa-c-revealer pa-u-text-center">
                        <div class="pa-c-revealer__static">
                            <div class="pa-l-flexbox pa-l-align-center pa-l-justify-center" style="height:5.25rem;">
                                <?php echo wp_get_attachment_image( $logo_id, 'medium', false, array( 'style' => 'max-width:7.5rem;max-height:100%;width:auto;height:auto' ) ) ?>
                            </div>
                            <p class="pa-h4 pa-u-weight-bold"><?php echo get_the_title( $award ); ?></p>
                            <p class="pa-h4 pa-l-mt-0"><?php echo nl2br( get_post_meta( $award, 'award_year', true ) ); ?></p>
                        </div>
                        <div class="pa-c-revealer__active">
                            <p class="pa-h4 pa-l-mt-0 pa-u-weight-bold"><?php echo get_the_title( $award ); ?></p>
                            <p class="pa-h4 pa-l-mt-0"><?php echo nl2br( get_post_meta( $award, 'award_details', true ) ); ?></p>
                        </div>
                    </div>
                
                </div>

            <?php endforeach; ?>

            </div>

		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}