<?php
/**
 * Checkout Form
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
  echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
  return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">


  <?php do_action( 'woocommerce_checkout_order_review' ); ?>

  <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

    <div id="customer_details" class="grid ms7-ms12">

        <?php do_action( 'woocommerce_checkout_billing' ); ?>

        <?php do_action( 'woocommerce_checkout_shipping' ); ?>

    </div>

    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

    <?php
      $order_button_text = apply_filters('woocommerce_order_button_text', __( 'Place order', 'woocommerce' ));

      echo apply_filters('woocommerce_order_button_html', '<input type="submit" class="button button--primary alt" name="woocommerce_checkout_place_order" id="place_order" value="' . $order_button_text . '" />' );
    ?>

  <?php endif; ?>


</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>