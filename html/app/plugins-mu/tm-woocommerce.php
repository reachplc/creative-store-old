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
 * @param		[type]	$price	[description]
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
 *
 * @return [type] [description]
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

	return $fields;

}

add_filter(
	'woocommerce_checkout_fields',
	'tm_override_checkout_fields'
);
