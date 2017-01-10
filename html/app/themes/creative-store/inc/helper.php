<?php
/**
 * Helper Functions.
 *
 * Functions that could do with being part of core.
 *
 * @package tm-rohe
 */

if ( ! function_exists( 'is_post_type' ) ) :

	/**
	 * Checks if paramater(s) are in the post type
	 *
	 * @param	int/string/array $post_types   Post type name(s) or id.
	 * @return   boolean                     If in post type.
	 * @version  1.0.0
	 * @since    1.0.0
	 */
	function is_post_type( $post_types = null ) {
		/** If our variable is not set stop as soon as possible. */
		if ( ! isset( $post_types ) ) {
			return false;
		}

		$array = array();

		if ( get_post_type() === $post_types  ) {
			array_push( $array, $post_types );
			return true;
		}

		if ( is_array( $post_types ) ) {
			foreach ( $post_types as $value ) {
				if ( get_post_type() === $value ) {
					array_push( $array, $value );
					return true;
				}
			}
		}

		return false;
	}

endif;
