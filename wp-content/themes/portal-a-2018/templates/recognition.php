<?php
/**
 * Template Name: Recognition
 */

get_header();
?>

	<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-c-work pa-l-pb-5') ?>>

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

		<p class="pa-u-text-center"><button class="pa-b-button js-reveal" data-target="all-recognition">View All</button></p>

		<div id="all-recognition" data-load-content="<?php echo rest_url( 'recognition' ) ?>">
			
			<script type="html/mustache-template">
			
				<h3 class="pa-l-mt-5 pa-u-faded" style="font-size:14px">Awards</h3>
				<ul class="pa-l-mt-2 pa-u-clean-list">
					{{#awards}}
					<li class="pa-l-mb-2">
						<span class="pa-h6 pa-l-mt-0 title" style="font-size:14px">{{ title }}</span>
						<span class="image pa-u-faded">{{ image }}</span>
					</li>
					{{/awards}}
				</ul>
				
				<h3 class="pa-l-mt-5 pa-u-faded" style="font-size:14px">Press</h3>
				<ul class="pa-l-mt-2 pa-u-clean-list">
					{{#awards}}
					<li class="pa-l-mb-2">
						<span class="pa-h6 pa-l-mt-0 title" style="font-size:14px">{{ title }}</span>
						<span class="image pa-u-faded">{{ image }}</span>
					</li>
					{{/awards}}
				</ul>

			</script>

		</div>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>