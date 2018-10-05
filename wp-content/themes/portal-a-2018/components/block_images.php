<?php
/**
 * images
 * ------------------------------------------------------- */
function pa_block_images( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--images">

            <div class="pa-l-flexbox does-wrap">
                
                <?php foreach ( $data['images'] as $image ) : ?>
                
                    <div class="pa-l-flex <?php echo pa_get_span( 12 / $data['grid'] ) ?>">
                        <?php echo wp_get_attachment_image( $image['image'], 'large' ) ?>
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