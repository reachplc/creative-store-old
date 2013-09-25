<?php
/**
 * creative-store functions and definitions
 *
 * @package creative-store
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'creative_store_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function creative_store_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on creative-store, use a find and replace
	 * to change 'creative-store' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'creative-store', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'creative-store' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'creative_store_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // creative_store_setup
add_action( 'after_setup_theme', 'creative_store_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function creative_store_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'creative-store' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="gamma widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'creative_store_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function creative_store_scripts() {
	wp_enqueue_style( 'creative-store-style', get_stylesheet_uri() );

	wp_enqueue_script( 'creative-store-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'creative-store-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'creative-store-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'creative_store_scripts' );

function wpb_adding_scripts() {
	wp_register_script('nav-main', get_template_directory_uri() . '/js/jquery.nav-main.js', array('jquery'),'0.0.0', true);
	wp_enqueue_script('nav-main');
}

add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' );



/**
 * WooCommerce scripts and styles
 */

//  Removes add to cart button from products view
add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );

function remove_add_to_cart_buttons() {
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}

//  Removes price from products view
  remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

//  Removes price from content-single-product
remove_action ( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

//  Removes stock notification from content-single-product
add_filter( 'woocommerce_stock_html', 'hide_availability' );

function hide_availability() {

}

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
