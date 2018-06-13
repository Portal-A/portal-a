<?php 

/**
 * Front Page
 */

get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>

	<?php
	$fileMP4 = get_field('mp4_video_file');
	$fileOGV = get_field('ogv_video_file');
	$fileWEBM = get_field('webm_video_file');
	$fileBackground = get_field('background_video');
	?>

	<div class="pa-c-hero is-left-aligned is-video">
		<div class="pa-c-hero__media has-scrim pa-c-cover-media is-fullscreen">
			<video id="background-video" muted autoplay loop preload="preload">
				<source src="<?php echo $fileBackground; ?>" type="video/mp4">
				Your browser does not support the video tag.
			</video>
		</div>
		<div class="pa-c-hero__content">
			
			<h1 class="pa-c-hero__title"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></h1>

			<div class="pa-l-flexbox pa-l-justify-space-between" style="width:100%">
				<button href="#reel" 
						class="pa-b-clean-button pa-u-scale-hover pa-u-transition-fast js-lightbox-toggle"
						style="margin-left:auto"
						data-template="#full-reel"
						data-template-data='{ "source": "<?php echo $fileBackground ?>" }'>
					<span class="pa-u-hide">Open video lightbox</span>
					<span class="pa-b-icon icon-sound" aria-hidden="true" style="font-size:2.25rem"></span>
				</button>
			</div>
			
		</div>
	</div>

	<div id="blocks">
		<?php get_template_part( 'partials/blocks' ) ?>
	</div>

<?php endwhile; ?>

<script id="full-reel" type="html/mustache-template">
	<video autoplay controls preload="preload">
		<source src="{{source}}" type="video/mp4">
		Your browser does not support the video tag.
	</video>
</script>

<?php get_footer(); ?>