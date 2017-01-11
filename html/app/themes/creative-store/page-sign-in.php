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
$login_status = ( get_query_var( 'status' ) === 'failed' ? true : false );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

				<article class="module login-form">

				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<section>

					<?php printf(
						'<p>%1$s <a href="%2$s">%3$s</a></p>',
						esc_html__( 'Not got an account?', 'creative-store' ),
						esc_url( home_url( 'accounts/create/' ) ),
						esc_html__( 'Click here to create an account.', 'creative-store' )
					); ?>

				</section>

				<?php if ( true === $login_status ) : ?>
					<section class="alert alert--message alert--warning alert--type box" role="alert">
						<p>
						<?php printf(
							'<strong>%1$s</strong> %2$s</p>',
							esc_html__( 'Ooops.', 'creative-store' ),
							esc_html__( 'Incorrect username or password. Please try again.', 'creative-store' )
						); ?>
						</p>
					</section>
				<?php endif; ?>

				<form id="member-login" action="<?php echo esc_url( home_url( 'wp-login.php' ) ); ?>" method="POST" enctype="multipart/form-data">

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

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer();
