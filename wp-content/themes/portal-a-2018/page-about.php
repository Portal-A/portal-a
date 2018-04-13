<?php
/*
TEMPLATE NAME: About Page
*/
?>

<?php get_header(); ?>
<?php if (have_posts()) while (have_posts()) : the_post(); ?>

	<?php
	$args = array(
		'numberposts' => -1,
		'post_type' => 'partners',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_status' => 'publish'
	);

	$items = get_posts($args);
	?>

	<?php
	$image_1_up = wp_get_attachment_image_src(get_post_meta($items[0]->ID, 'image_up', TRUE), 'full-size');
	$image_info_1_up = get_post($items[0]->ID);
	$image_1_over = wp_get_attachment_image_src(get_post_meta($items[0]->ID, 'image_over', TRUE), 'full-size');
	$image_info_1_over = get_post($items[0]->ID);

	$image_2_up = wp_get_attachment_image_src(get_post_meta($items[1]->ID, 'image_up', TRUE), 'full-size');
	$image_info_2_up = get_post($items[1]->ID);
	$image_2_over = wp_get_attachment_image_src(get_post_meta($items[1]->ID, 'image_over', TRUE), 'full-size');
	$image_info_2_over = get_post($items[1]->ID);

	$image_3_up = wp_get_attachment_image_src(get_post_meta($items[2]->ID, 'image_up', TRUE), 'full-size');
	$image_info_3_up = get_post($items[2]->ID);
	$image_3_over = wp_get_attachment_image_src(get_post_meta($items[2]->ID, 'image_over', TRUE), 'full-size');
	$image_info_3_over = get_post($items[2]->ID);
	?>

	<div class="partner-images">
		<div class="coin">
			<div class="heads">
				<img src="<?= $image_1_up[0] ?>" alt="<?= $image_info_1_up->post_title ?>" title="<?= $image_info_1_up->post_excerpt ?>" />
			</div>
			<div class="tails">
				<img src="<?= $image_1_over[0] ?>" alt="<?= $image_info_1_over->post_title ?>" title="<?= $image_info_1_over->post_excerpt ?>" />
			</div>
		</div>
		<div class="coin">
			<div class="heads">
				<img src="<?= $image_2_up[0] ?>" alt="<?= $image_info_2_up->post_title ?>" title="<?= $image_info_2_up->post_excerpt ?>" />
			</div>
			<div class="tails">
				<img src="<?= $image_2_over[0] ?>" alt="<?= $image_info_2_over->post_title ?>" title="<?= $image_info_2_over->post_excerpt ?>" />
			</div>
		</div>
		<div class="coin last">
			<div class="heads">
				<img src="<?= $image_3_up[0] ?>" alt="<?= $image_info_3_up->post_title ?>" title="<?= $image_info_3_up->post_excerpt ?>" />
			</div>
			<div class="tails">
				<img src="<?= $image_3_over[0] ?>" alt="<?= $image_info_3_over->post_title ?>" title="<?= $image_info_3_over->post_excerpt ?>" />
			</div>
		</div>
	</div>

	<div class="clear">
		<div class="left">
			<?php if (get_post_meta(2, 'partners_title', TRUE) != '') : ?>
				<h2>
					<?= get_post_meta(2, 'partners_title', TRUE); ?>
					<?php if (get_post_meta(2, 'partners_subtitle', TRUE) != '') : ?>
						<span class="l-r"><?= get_post_meta(2, 'partners_subtitle', TRUE); ?></span>
					<?php endif; ?>
				</h2>
			<?php endif; ?>
			<?php foreach ($items as $item) : ?>
				<div class="partner-name clear">
					<?php if (get_post_meta($item->ID, 'email', TRUE) != '') : ?>
            <h3 class="<?= $item->post_name ?>">
              <a class="email-address" href="<?= get_post_meta($item->ID, 'twitter_url', TRUE) ?>" target="_blank">
                <?php echo $item->post_title ?>
              </a>
            </h3>
            <a href="<?= get_post_meta($item->ID, 'twitter_url', TRUE) ?>" class="partner-email hide" target="_blank">twitter</a>
					<?php endif; ?>
				</div>
				<?= wpautop(get_post_meta($item->ID, 'title', TRUE)) ?>
			<?php endforeach; ?>
		</div>
		<div class="right">
			<?= the_content() ?>
		</div>
	</div>

		<div class="team clear">
      <div id="tabs">
        <!-- TEAM -->
        <?php $args = array(
            'numberposts' => -1,
            'post_type' => 'about',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_status' => 'publish'
          );

          $items = get_posts($args);
          $item_count = count($items);
          $about_index = 1;
          if ($item_count > 0):
        ?>
          <ul>
            <li><h4><a href="#team">Our Team</a></h4></li>
            <?php foreach ($items as $item) : ?>
            <li><h4><a href="/about/<?php echo $item->post_name; ?>" rel=".content"><?php echo $item->post_title;?></a></h4></li>
            <?php $about_index++; endforeach; ?>
          </ul>
        <?php endif; ?>
        <div id="team">
          <?php $args = array(
              'numberposts' => -1,
              'post_type' => 'team',
              'orderby' => 'menu_order',
              'order' => 'ASC',
              'post_status' => 'publish'
            );

            $items = get_posts($args);
            $item_count = count($items);
            $team_index = 1;
            if ($item_count > 0):
          ?>
          <?php foreach ($items as $item) : ?>
            <div class="team-member <?= $team_index % 3 == 0 && $team_index != 0 ? 'last' : '' ?>">
              <?php
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'medium');
                $image_info = get_post($item->ID);
                $hover_image_id = get_post_meta($item->ID, 'hover_photo', TRUE);
                $hover_image = wp_get_attachment_image_src($hover_image_id, 'medium');
              ?>
              <?php if ($image != false) : ?>
                <?php if (trim(get_post_meta($item->ID, 'team_twitter', TRUE)) != ''): ?>
                  <a href="<?= get_post_meta($item->ID, 'team_twitter', TRUE); ?>" target="_blank">
                    <?php if($hover_image): ?>
                      <img class="hover-photo" src="<?= $hover_image[0] ?>" alt="<?= $image_info->post_title ?>" title="<?= $image_info->post_excerpt ?>" />
                    <?php endif; ?>
                    <img src="<?= $image[0] ?>" alt="<?= $image_info->post_title ?>" title="<?= $image_info->post_excerpt ?>" />
                  </a>
                <?php else: ?>
                  <img src="<?= $image[0] ?>" alt="<?= $image_info->post_title ?>" title="<?= $image_info->post_excerpt ?>" />
                <?php endif; ?>
              <?php endif; ?>
              <h3><?= $item->post_title ?></h3>
              <?php if (trim(get_post_meta($item->ID, 'title', TRUE)) != ''): ?>
                <h4><?= get_post_meta($item->ID, 'title', TRUE); ?></h4>
              <?php endif; ?>
            </div>
          <?php $team_index++; endforeach; ?>
        </div>
      </div>
		</div>
	<?php endif; ?>

<?php endwhile; ?>
<?php get_footer(); ?>
