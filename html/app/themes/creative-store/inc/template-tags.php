<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package creative-store
 */

/**
 * Return post/page slug.
 *
 * @return string        [description]
 */
function creative_store_the_slug() {
	$slug = basename( get_permalink() );
	do_action( 'before_slug', $slug );
	$slug = apply_filters( 'slug_filter', $slug );
	do_action( 'after_slug', $slug );
	return $slug;
}

/**
 * Return SVG markup.
 *
 * @param array $args Icon, Title, and Description strings.
 * @return string SVG markup.
 */
function tm_rohe_get_svg( $args = array() ) {

	/** Make sure $args are an array. */
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'creative-store' );
	}
	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'creative-store' );
	}
	// Set defaults.
	$defaults = array(
		'icon'  => '',
		'title' => '',
		'desc'  => '',
	);
	// Parse args.
	$args = wp_parse_args( $args, $defaults );
	// Figure out which title to use.
	$title = ( $args['title'] ) ? $args['title'] : $args['icon'];
	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';
	// Set ARIA.
	$aria_labelledby = '';
	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="title-ID desc-ID"';
		$aria_hidden = '';
	}
	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';
	// Add title markup.
	$svg .= '<title>' . esc_html( $title ) . '</title>';
	// If there is a description, display it.
	if ( $args['desc'] ) {
		$svg .= '<desc>' . esc_html( $args['desc'] ) . '</desc>';
	}
	// Use absolute path in the Customizer so that icons show up in there.
	if ( is_customize_preview() ) {
		$svg .= '<use xlink:href="' . get_parent_theme_file_uri( '/assets/images/svg-icons.svg#icon-' . esc_html( $args['icon'] ) ) . '"></use>';
		$svg .= '</svg>';
		return $svg;
	}

	$svg .= '<use xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use>';
	$svg .= '</svg>';
	return $svg;

}
