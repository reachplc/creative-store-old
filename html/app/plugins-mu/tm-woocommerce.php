<?php
/**
 * Plugin Name:				WooCommerce Add-ons
 * Plugin URI:        https://www.github.comtrinitymirror/creative-store/
 * Version:						1.0.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.Text
 * Text Domain:       tm-woocommerce
 * Domain Path:       /languages
 * Author:						Trinity Mirror
 * Author URI:				http://www.trinitymirror.com
 *
 * @category     WordPress
 * @package      tm-accounts
 * @author       Trinity Mirror
 * @license      GPL-2.0+
 * @link         https://www.github.com/trinitymirror/creative-store/
 */

/**
 * Change the text on the add to cart button.
 *
 * @return	string	New text to be shown.
 */
function tm_cart_button_text() {
	return __( 'Reserve', 'tm-woocommerce' );
}

add_filter(
	'woocommerce_product_single_add_to_cart_text',
	'tm_cart_button_text'
);
