<?php
/**
 * blockquote
 * ------------------------------------------------------- */
function pa_block_blockquote( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--blockquote">
			<blockquote>
                <?php 
                echo $data['text'];
                $cite_image = wp_get_attachment_image( $data['cite'], 'medium' );
                if ( $cite_image ) : ?>
                    <cite><?php echo $cite_image ?></cite>
                <?php endif; ?>
			</blockquote>
		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}