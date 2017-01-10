<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function creative_store_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	global $post;

	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}

	return $classes;
}

add_filter(
	'body_class',
	'creative_store_body_classes'
);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function creative_store_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'creative_store_pingback_header' );

/**
 * Alter the default WP Query.
 *
 * @param  array $query Supplied by pre_get_posts.
 */
function change_archive_query_loop( $query ) {
	if ( $query->is_main_query() && ! is_admin() ) {
		$query->set( 'posts_per_page', '30' );
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'menu_order title' );
	}
}

add_action(
	'pre_get_posts',
	'change_archive_query_loop'
);
