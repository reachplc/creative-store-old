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

//  Updates 'add to cart' button to redirect to checkout
add_filter('add_to_cart_redirect', 'custom_add_to_cart_redirect');

function custom_add_to_cart_redirect() {
     return get_permalink(get_option('woocommerce_checkout_page_id'));
}

//  Change the text on the add to cart button
add_filter('single_add_to_cart_text', 'woo_custom_cart_button_text');

function woo_custom_cart_button_text() {
  return __('Reserve', 'woocommerce');
}

//  Remove data tabs from product view
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs',10);


/**
 * Checkout
 */

// Update checkout fields
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {

  //  Removes country field
  unset($fields['billing']['billing_country']);
  //  Removes first name
  unset($fields['billing']['billing_first_name']);
  //  Removes last name
  unset($fields['billing']['billing_last_name']);
  //  Removes company name
  unset($fields['billing']['billing_company']);
  //  Removes billing address
  unset($fields['billing']['billing_address_1']);
  unset($fields['billing']['billing_address_2']);
  unset($fields['billing']['billing_city']);
  unset($fields['billing']['billing_state']);
  unset($fields['billing']['billing_postcode']);
  // Removes email
  unset($fields['billing']['billing_email']);
  // Removes phone number
  unset($fields['billing']['billing_phone']);

  //  Add fields

  //  Sales Reps Email
  $fields['billing']['rep_email'] = array(
    'label'     => __('Sales Email Address', 'woocommerce'),
    'placeholder'   => _x('name.name@trinitymirror.com', 'placeholder', 'woocommerce'),
    'required'  => true,
    //'class'     => array('form-row-wide'),
    'clear'     => true
  );
  //  Client Name
  $fields['billing']['client_name'] = array(
    'label'     => __('Client\'s Name', 'woocommerce'),
    'required'  => true,
    //'class'     => array('form-row-wide'),
    'clear'     => true
  );

  //  Returns edited fields
  return $fields;
}

// Update the order meta with field value
add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ($_POST['rep_email']) update_post_meta( $order_id, 'sales_email_address', esc_attr($_POST['rep_email']));
    if ($_POST['client_name']) update_post_meta( $order_id, 'client_name', esc_attr($_POST['client_name']));
}

//  Add new fields to order edition page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Sales Email Address').':</strong> ' . $order->order_custom_fields['sales_email_address'][0] . '</p>';
    echo '<p><strong>'.__('Client\'s Name').':</strong> ' . $order->order_custom_fields['client_name'][0] . '</p>';
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
