<?php
/**
 * Component Functions
 * ------------------------------------------------------- */

/**
 * blockquote
 * ------------------------------------------------------- */
function pa_block_blockquote( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--blockquote">
			<blockquote>
                <?php 
                echo $data['text'];
                $cite_image = wp_get_attachment_image( $data['cite'], 'medium' );
                if ( $cite_image ) : ?>
                    <cite><?php echo $cite_image ?></cite>
                <?php endif; ?>
			</blockquote>
		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}

/**
 * embeds
 * ------------------------------------------------------- */
function pa_block_embeds( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--embeds <?php echo "grid-{$data['grid']}" ?>">

            <?php foreach ( $data['embeds'] as $embed ) : ?>

			<div class="pa-c-block--embeds-item">
				<div class="pa-c-block__video pa-c-media--16x9">
					<?php echo $embed['oEmbed'] ?>
				</div>
            </div>
            
            <?php endforeach; ?>

        </div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}

/**
 * images
 * ------------------------------------------------------- */
function pa_block_images( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--images <?php echo "grid-{$data['grid']}" ?>">
            
            <?php foreach ( $data['images'] as $image ) : ?>
            
                <div class="pa-c-block__images-item"> 
                    <?php echo wp_get_attachment_image( $image['image'], 'large' ) ?>    
                </div>
            
            <?php endforeach; ?>

		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}

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
                <p class="pa-h3 pa-l-flex pa-l-span-6" style="color:#9b9b9b">Position</p>
                <p class="pa-h3 pa-l-flex pa-l-span-3" style="color:#9b9b9b">Location</p>
                <p class="pa-h3 pa-l-flex pa-l-span-3" style="color:#9b9b9b">Department</p>
            </div>

            <ul class="pa-u-clean-list">

            <?php foreach ( $data['job_listings'] as $listing ) : ?>

                <div class="pa-c-accordion">

                    <div class="pa-l-container">
                        
                        <button class="pa-c-accordion__toggle pa-l-flexbox pa-l-flex-wrap js-accordion-toggle">
                            <p class="pa-l-mt-0 pa-l-flex pa-l-span-6-md"><strong><?php echo $listing['position'] ?></strong></p>
                            <p class="pa-l-mt-0 pa-l-flex pa-l-span-3-md" style="color:#9b9b9b"><?php echo $listing['location'] ?></p>
                            <p class="pa-l-mt-0 pa-l-flex pa-l-span-3-md" style="color:#9b9b9b"><?php echo $listing['department'] ?></p>
                        </button>

                        <div class="pa-c-accordion__content pa-l-flexbox pa-l-flex-wrap js-accordion-content">
                            <div class="pa-h5 pa-l-mt-0 pa-l-flex pa-l-span-5-md">
                                <?php echo $listing['description'] ?>
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

/**
 * statement
 * ------------------------------------------------------- */
function pa_block_statement( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--statement">
			<?php echo $data['statement'] ?>
		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}

/**
 * stats
 * ------------------------------------------------------- */
function pa_block_stats( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--stats">

            <?php foreach ( $data['stats'] as $stat ) : ?>
            
            <div class="pa-c-block__stat">
				<div class="pa-c-block__stat-figure pa-h2"><?php echo $stat['figure'] ?></div>
				<div class="pa-c-block__stat-text"><?php echo $stat['text'] ?></div>
            </div>

            <?php endforeach; ?>
			
		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}

/**
 * team members
 * ------------------------------------------------------- */
