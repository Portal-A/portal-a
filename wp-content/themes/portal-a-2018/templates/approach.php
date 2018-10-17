<?php
/**
 * Template Name: Approach
 */

get_header();
?>

	<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-l-pb-5') ?>>

		<?php pa_hero() ?>

		<div class="pa-c-page-content">

			<div class="pa-l-container">
			
				<?php pa_block_wysiwyg( array( 
					'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
				) ) ?>

                <?php get_template_part( 'partials/blocks' ) ?>

                <nav id="view-nav" class="pa-l-ma-0 pa-l-py-1 pa-u-text-center" aria-label="Approach Category Navigation">
                    <a href="#branded" class="pa-b-view-toggle js-view-toggle is-active">Branded</a>
                    <a href="#originals" class="pa-b-view-toggle js-view-toggle">Originals</a>
                </nav>

                <?php 
                $branded_image_id = get_field( 'branded_image' );
                $branded_image_url = wp_get_attachment_image_url($branded_image_id, 'large'); 
                ?>

                <section id="branded" data-view-top="#view-nav" class="js-view-target">
                    <div class="pa-c-ability-grid" style="background-image:url(<?php echo $branded_image_url ?>)">
                        <div class="pa-c-ability-column">
                            <?php 
                            $count = 1;
                            foreach ( (array) get_field( 'branded_abilities' ) as $item ) {
                                pa_ability($item);

                                if ( $count === 3 ) { ?>
                                    </div>
                                    <div class="pa-c-ability-column">
                                <?php }

                            $count++;
                            } ?>
                        </div>
                    </div>
                </section>

                <?php 
                $originals_image_id = get_field( 'originals_image' );
                $originals_image_url = wp_get_attachment_image_url($originals_image_id, 'large'); 
                ?>

                <section id="originals" data-view-top="#view-nav" class="js-view-target" style="display:none">
                    <div class="pa-c-ability-grid" style="background-image:url(<?php echo $originals_image_url ?>)">
                        <div class="pa-c-ability-column">
                            <?php 
                            $count = 1;
                            foreach ( (array) get_field( 'originals_abilities' ) as $item ) {
                                pa_ability($item);

                                if ( $count === 3 ) { ?>
                                    </div>
                                    <div class="pa-c-ability-column">
                                <?php }

                            $count++;
                            } ?>
                        </div>
                    </div>
                </section>

                <section id="additional-capabilities" class="pa-l-mt-5">
                    <p class="pa-u-uppercase pa-u-text-center"><small>Additional Capabilities</small></p>
                    <div class="pa-l-flexbox with-gutters does-wrap pa-l-mt-3">
                        <?php while ( have_rows('additional_abilities') ) : the_row(); ?>
                            <div class="pa-l-flex span-6 span-4-sm span-3-lg span-2-xl"><?php echo get_sub_field('name'); ?></div>
                        <?php endwhile; ?>
                    </div>
                </section>

            </div>

		</div>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>