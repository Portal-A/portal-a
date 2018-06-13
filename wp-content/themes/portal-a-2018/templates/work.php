<?php
/*
TEMPLATE NAME: Work
*/

get_header();

$branded = new WP_Query( array(
	'post_type' => 'work',
	'posts_per_page' => 500,
	'tax_query' => array(
		array(
			'taxonomy' => 'work-featured',
			'field' => 'slug',
			'terms' => array( 'work-page' )
		),
		array(
			'taxonomy' => 'work_type',
			'field' => 'slug',
			'terms' => array( 'branded' )
		),
	)
) ); 

$originals = new WP_Query( array(
	'post_type' => 'work',
	'posts_per_page' => 500,
	'tax_query' => array(
		array(
			'taxonomy' => 'work-featured',
			'field' => 'slug',
			'terms' => array( 'work-page' )
		),
		array(
			'taxonomy' => 'work_type',
			'field' => 'slug',
			'terms' => array( 'original' )
		),
	)
) ); ?>

<?php while ( have_posts() ) : the_post(); ?>

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

<?php endwhile; ?>

<div class="pa-l-container">
		
	<?php pa_block_wysiwyg( array( 
		'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
	) ) ?>
	
</div>

<?php get_template_part( 'partials/blocks' ) ?>

<nav id="view-nav" class="pa-l-ma-0 pa-l-py-1 pa-u-text-center" aria-label="Work Type Navigation">
	<a href="#branded" class="pa-b-view-toggle js-view-toggle is-active">Branded</a>
	<a href="#originals" class="pa-b-view-toggle js-view-toggle">Originals</a>
</nav>

<section id="branded" data-view-top="#view-nav" class="js-view-target">

	<?php 
	$count = 0;
	while ( $branded->have_posts() ) : $branded->the_post(); ?>

		<article <?php post_class() ?> style="<?php echo $count !== 0 ? 'margin-top:10px' : '' ?>" >
		
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="pa-c-cover-media does-scale with-scrim" style="min-height:400px">
				
				<?php the_post_thumbnail( 'hero' ) ?>
				<div class="pa-c-cover-media__content use-light-ui align-end" style="max-width:750px">
					<p>
						<?php 
						if ( $client_image_id = get_post_meta( get_the_ID(), 'client_image', true ) ) {
							echo wp_get_attachment_image( $client_image_id, 'full', false, array( 'style' => 'width:auto;height:auto;max-width:70px;max-height:70px' ) );
						} else {
							echo get_post_meta( get_the_ID(), 'client', true );
						} ?>
					</p>
					<h2 class="pa-work-title pa-l-mt-nudge"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></h2>
				</div>
			
			</a>
	
		</article>

	<?php $count++; endwhile; ?>

</section>

<section id="originals" data-view-top="#view-nav" class="js-view-target" style="display:none">

	<?php 
	$count = 0;
	while ( $originals->have_posts() ) : $originals->the_post(); ?>

		<article <?php post_class() ?> style="<?php echo $count !== 0 ? 'margin-top:10px' : '' ?>" >
		
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="pa-c-cover-media does-scale with-scrim" style="min-height:400px">
				<?php the_post_thumbnail( 'hero' ) ?>
				<div class="pa-c-cover-media__content use-light-ui align-end" style="max-width:750px">
					<p>
						<?php 
						if ( $client_image_id = get_post_meta( get_the_ID(), 'client_image', true ) ) {
							echo wp_get_attachment_image( $client_image_id, 'full', false, array( 'style' => 'width:auto;height:auto;max-width:70px;max-height:70px' ) );
						} else {
							echo get_post_meta( get_the_ID(), 'client', true );
						} ?>
					</p>
					<h2 class="pa-work-title pa-l-mt-nudge"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></h2>
				</div>
			</a>
	
		</article>

	<?php $count++; endwhile; wp_reset_query(); ?>

</section>

<?php get_footer(); ?>