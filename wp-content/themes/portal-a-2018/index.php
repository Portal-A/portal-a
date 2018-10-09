<?php
/**
 * Blog Template
 */

global $wp_query;

get_header();

$blog_page_id = get_option('page_for_posts');
$blog_page = get_post($blog_page_id); 
$queried_object_id = get_queried_object_id();
?>

<?php 
    pa_hero( array( 
        'content' => '<span class="pa-h3 js-cat-display">&nbsp;</span>'
    ), $blog_page );
?>

<div class="pa-c-page-content pa-l-mt-4 pa-l-pb-5">

    <?php if ( $blog_page->post_content ) : ?>

        <div class="pa-l-container">
        
            <?php pa_block_wysiwyg( array( 
                'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
            ) ) ?>
            
        </div>

    <?php endif; ?>

    <div class="js-post-carousel">

        <div class="pa-c-post-slide">
            <?php while ( have_posts() ) : the_post(); ?>
            
            <div class="pa-l-flex span-6-md span-4-lg">

                <?php pa_tile(array(
                    'url' => get_permalink(),
                    'type' => 'image',
                    'has_spacing' => true,
                    'image' => get_post_thumbnail_id(),
                    'text' => get_the_title(),
                )) ?>

            </div>

            <?php endwhile; ?>
        </div>

        <script class="js-post-template" type="text/mustache-template">
        
            <div class="pa-l-flex span-6-md span-4-lg">

                <a href="{{link}}" class="pa-c-tile is-image pa-u-bg-black pa-l-mb-gutter pa-l-flex span-12">
                    <span class="pa-c-tile__image" style="background-image:url({{featured_image}})"></span>
                    <div class="pa-c-tile__content x-center y-center is-revealed pa-u-text-center">
                        <p class="pa-h5 pa-u-weight-bold pa-l-mt-0 pa-u-text-center">{{{title.rendered}}}</p>
                    </div>
                </a>

            </div>
        
        </script>

    </div>

    <nav class="pa-l-container pa-l-flexbox pa-l-justify-space-between does-wrap pa-l-py-3">

        <?php 
        $found_posts = $wp_query->found_posts;
        $link_class = 'pa-l-flex pa-u-color-hover-primary js-cat-link';

        if ( is_category() ) {
            $query = new WP_Query(array( 'post_type' => 'post' ));
            $found_posts = $query->found_posts;
            $class = $link_class;
        } else {
            $class = $link_class . ' pa-u-color-primary pa-u-underline';
        } ?>

        <a href="<?php echo get_permalink( $blog_page_id ) ?>" 
           data-cat-id="0"
           data-count="<?php echo $found_posts ?>"
           class="<?php echo $class ?>"
           style="white-space:nowrap">
            All
        </a>

        <?php $cats = get_terms( 'category' );
        foreach ( $cats as $cat ) :
            
            $class = $queried_object_id === $cat->term_id ? $link_class . ' pa-u-color-primary pa-u-underline' : $link_class; ?>

            <a href="<?php echo get_term_link( $cat, 'category' ) ?>" 
            data-cat-id="<?php echo $cat->term_id ?>"
            data-count="<?php echo $cat->count ?>"
            class="<?php echo $class ?>",
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
                <a class="js-prev page-numbers" href="#">Previous</a>
                &nbsp;&nbsp;
                <span class="js-current-page">
                    <?php 
                    $page = get_query_var( 'paged' );
                    $page = $page === 0 ? 1 : $page;
                    echo $page; ?>
                </span>
                /
                <span class="js-total-pages">
                    <?php echo $wp_query->max_num_pages ?>
                </span>
                &nbsp;&nbsp;
                <a class="js-next page-numbers" href="#">Next</a>
            </nav>
        </div>
    </div>

</div>

<?php get_footer() ?>