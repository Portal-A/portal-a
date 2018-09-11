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

	<div class="pa-c-home-video">
		<div class="pa-c-home-video__media has-scrim pa-c-cover-media is-fullscreen">
			<video id="background-video" muted autoplay loop preload="preload">
				<source src="<?php echo $fileBackground; ?>" type="video/mp4">
				Your browser does not support the video tag.
			</video>
		</div>
		<div class="pa-c-home-video__content">
			
			<div class="pa-l-flexbox pa-l-justify-space-between" style="width:100%">
			
				<h1 class="pa-c-home-video__title"><?php echo $post->post_excerpt ? $post->post_excerpt : get_the_title(); ?></h1>

				<button href="#reel" 
						class="pa-b-clean-button pa-u-scale-hover pa-u-transition-fast js-lightbox-toggle"
						style="margin-left:auto"
						data-template="#full-reel"
						data-template-data='{ "source": "<?php echo $fileBackground ?>" }'>
					<span class="pa-u-hide">Open video lightbox</span>
					<span class="pa-b-icon icon-sound" aria-hidden="true" style="font-size:2rem"></span>
				</button>

			</div>
			
		</div>
	</div>

	<div style="position:relative; background:black">

		<?php if ( is_front_page() ) { ?>
			<nav class="pa-c-home-nav">
				<?php wp_nav_menu( array( 
					'theme_location' => 'header',
					'container' => '',
					'menu_class' => 'pa-c-home-nav__menu',
					'fallback_cb' => false
				) ); ?>
			</nav>
		<?php } ?>

		<div id="blocks">
			<?php get_template_part( 'partials/blocks' ) ?>
		</div>

	</div>

<?php endwhile; ?>

<script id="full-reel" type="html/mustache-template">
	<video autoplay controls preload="preload">
		<source src="{{source}}" type="video/mp4">
		Your browser does not support the video tag.
	</video>
</script>

<?php get_footer(); ?>