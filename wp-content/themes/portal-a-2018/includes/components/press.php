<?php
/**
 * Press
 */
function pa_block_press( $data, $options = array(), $return = false ) {

    switch( $data['grid'] ) :
        case '4':
            $span = 'pa-l-span-6-md pa-l-span-4-lg';
            break;
        case '6':
            $span = 'pa-l-span-6-md';
            break;
        default :
            $span = 'pa-l-span-12';
    endswitch;

    $span = 'pa-l-flex ' . $span;

    ob_start(); 
    
    ?>

        <div class="pa-c-block--press pa-l-container">
            
            <div class="pa-l-flexbox pa-l-flex-wrap pa-l-with-gutters">

            <?php foreach ( $data['press'] as $press ) :
                
                $press_post = get_post( $press );
                $url = get_post_meta( $press, 'url', true );
                $tag = $url ? 'a' : 'div';
                $href = $url ? "href=\"$url\"" : "";
                $hover = $url ? 'pa-u-color-hover-primary' : '';
                $logo_id = get_post_thumbnail_id( $press ); ?>
                
                <div class="<?php echo $span ?> pa-l-my-2">
                
                    <?php echo "<$tag $href class=\"$hover pa-u-display-block pa-u-text-center\" target=\"_blank\">" ?>
                    <blockquote class="has-quote pa-u-center" style="max-width:16.25rem">
                        <?php echo $press_post->post_content; ?>
                        <cite><?php echo wp_get_attachment_image( $logo_id, 'medium' ) ?></cite>
                    </blockquote>
                    <?php echo "</$tag>" ?>
                
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