<?php
/*
TEMPLATE NAME: Work
*/

get_header();

$hero = new WP_Query( array(
	'post_type' => 'work',
	'posts_per_page' => 1,
	'tax_query' => array(
		array(
			'taxonomy' => 'work-featured',
			'field' => 'slug',
			'terms' => array( 'work-page-hero' )
		)
	)
) );

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


<!-- page title for SEO, screen readers -->
<h1 style="display:none"><?php the_title(); ?></h1>
<!-- // -->


<?php while ( $hero->have_posts() ) : $hero->the_post(); ?>

	<div <?php post_class("pa-c-hero is-left-aligned") ?> >
		
		<div class="pa-c-hero__media pa-c-cover-media">
			<?php the_post_thumbnail( 'hero' ); ?>
		</div>

		<div class="pa-c-hero__content">
			<a href="<?php the_permalink() ?>" class="pa-u-scale-hover pa-u-transition-slow pa-u-display-block" title="<?php the_title(); ?>">
				<div class="pa-c-hero__title">
					<p>
						<?php 
						if ( $client_image_id = get_post_meta( get_the_ID(), 'client_image', true ) ) {
							echo wp_get_attachment_image( $client_image_id, 'full', false, array( 'style' => 'width:auto;height:auto;max-width:70px;max-height:70px' ) );
						} else {
							echo get_post_meta( get_the_ID(), 'client', true );
						} ?>
					</p>
					<h2 class="pa-work-title"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></h2>
				</div>
			</a>
		</div>

	</div>
<?php endwhile; ?>


<nav id="view-nav" class="pa-l-ma-0 pa-l-py-1 pa-u-text-center" aria-label="Work Type Navigation">
	<a href="#branded" class="pa-b-view-toggle js-view-toggle is-active">Branded</a>
	<a href="#originals" class="pa-b-view-toggle js-view-toggle">Originals</a>
</nav>

<section id="branded" data-view-top="#view-nav" class="js-view-target">

	<?php while ( $branded->have_posts() ) : $branded->the_post(); ?>

		<article <?php post_class() ?> >
		
			<div class="pa-c-cover-media with-scrim" style="min-height:400px">
				<?php the_post_thumbnail( 'hero' ) ?>
				<div class="pa-c-cover-media__content use-light-ui align-end" style="max-width:750px">
					<a href="<?php the_permalink() ?>" class="pa-u-scale-hover pa-u-transition-slow pa-u-display-block" title="<?php the_title(); ?>">
						<p>
							<?php 
							if ( $client_image_id = get_post_meta( get_the_ID(), 'client_image', true ) ) {
								echo wp_get_attachment_image( $client_image_id, 'full', false, array( 'style' => 'width:auto;height:auto;max-width:70px;max-height:70px' ) );
							} else {
								echo get_post_meta( get_the_ID(), 'client', true );
							} ?>
						</p>
						<h2 class="pa-work-title pa-l-mt-nudge"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></h2>
					</a>
				</div>
			</div>
	
		</article>

	<?php endwhile; ?>

</section>

<section id="originals" data-view-top="#view-nav" class="js-view-target" style="display:none">

	<?php while ( $originals->have_posts() ) : $originals->the_post(); ?>

		<article <?php post_class() ?> >
		
			<div class="pa-c-cover-media with-scrim" style="min-height:400px">
				<?php the_post_thumbnail( 'hero' ) ?>
				<div class="pa-c-cover-media__content use-light-ui align-end" style="max-width:750px">
					<a href="<?php the_permalink() ?>" class="pa-u-scale-hover pa-u-transition-slow pa-u-display-block" title="<?php the_title(); ?>">
						<p>
							<?php 
							if ( $client_image_id = get_post_meta( get_the_ID(), 'client_image', true ) ) {
								echo wp_get_attachment_image( $client_image_id, 'full', false, array( 'style' => 'width:auto;height:auto;max-width:70px;max-height:70px' ) );
							} else {
								echo get_post_meta( get_the_ID(), 'client', true );
							} ?>
						</p>
						<h2 class="pa-work-title pa-l-mt-nudge"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></h2>
					</a>
				</div>
			</div>
	
		</article>

	<?php endwhile; wp_reset_query(); ?>

</section>

<?php get_footer(); ?>