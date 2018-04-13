<?php
/*
TEMPLATE NAME: Home
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

  $fileMP4 = get_field('mp4_video_file');
  $fileOGV = get_field('ogv_video_file');
  $fileWEBM = get_field('webm_video_file');

  $bgVideo = get_field('background_video');
?>


<div class="slideshow video-holder">
  <div class="video loading" id="bgVideo" data-bgvideo="<?php echo $bgVideo; ?>"></div>
	<div class="slideshow-headline"><?php echo wpautop(get_post_meta(2, 'headline', TRUE)); ?></div>
  <a class="reel-button" href="#reel" data-video="<?php echo $fileMP4['url']; ?>"><?php the_field('video_button_text');?></a>
</div>

<div class="open-popup-link mfp-hide" id="reel">
  <video controls>
    <source src="<?php echo $fileMP4['url']; ?>" type="video/mp4">
    <source src="<?php echo $fileOGV['url']; ?>" type="video/ogv">
    <source src="<?php echo $fileWEBM['url']; ?>" type="video/webm">
    Your browser does not support the video tag.
  </video>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>
