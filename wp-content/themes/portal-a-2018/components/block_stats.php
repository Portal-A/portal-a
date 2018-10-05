<?php
/**
 * stats
 * ------------------------------------------------------- */
function pa_block_stats( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--stats">

            <?php foreach ( $data['stats'] as $stat ) : ?>
            
            <div class="pa-c-block__stat">
				<div class="pa-c-block__stat-figure pa-h2"><?php echo $stat['figure'] ?></div>
				<div class="pa-c-block__stat-text"><?php echo $stat['text'] ?></div>
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