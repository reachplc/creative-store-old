<?php
/**
 * Sign-out Template.
 *
 * @package creative-store
 */

if ( ! is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}

wp_logout();
wp_safe_redirect( home_url( '/accounts/sign-in/' ) );
exit;
