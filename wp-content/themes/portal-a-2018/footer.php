</main>
<!-- .content -->

<footer class="mainfoot">
	<div class="pa-l-px-1">
		Portal A Limited <?php echo date('Y') ?> //
		<?php echo get_post_meta(2, 'locations', TRUE) ?> //
		<a href="mailto:<?php echo get_post_meta(2, 'info_email', TRUE) ?>">
			<?php echo get_post_meta(2, 'info_email', TRUE) ?>
		</a>
		<span class="social">
			<a href="<?php echo get_post_meta(2, 'facebook_url', TRUE) ?>" target="_blank" class="facebook">Facebook</a>
			<a href="<?php echo get_post_meta(2, 'twitter_url', TRUE) ?>" target="_blank" class="twitter">Twitter</a>
			<a href="<?php echo get_post_meta(2, 'linkedin_url', TRUE) ?>" target="_blank" class="linkedin">LinkedIn</a>
			<a href="<?php echo get_post_meta(2, 'instagram_url', TRUE) ?>" target="_blank" class="instagram">Instagram</a>
			<a href="<?php echo get_post_meta(2, 'youtube_url', TRUE) ?>" target="_blank" class="youtube">YouTube</a>
			<a href="<?php echo get_permalink(87) ?>" class="blog-link">Portal A Blog</a>
		</span>
	</div>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script>
	window.jQuery || document.write(
		'<script src="<?php echo PA_ASSETS . "js/jquery-1.8.0.min.js"; ?>"><\/script>')
</script>

<?php wp_footer(); ?>
</body>

</html>
