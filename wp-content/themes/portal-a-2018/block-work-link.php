<?php
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'medium');
	$image_info = get_post($item->ID);
	$preview_mp4 = wp_get_attachment_url(get_post_meta($item->ID, 'preview_mp4', true));
	$preview_webm = wp_get_attachment_url(get_post_meta($item->ID, 'preview_webm', true));
?>
<a href="<?php echo get_permalink($item->ID) ?>" class="work-link <?php echo $work_index%3 == 0 ? 'right' : '' ?> <?php echo $preview_mp4 != '' ? 'video' : '' ?> <?php echo has_term('work-page', 'work-featured', $item->ID) ? 'featured' : '' ?>">
	<div class="work <?php echo $work_index % 3 == 0 && $work_index != 0 ? 'last' : '' ?>">
		<?php if ($image != false) : ?>
			<img src="<?php bloginfo('template_directory'); ?>/assets/img/blank.gif" data-src="<?php echo $image[0] ?>" alt="<?php echo $image_info->post_title ?>" title="<?php echo $image_info->post_excerpt ?>" />
		<?php endif; ?>
    <div class="title-holder">
      <h3 class="main-title"><?php echo get_post_meta($item->ID, 'client', TRUE) ?></h3>
      <div class="bottom">
        <h3><?php echo get_post_meta($item->ID, 'client', TRUE) ?></h3>
        <h4><?php echo get_post_meta($item->ID, 'videos_title', TRUE) ?></h4>
      </div>
    </div>
		<?php $check = $detect->isMobile(); if(!$check): ?>
			<?php if ($preview_mp4 != '' & $preview_webm != ''): ?>
				<?php if (has_term('work-page', 'work-featured', $item->ID)): ?>
					<video preload="auto" width="663" height="462" data-proto="video" loop="true" muted="muted" mp4-src="<?php echo $preview_mp4; ?>" webm-src="<?php echo $preview_webm; ?>">
				<?php else: ?>
					<video preload="auto" width="320" height="223" data-proto="video" loop="true" muted="muted" mp4-src="<?php echo $preview_mp4; ?>" webm-src="<?php echo $preview_webm; ?>">
				<?php endif; ?>
				</video>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</a>
<?php if ($work_index == 3): ?>
	<div class="clear"></div>
<?php endif; ?>
