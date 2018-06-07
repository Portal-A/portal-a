<?php

while( have_rows('blocks') ) : the_row();

    $block_fn = 'pa_block_' . get_row_layout();

    if ( function_exists( $block_fn ) ) {
 
        $block_fn( get_row(true) );
 
    }

endwhile;

?>