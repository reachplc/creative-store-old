<?php
/**
 * Lost Password template.
 *
 * @package creative-store
 */

if ( is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}

/** Check if the login failed. */
$login_status = ( get_query_var( 'status' ) === 'failed' ? true : false );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

				<article class="module lost-password-form">

				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<section>

					<?php esc_html_e(
						'Please enter your username or email address. You will receive a link to create a new password via email.',
						'creative-store'
					); ?>

				</section>

				<form id="lostpasswordform" action="<?php echo esc_url( wp_lostpassword_url() ); ?>" method="post">

					<div class="c-field">

						<label class="c-field__label" for="user_login">
							<?php esc_html_e( 'Username or E-mail', 'creative-store' ); ?>
						</label>

						<div class="c-field__input">
							<input type="text" name="user_login" id="user_login">
						</div>

					</div>

					<div class="c-field">

						<div class="c-field__input">
							<input type="submit" name="submit" class="btn"
							value="<?php esc_html_e( 'Get New Password', 'creative-store' ); ?>">
						</div>

					</div>

				</form>

				</article>


		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_footer();
