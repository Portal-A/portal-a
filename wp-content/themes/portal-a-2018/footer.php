</main>
<!-- .content -->

<footer class="mainfoot">
	
	<p class="pa-l-mt-0" style="letter-spacing: 0.0526em">
		Portal A Limited <?php echo date('Y') ?> //
		<?php echo get_post_meta(2, 'locations', TRUE) ?> //
		<a href="mailto:<?php echo get_post_meta(2, 'info_email', TRUE) ?>">
			<?php echo get_post_meta(2, 'info_email', TRUE) ?>
		</a>
	</p>

	<span class="social">
		<a href="<?php echo get_post_meta(2, 'youtube_url', TRUE) ?>" target="_blank" class="">
			<span class="pa-u-hide">YouTube</span>
			<i class="pa-b-icon icon-youtube" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_post_meta(2, 'instagram_url', TRUE) ?>" target="_blank" class="">
			<span class="pa-u-hide">Instagram</span>
			<i class="pa-b-icon icon-instagram" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_post_meta(2, 'facebook_url', TRUE) ?>" target="_blank" class="">
			<span class="pa-u-hide">Facebook</span>
			<i class="pa-b-icon icon-facebook" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_post_meta(2, 'twitter_url', TRUE) ?>" target="_blank" class="">
			<span class="pa-u-hide">Twitter</span>
			<i class="pa-b-icon icon-twitter" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_post_meta(2, 'linkedin_url', TRUE) ?>" target="_blank" class="">
			<span class="pa-u-hide">LinkedIn</span>
			<i class="pa-b-icon icon-linkedin" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_permalink(87) ?>" class="blog-link">Portal A Blog</a>
	</span>

</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script>
	window.jQuery || document.write(
		'<script src="<?php echo PA_ASSETS . "js/jquery-1.8.0.min.js"; ?>"><\/script>')
</script>

<?php wp_footer(); ?>
</body>

</html>
