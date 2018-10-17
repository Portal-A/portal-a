</main>
<!-- .content -->

<footer class="pa-c-footer pa-u-uppercase">
	
	<p class="pa-u-weight-light pa-l-mt-0" style="letter-spacing: 0.0526em">
		Portal A Limited <?php echo date('Y') ?> //
		<?php echo get_post_meta(2, 'locations', TRUE) ?> //
		<a href="mailto:<?php echo get_post_meta(2, 'info_email', TRUE) ?>">
			<?php echo get_post_meta(2, 'info_email', TRUE) ?>
		</a>
	</p>

	<span class="social">
		<a href="<?php echo get_post_meta(2, 'youtube_url', TRUE) ?>" target="_blank" class="social-link">
			<span class="pa-u-hide">YouTube</span>
			<i class="pa-b-icon icon-youtube" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_post_meta(2, 'instagram_url', TRUE) ?>" target="_blank" class="social-link">
			<span class="pa-u-hide">Instagram</span>
			<i class="pa-b-icon icon-instagram" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_post_meta(2, 'facebook_url', TRUE) ?>" target="_blank" class="social-link">
			<span class="pa-u-hide">Facebook</span>
			<i class="pa-b-icon icon-facebook" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_post_meta(2, 'twitter_url', TRUE) ?>" target="_blank" class="social-link">
			<span class="pa-u-hide">Twitter</span>
			<i class="pa-b-icon icon-twitter" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_post_meta(2, 'linkedin_url', TRUE) ?>" target="_blank" class="social-link">
			<span class="pa-u-hide">LinkedIn</span>
			<i class="pa-b-icon icon-linkedin" aria-hidden="true"></i>
		</a>
		<a href="<?php echo get_permalink(87) ?>" class="blog-link pa-l-mt-0 pa-u-weight-light">Portal A Blog</a>
	</span>

</footer>

<?php wp_footer(); ?>

<?php if ( defined( 'WP_DEBUG' ) && WP_DEBUG === TRUE ) : ?>

	<script type="text/javascript">

		/**
		 * Replaces local image urls with ones from live site.
		 */

		var images = document.querySelectorAll('img.attachment-hero, img.wp-post-image');

		// console.log(images);
		
		// images.forEach(function(img){

		// 	var siteUrl = "<?php echo site_url() ?>",
		// 		siteUrlRegexp = new RegExp( siteUrl, "g" ),
		// 		src = img.getAttribute("src"),
		// 		srcset = img.getAttribute("srcset");

		// 	if ( src.indexOf(siteUrl) > -1 ) {				
		// 		src = src.replace( siteUrlRegexp, "https://www.portal-a.com");
		// 		img.setAttribute('src', src);

		// 		if ( srcset ) {
		// 			srcset = srcset.replace( siteUrlRegexp, "https://www.portal-a.com");
		// 			img.setAttribute('srcset', srcset);
		// 		}
				
		// 	}

		// });

	</script>

<?php endif; ?>

</body>

</html>
