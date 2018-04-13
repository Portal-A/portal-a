<?php
/*
TEMPLATE NAME: Slideshow Home
*/
?>

<?php get_header(); ?>
<?php if (have_posts()) while (have_posts()) : the_post(); ?>

<?php
$args = array(
	'numberposts' => -1,
	'post_type' => 'home-projects',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_status' => 'publish'
);

$items = get_posts($args);
?>

<div class="slideshow">

	<?php foreach ($items as $item) : ?>
	<?php
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full-size');
	?>
	<div class="slide" data-image="<?= $image[0] ?>">
		<?php $work_pages = MRP_get_related_posts($item->ID, TRUE, TRUE, 'work', TRUE, 'ASC'); if(count($work_pages) == 1): ?>
			<?php foreach ($work_pages as $work_page): ?>
				<?php if (trim(get_post_meta($work_page->ID, 'work_index_title', TRUE)) != ''): ?>
					<p><a href="<?= get_permalink($work_page->ID) ?>">View "<?= get_post_meta($work_page->ID, 'work_index_title', TRUE); ?>"</a></p>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<?php endforeach; ?>

	<div class="slideshow-headline"><?php echo wpautop(get_post_meta(2, 'headline', TRUE)); ?></div>

	<a href="#" class="previous">Previous</a>
	<a href="#" class="next">Next</a>

</div>

<?php endwhile; ?>
<?php get_footer(); ?>
