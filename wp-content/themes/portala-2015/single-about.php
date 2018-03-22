<?php
/*
TEMPLATE NAME: About
*/
?>
<?php if (have_posts()) while (have_posts()) : the_post(); ?>
  <div class="about">
    <?php if ( has_post_thumbnail() ) { ?>
      <div class="left-side">
        <?php the_post_thumbnail(); ?>
      </div>
      <div class="right-side">
        <?php the_content(); ?>
      </div>
    <?php } else { ?>
      <?php the_content(); ?>
    <?php } ?>
  </div>
<?php endwhile; ?>
