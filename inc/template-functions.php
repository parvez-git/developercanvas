<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 * @package developercanvas
 */

function developercanvas_body_classes( $classes ) {

	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'developercanvas_body_classes' );


function developercanvas_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'developercanvas_pingback_header' );
