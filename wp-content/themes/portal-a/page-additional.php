<?php
	/*
	TEMPLATE NAME: Additional Posts
	*/
	
	require_once 'src/Mobile_Detect.php';
	global $detect; $detect = new Mobile_Detect;
	global $deviceType; $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	global $scriptVersion; $scriptVersion = $detect->getScriptVersion();

	$offset = htmlspecialchars(trim($_GET['offset']));
    if ($offset == '') {
        $offset = 0;
    }
    
    $args = array(
		'posts_per_page' => 6,
		'post_type' => 'work',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_status' => 'publish',
		'offset' => $offset
	);
	$items = get_posts($args);
	$work_index = ($offset + 1);
?>
	<?php foreach ($items as $item) : ?>
		<?php include('block-work-link.php'); ?>
	<?php $work_index++; endforeach; ?>