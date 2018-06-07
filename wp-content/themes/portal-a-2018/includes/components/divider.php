<?php
/**
 * Divider
 * ------------------------------------------------------- */
function pa_block_divider( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <hr class="pa-c-block--divider" />

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}
