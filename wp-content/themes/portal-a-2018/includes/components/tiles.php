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
                            $span = 'pa-l-span-6-md pa-l-span-3-lg';
                            break;
                        case 'third':
                        case '4':
                            $span = 'pa-l-span-6-md pa-l-span-4-lg';
                            break;
                        case '5':
                            $span = 'pa-l-span-6-md pa-l-span-5-lg';
                            break;
                        case 'half':
                        case '6':
                            $span = 'pa-l-span-6-md';
                            break;
                        case '7':
                            $span = 'pa-l-span-12-md pa-l-span-7-lg';
                            break;
                        case '8':
                            $span = 'pa-l-span-12-md pa-l-span-8-lg';
                            break;
                        case '9':
                            $span = 'pa-l-span-12-md pa-l-span-9-lg';
                            break;
                        default :
                            $span = 'pa-l-span-12';
                    endswitch;
                    
                    $span = 'pa-l-flex ' . $span;
                    $url = $tile['url'];
                    $tag = $url ? 'a' : 'div';
                    $href = $url ? "href=\"$url\"" : "";
                    $gutter = $has_spacing ? 'pa-l-mb-gutter' : ''; ?>


                    <?php if ( $tile['type'] === 'image' ) :

    
                        $options = $tile['image_options'] ? $tile['image_options'] : array();
                        $image_meta = wp_get_attachment_metadata( $tile['image'] );
                        $ratio = ($image_meta['height'] / $image_meta['width']) * 100;
                        $proportional_image = in_array( 'proportional_image', $options );
                        $padding = $proportional_image ? $ratio / ( 12 / $tile['columns'] ) : 0;
                        $effects = $url ? 'does-scale does-fade' : ''; ?>

                        <?php echo "<$tag $href class=\"pa-c-cover-media $span $gutter $effects\" style=\"padding-top:{$padding}%\">"?>
                            <?php echo wp_get_attachment_image( $tile['image'], 'large' ); ?>
                            <?php if ( $tile['text'] ) : ?>
                                <div class="pa-c-cover-media__content is-animated fade-in from-bottom use-light-ui pa-u-text-center" style="width:100%">
                                    <p class="pa-h4 pa-l-mt-0"><?php echo $tile['text'] ?></p>
                                </div>
                            <?php endif; ?>
                        <?php echo "</$tag>" ?>


                    <?php else :
                     
                     
                        $options = $tile['options'] ? $tile['options'] : array();
                        $effects = $url ? 'pa-u-scale-hover pa-u-transition-slow' : '';
                        $is_centered = in_array( 'center', $options );
                        $text_align = $is_centered ? 'pa-u-text-center' : '';
                        $padding = $is_centered ? 'pa-l-py-3 pa-l-px-1' : 'pa-l-pa-3';
                        $icon_size = in_array( 'large_icon', $options ) ? 'font-size:4rem' : ''; ?>

                        <?php echo "<div class=\"$span $gutter $padding pa-l-flexbox pa-l-flex-wrap pa-l-align-center pa-l-justify-space-between pa-u-bg-primary pa-u-color-white\">" ?>
                            <?php echo "<$tag $href class=\"pa-u-display-block $effects $text_align\" style=\"width:100%\">"; ?>
                                <p class="pa-l-mt-0">
                                    <?php echo "<span class=\"pa-b-icon icon-{$tile['icon']}\" aria-hidden=\"true\" style=\"$icon_size\"></span>" ?>
                                </p>
                                <p style="max-width:450px">
                                    <span class="pa-u-weight-bold"><?php echo $tile['text'] ?></span>
                                </p>
                                <p class="pa-h3 pa-l-align-self-end pa-u-weight-light">
                                    <?php echo wp_get_attachment_image( $tile['source_image'], 'thumbnail', false, array( 'style' => 'max-height: 24px;width:auto;height:auto' ) ) ?>
                                    <?php echo $tile['source'] ?>
                                </p>
                            <?php echo "</$tag>" ?>
                        </div>


                    <?php endif; ?>

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
