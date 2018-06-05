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
	?>

	<div class="pa-c-hero is-video">
		<div class="pa-c-hero__media pa-c-cover-media is-fullscreen">
			<video muted autoplay loop>
				<source src="<?php echo $fileWEBM['url']; ?>" type="video/webm">
				<source src="<?php echo $fileMP4['url']; ?>" type="video/mp4">
				<source src="<?php echo $fileOGV['url']; ?>" type="video/ogv"> Your browser does not support the video tag.
			</video>
		</div>
		<div class="pa-c-hero__content">
			
			<h1 class="pa-c-hero__title"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></h1>

			<div class="pa-l-flexbox pa-l-justify-space-between" style="width:100%">
				<a href="#blocks" class="js-smooth-scroll pa-u-scale-hover pa-u-transition-fast">
					<span class="pa-u-hide">Scroll down</span>
					<span class="pa-b-icon icon-arrow-down" aria-hidden="true" style="font-size:2.25rem"></span>
				</a>
				<a href="#" class="pa-u-scale-hover pa-u-transition-fast">
					<span class="pa-u-hide">Unmute video</span>
					<span class="pa-b-icon icon-sound" aria-hidden="true" style="font-size:2.25rem"></span>
				</a>
			</div>
			
		</div>
	</div>

	<div id="blocks">
		<?php get_template_part( 'components/blocks' ) ?>
	</div>

<?php endwhile; ?>

<?php get_footer(); ?>