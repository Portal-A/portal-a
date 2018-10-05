<?php
/**
 * tiles
 * ------------------------------------------------------- */
function pa_block_tiles( $data, $options = array(), $return = false ) {

    if ( empty( $data['tiles'] ) )
        return;

    $defaults = array(
        'style' => ''
    );

    $options = array_merge( $defaults, $options );

    $tile_options = $data['tile_options'] ? $data['tile_options'] : array();
    $has_container = in_array( 'container', $tile_options ) ;
    $has_spacing = in_array( 'spacing', $tile_options );

    ob_start(); 
    ?>

        <div class="pa-c-block--tiles <?php echo $has_container ? 'pa-l-container' : '' ?>" style="<?php echo $options['style'] ?>">

            <div class="pa-l-flexbox does-wrap <?php echo $has_spacing ? 'with-gutters' : '' ?>">
    
                <?php foreach ( $data['tiles'] as $tile ) {

                    pa_tile( array_merge( array(
                        'has_spacing' => $has_spacing
                    ), $tile ) );

                } ?>

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
