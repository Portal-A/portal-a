<?php
/**
 * images
 * ------------------------------------------------------- */
function pa_block_images( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--images <?php echo "grid-{$data['grid']}" ?>">

            <div class="pa-c-tiles">
                
                <?php foreach ( $data['images'] as $image ) : ?>
                
                    <div class="pa-c-tile"> 
                        <span><?php echo wp_get_attachment_image( $image['image'], 'large' ) ?></span>
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