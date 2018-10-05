<?php
/**
 * statement
 * ------------------------------------------------------- */
function pa_block_statement( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--statement">
			<?php echo $data['statement'] ?>
		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}