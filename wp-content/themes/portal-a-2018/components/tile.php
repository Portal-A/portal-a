<?php

function pa_tile( $tile ) {

    $defaults = array(
        'columns'      => (string) '',
        'hover'        => (bool) true,
        'has_spacing'  => (bool) false,
        'icon'         => (string) '',
        'image'        => (int) 0,
        'options'      => (array) array(),
        'source_image' => (int) 0,
        'source'       => (string) '',
        'text'         => (string) '',
        'type'         => (string) '',
        'url'          => (string) '',
    );

    $tile = array_merge( $defaults, $tile );
    extract($tile);
    
    ob_start();

        $type = $type;
        $span = pa_get_span( $columns );
        $span = 'pa-l-flex ' . $span;
        $url = $url;
        $tag = $url ? 'a' : 'div';
        $href = $url ? "href=\"$url\"" : "";
        $gutter = $has_spacing ? 'pa-l-mb-gutter' : '';
        $options = $options ? $options : array();
        $is_centered = in_array( 'center', $options );
        $text_align = $is_centered ? 'pa-u-text-center' : '';
        $icon_size = in_array( 'large_icon', $options ) ? 'font-size:4rem' : '';
        $bg_color = $type === 'image' ? 'black' : 'primary';
        $hover = ! $hover ? 'no-hover' : '';
        $image = wp_get_attachment_image_url( $image, 'large' );

        $tile_class = implode( ' ', array( 
            "pa-c-tile", 
            "is-$type", 
            "pa-u-bg-$bg_color",
            $span, 
            $hover, 
        ) );
        ?>

        <?php echo "<$tag $href class=\"$tile_class\" >"?>

            <?php if ( $type === 'image' && $image ) : ?>
                <span class="pa-c-tile__image" style="background-image:url(<?php echo $image ?>)"></span>
            <?php endif; ?>
            
            <div class="pa-c-tile__content">

                <?php if ( ! empty( $icon ) ) : ?>
                    <div><?php echo "<span class=\"pa-b-icon icon-{$icon[0]}\" aria-hidden=\"true\" style=\"$icon_size\"></span>" ?></div>
                <?php endif; ?>

                <?php if ( $text ) : ?>
                <p class="pa-h5 pa-u-weight-bold pa-l-mt-0 <?php echo $text_align ?>"><?php echo $text ?></span>
                <?php endif; ?>
                
                <?php if ( $source_image || $source ) : ?>
                    <p>
                        <?php echo wp_get_attachment_image( $source_image, 'thumbnail', false, array( 'style' => 'max-height: 24px;width:auto;height:auto' ) ) ?>
                        <?php echo $source ?>
                    </p>
                <?php endif; ?>

            </div>
        
        <?php echo "</$tag>" ?>

    <?php
    echo ob_get_clean();

}