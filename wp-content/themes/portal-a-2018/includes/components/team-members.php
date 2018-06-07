<?php
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