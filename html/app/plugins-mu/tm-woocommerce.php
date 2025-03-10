<?php
/**
 * Plugin Name:				WooCommerce Add-ons
 * Plugin URI:        https://www.github.comtrinitymirror/creative-store/
 * Version:						1.0.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.Text
 * Text Domain:       tm-woocommerce
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
 * Get users selected region(s).
 *
 * @return	string|array		List of regions from extended profile.
 */
function tm_get_user_region() {

	if ( ! is_user_logged_in() ) {
		return false;
	}

	// Get users region from Extended Profile.
	$region = xprofile_get_field_data(
		'Region',
		bp_loggedin_user_id(),
		'array'
	);

	// Convert to lowercase.
	$region = strtolower( $region );

	// Convert spaces to hyphens.
	$region = preg_replace( '/\s+/', '-', $region );

	return $region;

}

/**
 * Remove product if not in stock for users region.
 *
 * @param		bool $is_visible     Is product visible by default.
 * @param		int  $product_id     Product Id.
 *
 * @return	bool		           	Should Product be visible.
 */
function tm_remove_product_stock_region( $is_visible, $product_id ) {

	$product_variable = new WC_Product_Variable( $product_id );
		$product_variations = $product_variable->get_available_variations();

		foreach ( $product_variations as $variation ) {

		/** Get users region. */
		$user_region = tm_get_user_region();

		/** Get products regions. */
		$product_region = $variation['attributes']['attribute_pa_regions'];

		if ( $user_region === $product_region  && ! $variation['is_in_stock'] ) {
			$is_visible = false;
			}
}

	return $is_visible;
}

add_filter(
	'woocommerce_product_is_visible',
	'tm_remove_product_stock_region',
	10,
	2
);

/**
 *  Remove the result count from WooCommerce.
 */
function tm_remove_result_count() {

remove_action(
	'woocommerce_after_shop_loop',
	'woocommerce_result_count',
	20
);

remove_action(
	'woocommerce_before_shop_loop',
	'woocommerce_result_count',
	20
);

}

add_action(
	'init',
	'tm_remove_result_count'
);

/**
 * Removes products count after categories name.
 */
function tm_remove_category_products_count() {
	return;
}

add_filter(
	'woocommerce_subcategory_count_html',
	'tm_remove_category_products_count'
);


/**
 * Change the text on the add to cart button.
 *
 * @return	string	New text to be shown.
 */
function tm_cart_button_text() {
	return __( 'Reserve', 'tm-woocommerce' );
}

add_filter(
	'woocommerce_product_single_add_to_cart_text',
	'tm_cart_button_text'
);


/**
 * Remove prices from products.
 *
 * @param		string $price  Price Value.
 *
 * @return	string        	New price value.
 */
function tm_remove_prices( $price ) {
	$price = '';
	return $price;
}

add_filter(
	'woocommerce_variable_sale_price_html',
	'tm_remove_prices',
	10
);

add_filter(
	'woocommerce_variable_price_html',
	'tm_remove_prices',
	10
);

add_filter(
	'woocommerce_get_price_html',
	'tm_remove_prices', 10
);

/**
 * Remove footer credit.
 *
 * @return bool Return no content.
 */
function tm_remove_footer_credit() {
	return false;
}

add_filter(
	'storefront_credit_link',
	'tm_remove_footer_credit'
);

/**
 * Layout for cart link in header.
 */
function storefront_cart_link() {
?>
	<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
		<span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) );?></span>
	</a>
<?php
}


/**
 * Remove billing fields from checkout.
 *
 * @param  array $fields Default fields.
 *
 * @return array         Modified fields.
 */
function tm_override_checkout_fields( $fields ) {

	unset( $fields['billing']['billing_first_name'] );
	unset( $fields['billing']['billing_last_name'] );
	unset( $fields['billing']['billing_company'] );
	unset( $fields['billing']['billing_address_1'] );
	unset( $fields['billing']['billing_address_2'] );
	unset( $fields['billing']['billing_city'] );
	unset( $fields['billing']['billing_postcode'] );
	unset( $fields['billing']['billing_country'] );
	unset( $fields['billing']['billing_state'] );
	unset( $fields['billing']['billing_phone'] );
	unset( $fields['billing']['billing_address_2'] );
	unset( $fields['billing']['billing_postcode'] );
	unset( $fields['billing']['billing_company'] );
	unset( $fields['billing']['billing_last_name'] );
	unset( $fields['billing']['billing_email'] );
	unset( $fields['billing']['billing_city'] );

	unset( $fields['shipping']['shipping_first_name'] );
	unset( $fields['shipping']['shipping_last_name'] );
	unset( $fields['shipping']['shipping_company'] );
	unset( $fields['shipping']['shipping_address_1'] );
	unset( $fields['shipping']['shipping_address_2'] );
	unset( $fields['shipping']['shipping_city'] );
	unset( $fields['shipping']['shipping_postcode'] );
	unset( $fields['shipping']['shipping_country'] );
	unset( $fields['shipping']['shipping_state'] );

	return $fields;

}

add_filter(
	'woocommerce_checkout_fields',
	'tm_override_checkout_fields'
);
