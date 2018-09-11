<?php

$partners = new WP_Query(array(
    'post_type' => 'client-partners',
    'posts_per_page' => 500
));

ob_start(); ?>

    <div class="pa-l-container" style="max-width:1312px">
        
        <div class="pa-l-flexbox pa-l-flex-wrap pa-l-with-gutters pa-l-mt-5">

            <?php while ( $partners->have_posts() ) : $partners->the_post();
            
                $hex = get_field('partner_hex');
                $link = get_field('partner_custom_link');
                if ( ! $link ) {
                    $partner_work = get_field('partner_work');
                    $link = $partner_work ? get_permalink( $partner_work ) : false;
                }
                $tag = $link ? 'a' : 'div';
                $class = $link ? 'class="pa-u-display-inline-block pa-b-underline-link is-thick"' : 'class="pa-u-display-inline-block"';
                $href = $link ? 'href="'.esc_url($link).'"' : '';
                ?>
            
                <div class="pa-l-flex pa-l-span-6 pa-l-span-4-md pa-l-span-3-lg pa-u-text-center pa-l-mb-4">
                    <?php echo "<$tag $href $class>" ?>
                        <?php the_post_thumbnail( 'medium', array( 'style' => 'display:inline-block; max-width:200px; max-height: 75px; width:auto; height: auto;' ) ) ?>
                        <?php if ( $link ) : ?>
                            <span class="pa-b-underline-bar" role="presentation" style="background-color:<?php echo $hex ?>"></span>
                        <?php endif; ?>
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
