<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package creative-store
 */
?>

<?php

/**
 * Require login for site
 */

if (!is_user_logged_in()) {
  header('Location: '.wp_login_url(get_permalink()));
  exit;
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,800' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <?php do_action( 'before' ); ?>

  <nav id="js-nav" class="nav-main nav-main__nav" role="navigation">
<?php get_sidebar(); ?>
  </nav>

    <!--<div class="slide-nav">
    <h1 class="menu-toggle"><?php #_e( 'Menu', 'creative-store' ); ?></h1>
    <div class="screen-reader-text skip-link"><a href="#content" title="<?php #esc_attr_e( 'Skip to content', 'creative-store' ); ?>"><?php #_e( 'Skip to content', 'creative-store' ); ?></a></div>

    <?php #wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
  </div>-->

  <header id="masthead" class="header__main nav-main__header cf" role="banner">
    <div class="wrapper">
      <div class="brand alpha">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
      </a>
    </div>
    <nav id="site-navigation" class="main-navigation">
    <button id="js-nav-button">nav</button>
    </nav><!-- #site-navigation -->

      <div class='user'>
        <?php
          if ( is_user_logged_in() ) {  // If logged in:
            wp_loginout( home_url() ); // Display "Log Out" link.
          }
        ?>
      </div>
    </div>

  </header><!-- #masthead -->

  <div id="content" class="site-content nav-main__content">
