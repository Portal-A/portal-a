<?php
namespace PA\API;

function setup() {
    $n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

    add_action( 'rest_api_init', $n('register_pa_rest_routes') );
    add_action( 'rest_api_init', $n('register_pa_rest_fields') );

}

function register_pa_rest_routes() {

    register_rest_route( 'pa-api/v1', '/recognition', array(
        'methods' => 'GET',
        'callback' => __NAMESPACE__ . '\\get_recognition_items',
    ) );
    
}

function get_recognition_items( $request ) {

    $awards = new \WP_Query(array(
        'post_type' => array( 'award' ),
        'posts_per_page' => 500,
        'ignore_sticky_posts' => true,
        'no_found_rows' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'award-types',
                'field' => 'slug',
                'terms' => array( 'archived' )
            )
        )
    ));

    $press = new \WP_Query(array(
        'post_type' => array( 'press' ),
        'posts_per_page' => 500,
        'ignore_sticky_posts' => true,
        'no_found_rows' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'press-types',
                'field' => 'slug',
                'terms' => array( 'archived' )
            )
        )
    ));

    $response = array( 'awards' => array(), 'press' => array() );

    if ( $awards->have_posts() ) {

        foreach( $awards->posts as $p ) {
     
            $response['awards'][] = array(
                'title' => get_post_meta( $p->ID, 'award_details', true ),
                'image' => get_the_post_thumbnail( $p->ID, 'medium', array( 'style' => 'max-height:100%; width: auto' ) ),
            );
     
        }

    }
    
    if ( $press->have_posts() ) {

        foreach( $press->posts as $p ) {

            $response['press'][] = array(
                'title' => $p->post_content,
                'image' => get_the_post_thumbnail( $p->ID, 'medium', array( 'style' => 'max-height:100%; width: auto' ) ),
                'url' => get_post_meta( $p->ID, 'url', true ),
            );

        }

    }
    
    return new \WP_REST_Response( $response, 200 );

}

function register_pa_rest_fields() {

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