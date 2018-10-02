<?php get_header(); ?>

	<?php pa_hero(
		array(
			'title' => 'Page Not Found',
			'content' => '<p>Please check out our <a href="<?= get_permalink(2) ?>">home</a> or <a href="<?= get_permalink(12) ?>">work</a> page.</p>'
		)
	) ?>
	
<?php get_footer(); ?>