<?php
/**
 * Page
 */

get_header();
?>

	<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-c-post pa-l-pb-5') ?>>

		<div class="pa-c-hero is-left-aligned is-fixed">
		
			<div class="pa-c-hero__media pa-c-cover-media js-parallax">
				<?php the_post_thumbnail( 'hero', array( 'class' => 'js-parallax-child' ) ); ?>
			</div>
			
		</div>

		<div class="pa-c-page-content">
		
			<div class="pa-l-container">
				<div class="pa-c-hero-tab">
					<div class="pa-c-hero-tab__inner">
						<p class="pa-h3 pa-l-mt-0"><?php the_date() ?></p>
						<h1 class="pa-h2 pa-u-weight-bold">
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
			</div>

			<div class="pa-l-container" style="position:relative">
			
				<?php pa_block_wysiwyg( array( 
					'wysiwyg' => apply_filters( 'the_content', get_the_content() )
				), array( 
					'class' => 'is-left-aligned',
				) ) ?>

				<p class="pa-c-post__back-link"><a href="<?php echo get_post_type_archive_link( 'post' ) ?>" class="pa-u-color-primary">&lsaquo; Back to blog</a></p>
				
			</div>

			<?php get_template_part( 'partials/blocks' ) ?>

		</div>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>