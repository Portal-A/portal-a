<?php
/**
 * banner
 * ------------------------------------------------------- */
function pa_block_banner( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--banner">
            <h2 class="pa-u-uppercase pa-u-weight-bold pa-l-ma-0 pa-l-py-1 pa-l-px-gutter pa-u-text-center"><?php echo $data['text'] ?></h2>
		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}