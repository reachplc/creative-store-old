<?php
/**
 * Plugin Name:				Accounts
 * Plugin URI:        https://www.github.comtrinitymirror/creative-store/
 * Version:						1.0.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.Text
 * Text Domain:       tm-accounts
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
 * Filter Force Login to allow exceptions for specific URLs.
 *
 * @return array An array of URLs. Must be absolute.
 */
function my_forcelogin_whitelist( $whitelist ) {
  $whitelist[]	= home_url( '/accounts/sign-in/' );
	$whitelist[]	= home_url( '/accounts/create/' );
	$whitelist[]	= home_url( '/accounts/activate/' );
  return $whitelist;
}

add_filter(
	'v_forcelogin_whitelist',
	'my_forcelogin_whitelist',
	10,
	1
);
