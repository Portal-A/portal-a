<?php
/**
 * Blog Template
 */

global $wp_query;

get_header();

$blog_page_id = get_option('page_for_posts');
$blog_page = get_post($blog_page_id); 
?>

    <section <?php post_class('pa-l-pb-5') ?>>

        <div class="pa-c-hero is-fixed">
        
            <div class="pa-c-hero__media pa-c-cover-media js-parallax">
                <?php get_the_post_thumbnail( $blog_page, 'hero', array( 'class' => 'js-parallax-child' ) ); ?>
            </div>
            
        </div>

        <div class="pa-c-page-content">
        
            <div class="pa-c-hero-tab">
                <div class="pa-c-hero-tab__inner">
                    <h1 class="pa-u-text-center pa-l-mt-0">
                        <?php 
                        if ( $blog_page->post_excerpt ) :
                            echo $blog_page->post_excerpt;
                        else :
                            echo apply_filters( 'the_title', $blog_page->post_title );
                        endif; 
                        ?>
                    </h1>
                </div>
            </div>

            <?php if ( $blog_page->post_content ) : ?>

                <div class="pa-l-container">
                
                    <?php pa_block_wysiwyg( array( 
                        'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
                    ) ) ?>
                    
                </div>

            <?php endif; ?>

            <div class="pa-l-mt-5">

                <?php
                $data = array(
                    'tiles' => array(),
                    'tile_options' => array('spacing')
                );

                foreach ( $wp_query->posts as $blog_post ) {
                    $data['tiles'][] = array(
                        'url' => get_permalink( $blog_post ),
                        'image' => get_post_thumbnail_id( $blog_post ), //7852
                        'image_options' => array('proportional_image'),
                        'text' => $blog_post->post_title,
                        'type' => 'image',
                        'columns' => '4'
                    );
                }
                pa_block_tiles($data); ?>

            </div>

            <nav class="pa-l-container pa-l-flexbox pa-l-justify-space-between pa-l-flex-wrap pa-l-py-3">
                <?php $cats = get_terms( 'category' );
                foreach ( $cats as $cat ) : ?>

                    <a href="<?php echo get_term_link( $cat, 'category' ) ?>" 
                    class="pa-l-flex pa-u-color-hover-primary",
                    style="white-space:nowrap">
                        <?php echo $cat->name; ?>
                    </a>

                <?php endforeach; ?>
            </nav>

            <hr/>

            <div class="pa-l-container pa-l-mt-1 pa-l-flexbox" style="font-size:14px">
                <div style="margin-left:auto">
                    <?php the_posts_pagination( array(
                        'mid_size' => 2,
                    ) ); ?>
                </div>
            </div>

        </div>

    </section>


<?php get_footer() ?>