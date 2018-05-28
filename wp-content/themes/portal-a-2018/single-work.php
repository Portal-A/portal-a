<?php
/*
Single Work
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
				<?php 
				if ( $client_image_id = get_post_meta( get_the_ID(), 'client_image_dark', true ) ) {
					echo wp_get_attachment_image( $client_image_id, 'full' );
				} else {
					echo get_post_meta( get_the_ID(), 'client', true );
				} ?>
			</div>
			
		</div>


		<h1 class="pa-u-text-center"><?php the_title(); ?></h1>

		<?php get_template_part( 'components/blocks' ); ?>

		<p class="pa-u-text-center pa-l-mt-5">
			<a href="<?php echo site_url('work/'); ?>" class="pa-b-button">View All Work</a>
		</p>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>