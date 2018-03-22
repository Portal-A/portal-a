
<div class="blog-content clear">
	<div class="left">
		
		<?php if (have_posts()) while (have_posts()) : the_post(); ?>
		<div class="post clear">
			<div class="lefty">
				<h2><?= mysql2date('m/d/y', $post->post_date) ?></h2>
				<h5>Categories</h5>
				<?= fuzzco_posted_in_short() ?>
				<?php if (!is_singular('post')) : ?>
				<h5>Comments</h5>
				<?php comments_popup_link( 'Add/View', 'Add/View', '%', 'comments-link', ''); ?>
				<?php endif; ?>
			</div>
			<div class="righty">
			
				<?php if (is_singular('post')) : ?>
				<h2><?= $post->post_title ?></h2>
				<?php else : ?>
				<h2><a href="<?= get_permalink($post->ID) ?>"><?= $post->post_title ?></a></h2>
				<?php endif; ?>
				
				<?= the_content() ?>
				
			</div>
			
		</div>
		
		<?php if (is_singular('post')): ?>
		<div class="post clear">
			<div class="lefty">
				<h2>Comments</h2>
			</div>
			<div class="righty">
				<h2>for <?= $post->post_title ?></h2>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=380247355384665";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				
				<div class="#respond">
					<div class="fb-comments" data-href="<?= get_permalink($post->ID) ?>" data-num-posts="2" data-width="560"></div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<?php endwhile; ?>

		<?php if (!is_singular('post')): ?>
		<div class="post-controls clear">
			<span class="older-link"><?php next_posts_link('Older Posts') ?></span>
			<span class="newer-link"><?php previous_posts_link('Newer Posts') ?></span>
		</div>
		<?php endif; ?>
		
	</div>
	<div class="right">
		
		<h2>Portal A Blog</h2>
		<h5>Post Categories</h5>
		<ul>
			<?php wp_list_categories('orderby=name&title_li='); ?>
		</ul>
		<h5>Follow Our Blog</h5>
		<ul>
			<li><a href="http://www.google.com/ig/addtoreader?et=gEs490VY&source=ign_pLt&
feedurl=<?= get_bloginfo('rss2_url') ?>&feedtitle=<?= get_bloginfo('title') ?>">Add to Google Reader</a></li>
			<li><a href="<?= get_bloginfo('rss2_url') ?>">RSS Feed</a></li>
			<li><a href="<?= get_bloginfo('atom_url') ?>">Atom Feed</a></li>
		</ul>
		
	</div>
</div>