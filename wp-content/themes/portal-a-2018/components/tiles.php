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

            <div class="pa-l-flexbox pa-l-flex-wrap <?php echo $has_spacing ? 'pa-l-with-gutters' : '' ?>">

                <?php foreach ( $data['tiles'] as $tile ) :
                    
                    switch( $tile['columns'] ) :
                        case '3':
                            $span = 'span-6-md span-3-lg';
                            break;
                        case 'third':
                        case '4':
                            $span = 'span-6-md span-4-lg';
                            break;
                        case '5':
                            $span = 'span-6-md span-5-lg';
                            break;
                        case 'half':
                        case '6':
                            $span = 'span-6-md';
                            break;
                        case '7':
                            $span = 'span-12-md span-7-lg';
                            break;
                        case '8':
                            $span = 'span-12-md span-8-lg';
                            break;
                        case '9':
                            $span = 'span-12-md span-9-lg';
                            break;
                        default :
                            $span = 'span-12';
                    endswitch;
                    
                    $type = $tile['type'];
                    $span = 'pa-l-flex ' . $span;
                    $url = $tile['url'];
                    $tag = $url ? 'a' : 'div';
                    $href = $url ? "href=\"$url\"" : "";
                    $gutter = $has_spacing ? 'pa-l-mb-gutter' : '';
                    $options = $tile['options'] ? $tile['options'] : array();
                    $is_centered = in_array( 'center', $options );
                    $text_align = $is_centered ? 'pa-u-text-center' : '';
                    $icon_size = in_array( 'large_icon', $options ) ? 'font-size:4rem' : '';
                    $bg_color = $type === 'image' ? 'black' : 'primary' ?>

                    <?php echo "<$tag $href class=\"pa-c-tile $span is-$type pa-u-bg-$bg_color\" >"?>

                        <?php if ( $type === 'image' ) : ?>
                            <span class="pa-c-tile__image" style="background-image:url(<?php echo wp_get_attachment_image_url($tile['image'], 'large') ?>)"></span>
                        <?php endif; ?>
                        
                        <div class="pa-c-tile__content">

                            <?php if ( ! empty( $tile['icon'] ) ) : ?>
                                <div><?php echo "<span class=\"pa-b-icon icon-{$tile['icon'][0]}\" aria-hidden=\"true\" style=\"$icon_size\"></span>" ?></div>
                            <?php endif; ?>

                            <?php if ( $tile['text'] ) : ?>
                            <p class="pa-h5 pa-u-weight-bold pa-l-mt-0 <?php echo $text_align ?>"><?php echo $tile['text'] ?></span>
                            <?php endif; ?>
                            
                            <?php if ( $tile['source_image'] || $tile['source'] ) : ?>
                                <p>
                                    <?php echo wp_get_attachment_image( $tile['source_image'], 'thumbnail', false, array( 'style' => 'max-height: 24px;width:auto;height:auto' ) ) ?>
                                    <?php echo $tile['source'] ?>
                                </p>
                            <?php endif; ?>

                        </div>
                    
                    <?php echo "</$tag>" ?>

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
