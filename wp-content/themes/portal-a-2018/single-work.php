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

		</div>

		<div class="pa-c-work__client">
			<?php 
			if ( $client_image_id = get_post_meta( get_the_ID(), 'client_image', true ) ) {
				echo wp_get_attachment_image( $client_image_id, 'full' );
			} else {
				echo get_post_meta( get_the_ID(), 'client', true );
			} ?>
		</div>

		<h1 class="pa-u-text-center pa-l-mt-0"><?php the_title(); ?></h1>

		<div class="pa-c-block--wysiwyg">
			<h2>We partnered with Simone Giertz to create a horrifying and hilarious robot. We partnered with Simone Giertz to create a horrifying and hilarious.</h2>
		</div>
		
		<div class="pa-c-block--stats">
			<div class="pa-c-block__stat">
				<div class="pa-c-block__stat-figure pa-h2">130k</div>
				<div class="pa-c-block__stat-text">Hero video views in the first week</div>
			</div>
			<div class="pa-c-block__stat">
				<div class="pa-c-block__stat-figure pa-h2">130k</div>
				<div class="pa-c-block__stat-text">Hero video views in the first week</div>
			</div>
			<div class="pa-c-block__stat">
				<div class="pa-c-block__stat-figure pa-h2">130k</div>
				<div class="pa-c-block__stat-text">Hero video views in the first week</div>
			</div>
		</div>

		<div class="pa-c-block--embed">
			<div class="pa-c-block__video pa-c-media--16x9">
				<?php echo get_field( "video_embed_code" ); ?>
			</div>
		</div>

		<div class="pa-c-block--wysiwyg">
			<div class="pa-c-block__title pa-h3">
				The Process
			</div>
			<p>Simone’s Westworld robot created a huge disturbance in the digital community. In the first day of launch, the campaign hit 400k views across all the content. Both Simone and HBO Westworld social channels publicized the video with multitudes of social posts and assets.</p>
			<p>Simone’s Westworld robot created a huge disturbance in the digital community. In the first day of launch, the campaign hit 400k views across all the content. </p>
		</div>

		<div class="pa-c-block--images grid-2">
			<div class="pa-c-block__images-item"><img src="//picsum.photos/1200/600" /></div>
			<div class="pa-c-block__images-item"><img src="//picsum.photos/1200/600" /></div>
		</div>

		<div class="pa-c-block--blockquote">
			<blockquote>
				A hilariously horrible Westworld knockoff robot created by Simone Giertz...
			</blockquote>
			<cite>AdWeek</cite>
		</div>


	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>