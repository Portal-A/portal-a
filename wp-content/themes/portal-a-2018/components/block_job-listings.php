<?php

/**
 * job listings
 * ------------------------------------------------------- */
function pa_block_job_listings( $data, $options = array(), $return = false ) {

    $defaults = array(
        'style' => ''
    );

    $options = array_merge( $defaults, $options );

    ob_start(); 
    ?>

        <div class="pa-c-block--job-listings" style="<?php echo $options['style'] ?>">
            
            <div class="pa-l-container pa-l-flexbox pa-l-mb-2">
                <p class="pa-h3 pa-l-flex span-6" style="color:#9b9b9b">Position</p>
                <p class="pa-h3 pa-l-flex span-3" style="color:#9b9b9b">Location</p>
                <p class="pa-h3 pa-l-flex span-3" style="color:#9b9b9b">Department</p>
            </div>

            <ul class="pa-u-clean-list">

            <?php foreach ( $data['job_listings'] as $listing ) : ?>

                <div class="pa-c-accordion">

                    <div class="pa-l-container">
                        
                        <button class="pa-c-accordion__toggle pa-l-flexbox does-wrap js-accordion-toggle">
                            <p class="pa-l-mt-0 pa-l-flex span-6-md"><strong><?php echo $listing['position'] ?></strong></p>
                            <p class="pa-l-mt-0 pa-l-flex span-3-md" style="color:#9b9b9b"><?php echo $listing['location'] ?></p>
                            <p class="pa-l-mt-0 pa-l-flex span-3-md" style="color:#9b9b9b"><?php echo $listing['department'] ?></p>
                        </button>

                        <div class="pa-c-accordion__content pa-l-flexbox does-wrap js-accordion-content">
                            <div class="pa-l-flex span-5-md">
                                <small><?php echo $listing['description'] ?></small>
                            </div>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

            </ul>

		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}