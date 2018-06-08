<?php
/**
 * blockquote
 * ------------------------------------------------------- */
function pa_block_blockquote( $data, $options = array(), $return = false ) {

    $url = array_key_exists( 'url', $data ) ? $data['url'] : '';
    $tag = $url ? 'a' : '';
    $href = $url ? "href=\"$url\"" : "";
    
    ob_start(); 
    
    ?>

        <div class="pa-c-block--blockquote pa-l-container">
            
            <?php echo $tag ? "<$tag $href class=\"pa-u-display-block pa-u-color-hover-primary\" target=\"_blank\">" : "" ?>
                
                <blockquote>
                    <?php 
                    echo $data['text'];
                    $cite_image = wp_get_attachment_image( $data['cite'], 'medium' );
                    if ( $cite_image ) : ?>
                        <cite><?php echo $cite_image ?></cite>
                    <?php endif; ?>
                </blockquote>

            <?php echo $tag ? "</$tag>" : "" ?>

		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}