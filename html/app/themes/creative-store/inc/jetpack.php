<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package creative-store
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function creative_store_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'creative_store_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'creative_store_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function tm_rohe_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) {
			get_template_part( 'components-templates/content', 'search' );
			return;
		}
		get_template_part( 'components-templates/content', get_post_format() );
	}
}
