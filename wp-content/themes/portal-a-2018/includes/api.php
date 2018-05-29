<?php
namespace PA\API;

function setup() {
    $n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

    add_action( 'rest_api_init', $n('register_blocks') );

}

function register_blocks() {
    register_rest_field( 'page',
        'blocks',
        array(
            'get_callback'    => __NAMESPACE__ . '\\get_blocks',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

/**
 * Get the value of the "blocks" field
 *
 * @param array $object Details of current post.
 * @param string $field_name Name of field.
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function get_blocks( $object, $field_name, $request ) {
    
    $block_content = array();

    while( have_rows( 'blocks', $object['id'] ) ) : the_row();

        $block_fn = '\pa_block_' . get_row_layout();

        if ( function_exists( $block_fn ) ) {
    
            $block_content[] = $block_fn( get_row(true), array(), 'return' );
    
        }

    endwhile;

    return implode( '', $block_content );

}