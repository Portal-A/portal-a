<?php
/*
TEMPLATE NAME: Approach Page
*/
?>

<?php get_header(); ?>
<?php if (have_posts()) while (have_posts()) : the_post(); ?>

<div class="services-wrapper">
	<h2 class="page-headline">
		<?php echo get_the_content(); ?>
	</h2>

	<?php
	$args = array(
		'numberposts' => -1,
		'post_type' => 'service',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_status' => 'publish'
	);
	$services = get_posts($args);
	?>

	<div class="services-list">
		<?php foreach($services as $index=>$service): ?>
    <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($service->ID), 'thumbnail_size' ); ?>
    <?php $thumbnail_id = get_post_meta($service->ID, 'icon', true); ?>

    <div id="service-<?php echo $index+1; ?>" class="service item <?php if ((($index+1)%3)==0) echo " right"; ?>">
			<div class="service-content" style="background-image: url(<?php echo $url = $thumb['0']; ?>);">

				<div class="x">&times;</div>

				<div class="overlay"></div>

				<h2><?php echo $service->post_title; ?></h2>

				<h6>+</h6>

				<div class="description">
          <div class="description-holder">
            <div class="description-holder-block">
              <h2><?php echo $service->post_title; ?></h2>
              <div class="icon"><?php echo wp_get_attachment_image($thumbnail_id, 'thumbnail'); ?></div>
              <p><?php echo $service->post_content; ?></p>
            </div>
          </div>
				</div>
			</div>
		</div>

		<?php endforeach; ?>
		<div class="bar"></div>
	</div>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>
