<?php
/**
 * images
 * ------------------------------------------------------- */
function pa_block_images( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--images <?php echo "grid-{$data['grid']}" ?>">
            
            <?php foreach ( $data['images'] as $image ) : ?>
            
                <div class="pa-c-block__images-item"> 
                    <?php echo wp_get_attachment_image( $image['image'], 'large' ) ?>    
                </div>
            
            <?php endforeach; ?>

		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}