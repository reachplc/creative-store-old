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
 * @param  array $whitelist     Force Login Plugin's white list.
 *
 * @return array                An array of URLs. Must be absolute.
 */
function my_forcelogin_whitelist( $whitelist ) {

	$whitelist[]	= home_url( '/accounts/' );
	$whitelist[]	= home_url( '/accounts/sign-in/' );
	$whitelist[]	= home_url( '/accounts/sign-out' );
	$whitelist[]	= home_url( '/accounts/create/' );
	$whitelist[]	= home_url( '/accounts/activate/' );
	$whitelist[]	= home_url( '/accounts/lost-password/' );

	return $whitelist;
}

add_filter(
	'v_forcelogin_whitelist',
	'my_forcelogin_whitelist',
	10,
	1
);

/**
 * Add login to acceptable query vars.
 *
 * @param		array		$vars			Default WordPress query vars.
 *
 * @return	array							Updated query vars.
 */
function add_login_query_var( $vars ){
	$vars[] = 'login';
	return $vars;
}

add_filter(
	'query_vars',
	'add_login_query_var'
);

/**
 * [custom_login_page description]
 *
 * @param  string $login_url    Default WordPress login url.
 * @param  string $redirect     Page to redirect the user to once complete.
 * @param  tbc    $force_reauth TBC.
 *
 * @return string               Plugin define url to use.
 */
function custom_login_page( $login_url, $redirect, $force_reauth ) {

		$login_url = home_url( '/accounts/sign-in/' );

		if ( ! empty( $redirect ) ) {
		$login_url = add_query_arg(
		array(
		'redirect_to'	=> rawurlencode( $redirect ),
		),
		$login_url
	);
		}

		if ( $force_reauth ) {
		$login_url	= add_query_arg(
		array(
		'reauth'	=> '1',
		),
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
 * Redirect failed login to referrer page.
 */
function tm_front_end_login_fail() {

	/** Check if referer is present. */
	if ( isset( $_SERVER['HTTP_REFERER'] ) ) { // Input var okay.
		$referrer = filter_var(
			wp_unslash( $_SERVER['HTTP_REFERER'] ), // Input var okay.
			FILTER_SANITIZE_URL
		);
	}

	/** If there's a valid referrer, and it's not the default log-in screen. */
	if ( ! empty( $referrer ) && ! strstr( $referrer, 'wp-login' ) && ! strstr( $referrer, 'wp-admin' ) ) {
		wp_safe_redirect(
			esc_url_raw(
				add_query_arg(
					array( 'login' => 'failed' ),
					$referrer
				)
			)
		);
		return;
	}

}

add_action(
	'wp_login_failed',
	'tm_front_end_login_fail'
);

/**
 * Update WP default logout url.
 */
function tm_logout_url() {
	return home_url( '/accounts/sign-out/' );
}

add_filter(
	'logout_url',
	'tm_logout_url'
);

/**
 * Check if login fields are empty.
 *
 * @param  null|WP_User|WP_Error $user     The user's progress.
 * @param  string                $username                The user's username.
 * @param  string                $password                The user's password.
 *
 * @return WP_User|WP_Error                WP_User object if authenticating the user or, if generating an error, a WP_Error object.
 */
function tm_check_username_password( $user, $username, $password ) {

	/** Check if referer is present. */
	if ( isset( $_SERVER['HTTP_REFERER'] ) ) { // Input var okay.
		$referrer = filter_var(
			wp_unslash( $_SERVER['HTTP_REFERER'] ), // Input var okay.
			FILTER_SANITIZE_URL
		);
	}

	/** If there's a valid referrer, and it's not the default log-in screen. */
	if ( ! empty( $referrer ) && ! strstr( $referrer, 'wp-login' ) && ! strstr( $referrer, 'wp-admin' ) ) {

		if ( '' === $username || '' === $password ) {

			wp_safe_redirect(
				esc_url_raw(
					add_query_arg(
						array( 'login' => 'empty' ),
						$referrer
					)
				)
			);

			return;

		}
	}

	return $user;

}

add_action(
	'authenticate',
	'tm_check_username_password',
	1,
	3
);
