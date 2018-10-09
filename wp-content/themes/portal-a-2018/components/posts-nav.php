<?php

function pa_posts_nav() {
    global $wp_query;

    ob_start(); ?>

        <nav class="navigation pagination" role="navigation">
            <h2 class="screen-reader-text">Posts navigation</h2>
            <a class="js-prev page-numbers pa-u-color-hover-primary" href="#">Previous</a>
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
            <a class="js-next page-numbers pa-u-color-hover-primary" href="#">Next</a>
        </nav>

    <?php 
    echo ob_get_clean();

}