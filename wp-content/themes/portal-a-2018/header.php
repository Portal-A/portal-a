<?php if (is_page(12)) {
		require_once 'src/Mobile_Detect.php';
		global $detect; $detect = new Mobile_Detect;
		global $deviceType; $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		global $scriptVersion; $scriptVersion = $detect->getScriptVersion();
	}
?>

<!doctype html>
<html <?php language_attributes(); ?>>

	<head>

		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=1032"/>
		<meta name="blog-title" content="<?php bloginfo('title'); ?>" />

		<link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/assets/img/favicon.ico?v1.1"/>
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('title'); ?> Feed" href="<?= get_bloginfo('rss2_url') ?>" />

		<script type="text/javascript" src="//use.typekit.net/rln3vwl.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

		<!--[if lt IE 9]>
		<script src="<?php echo PA_ASSETS . 'js/html5.js' ?>"></script>
		<![endif]-->
		<?php fuzzco_head(); ?>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-37255526-1', 'auto');
		  ga('send', 'pageview');

		</script>

	</head>

	<body <?php body_class(); ?>>

		<header class="pa-c-masthead">
			<a href="<?= get_bloginfo('url') ?>"><img class="icon-logo" src="<?php echo get_template_directory_uri() . '/assets/img/icon-logo.png' ?>" alt="Portal A"></a>
			
			<?php wp_nav_menu( array( 
				'theme_location' => 'header',
				'container' => '',
				'menu_class' => 'pa-c-header-menu',
				'fallback_cb' => false
			) ) ?>

		</header>

		<main class="content">