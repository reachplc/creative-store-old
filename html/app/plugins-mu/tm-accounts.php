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

function custom_login_page( $login_url, $redirect, $force_reauth ) {

		$login_url = home_url( '/accounts/sign-in/' );

		if ( ! empty( $redirect ) ) {
			$login_url = add_query_arg(
				array( 'redirect_to'	=> urlencode( $redirect ) ),
				$login_url
			);
		}

		if ( $force_reauth ) {
			$login_url	= add_query_arg(
				array( 'reauth'	=> '1' ),
				$login_url
			);
		}

		return esc_url_raw( $login_url );

}

add_filter(
	'login_url',
	'custom_login_page',
	10, 3
);

/**
 * Redirect failed login to referrer page
 */

function my_front_end_login_fail( $username ) {
	/** Check if referer is present. */
	if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
		$referrer = esc_url( $_SERVER['HTTP_REFERER'] );
	}
	/** If there's a valid referrer, and it's not the default log-in screen. */
	if ( ! empty( $referrer ) && ! strstr( $referrer,'wp-login' ) && ! strstr( $referrer,'wp-admin' ) ) {
		wp_redirect( esc_url_raw( add_query_arg( array( 'status' => 'failed' ), $referrer ) ) );
		exit;
	}
}

add_action(
	'wp_login_failed',
	'my_front_end_login_fail'
);

/**
 * Update WP default logout url.
 */
function tm_logout_url() {
	return home_url( '/accounts/sign-out/' );;
}

add_filter(
	'logout_url',
	'tm_logout_url'
);
