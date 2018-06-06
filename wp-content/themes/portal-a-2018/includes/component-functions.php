<?php
/**
 * Component Functions
 * ------------------------------------------------------- */

/**
 * banner
 * ------------------------------------------------------- */
function pa_block_banner( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--banner">
            <h2 class="pa-u-uppercase pa-u-weight-bold pa-l-ma-0 pa-l-py-1 pa-l-px-gutter pa-u-text-center"><?php echo $data['text'] ?></h2>
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
 * Divider
 * ------------------------------------------------------- */
function pa_block_divider( $data, $options = array(), $return = false ) {

    ob_start(); 
    ?>

        <hr class="pa-c-block--divider" />

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

    $tile_options = $data['tile_options'] ? $data['tile_options'] : array();
    $has_container = in_array( 'container', $tile_options ) ;
    $has_spacing = in_array( 'spacing', $tile_options );

    ob_start(); 
    ?>

        <div class="pa-c-block--tiles <?php echo $has_container ? 'pa-l-container' : '' ?>" style="<?php echo $options['style'] ?>">

            <div class="pa-l-flexbox pa-l-flex-wrap <?php echo $has_spacing ? 'pa-l-with-gutters' : '' ?>">

                <?php foreach ( $data['tiles'] as $tile ) :
                    
                    switch( $tile['columns'] ) :
                        case '3':
                            $span = 'pa-l-span-6-md pa-l-span-3-lg';
                            break;
                        case 'third':
                        case '4':
                            $span = 'pa-l-span-6-md pa-l-span-4-lg';
                            break;
                        case '5':
                            $span = 'pa-l-span-6-md pa-l-span-5-lg';
                            break;
                        case 'half':
                        case '6':
                            $span = 'pa-l-span-6-md';
                            break;
                        case '7':
                            $span = 'pa-l-span-12-md pa-l-span-7-lg';
                            break;
                        case '8':
                            $span = 'pa-l-span-12-md pa-l-span-8-lg';
                            break;
                        case '9':
                            $span = 'pa-l-span-12-md pa-l-span-9-lg';
                            break;
                        default :
                            $span = 'pa-l-span-12';
                    endswitch;
                    
                    $span = 'pa-l-flex ' . $span;
                    $url = $tile['url'];
                    $tag = $url ? 'a' : 'div';
                    $href = $url ? "href=\"$url\"" : "";
                    $gutter = $has_spacing ? 'pa-l-mb-gutter' : ''; ?>


                    <?php if ( $tile['type'] === 'image' ) :

    
                        $options = $tile['image_options'] ? $tile['image_options'] : array();
                        $image_meta = wp_get_attachment_metadata( $tile['image'] );
                        $ratio = ($image_meta['height'] / $image_meta['width']) * 100;
                        $proportional_image = in_array( 'proportional_image', $options );
                        $padding = $proportional_image ? $ratio / ( 12 / $tile['columns'] ) : 0;
                        $effects = $url ? 'does-scale does-fade' : ''; ?>

                        <?php echo "<$tag $href class=\"pa-c-cover-media $span $gutter $effects\" style=\"padding-top:{$padding}%\">"?>
                            <?php echo wp_get_attachment_image( $tile['image'], 'large' ); ?>
                            <?php if ( $tile['text'] ) : ?>
                                <div class="pa-c-cover-media__content is-animated fade-in from-bottom use-light-ui pa-u-text-center" style="width:100%">
                                    <p class="pa-h4 pa-l-mt-0"><?php echo $tile['text'] ?></p>
                                </div>
                            <?php endif; ?>
                        <?php echo "</$tag>" ?>


                    <?php else :
                     
                     
                        $options = $tile['options'] ? $tile['options'] : array();
                        $effects = $url ? 'pa-u-scale-hover pa-u-transition-slow' : '';
                        $is_centered = in_array( 'center', $options );
                        $text_align = $is_centered ? 'pa-u-text-center' : '';
                        $padding = $is_centered ? 'pa-l-py-3 pa-l-px-1' : 'pa-l-pa-3';
                        $icon_size = in_array( 'large_icon', $options ) ? 'font-size:4rem' : ''; ?>

                        <?php echo "<div class=\"$span $gutter $padding pa-l-flexbox pa-l-flex-wrap pa-l-align-center pa-l-justify-space-between pa-u-bg-primary pa-u-color-white\">" ?>
                            <?php echo "<$tag $href class=\"pa-u-display-block $effects $text_align\" style=\"width:100%\">"; ?>
                                <p class="pa-l-mt-0">
                                    <?php echo "<span class=\"pa-b-icon icon-{$tile['icon']}\" aria-hidden=\"true\" style=\"$icon_size\"></span>" ?>
                                </p>
                                <p style="max-width:450px">
                                    <span class="pa-u-weight-bold"><?php echo $tile['text'] ?></span>
                                </p>
                                <p class="pa-h3 pa-l-align-self-end pa-u-weight-light">
                                    <?php echo wp_get_attachment_image( $tile['source_image'], 'thumbnail', false, array( 'style' => 'max-height: 24px;width:auto;height:auto' ) ) ?>
                                    <?php echo $tile['source'] ?>
                                </p>
                            <?php echo "</$tag>" ?>
                        </div>


                    <?php endif; ?>

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