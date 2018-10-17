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

                <section id="branded" data-view-top="#view-nav" class="js-view-target" style="background-image:url(//picsum.photos/1200/1170); background-size:cover; background-position:center">
                    <div class="pa-c-ability-grid">
                        <div class="pa-c-ability-column">
                            <?php foreach ( [0,1,2] as $item ) : ?>
                                <a href="#" class="pa-c-ability js-ability">
                                    <h2 class="pa-c-ability__title">Branded</h2>
                                    <div class="pa-c-ability__content">
                                        <p>We develop big ideas built for small screens – formats and concepts that break through the noise, and are designed for a connected audience. We develop big ideas built for small screens – formats and concepts that break through the noise. We develop big ideas built for small screens – formats and concepts that break through the noise.</p>
                                        <div class="pa-l-flexbox pa-l-mt-2">
                                            <div class="pa-l-flex">lower content here</div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="pa-c-ability-column">
                            <?php foreach ( [0,1,2] as $item ) : ?>
                                <a href="#" class="pa-c-ability js-ability">
                                    <h2 class="pa-c-ability__title">Branded</h2>
                                    <div class="pa-c-ability__content">
                                        <p>We develop big ideas built for small screens – formats and concepts that break through the noise, and are designed for a connected audience. We develop big ideas built for small screens – formats and concepts that break through the noise. We develop big ideas built for small screens – formats and concepts that break through the noise.</p>
                                        <div class="pa-l-flexbox pa-l-mt-2">
                                            <div class="pa-l-flex">lower content here</div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <section id="originals" data-view-top="#view-nav" class="js-view-target" style="display:none; background-image:url(//picsum.photos/1170/1170); background-size:cover; background-position:center">
                    <div class="pa-l-flexbox" style="width:100%">
                        <div class="pa-c-ability-column">
                            <?php foreach ( [0,1,2] as $item ) : ?>
                                <a href="#" class="pa-c-ability js-ability">
                                    <h2 class="pa-c-ability__title">Original</h2>
                                    <div class="pa-c-ability__content">
                                        <p>We develop big ideas built for small screens – formats and concepts that break through the noise, and are designed for a connected audience. We develop big ideas built for small screens – formats and concepts that break through the noise. We develop big ideas built for small screens – formats and concepts that break through the noise.</p>
                                        <div class="pa-l-flexbox pa-l-mt-2">
                                            <div class="pa-l-flex">lower content here</div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="pa-c-ability-column">
                            <?php foreach ( [0,1,2] as $item ) : ?>
                                <a href="#" class="pa-c-ability js-ability">
                                    <h2 class="pa-c-ability__title">Original</h2>
                                    <div class="pa-c-ability__content">
                                        <p>We develop big ideas built for small screens – formats and concepts that break through the noise, and are designed for a connected audience. We develop big ideas built for small screens – formats and concepts that break through the noise. We develop big ideas built for small screens – formats and concepts that break through the noise.</p>
                                        <div class="pa-l-flexbox pa-l-mt-2">
                                            <div class="pa-l-flex">lower content here</div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

            </div>

		</div>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>