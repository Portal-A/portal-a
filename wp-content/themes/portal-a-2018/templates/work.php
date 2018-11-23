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

<?php the_post(); ?>

<?php pa_hero() ?>

<div class="pa-c-page-content pa-l-mt-4">

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
			
				<?php
				$client_image_id = get_post_meta( get_the_ID(), 'client_image', true );
				
				pa_tile(array(
					'content_x'      => 'left',
					'content_y'      => 'bottom',
					'image'          => get_post_thumbnail_id(),
					'reveal_content' => false,
					'source_image'   => wp_get_attachment_image( $client_image_id, 'medium', false, array( 'style' => 'width:auto;height:auto;max-width:70px;max-height:70px' ) ),
					'source'         => get_post_meta( get_the_ID(), 'client', true ),
					'text'           => get_the_title(),
					'text_align'	 => 'left',
					'type'           => 'image',
					'url'            => get_permalink(),
				)); ?>
		
			</article>

		<?php $count++; endwhile; ?>

	</section>

	<section id="originals" data-view-top="#view-nav" class="js-view-target" style="display:none">

		<?php 
		$count = 0;
		while ( $originals->have_posts() ) : $originals->the_post(); ?>

			<article <?php post_class() ?> style="<?php echo $count !== 0 ? 'margin-top:10px' : '' ?>" >
			
				<?php
				$client_image_id = get_post_meta( get_the_ID(), 'client_image', true );
				
				pa_tile(array(
					'content_x'      => 'left',
					'content_y'      => 'bottom',
					'image'          => get_post_thumbnail_id(),
					'reveal_content' => false,
					'source_image'   => wp_get_attachment_image( $client_image_id, 'medium', false, array( 'style' => 'width:auto;height:auto;max-width:70px;max-height:70px' ) ),
					'source'         => get_post_meta( get_the_ID(), 'client', true ),
					'text'           => get_the_title(),
					'text_align'	 => 'left',
					'type'           => 'image',
					'url'            => get_permalink(),
				));
				?>
		
			</article>

		<?php $count++; endwhile; wp_reset_query(); ?>

	</section>

</div>

<?php get_footer(); ?>