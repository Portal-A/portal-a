<?php
/**
 * Template Name: Partners
 */

get_header();
?>

	<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-l-pb-5') ?> >

		<?php pa_hero() ?>

		<div class="pa-c-page-content">
				
			<div class="pa-c-hero-tab">
				<div class="pa-c-hero-tab__inner">
					<h1 class="pa-u-text-center pa-l-mt-0">
						<?php 
						if ( $post->post_excerpt ) :
							echo $post->post_excerpt;
						else :
							the_title();
						endif; 
						?>
					</h1>
				</div>
			</div>

			<?php
			$partners = new WP_Query(array(
				'post_type' => 'client-partners',
				'posts_per_page' => 500
			));?>

			<div class="pa-l-container" style="max-width:1312px">
				
				<div class="pa-l-flexbox pa-l-flex-wrap pa-l-with-gutters pa-l-mt-5">
		
					<?php while ( $partners->have_posts() ) : $partners->the_post();
					
						$hex = get_field('partner_hex');
						$link = get_field('partner_custom_link');
						if ( ! $link ) {
							$partner_work = get_field('partner_work');
							$link = $partner_work ? get_permalink( $partner_work ) : false;
						}
						$tag = $link ? 'a' : 'div';
						$class = $link ? 'class="pa-u-display-inline-block pa-b-underline-link is-thick"' : 'class="pa-u-display-inline-block"';
						$href = $link ? 'href="'.esc_url($link).'"' : '';
						?>
					
						<div class="pa-l-flex span-6 span-4-md span-3-lg pa-u-text-center pa-l-mb-4">
							<?php echo "<$tag $href $class>" ?>
								<?php the_post_thumbnail( 'medium', array( 'style' => 'display:inline-block; max-width:200px; max-height: 75px; width:auto; height: auto;' ) ) ?>
								<?php if ( $link ) : ?>
									<span class="pa-b-underline-bar" role="presentation" style="background-color:<?php echo $hex ?>"></span>
								<?php endif; ?>
							<?php echo "</$tag>" ?>
						</div>

					<?php endwhile; ?>
		
				</div>

			</div>

			<p class="pa-u-text-center pa-l-mt-5">
				<a href="<?php echo site_url('work/'); ?>" class="pa-b-button">View All Work</a>
			</p>

		</div>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>