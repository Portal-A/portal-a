<?php
/**
 * Blog Template
 */

get_header();

$blog_page_id = get_option('page_for_posts');
$blog_page = get_post($blog_page_id); 
$queried_object_id = get_queried_object_id();
?>

<?php 
    pa_hero( array( 
        // 'content' => '<div class="pa-h3 js-cat-display">'.( is_archive() ? get_the_archive_title() : '&nbsp;' ).'</div>'
    ), $blog_page );
?>

<div class="pa-c-page-content pa-l-pb-5">

    <?php if ( $blog_page->post_content ) : ?>

        <div class="pa-l-container">
        
            <?php pa_block_wysiwyg( array( 
                'wysiwyg' => apply_filters( 'the_content', get_the_content() ),
            ) ) ?>
            
        </div>

    <?php endif; ?>

    <div class="pa-l-mb-1 pa-l-mr-1 pa-l-flexbox js-upper-paging" style=" <?php echo 'opacity: ' . (get_query_var('paged') > 1 ? '1' : '0') ?> ">
        <div style="margin-left:auto">
            <?php pa_posts_nav() ?>
        </div>
    </div>

    <div class="js-post-carousel">

        <div class="pa-c-post-slide pa-u-transition-slow">
            <div class="pa-l-flexbox does-wrap with-gutters">
                <?php while ( have_posts() ) : the_post(); ?>
                

                        <?php pa_tile(array(
                            'url' => get_permalink(),
                            'type' => 'image',
                            'columns' => 4,
                            'has_spacing' => true,
                            'image' => get_post_thumbnail_id(),
                            'text' => get_the_title(),
                        )) ?>


                <?php endwhile; ?>
            </div>
        </div>

        <script class="js-post-template" type="text/mustache-template">
        
            <a href="{{link}}" class="pa-c-tile is-image pa-u-bg-black pa-l-mb-gutter pa-l-flex span-6-md span-4-lg">
                <span class="pa-c-tile__image" style="background-image:url({{featured_image}})"></span>
                <div class="pa-c-tile__content x-center y-center is-revealed pa-u-text-center">
                    <p class="pa-h5 pa-u-weight-bold pa-l-mt-0 pa-u-text-center">{{{title.rendered}}}</p>
                </div>
            </a>
        
        </script>

    </div>

    <nav class="pa-l-container pa-l-flexbox justify-center does-wrap pa-l-py-3">

        <?php 
        $found_posts = $wp_query->found_posts;
        $link_class = 'pa-h3 pa-u-weight-light pa-l-px-1 pa-l-my-half pa-l-flex pa-u-color-hover-primary js-cat-link';

        if ( is_category() ) {
            $query = new WP_Query(array( 'post_type' => 'post' ));
            $found_posts = $query->found_posts;
            $class = $link_class;
        } else {
            $class = $link_class . ' pa-u-color-primary';
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
            
            $class = $queried_object_id === $cat->term_id ? $link_class . ' pa-u-color-primary pa-u-weight-bold' : $link_class; ?>

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

    <div class="pa-l-mt-1 pa-l-mr-1 pa-l-flexbox">
        <div style="margin-left:auto">
            <?php pa_posts_nav() ?>
        </div>
    </div>

</div>

<?php get_footer() ?>