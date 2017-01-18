<?php
/**
 * Plugin Name:				Creative Store Config
 * Plugin URI:        https://www.github.comtrinitymirror/creative-store/
 * Version:						1.0.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.Text
 * Text Domain:       ti-michaelbragg-config
 * Domain Path:       /languages
 * Author:						Trinity Mirror
 * Author URI:				http://www.trinitymirror.com
 *
 * @category     WordPress
 * @package      tm-creativestore-config
 * @author       Trinity Mirror
 * @license      GPL-2.0+
 * @link         https://www.github.com/trinitymirror/creative-store/
 */

/** Load Required Plugin controller. */
require WPMU_PLUGIN_DIR . '/wds-required-plugins/wds-required-plugins.php';

/**
 * Add required plugins to WDS_Required_Plugins
 *
 * @param  array $required Array of required plugins in `plugin_dir/plugin_file.php` form.
 *
 * @return array           Modified array of required plugins
 */
function wds_required_plugins_add( $required ) {
	$required = array_merge( $required, array(
		'bp-rsed/bp-rsed.php',
		'brute-force-login-protection/brute-force-login-protection.php',
		'buddypress/bp-loader.php',
		'cmb2/init.php',
		'safe-redirect-manager/safe-redirect-manager.php',
		'stream/stream.php',
		'ti-admin.php',
		'woocommerce/woocommerce.php',
		'wp-mail-smtp/wp_mail_smtp.php',
		'wp-robots-txt/robots-txt.php',
	) );
	return $required;
}

add_filter(
	'wds_required_plugins',
	'wds_required_plugins_add'
);

/**
 * Modify the required-plugin label
 *
 * @param  string $label Label markup.
 *
 * @return string         (modified) label markup
 */
function change_wds_required_plugins_text( $label ) {
	$label_text = __( 'Required Plugin for Creative Store', 'tm-creativestore-config' );
	$label = sprintf( '<span style="color: #888">%s</span>', $label_text );
	return $label;
}

add_filter(
	'wds_required_plugins_text',
	'change_wds_required_plugins_text'
);

/**
 * Modify object types used in TI Subtitle plugin.
 *
 * @return array	$object_types	New object types to use.
 */
function tm_creativestore_admin_footer() {

	return sprintf(
		'%1$s %2$s.',
		esc_html( 'Created by', 'tm-admin' ),
		esc_html( 'Trinity Mirror Creative', 'tm-admin' )
	);

}

add_filter(
	'ti_admin_footer',
	'tm_creativestore_admin_footer'
);

/**
 * Disable Emoji Icons
 */
function disable_wp_emojicons() {

	/** All actions related to emojis. */
	remove_action(
		'admin_print_styles',
		'print_emoji_styles'
	);

	remove_action(
		'wp_head',
		'print_emoji_detection_script',
		7
	);

	remove_action(
		'admin_print_scripts',
		'print_emoji_detection_script'
	);

	remove_action(
		'wp_print_styles',
		'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	/** Filter to remove TinyMCE emojis. */
	add_filter(
		'tiny_mce_plugins',
		'disable_emojicons_tinymce'
	);
}

/**
 * Disable Emojicons in Tinymce
 *
 * @param		array $plugins    Plugin list.
 *
 * @return	array						Empty array.
 */
function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	}
	return array();
}

add_action(
	'init',
	'disable_wp_emojicons'
);
