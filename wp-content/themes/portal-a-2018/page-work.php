<?php
/*
TEMPLATE NAME: Work
*/
?>

<?php get_header(); ?>

<div class="pa-c-hero">
	
	<div class="pa-c-hero__media pa-c-cover-media">
		<img src="//picsum.photos/1440/800/" width="1440" height="800" />
	</div>

	<div class="pa-c-hero__content">
		<div class="pa-c-hero__title">
			<img src="//placehold.it/64x26/ffffff/dddddd" />
			<h1>Simone Giertz really wanted to be on HBO Westworld. Well, dreams come true.</h1>
		</div>
	</div>

</div>

<nav class="pa-l-ma-0 pa-l-py-1 pa-u-text-center">
	<a href="#branded" class="pa-b-filter js-filter is-active">Branded</a>
	<a href="#originals" class="pa-b-filter js-filter">Originals</a>
</nav>

<section id="branded" class="js-filter-target">

	<?php $i = 0; do { ?>

		<article><a href="#">
		
			<div class="pa-c-cover-media" style="min-height:400px">
				<img src="//picsum.photos/1440/450/?image=<?php echo $i * 10 + 100 ?>" width="1440" height="450" />
				<div class="pa-c-cover-media__content use-light-ui align-end">
					<p><img src="//placehold.it/64x26/ffffff/dddddd" /></p>
					<h1 class="pa-h1">Branded Project Title</h1>
				</div>
			</div>
		
		</a></article>

	<?php $i++; } while ( $i < 6 )?>

</section>

<section id="originals" class="js-filter-target" style="display:none">

<?php $i = 0; do { ?>

	<article><a href="#">
	
		<div class="pa-c-cover-media" style="min-height:400px">
			<img src="//picsum.photos/1440/450/?image=<?php echo $i * 2 + 50 ?>" width="1440" height="450" />
			<div class="pa-c-cover-media__content use-light-ui align-end">
				<p><img src="//placehold.it/64x26/ffffff/dddddd" /></p>
				<h1 class="pa-h1">Original Project Title</h1>
			</div>
		</div>
	
	</a></article>

<?php $i++; } while ( $i < 6 )?>

</section>

<?php get_footer(); ?>