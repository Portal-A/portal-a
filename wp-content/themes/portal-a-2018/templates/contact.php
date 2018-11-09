<?php
/**
 * Template Name: Contact
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
                
                <div class="pa-l-flexbox does-wrap with-gutters pa-l-mt-5 pa-l-mb-4">
        
                    <div class="pa-l-flex span-6-md span-4-lg pa-u-text-center pa-l-mb-4">
                        <i class="pa-b-icon icon-envelope pa-u-display-inline-block" style="min-height: 72px; font-size:60px" aria-hidden="true"></i>
                        <p class="pa-h2 pa-l-mt-half">
                            <strong>New Projects</strong><br/>
                            <a href="mailto:biz@portal-a.com" class="pa-u-color-hover-primary">biz@portal-a.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex span-6-md span-4-lg pa-u-text-center pa-l-mb-4">
                        <i class="pa-b-icon icon-team pa-u-display-inline-block" style="min-height: 72px; font-size:60px" aria-hidden="true"></i>
                        <p class="pa-h2 pa-l-mt-half">
                            <strong>Join Our Team</strong><br/>
                            <a href="mailto:jobs@portal-a.com" class="pa-u-color-hover-primary">jobs@portal-a.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex span-6-md span-4-lg pa-u-text-center pa-l-mb-4">
                        <i class="pa-b-icon icon-hand pa-u-display-inline-block" style="min-height: 72px; font-size:72px" aria-hidden="true"></i>
                        <p class="pa-h2 pa-l-mt-half">
                            <strong>Say Hello</strong><br/>
                            <a href="mailto:info@portal-a.com" class="pa-u-color-hover-primary">info@portal-a.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex span-6-md span-4-lg pa-u-text-center pa-l-mb-4">
                        <i class="pa-b-icon icon-pencil pa-u-display-inline-block" style="min-height: 72px; font-size:60px" aria-hidden="true"></i>
                        <p class="pa-h2 pa-l-mt-half">
                            <strong>Press Inquiries</strong><br/>
                            <a href="mailto:donna@portal-a.com" class="pa-u-color-hover-primary">donna@portal-a.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex span-6-md span-4-lg pa-u-text-center pa-l-mb-4">
                        <i class="pa-b-icon icon-suitcase pa-u-display-inline-block" style="min-height: 72px; font-size:64px" aria-hidden="true"></i>
                        <p class="pa-h2 pa-l-mt-half">
                            <strong>Representation</strong><br/>
                            <a href="mailto:email@wme.com" class="pa-u-color-hover-primary">email@wme.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex span-6-md span-4-lg pa-u-text-center pa-l-mb-4">
                        <form >
                            <div class="pa-u-center" style="position:relative;width:100%;max-width:255px; margin: 17px 0">
                                <input type="email" placeholder="Email" name="email" class="pa-b-input pa-u-display-block" style="width:100%" />
                                <button type="submit" class="pa-b-submit">
                                    Sign up
                                </button>
                            </div>
                            <span class="pa-u-clearfix"></span>
                            <p class="pa-h2 pa-l-mt-half">
                                <strong>Stay In The Know</strong><br/>
                                Rarely sent, often enjoyed
                            </p>
                        </form>
                    </div>
        
                </div>

            </div>

            <?php
            $locations = new WP_Query(array(
                'post_type' => 'locations',
            ));

            if ( $locations->have_posts() ) : ?>

                <div class="pa-l-flexbox does-wrap">

                <?php
                while ( $locations->have_posts() ) : $locations->the_post(); ?>

                    <div class="pa-l-flex span-6-md">
                        
                        <?php pa_tile(array(
                            'type' => 'image',
                            'image' => get_post_thumbnail_id(),
                            'reveal_content' => false,
                            'text' => '<h2 class="pa-h1 pa-l-mt-0 pa-u-uppercase pa-u-weight-black">'.get_the_title().'</h2>'
                        )) ?>

                        <p class="pa-u-text-center pa-l-mb-3"><?php echo nl2br( get_post_meta( get_the_ID(), 'address', true ) ) ?></p>
                    
                    </div>

                <?php 
                endwhile; ?>
                
                </div>

            <?php
            endif;

            wp_reset_query();
            ?>
            
            <?php get_template_part( 'partials/blocks' ) ?>

        </div>

	</article>

	<?php endwhile; ?>

<?php get_footer(); ?>