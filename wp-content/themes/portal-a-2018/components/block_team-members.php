<?php
/**
 * team members
 * ------------------------------------------------------- */
function pa_block_team_members( $data, $options = array(), $return = false ) {

    if ( empty( $data['team_members'] ) ) {
        return;
    }

    $column_width = intval( $data['grid'] );
    $team_members = $data['team_members'];

    ob_start();
    ?>

        <div class="pa-c-block--team-members">

            <div class="pa-l-flexbox does-wrap with-gutters">
            
                <?php 
                $columns = 12 / $column_width;
                $lg = "span-$columns-lg";
                if ( $columns > 6 ) :
                    $md = "span-12-md";
                else :
                    $md = "span-6-md";
                endif;
                $grid_class = "$md $lg";

                foreach ( $team_members as $member ) :

                    $thumb_id = get_post_thumbnail_id( $member );
                    $image_url = wp_get_attachment_image_url( $thumb_id, 'large' );
                    $hover_image_url = wp_get_attachment_image_url( get_post_meta( $member, 'hover_photo', true ), 'large' );
                    $title = get_post_meta( $member, 'title', true );
                    ?>

                    <div class="pa-l-flex <?php echo $grid_class ?>">

                        <div class="pa-c-profile pa-l-mb-3">

                            <div style="overflow:hidden; position:relative">
                                <div class="pa-c-profile__image">
                                    <div class="pa-c-tile" style="pointer-events:none">
                                        <span class="pa-c-tile__image" style="background-image:url( <?php echo $image_url ?> )"></span>
                                    </div>
                                </div>
                                <div class="pa-c-profile__hover-image">
                                    <div class="pa-c-tile" style="pointer-events:none">
                                        <span class="pa-c-tile__image" style="background-image:url( <?php echo $hover_image_url ?> )"></span>
                                    </div>
                                </div>
                            </div>

                            <p class="pa-h5"><strong><?php echo get_the_title( $member ) ?></strong></p>
                            <p class="pa-h5 pa-l-mt-0 pa-u-weight-light"><?php echo $title ?></p>

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