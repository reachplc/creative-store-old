<?php
/**
 * Sign-in template.
 *
 * @package creative-store
 */

if ( is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}

/** Check if the login failed. */
$login_status = ( get_query_var( 'login' ) === 'failed' ? true : false );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

				<article class="module login-form">

				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<section>

					<?php printf(
						'<p>%1$s <a href="%2$s">%3$s</a></p>',
						esc_html__( 'Not got an account?', 'creative-store' ),
						esc_url( wp_registration_url() ),
						esc_html__( 'Click here to create your account.', 'creative-store' )
					); ?>

				</section>

				<form id="member-login" action="<?php echo esc_url( home_url( 'wp-login.php' ) ); ?>" method="POST" enctype="multipart/form-data">

					<?php if ( true === $login_status ) : ?>
						<section class="c-alert c-alert--message c-alert--warning c-alert--type u-stack-l" role="alert">
							<p>
							<?php printf(
								'<strong>%1$s</strong> %2$s',
								esc_html__( 'Ooops.', 'creative-store' ),
								esc_html__( 'Incorrect username or password. Please try again.', 'creative-store' )
							); ?>
							</p>
						</section>
					<?php endif; ?>

					<fieldset id="account-details">

						<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( 'dashboard/' ) ); ?>">

						<div class="c-field">
							<label class="c-field__label" for="log">
								<?php esc_html_e( 'Username', 'creative-store' ); ?>
							</label>
							<div class="c-field__input">
								<input type="text" name="log" id="log" required>
							</div>
						</div>

						<div class="c-field">
							<label class="c-field__label" for="pwd">
								<?php esc_html_e( 'Password', 'creative-store' ); ?>
							</label>
							<div class="c-field__input">
								<input type="password" name="pwd" id="pwd" required>
							</div>
						</div>

						<div class="c-field">
							<ul class="c-list">
								<li class="c-list__item">
									<div class="c-checkbox">
										<input class="c-checkbox__input" type="checkbox" name="rememberme" value="forever">
										<label class="c-checkbox__label">
											<?php esc_html_e( 'Remember Me', 'creative-store' ); ?>
										</label>
									</div>
								</li>
							</ul>
						</div>


						<div class="c-field">
							<button class="" type="submit" name="submit" id="submit">
								<?php esc_html_e( 'Login', 'creative-store' ); ?>
							</button>
						</div>

					</fieldset>

				</form>

				</article>

				<section>
					<?php printf(
						'<p><a href="%1$s" title="%2$s">%3$s</a></p>',
						esc_url( wp_lostpassword_url( get_permalink() ) ),
						esc_html__( 'Forgot Password', 'creative-store' ),
						esc_html__( 'Forgot your Password?' )
					); ?>
				</section>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_footer();
