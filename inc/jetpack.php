<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package start
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function lean_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'lean_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function lean_jetpack_setup
add_action( 'after_setup_theme', 'lean_jetpack_setup' );

function lean_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function lean_infinite_scroll_render