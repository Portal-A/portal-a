<?php
/*
Template Name: About
*/

get_header();
?>

    <?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-c-work pa-l-pb-5') ?>>

		<?php pa_hero() ?>

        <div class="pa-c-page-content">
            
            <div class="pa-l-container">
            
                <?php pa_block_wysiwyg( array( 
                    'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
                ) ) ?>
                
            </div>

            <?php get_template_part( 'partials/blocks' ) ?>
        

            <?php
            $children = new WP_Query(array(
                'post_type' => 'page',
                'post_parent' => $post->ID,
                'posts_per_page' => 100,
                'ignore_sticky_posts' => true,
                'orderby' => 'menu_order title',
                'order' => 'ASC'
            )); 
            
            if ( $children->have_posts() ) : ?>

                <hr class="pa-l-mt-4"/>

                <nav id="view-nav" class="pa-c-view-nav pa-u-text-center pa-l-pt-4" aria-label="Child page navigation">
                    <?php while ( $children->have_posts() ) : $children->the_post(); ?>
                        
                        <a href="#<?php echo "{$post->post_type}-{$post->ID}" ?>" class="pa-b-view-toggle js-view-toggle"><?php the_title(); ?></a>

                    <?php endwhile; ?>
                </nav>

                <?php while ( $children->have_posts() ) : $children->the_post();
                
                    $is_start_view = get_post_meta($post->ID, 'start_page', true) ? 'js-view-start' : ''; ?>

                    <article id="<?php echo "{$post->post_type}-{$post->ID}" ?>" 
                             class="js-view-target pa-l-mb-4 <?php echo $is_start_view ?>"
                             data-view-top="#view-nav" 
                             data-load-content="<?php echo $post->ID; ?>" 
                             style="display:none" >

                        <?php get_template_part( 'partials/template', $post->post_name ); ?>

                    </article>

                <?php endwhile; wp_reset_query(); ?>

            <?php endif; ?>

        </div>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>