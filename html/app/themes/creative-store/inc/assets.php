<?php
/**
 * Register and load styles and scripts when required.
 *
 * @package tm-rohe
 */

/**
 * Register scripts.
 */
function creative_store_register_scripts() {

	wp_register_script(
		'tm-rohe-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array(),
		'1.0.0',
		true
	);

	wp_register_script(
		'tm-rohe-skip-link-focus-fix',
		get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		array(),
		'1.0.0',
		true
	);

}
add_action(
	'wp_enqueue_scripts',
	'creative_store_register_scripts',
	1
);

/**
 * Register styles.
 */
function creative_store_register_styles() {

	wp_register_style(
		'creative-store',
		get_stylesheet_uri(),
		array(),
		'1.0.0'
	);

}

add_action(
	'wp_enqueue_scripts',
	'creative_store_register_styles',
	1
);

/**
 * Dequeue scripts.
 */
function creative_store_dequeue_scripts() {

}

add_action(
	'wp_print_scripts',
	'creative_store_dequeue_scripts',
	100
);

/**
 * Dequeue styles.
 */
function creative_store_dequeue_styles() {

}

add_action(
	'wp_print_styles',
	'creative_store_dequeue_styles',
	100
);

/**
 * Enqueue scripts
 */
function creative_store_enqueue_scripts() {

	/** Scripts to be loaded globally. */
	wp_enqueue_script( 'tm-rohe-navigation' );
	wp_enqueue_script( 'tm-rohe-2016-skip-link-focus-fix' );

}

add_action(
	'wp_enqueue_scripts',
	'creative_store_enqueue_scripts',
	100
);

/**
 * Enqueue styles
 */
function creative_store_enqueue_styles() {

	wp_enqueue_style( 'creative-store' );

}

add_action(
	'wp_enqueue_scripts',
	'creative_store_enqueue_styles',
	100
);

/**
 * Dequeue Contact Form 7 if not on the contact page.
 */
function creative_store_exclude_contact() {

}

add_action(
	'wp_print_styles',
	'creative_store_exclude_contact',
	100
);


/**
 * Add SVG definitions to footer.
 */
function creative_store_include_svg_icons() {
	/** Define SVG sprite file. */
	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';
	/** If it exists, include it. */
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
	/** Define SVG sprite file. */
	$svg_solutions = get_template_directory() . '/assets/images/svg-solutions.svg';
	/** If it exists, include it. */
	if ( file_exists( $svg_solutions ) ) {
		require_once( $svg_solutions );
	}
}

add_action(
	'wp_footer',
	'creative_store_include_svg_icons',
	9999
);
