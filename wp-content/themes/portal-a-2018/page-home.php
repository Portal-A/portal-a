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
		
		<div class="pa-c-hero__title">
			<h1>Breakthrough entertainment<br/>for a new generation</h1>
		</div>

		<div class="pa-l-flexbox pa-l-justify-space-between" style="width:100%">
			<a href="#the-latest" class="js-smooth-scroll pa-u-scale-hover pa-u-transition-fast">
				<span class="pa-u-hide">Scroll down</span>
				<i class="pa-b-icon icon-arrow-down" aria-hidden="true" style="font-size:2.25rem"></i>
			</a>
			<a href="#" class="pa-u-scale-hover pa-u-transition-fast">
				<span class="pa-u-hide">Unmute video</span>
				<i class="pa-b-icon icon-sound" aria-hidden="true" style="font-size:2.25rem"></i>
			</a>
		</div>
		
	</div>
</div>

<h2 id="the-latest" class="pa-l-ma-0 pa-l-py-1 pa-u-text-center">The Latest</h2>

<div class="pa-l-flexbox pa-l-flex-wrap">
	
	<a href="#" class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg pa-c-cover-media does-scale does-fade" >
		<img src="//picsum.photos/800/500/" alt="" width="800" height="500"/>
		<div class="pa-c-cover-media__content is-animated use-light-ui pa-u-text-center" style="width:100%">
			<p class="pa-h4 pa-l-mt-0">Lorem ipsum dolor</p>
		</div>
	</a>

	<div class="pa-l-flex pa-l-span-6-md pa-l-span-3-lg pa-l-pa-2 pa-u-bg-primary pa-u-color-white">
		<a href="#" class="pa-u-display-block pa-u-scale-hover pa-u-transition-slow">
			<blockquote class="pa-h3 pa-u-center" style="text-transform:none;max-width:260px">
				<i class="pa-b-icon icon-left-quote" aria-hidden="true" style="font-size:1.25rem"></i><br/>
				Portal A, more than any other creative shop, has cracked the code of online video.<br/>
				<br/>
				<cite>
					<img src="//placehold.it/70x20/ffffff/dddddd" alt="BBC" width="70" height="20" />
				</cite>
			</blockquote>
		</a>
	</div>

	<a href="#" class="pa-l-flex pa-l-span-6-md pa-l-span-5-lg pa-c-cover-media does-scale does-fade">
		<img src="//picsum.photos/800/550/" alt="" width="800" height="550"/>
		<div class="pa-c-cover-media__content is-animated use-light-ui pa-u-text-center" style="width:100%">
			<p class="pa-h4 pa-l-mt-0">Lorem ipsum dolor</p>
		</div>
	</a>

	<div class="pa-l-flex pa-l-flexbox pa-l-align-center pa-l-justify-center pa-l-span-6-md pa-l-span-3-lg pa-l-pa-2 pa-u-bg-primary pa-u-color-white">
		<a href="#" class="pa-u-display-block pa-u-text-center pa-u-scale-hover pa-u-transition-slow">
			<i class="pa-b-icon icon-hand-wave" aria-hidden="true" style="font-size:4rem"></i><br/>
			<br/>
			<p class="pa-h3">NOW HIRING!</p>
		</a>
	</div>

	<a href="#" class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg pa-c-cover-media does-scale does-fade">
		<img src="//picsum.photos/800/600/" alt="" width="800" height="600"/>
		<div class="pa-c-cover-media__content is-animated use-light-ui pa-u-text-center" style="width:100%">
			<p class="pa-h4 pa-l-mt-0">Lorem ipsum dolor</p>
		</div>
	</a>

	<div class="pa-l-flex pa-l-span-6-md pa-l-span-5-lg pa-l-pa-2 pa-u-bg-primary pa-u-color-white">
		<a href="#" class="pa-u-display-block pa-u-scale-hover pa-u-transition-slow">
			<blockquote class="pa-u-center" style="max-width:440px">
				<span class="pa-h3" style="text-transform:none">
					<i class="pa-b-icon icon-left-quote" aria-hidden="true" style="font-size:1.25rem"></i><br/>
					We’re thrilled to welcome six bright and talented new members to the Portal A family, and congratulate our all-stars on their recent promotions.<br/>
				</span>
				<br/>
				<cite class="pa-u-faded">Read about it on our blog</cite>
			</blockquote>
		</a>
	</div>

</div>

<?php get_footer(); ?>