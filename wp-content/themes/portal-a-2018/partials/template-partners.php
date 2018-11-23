<?php

$partners = new WP_Query(array(
    'post_type' => 'client-partners',
    'posts_per_page' => 500
));

ob_start(); ?>

    <div class="pa-l-container" style="max-width:1312px">
        
        <div class="pa-l-flexbox does-wrap with-gutters pa-l-mt-5">

            <?php while ( $partners->have_posts() ) : $partners->the_post();
            
                $hex = get_field('partner_hex');
                $link = get_field('partner_custom_link');
                if ( ! $link ) {
                    $partner_work = get_field('partner_work');
                    $link = $partner_work ? get_permalink( $partner_work ) : false;
                }
                $tag = $link ? 'a' : 'div';
                $class = $link ? 'class="pa-c-media--4x3 pa-u-display-block pa-u-faded-hover pa-u-transition"' : 'class="pa-c-media--4x3"';
                $href = $link ? 'href="'.esc_url($link).'"' : '';
                $style = "style=\"background-color:$hex\""
                ?>
            
                <div class="pa-l-flex span-6 span-4-md span-3-lg" style="margin-bottom:8px">
                    <?php echo "<$tag $href $class $style>" ?>
                        <?php the_post_thumbnail( 'medium', array( 'class' => 'absolute-center', 'style' => 'max-width:200px; max-height: 75px; width:auto; height: auto;' ) ) ?>                        
                    <?php echo "</$tag>" ?>
                </div>

            <?php endwhile; ?>

        </div>

    </div>

    <p class="pa-u-text-center pa-l-mt-5">
        <a href="<?php echo site_url('work/'); ?>" class="pa-b-button">View All Work</a>
    </p>

<?php $html = ob_get_clean(); ?>

<script type="html/mustache-template">
    
    {{ #content.rendered }}
    
        <div class="pa-c-block--wysiwyg">

            {{{ content.rendered }}}
            
        </div>

    {{ /content.rendered }}

    <?php echo $html ?>

    {{{ blocks }}}

</script>	
