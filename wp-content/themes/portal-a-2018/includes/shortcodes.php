<?php
namespace PA\Shortcodes;


function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_shortcode( 'button', $n('button_fn') );

}

function button_fn( $atts, $content ) {
    $a = shortcode_atts( array(
        'url' => '#',
        'new_window' => 'false',
    ), $atts );

    $url = $a['url'];
    $target = $a['new_window'] === 'true' ? '_blank' : '_self';

    return "<a href=\"$url\" target=\"$target\" class=\"pa-b-button\">$content</a>";
}