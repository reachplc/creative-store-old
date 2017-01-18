<?php
/**
 * Creative Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package creative-store
 */

if ( ! function_exists( 'creative_store_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function creative_store_setup() {
		/** Add function here. */
	}

endif;

add_action(
	'after_setup_theme',
	'creative_store_setup'
);

/**
 * Functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package creative-store
 */

/**
 * Load functions files
 */
$function_includes = array(
	'inc/extras.php',						/** Custom functions that act independently of the theme templates. */
	'inc/helper.php',						/** Helper functions. */
	'inc/template-tags.php',		/** Custom template tags for this theme. */
	'inc/assets.php',						/** Scripts and stylesheets. */
	'inc/media.php',						/** Updates to media files.*/
);

foreach ( $function_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		continue;
	}
	require_once $filepath;
}

unset( $file, $filepath );
