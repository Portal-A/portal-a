<?php
/**
 * Page
 */

get_header();
?>

	<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-c-post pa-l-pb-4 pa-l-py-6') ?>>

		<div class="pa-c-page-content">
		
			<div class="pa-l-container" style="position:relative">

				<h6><?php the_date() ?></h6>

				<h4><?php the_title() ?></h4>
			
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