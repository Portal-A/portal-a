<?php
/*
TEMPLATE NAME: Work
*/
?>

<?php get_header(); ?>
	<?php if (have_posts()) while (have_posts()) : the_post(); ?>
	
		<?php if ($post->post_content != ''): ?>
			<h2 class="work-heading"><?php the_content(); ?></h2>
		<?php endif; ?>
	
	<?php									
		$args = array(
			'posts_per_page' => -1,
			'post_type' => 'work',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_status' => 'publish'
		);
		$items = get_posts($args);
		$work_index = 1;
	?>
	
		<div class="works clear">
		
			<?php foreach ($items as $item) : ?>
				<?php include('block-work-link.php'); ?>
			<?php $work_index++; endforeach; ?>
	
			<div class="additional-posts last"></div>
	
		</div>
	
	<?php endwhile; ?>
<?php get_footer(); ?>
