<?php
/*
Single Work
*/

get_header();
?>

    <?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-c-work pa-l-pb-5') ?>>

		<div class="pa-c-hero is-centered">
		
			<div class="pa-c-hero__media pa-c-cover-media">
				<?php the_post_thumbnail( 'hero' ); ?>
			</div>

			<div class="pa-c-hero__tab">
				<h1 class="pa-u-text-center pa-l-mt-0">
					<?php 
					if ( $post->post_excerpt ) :
						echo $post->post_excerpt;
					else :
						the_title();
					endif; 
					?>
				</h1>
			</div>
			
        </div>
        
		<div class="pa-l-container">
		
			<?php pa_block_wysiwyg( array( 
				'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
			), array(
				'style' => 'max-width:700px'
			) ) ?>
			
		</div>

        <?php get_template_part( 'components/blocks' ) ?>
        
        <p class="pa-u-text-center pa-h3 pa-l-mt-4">
            <a href="#view-nav" class="pa-u-display-inline-block js-smooth-scroll">
                <span class="pa-u-display-block pa-l-pb-1">Learn More</span>
                <span class="pa-b-icon icon-arrow-down" aria-hidden="true" style="font-size:2.25rem"></span>
            </a>
        </p>

        <?php
        $children = new WP_Query(array(
            'post_type' => 'page',
            'post_parent' => $post->ID,
            'posts_per_page' => 100,
            'ignore_sticky_posts' => true
        )); 
        
        if ( $children->have_posts() ) : ?>

            <hr class="pa-l-mt-4"/>

            <nav id="view-nav" class="pa-u-text-center pa-l-py-4" aria-label="Child page navigation">
                <?php while ( $children->have_posts() ) : $children->the_post(); ?>
                    
                    <a href="#<?php echo "{$post->post_type}-{$post->ID}" ?>" class="pa-b-filter js-view-toggle"><?php the_title(); ?></a>

                <?php endwhile; ?>
            </nav>

            <?php while ( $children->have_posts() ) : $children->the_post(); ?>

                <article id="<?php echo "{$post->post_type}-{$post->ID}" ?>" class="js-view-target pa-l-mb-4" data-view-top="#view-nav" data-load-content="<?php echo $post->ID; ?>" style="display:none" >

                    <?php get_template_part( 'components/template', $post->post_name ); ?>

                </article>

            <?php endwhile; wp_reset_query(); ?>

            <hr class="pa-l-mb-4"/>

        <?php endif; ?>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>