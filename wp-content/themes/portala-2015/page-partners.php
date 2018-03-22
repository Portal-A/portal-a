<?php
/*
TEMPLATE NAME: Partners
*/
?>

<?php get_header(); ?>
	<?php if (have_posts()) while (have_posts()) : the_post(); ?>
	
		<?php if ($post->post_content != ''): ?>
			<h2 class="page-headline"><?php echo $post->post_content; ?></h2>
		<?php endif; ?>
	
	<?php											
		$args = array(
			'numberposts' => -1,
			'post_type' => 'client-partners',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_status' => 'publish'
		);
		$items = get_posts($args);
		$item_index = 1;
	?>
	<div class="partners clear">
		<?php foreach ($items as $item) : ?>
			<div class="partner-block<?php if ($item_index % 3 == 0) {echo ' right';} ?>">
			
				<!-- WORK PAGE LINK -->
				<?php $work_pages = MRP_get_related_posts($item->ID, true, true, 'work'); ?>
				<?php if (count($work_pages) > 0): ?>
					<?php foreach ($work_pages as $work_page): ?>
						<a href="<?php echo get_permalink($work_page->ID); ?>">
						<?php break; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				
					<?php if (trim(get_post_meta($item->ID, 'partner_hex', true)) != ''): ?>
						<span class="brand-color" style="background: <?php echo get_post_meta($item->ID, 'partner_hex', true); ?>"></span>
					<?php endif; ?>
				
					<!-- PARTNER LOGO -->
					<?php
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'medium');
						$image_info = get_post($item->ID);
					?>
					<?php if ($image): ?>				
						<img src="<?php echo $image[0]; ?>" alt="<?php echo $item->post_title ?>" title="<?php echo $item->post_title ?>" />
					<?php else: ?>
						<span class="block-title"><?php echo $item->post_title; ?></span>
					<?php endif; ?>
					
				<!-- CLOSE WORK PAGE LINK -->
				<?php if (count($work_pages) > 0): ?>
					</a>
				<?php endif; ?>	
					
			</div>
		<?php $item_index++; endforeach; ?>
	</div>
	
	<?php endwhile; ?>
<?php get_footer(); ?>
