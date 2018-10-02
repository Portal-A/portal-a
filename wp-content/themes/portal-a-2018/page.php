<?php
/**
 * Page
 */

get_header();
?>

	<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-l-pb-5') ?>>

		<?php pa_hero() ?>

		<div class="pa-c-page-content">

			<div class="pa-l-container">
			
				<?php pa_block_wysiwyg( array( 
					'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
				) ) ?>
				
			</div>

			<?php get_template_part( 'partials/blocks' ) ?>

		</div>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>