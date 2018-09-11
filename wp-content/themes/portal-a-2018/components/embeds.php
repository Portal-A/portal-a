<?php
/**
 * embeds
 * ------------------------------------------------------- */
function pa_block_embeds( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--embeds <?php echo "grid-{$data['grid']}" ?>">

            <?php foreach ( $data['embeds'] as $embed ) : ?>

			<div class="pa-c-block--embeds-item">
				<div class="pa-c-block__video pa-c-media--16x9">
					<?php echo $embed['oEmbed'] ?>
				</div>
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