function pa_block_team_members( $data, $options = array(), $return = false ) {

    if ( empty( $data['team_members'] ) ) {
        return;
    }

    ob_start();
    ?>

        <div class="pa-c-block--team-members">

            <div class="pa-l-flexbox pa-l-flex-wrap pa-l-with-gutters">
            
                <?php 
                $columns = 12 / intval( $data['grid'] );
                $lg = "pa-l-span-$columns-lg";
                if ( $columns > 6 ) :
                    $md = "pa-l-span-12-md";
                else :
                    $md = "pa-l-span-6-md";
                endif;
                $grid_class = "$md $lg";

                foreach ( $data['team_members'] as $member ) :

                    $thumb_id = get_post_thumbnail_id( $member );
                    $image = wp_get_attachment_image( $thumb_id, 'large' );
                    $hover_image = wp_get_attachment_image( get_post_meta( $member, 'hover_photo', true ), 'large' );
                    $title = get_post_meta( $member, 'title', true );
                    ?>
                    <div class="pa-l-flex <?php echo $grid_class ?>">

                        <div class="pa-c-profile pa-l-mb-3">
                            <div class="pa-c-profile__image pa-c-cover-media" style="padding-top:75%"><?php echo $image ?></div>
                            <div class="pa-c-profile__hover-image pa-c-cover-media" style="padding-top:75%"><?php echo $hover_image ?></div>
                            <p><strong><?php echo get_the_title( $member ) ?></strong></p>
                            <p class="pa-h5 pa-l-mt-nudge"><?php echo $title ?></p>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}

/**
 * tiles
 * ------------------------------------------------------- */
function pa_block_tiles( $data, $options = array(), $return = false ) {

    if ( empty( $data['tiles'] ) )
        return;

    $defaults = array(
        'style' => ''
    );

    $options = array_merge( $defaults, $options );

    ob_start(); 
    ?>

        <div class="pa-c-block--tiles" style="<?php echo $options['style'] ?>">

            <div class="pa-l-container">
            
                <div class="pa-l-flexbox pa-l-flex-wrap pa-l-with-gutters">

                    <?php foreach ( $data['tiles'] as $tile ) :
                        
                        $span = $tile['width'] === 'third' ? 'pa-l-span-4-md' : 'pa-l-span-12';
                        $url = $tile['url'];
                        $tag = $url ? 'a' : 'div';
                        $href = $url ? "href=\"$url\"" : ""; ?>

                        <?php if ( $tile['type'] === 'image' ) :
                        
                            $padding = $tile['width'] === 'third' ? 'padding-top: 100%' : 'padding-top: 33.333%' ?>

                            <?php echo "<$tag $href class=\"pa-l-flex $span pa-l-mb-gutter\">" ?>
                                <div class="pa-c-cover-media" style="<?php echo $padding ?>">
                                    <?php echo wp_get_attachment_image( $tile['image'], 'large' ); ?>
                                </div>
                            <?php echo "</$tag>" ?>

                        <?php else : ?>

                            <?php echo "<$tag $href class=\"pa-l-flex $span pa-l-flexbox pa-l-flex-wrap pa-l-justify-space-between pa-u-text-center pa-l-pa-1 pa-l-mb-gutter pa-u-bg-primary pa-u-color-white\">" ?>
                                <div class="pa-u-center pa-l-mt-nudge" style="width:100%">
                                    <span class="pa-b-icon icon-left-quote" aria-hidden="true"></span>
                                    <p class="pa-u-weight-bold pa-l-px-1">
                                        <?php echo $tile['text'] ?>
                                    </p>
                                </div>
                                <div class="pa-h3 pa-u-center pa-l-align-self-end" style="font-weight:300">
                                    <?php echo $tile['source'] ?>
                                </div>
                            <?php echo "</$tag>" ?>

                        <?php endif; ?>

                    <?php endforeach; ?>

                </div>

            </div>

		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}

/**
 * wysiwyg
 * ------------------------------------------------------- */
function pa_block_wysiwyg( $data, $options = array(), $return = false ) {

    $defaults = array(
        'style' => ''
    );

    $options = array_merge( $defaults, $options );

    ob_start(); 
    ?>

        <div class="pa-c-block--wysiwyg" style="<?php echo $options['style'] ?>">
            <?php if ( array_key_exists('title', $data) && $data['title'] !== '' ) : ?>
                <div class="pa-c-block__title pa-h3">
                    <?php echo $data['title'] ?>
                </div>
            <?php endif; ?>
			<?php echo $data['wysiwyg'] ?>
		</div>

    <?php
    $html = ob_get_clean();
    
    if ( $return ) :
        return $html;
    else :
        echo $html;
    endif;
}