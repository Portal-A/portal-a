<?php
/*
TEMPLATE NAME: Press
*/
?>

	<?php get_header(); ?>
	<?php if (have_posts()) while (have_posts()) : the_post(); ?>

	<?php
$args = array(
	'numberposts' => 1,
	'post_type' => 'press',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_status' => 'publish',
	'press-types' => 'top'
);

$tops = get_posts($args);

$args = array(
	'numberposts' => -1,
	'post_type' => 'press',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_status' => 'publish',
	'press-types' => 'full'
);

$full = get_posts($args);
$full_index = 0;

$args = array(
  'numberposts' => -1,
  'post_type' => 'press',
  'orderby' => 'menu_order',
  'order' => 'ASC',
  'post_status' => 'publish',
  'press-types' => 'grid'
);

$grid = get_posts($args);

$args = array(
	'numberposts' => -1,
	'post_type' => 'press',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_status' => 'publish',
	'tax_query'	=> array(
        array(
            'taxonomy'  => 'press-types',
            'field'     => 'slug',
            'terms'     => array('top', 'middle', 'grid'),
            'operator'  => 'NOT IN'))
);

$bottoms = get_posts($args);
$bottoms_index = 0;

?>

		<div class="top clear">
			<?php
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full-size');
			$image_info = get_post(get_post_thumbnail_id($post->ID));
			$link = get_post_meta($tops[0]->ID, 'url', TRUE);
			$opening_tag = $link ? '<a href="'.$link.'" target="_blank">' : '<span>';
			$closing_tag = $link ? '</a>' : '</span>';
			?>
			<?php if ($image != false) : ?>

				<?php echo $opening_tag; ?>
			
					<img src="<?php bloginfo('template_directory'); ?>/-/img/blank.gif" data-src="<?= $image[0] ?>" alt="<?= $image_info->post_title ?>" title="<?= $image_info->post_excerpt ?>" />
					<?php endif; ?>
					<div class="shade"></div>
					<div class="quote">
						<span class="icon"></span>
						<?= wpautop($tops[0]->post_content) ?>
					</div>

					<?php
						$image_top = wp_get_attachment_image_src(get_post_meta($tops[0]->ID, 'publication_logo', TRUE), 'full-size');
						$image_info_top = get_post($tops[0]->ID);
					?>

						<?php if ($image_top) : ?>
						<img src="<?= $image_top[0] ?>" alt="<?= $image_info_top->post_title ?>" title="<?= $image_info_top->post_excerpt ?>" class="logo"/>

				<?php echo $closing_tag; ?>

			<?php endif; ?>
		</div>

		<div class="bottom clear presses">
			<div class="row clear">

				<?php foreach($full as $press) : ?>

				<div class="press clearfix">
					<div class="title">
						<h3>
							<a href="<?= get_post_meta($press->ID, 'url', TRUE) ?>" target="_blank">"
								<?php echo $press->post_content; ?>"</a>
						</h3>
					</div>
					<div class="meta loading">
						<h4>
							<?php echo $press->post_title; ?>
						</h4>
					</div>
				</div>

				<?php $full_index++; endforeach; ?>

			</div>
		</div>

		<div class="clear press-grid">

			<div class="press-grid-row">
				<?php
  $items_per_row = 3;
  $item_count = 1;
  ?>
					<?php foreach($grid as $press) : ?>

					<div class="press-grid-item">
						<h3>
							<a href="<?= get_post_meta($press->ID, 'url', TRUE) ?>" target="_blank">"
								<?php echo $press->post_content; ?>"</a>
						</h3>
						<h4>
							<?php echo $press->post_title; ?>
						</h4>
					</div>

					<?php
    if(($item_count % $items_per_row == 0) && ($item_count != count($grid))) {echo '</div><div class="press-grid-row">';}
    $item_count++; 
    ?>

						<?php $full_index++; endforeach; ?>
			</div>

		</div>


		<?php endwhile; ?>
		<?php get_footer(); ?>