<?php
/**
 * Plugin Name:		TI Admin
 * Plugin URI:		https://github.com/thoughtsideas/ti-admin/
 * Description:		Clean-up the admin center options
 * Version:				1.0.0
 * Text Domain:		ti-admin
 * Author:				Thoughts & Ideas
 * Author URI:		http://www.thoughtsideas.uk
 * License:				GPL-2.0
 *
 * Copyright (c) 2017 Thoughts & Ideas <http://www.thoughtsideas.uk>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 * @category    WordPress
 * @package     ti-admin
 * @author      Michael Bragg <http://www.thoughtsideas.uk>
 * @copyright   2017 Michael Bragg
 * @license     https://opensource.org/licenses/GPL-2.0
 */

/**
 * TI Admin
 *
 * @category		WordPress
 * @package		ti-admin
 * @author			Michael Bragg <http://www.thoughtsideas.uk>
 * @copyright	2017 Michael Bragg
 * @license		https://opensource.org/licenses/GPL-2.0
 */
class TI_Admin {

	/**
	 * Current version number.
	 *
	 * @since		1.0.0
	 * @var			string
	 */
	const VERSION	= '1.0.0';

	/**
	 * Single instance of the TI_Admin object.
	 *
	 * @since		1.0.0
	 * @var			string      TI_Admin
	 */
	public static $single_instance	= null;

	/**
	 * Admin footer content.
	 *
	 * @since		1.0.0
	 * @var			string				Content to output as footer.
	 */
	public $admin_footer;

	/**
	 * Set defaults for plugin.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		/** Set default admin footer content. */
		$this->admin_footer = sprintf(
			'%1$s <a href="%3$s" target="_blank">%2$s</a>.',
			esc_html( 'Created by', 'ti-admin' ),
			esc_html( 'Thoughts & Ideas', 'ti-admin' ),
			esc_url( 'http://www.thoughtsideas.uk/' )
		);
	}

	/**
	 * Creates/returns the single instance TI_Admin object.
	 *
	 * @since		1.0.0
	 * @return	TI_Admin Single instance object.
	 */
	public static function initiate() {
		if ( null === self::$single_instance ) {
			self::$single_instance	= new self();
		}
		return self::$single_instance;
	}

	/**
	 * Override constants.
	 *
	 * @since		1.0.0
	 * @param		string $constant Constant name.
	 * @param		string $value    Constant value.
	 */
	public function override_constant( $constant, $value ) {
		if ( ! defined( $constant ) ) {
			/** Constant can be overridden via wp-config.php. */
			define( $constant, $value );
		}
	}

	/**
	 * Define constants.
	 *
	 * @since		1.0.0
	 */
	public function define_constants() {
		/** Constants required by plugin. */
	}

	/**
	 * Change Admin Footer Text
	 */
	function modify_footer_admin() {

		return wp_kses(
			$this->admin_footer,
			array(
				'a'					=> array(
					'href'		=> array(),
					'title'		=> array(),
					'target'	=> array(),
				),
				'strong'		=> array(),
				'em'				=> array(),
			),
			array(
				'http',
				'https',
				'matilto',
			)
		);
	}

	/**
	 * Remove WordPress Logo from Header.
	 *
	 * @since		1.0.0
	 * @param array $wp_admin_bar Items currently in admin bar.
	 */
	public function remove_admin_logo( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
	}

	/**
	 * Only show WordPress update message to administrator roles
	 *
	 * @since		1.0.0
	 */
	public static function admin_update_message() {
		if ( ! current_user_can( 'manage_options' ) ) {
			remove_action(
				'admin_notices',
				'update_nag',
				3
			);
		}
	}

}

/**
 *  If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Initialize plugin.
 */
function ti_admin_init() {

	$ti_admin	= new TI_Admin();

	add_action(
		'after_setup_theme',
		array(
			$ti_admin,
			'define_constants',
		),
		1
	);

	/** Update admin footer content. */
	if ( has_filter( 'ti_admin_footer' ) ) {
		$ti_admin->admin_footer = apply_filters(
			'ti_admin_footer',
			$ti_admin->admin_footer
		);
	}

	add_filter(
		'admin_footer_text',
		array(
			$ti_admin,
			'modify_footer_admin',
		)
	);

	add_action(
		'admin_bar_menu',
		array(
			$ti_admin,
			'remove_admin_logo',
		),
		11
	);

	add_action(
		'admin_notices',
		array(
			$ti_admin,
			'admin_update_message',
		),
		1
	);

}

ti_admin_init();
