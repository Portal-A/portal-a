<?php get_header(); ?>

<div class="work-controls work-controls-top clear">
	<?php $prev_post = get_adjacent_post(FALSE, '', TRUE); ?>
	<?php if ($prev_post) : ?>
	<a href="<?= get_permalink($prev_post->ID) ?>" class="previous-post">Previous Project</a>
	<?php endif; ?>
	
	<h2 class="work-title">"<?= $post->post_title ?>"</h2>
	
	<?php $next_post = get_adjacent_post(FALSE, '', FALSE); ?>
	<?php if ($next_post) : ?>
	<a href="<?= get_permalink($next_post->ID) ?>" class="next-post">Next Project</a>
	<?php endif; ?>
</div>

<div class="top clear">
	<div class="left">
		<?= wpautop($post->post_content) ?>
		<div class="work-meta">
		<h3>Created for</h3>
		<h4><?= get_post_meta($post->ID, 'client', TRUE) ?></h4>
		</div>
	</div>
	<div class="right">
		<div class="video">
			<?php
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
			$image_info = get_post($post->ID);
			?>
			
			<?php if (get_post_meta($post->ID, 'video_embed_code', TRUE) != '') : ?>
			
			<div class="video-embed">
				<?= get_post_meta($post->ID, 'video_embed_code', TRUE) ?>
			</div>	
			
			<?php elseif($image != false) : ?>
			
			<img src="<?= $image[0] ?>" alt="<?= $image_info->post_title ?>" title="<?= $image_info->post_excerpt ?>" />
			
			<?php endif; ?>
		</div>
	</div>
</div>

<?php

$presses = MRP_get_related_posts($post->ID, true, true, 'press');
$middles_index = 1;

?>

<?php if ($presses) : ?>

<div class="middle clear presses">
	<h2>Press for "<?= $post->post_title ?>"</h2>
	
	<?php foreach($presses as $press) : ?>
	<a href="<?= get_post_meta($press->ID, 'url', TRUE) ?>" target="_blank">
	<div class="press <?= $middles_index % 2 == 0 ? 'even' : '' ?> <?= $middles_index % 4 == 0 ? 'last' : '' ?>">
		<?php if (get_post_meta($press->ID, 'url', TRUE) != '') : ?>
		<h5><span class="quotemark"></span><?= substr($press->post_content, 0, 150) ?>"</h5>
		<h6>Read More...</h6>
		<?php else : ?>
		<h5><?= substr($press->post_content, 0, 150) ?>"</h5>
		<?php endif; ?>
		
		<?php
		$image_middle = wp_get_attachment_image_src(get_post_meta($press->ID, 'publication_logo', TRUE), 'full-size');
		$image_info_middle = get_post($press->ID);
		?>
		
		<?php if ($image_middle) : ?>
		<div class="logo">
			<img src="<?= $image_middle[0] ?>" alt="<?= $image_info_middle->post_title ?>" title="<?= $image_info_middle->post_excerpt ?>" />
		</div>
		<?php else: ?>
		<div class="logo">
			<h4><?= $press->post_title ?></h4>
		</div>
		<?php endif; ?>
		
	</div>
	</a>
	<?php $middles_index++; endforeach; ?>
</div>

<?php endif; ?>

<?php

$video_index = 1;
$videos = get_post_meta($post->ID, 'additional_video_embed_code', FALSE);

?>
<?php if (count($videos) > 0) : ?>

<div class="middle clear videos">

	<h2>More Videos</h2>

	<div class="clear">
	<?php foreach($videos as $video) : ?>
	<div class="video-embed additional-video-embed <?= $video_index % 2 == 0 ? 'last' : ''; ?>">
		<?= $video ?>
	</div>	
	<?php $video_index++; endforeach; ?>
	</div>

</div>
<?php endif; ?>

<?php

$photo_index = 1;
$photos = get_post_meta($post->ID, 'additional_photo', FALSE);

?>
<?php if (count($photos) > 0) : ?>

<div class="middle clear photos">

	<?php if (get_post_meta($press->ID, 'images_title', TRUE) != '') : ?>
	<h2><?= get_post_meta($press->ID, 'images_title', TRUE) ?></h2>
	<?php else : ?>
	<h2>More Photos</h2>
	<?php endif; ?>

	<div class="clear">
	<?php foreach($photos as $photo) : ?>
	<?php
	$image = wp_get_attachment_image_src($photo, 'full-size');
	$image_info = get_post($photo->ID);
	?>
	<div class="additional-photo <?= $photo_index % 2 == 0 ? 'last' : ''; ?>">
		<img src="<?= $image[0] ?>" alt="<?= $image_info->post_title ?>" title="<?= $image_info->post_excerpt ?>" />
	</div>	
	<?php $photo_index++; endforeach; ?>
	</div>

</div>
<?php endif; ?>

<div class="work-controls work-controls-bottom clear">
	<?php $prev_post = get_adjacent_post(FALSE, '', TRUE); ?>
	<?php if ($prev_post) : ?>
	<a href="<?= get_permalink($prev_post->ID) ?>" class="previous-post">Previous Project</a>
	<?php endif; ?>
	
	<?php $next_post = get_adjacent_post(FALSE, '', FALSE); ?>
	<?php if ($next_post) : ?>
	<a href="<?= get_permalink($next_post->ID) ?>" class="next-post">Next Project</a>
	<?php endif; ?>
</div>

<?php get_footer(); ?>