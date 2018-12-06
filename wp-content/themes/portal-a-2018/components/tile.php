<?php

function pa_tile( $tile ) {

    $defaults = array(
        'columns'        => '',
        'content_x'      => 'center',
        'content_y'      => 'center',
        'has_spacing'    => false,
        'icon'           => '',
        'image'          => 0,
        'large_icon'     => false,
        'reveal_content' => true,
        'source_image'   => 0,
        'source'         => '',
        'text_align'     => 'center',
        'text'           => '',
        'type'           => '',
        'url'            => '',
    );

    $tile = array_merge( $defaults, $tile );
    extract($tile);
    
    ob_start();
        
        // layout        
        $span = pa_get_span( $columns );
        $span = 'pa-l-flex ' . $span;

        // attributes
        $text_align = "pa-u-text-$text_align";
        $gutter = $has_spacing ? 'pa-l-mb-gutter' : '';
        $tag = $url ? 'a' : 'div';
        $href = $url ? "href=\"$url\"" : "";
        $icon_size = $large_icon ? 'font-size:4rem' : '';
        
        // appearance
        $reveal = $reveal_content ? 'is-revealed' : '';
        
        // image
        $image = wp_get_attachment_image_url( $image, 'large' );

        $tile_class = implode( ' ', array( 
            "pa-c-tile", 
            "is-$type", 
            $gutter,
            $span,
        ) );

        $tile_content_class = implode( ' ', array( 
            "pa-c-tile__content",
            "x-$content_x",
            "y-$content_y",
            $reveal,
            $text_align,
        ) );
        ?>

        <?php echo "<$tag $href class=\"$tile_class\" >"?>

            <?php if ( $type === 'image' && $image ) : ?>
                <span class="pa-c-tile__image" style="background-image:url(<?php echo $image ?>)"></span>
            <?php endif; ?>
            
            <div class="<?php echo $tile_content_class ?>">

                <?php if ( $type !== 'image' && ! empty( $icon ) ) : ?>
                    <div><?php echo "<span class=\"pa-b-icon icon-{$icon[0]}\" aria-hidden=\"true\" style=\"$icon_size\"></span>" ?></div>
                <?php endif; ?>

                <?php if ( $text ) : ?>
                <p class="pa-h3 pa-u-weight-bold pa-l-mt-0 <?php echo $text_align ?>"><?php echo $text ?></span>
                <?php endif; ?>
                
                <?php if ( $source_image || $source ) : ?>
                    <p>
                        <?php
                        if ( $source_image ) {
                            echo is_int( $source_image ) ? wp_get_attachment_image( $source_image, 'thumbnail', false, array( 'style' => 'max-height: 24px;width:auto;height:auto' ) ) : $source_image;
                        }
                        else { echo $source; }
                        ?>
                    </p>
                <?php endif; ?>

            </div>
        
        <?php echo "</$tag>" ?>

    <?php
    echo ob_get_clean();

}