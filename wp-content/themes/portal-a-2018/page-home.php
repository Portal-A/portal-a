<?php
/*
TEMPLATE NAME: Home
*/
?>

<?php get_header(); ?>

  <?php
    $fileMP4 = get_field('mp4_video_file');
    $fileOGV = get_field('ogv_video_file');
    $fileWEBM = get_field('webm_video_file');
    $bgVideo = get_field('background_video');
  ?>

  <div class="pa-c-hero is-video">
    <video class="pa-c-hero__media" controls muted>
      <source src="<?php echo $fileWEBM['url']; ?>" type="video/webm">
      <source src="<?php echo $fileMP4['url']; ?>" type="video/mp4">
      <source src="<?php echo $fileOGV['url']; ?>" type="video/ogv">
      Your browser does not support the video tag.
    </video>
    <div class="pa-c-hero__content">
        <?php echo apply_filters('the_content', get_post_meta( 2, 'headline', TRUE ) ); ?>
    </div>
  </div>

<?php get_footer(); ?>
