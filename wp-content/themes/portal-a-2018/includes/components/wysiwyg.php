<?php
/**
 * wysiwyg
 * ------------------------------------------------------- */
function pa_block_wysiwyg( $data, $options = array(), $return = false ) {

    $defaults = array(
        'style' => '',
        'class' => ''
    );

    $options = array_merge( $defaults, $options );

    ob_start(); 
    ?>

        <div class="pa-c-block--wysiwyg <?php echo $options['class']; ?>" style="<?php echo $options['style'] ?>">
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