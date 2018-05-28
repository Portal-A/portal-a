<?php
/**
 * Component Functions
 * ------------------------------------------------------- */

/**
 * blockquote
 * ------------------------------------------------------- */
function pa_block_blockquote( $data ) {

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
    echo $html;
}

/**
 * embeds
 * ------------------------------------------------------- */
function pa_block_embeds( $data ) {

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
    echo $html;
}

/**
 * images
 * ------------------------------------------------------- */
function pa_block_images( $data ) {

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
    echo $html;
}

/**
 * statement
 * ------------------------------------------------------- */
function pa_block_statement( $data ) {

    ob_start(); 
    ?>

        <div class="pa-c-block--statement">
			<?php echo $data['statement'] ?>
		</div>

    <?php
    $html = ob_get_clean();
    echo $html;
}

/**
 * stats
 * ------------------------------------------------------- */
function pa_block_stats( $data ) {

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
    echo $html;
}

/**
 * wysiwyg
 * ------------------------------------------------------- */
function pa_block_wysiwyg( $data, $options = array() ) {

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
    echo $html;
}