<!doctype html>
<html <?php language_attributes(); ?>>

	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
		
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('title'); ?> Feed" href="<?= get_bloginfo('rss2_url') ?>" />

		<?php if ( ! defined( 'WP_DEBUG' ) || WP_DEBUG === FALSE ) : ?>
		
			<!-- Google Analytics -->
			<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-37255526-1', 'auto');
			ga('send', 'pageview');
			</script>

			<!-- LinkedIn Insight Tag -->
			<script type="text/javascript"> _linkedin_data_partner_id = "359345"; </script>
			<script type="text/javascript"> (function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); </script> 
			<noscript> <img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=359345&fmt=gif" /> </noscript>

		<?php endif; ?>

	</head>

	<body <?php body_class(); ?>>

		<header class="pa-c-masthead">
			<a href="<?= get_bloginfo('url') ?>" class="pa-c-logo">
				<img class="pa-c-logo__static" src="<?php echo get_template_directory_uri() . '/assets/img/icon-logo.png' ?>" alt="Portal A logo static" width="117" height="117" >
				<img class="pa-c-logo__active" src="<?php echo get_template_directory_uri() . '/assets/img/icon-logo.gif' ?>" alt="Portal A logo active" width="117" height="117" >
			</a>
			
			<?php wp_nav_menu( array( 
				'theme_location' => 'header',
				'container' => '',
				'menu_class' => 'pa-c-header-menu',
				'fallback_cb' => false
			) ) ?>

		</header>

		<main class="content">