<?php
/**
 * Blog Template
 */

global $wp_query;

get_header();

$blog_page_id = get_option('page_for_posts');
$blog_page = get_post($blog_page_id); 
?>

<div class="pa-c-hero is-fixed">

    <div class="pa-c-hero__media pa-c-cover-media js-parallax">
        <?php get_the_post_thumbnail( $blog_page, 'hero', array( 'class' => 'js-parallax-child' ) ); ?>
    </div>
    
</div>

<div class="pa-c-page-content pa-l-pb-5">

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

    <div class="pa-l-mt-5 js-post-carousel">

        <div class="pa-c-post-slide">
            <?php while ( have_posts() ) : the_post(); ?>
            
            <div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg">
                <a href="<?php the_permalink() ?>" class="pa-c-cover-media pa-l-mb-gutter does-scale does-fade" style="padding-top:100%">
                    <?php the_post_thumbnail('large') ?>
                    <div class="pa-c-cover-media__content is-animated fade-in from-bottom use-light-ui pa-u-text-center" style="width:100%">
                        <p class="pa-h4 pa-l-mt-0"><?php the_title() ?></p>
                    </div>
                </a>
            </div>

            <?php endwhile; ?>
        </div>

        <script class="js-post-template" type="text/mustache-template">
        
            <div class="pa-l-flex pa-l-span-6-md pa-l-span-4-lg">
                <a href="{{link}}" class="pa-c-cover-media pa-l-mb-gutter does-scale does-fade" style="padding-top:100%">
                    {{{featured_image}}}
                    {{#title.rendered}}
                        <div class="pa-c-cover-media__content is-animated fade-in from-bottom use-light-ui pa-u-text-center" style="width:100%">
                            <p class="pa-h4 pa-l-mt-0">{{{title.rendered}}}</p>
                        </div>
                    {{/title.rendered}}
                </a>
            </div>
        
        </script>

    </div>

    <nav class="pa-l-container pa-l-flexbox pa-l-justify-space-between pa-l-flex-wrap pa-l-py-3">
        <?php $cats = get_terms( 'category' );
        foreach ( $cats as $cat ) : ?>

            <a href="<?php echo get_term_link( $cat, 'category' ) ?>" 
            class="pa-l-flex pa-u-color-hover-primary js-cat-link",
            style="white-space:nowrap">
                <?php echo $cat->name; ?>
            </a>

        <?php endforeach; ?>
    </nav>

    <hr/>

    <div class="pa-l-container pa-l-mt-1 pa-l-flexbox" style="font-size:14px">
        <div style="margin-left:auto">
            <nav class="navigation pagination" role="navigation">
                <h2 class="screen-reader-text">Posts navigation</h2>
                <!-- <div class="nav-links"><span aria-current="page" class="page-numbers current">1</span>
                <a class="page-numbers" href="http://portal-a.local/blog/page/2/">2</a>
                <a class="page-numbers" href="http://portal-a.local/blog/page/3/">3</a>
                <span class="page-numbers dots">…</span>
                <a class="page-numbers" href="http://portal-a.local/blog/page/17/">17</a> -->
                <a class="js-prev page-numbers" href="#">Previous</a>
                &nbsp;|&nbsp;
                <a class="js-next page-numbers" href="#">Next</a>
            </nav>
        </div>
    </div>

</div>

<?php get_footer() ?>