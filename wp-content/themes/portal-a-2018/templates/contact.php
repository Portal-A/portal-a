<?php
/**
 * Template Name: Contact
 */

get_header();
?>

	<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('pa-l-pb-5') ?>>

		<div class="pa-c-hero is-fixed">
		
			<div class="pa-c-hero__media pa-c-cover-media js-parallax">
				<?php the_post_thumbnail( 'hero', array( 'class' => 'js-parallax-child' ) ); ?>
			</div>
			
        </div>

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

            <div class="pa-l-container">
            
                <?php pa_block_wysiwyg( array( 
                    'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
                ) ) ?>
                
                <div class="pa-l-flexbox pa-l-flex-wrap pa-l-with-gutters pa-l-mt-5">
        
                    <div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg pa-u-text-center pa-l-mb-4">
                        [icon]<br/>
                        <p class="pa-l-mt-half">
                            <strong>New Projects</strong><br/>
                            <a href="mailto:biz@portal-a.com" class="pa-u-color-hover-primary">biz@portal-a.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg pa-u-text-center pa-l-mb-4">
                        [icon]<br/>
                        <p class="pa-l-mt-half">
                            <strong>Join Our Team</strong><br/>
                            <a href="mailto:jobs@portal-a.com" class="pa-u-color-hover-primary">jobs@portal-a.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg pa-u-text-center pa-l-mb-4">
                        [icon]<br/>
                        <p class="pa-l-mt-half">
                            <strong>Say Hello</strong><br/>
                            <a href="mailto:info@portal-a.com" class="pa-u-color-hover-primary">info@portal-a.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg pa-u-text-center pa-l-mb-4">
                        [icon]<br/>
                        <p class="pa-l-mt-half">
                            <strong>Press Inquiries</strong><br/>
                            <a href="mailto:donna@portal-a.com" class="pa-u-color-hover-primary">donna@portal-a.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg pa-u-text-center pa-l-mb-4">
                        [icon]<br/>
                        <p class="pa-l-mt-half">
                            <strong>Representation</strong><br/>
                            <a href="mailto:email@wme.com" class="pa-u-color-hover-primary">email@wme.com</a>
                        </p>
                    </div>
                    
                    <div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg pa-u-text-center pa-l-mb-4">
                        <form >
                            <div class="pa-u-center" style="position:relative;width:100%;max-width:220px">
                                <input type="email" placeholder="Email" name="email" class="pa-b-input pa-u-display-block" style="width:100%" />
                                <button type="submit" class="pa-b-submit">
                                    S
                                </button>
                            </div>
                            <p class="pa-l-mt-half">
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

                <div class="pa-l-flexbox pa-l-flex-wrap">

                <?php
                while ( $locations->have_posts() ) : $locations->the_post(); ?>

                    <div class="pa-l-flex pa-l-span-6-md">
                        <div class="pa-c-cover-media does-scale" style="padding-top:43%">
                            <?php the_post_thumbnail('large'); ?>
                            <div class="pa-c-cover-media__cover does-fade">
                                <p class="pa-h1 pa-l-mt-0"><?php the_title(); ?></p>
                            </div>
                        </div>
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