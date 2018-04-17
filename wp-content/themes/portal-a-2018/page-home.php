<?php
/*
TEMPLATE NAME: Home
*/
?>

<?php get_header(); ?>

<?php
$fileMP4 = get_field('mp4_video_file');
$fileOGV = get_field('ogv_video_file');
$fileWEBM = get_field('webm_video_file');
$bgVideo = get_field('background_video');
?>

<div class="pa-c-hero is-video">
	<video class="pa-c-hero__media" muted autoplay loop>
		<source src="<?php echo $fileWEBM['url']; ?>" type="video/webm">
		<source src="<?php echo $fileMP4['url']; ?>" type="video/mp4">
		<source src="<?php echo $fileOGV['url']; ?>" type="video/ogv"> Your browser does not support the video tag.
	</video>
	<div class="pa-c-hero__content">
		<h1>Breakthrough entertainment<br/>for a new generation</h1>
		<?php //echo apply_filters('the_content', get_post_meta( 2, 'headline', TRUE ) ); ?>
	</div>
</div>

<h2 class="pa-l-ma-0 pa-l-py-1 pa-u-text-center">The Latest</h2>

<div class="pa-l-flexbox pa-l-flex-wrap">
	
	<div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg" style="background-image:url(//unsplash.it/800/500);background-size:cover;background-position:center">
		<img src="//unsplash.it/800/500" alt="" width="800" height="500" class="pa-u-hide-md"/>
	</div>
	<div class="pa-l-flex pa-l-span-6-md pa-l-span-3-lg pa-l-pa-2 pa-u-bg-primary pa-u-color-white">
		<blockquote class="pa-h3 pa-u-scale-hover pa-u-transition-fast" style="text-transform:none">
			<i class="pa-b-icon icon-left-quote" aria-hidden="true" style="font-size:1.25rem"></i><br/>
			Portal A, more than any other creative shop, has cracked the code of online video.<br/>
			<br/>
			<cite>
				<img src="//placehold.it/70x20/ffffff/dddddd" alt="BBC" width="70" height="20" />
			</cite>
		</blockquote>
	</div>
	<div class="pa-l-flex pa-l-span-6-md pa-l-span-5-lg" style="background-image:url(//unsplash.it/800/550);background-size:cover;background-position:center">
		<img src="//unsplash.it/800/550" alt="" width="800" height="550" class="pa-u-hide-md"/>
	</div>
	<div class="pa-l-flex pa-l-flexbox pa-l-align-center pa-l-justify-center pa-l-span-6-md pa-l-span-3-lg pa-l-pa-2 pa-u-bg-primary pa-u-color-white">
		<a href="#" class="pa-u-display-block pa-u-text-center pa-u-scale-hover pa-u-transition-fast pa-u-opaque">
			<i class="pa-b-icon icon-hand-wave" aria-hidden="true" style="font-size:4rem"></i><br/>
			<br/>
			<p class="pa-h3">NOW HIRING!</p>
		</a>
	</div>
	<div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg" style="background-image:url(//unsplash.it/800/600);background-size:cover;background-position:center">
		<img src="//unsplash.it/800/600" alt="" width="800" height="600" class="pa-u-hide-md"/>
	</div>
	<div class="pa-l-flex pa-l-span-6-md pa-l-span-5-lg pa-l-pa-2 pa-u-bg-primary pa-u-color-white">
		<a href="#" class="pa-u-display-block pa-u-scale-hover pa-u-transition-fast pa-u-opaque">
			<blockquote>
				<span class="pa-h3" style="text-transform:none">
					<i class="pa-b-icon icon-left-quote" aria-hidden="true" style="font-size:1.25rem"></i><br/>
					We’re thrilled to welcome six bright and talented new members to the Portal A family, and congratulate our all-stars on their recent promotions.<br/>
				</span>
				<br/>
				<cite class="pa-u-faded"><em>Read about it on our blog...</em></cite>
			</blockquote>
		</a>
	</div>

</div>

<?php get_footer(); ?>