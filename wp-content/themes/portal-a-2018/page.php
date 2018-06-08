<?php
/**
 * Page
 */

get_header();
?>

	<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-l-pb-5') ?>>

		<div class="pa-c-hero">
		
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
			) ) ?>
			
		</div>

		<?php get_template_part( 'partials/blocks' ) ?>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>