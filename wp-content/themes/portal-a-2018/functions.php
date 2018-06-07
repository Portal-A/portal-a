<?php

//define('FUZZCO_DEBUG', true);

// Useful global constants
define( 'PA_VERSION',      '3.0.0' );
define( 'PA_URL',          get_stylesheet_directory_uri() );
define( 'PA_TEMPLATE_URL', get_template_directory_uri() );
define( 'PA_PATH',         dirname( __FILE__ ) . '/' );
define( 'PA_INC',          PA_PATH . 'includes/' );
define( 'PA_ASSETS',       PA_TEMPLATE_URL . '/assets/' );

// Include Libraries
require_once( PA_INC . 'extended-cpts/extended-cpts.php' );

// Include required files
require_once( PA_INC . 'core.php' );
require_once( PA_INC . 'post-types.php' );
require_once( PA_INC . 'taxonomies.php' );
require_once( PA_INC . 'helpers.php' );
require_once( PA_INC . 'api.php' );

// Include components
foreach ( glob( PA_INC . 'components/*.php' ) as $filename )
{
    require_once( $filename );
}

// Initialize functions
PA\Core\setup();
PA\PostTypes\setup();
PA\API\setup();
