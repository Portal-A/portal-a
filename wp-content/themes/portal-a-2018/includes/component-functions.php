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

            <div class="pa-l-flexbox pa-l-flex-wrap">
            
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