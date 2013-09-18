<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo '<main id="main" class="site-main site-shop" role="main">';

// Check to apply the correct process breadcrumbs state
// depending on the page viewed
if ( is_shop() ) {
?>

  <div class="instructions wrapper">
    <ol class="list breadcrumbs breadcrumbs__instructions">
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_01.png" alt="">
          <figcaption><em>1.</em> Select your area</figcation>
        </figure>
      </li>
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_02.png" alt="">
          <figcaption><em>2.</em> Choose your design</figcation>
        </figure>
      </li>
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_03.png" alt="">
          <figcaption><em>3.</em> Request and reserve</figcation>
        </figure>
      </li>
    </ol>
  </div><!--/ breadcrumbs breadcrumbs__instructions  -->

<?php
} elseif( is_product_category() ) {
?>
  <div class="instructions wrapper">
    <ol class="list breadcrumbs breadcrumbs__instructions">
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_01.png" alt="">
          <figcaption><em>1.</em> Select your area</figcation>
        </figure>
      </li>
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_02.png" alt="">
          <figcaption><em>2.</em> Choose your design</figcation>
        </figure>
      </li>
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_03.png" alt="">
          <figcaption><em>3.</em> Request and reserve</figcation>
        </figure>
      </li>
    </ol>
  </div><!--/ breadcrumbs breadcrumbs__instructions  -->
<?php
} elseif( is_product() ) {
  ?>
  <div class="instructions wrapper">
    <ol class="list breadcrumbs breadcrumbs__instructions">
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_01.png" alt="">
          <figcaption><em>1.</em> Select your area</figcation>
        </figure>
      </li>
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_02.png" alt="">
          <figcaption><em>2.</em> Choose your design</figcation>
        </figure>
      </li>
      <li class="text-center">
        <figure>
          <img src="<?php echo bloginfo('stylesheet_directory'); ?>/gui/breadcrumb-instructions_03.png" alt="">
          <figcaption><em>3.</em> Request and reserve</figcation>
        </figure>
      </li>
    </ol>
  </div><!--/ breadcrumbs breadcrumbs__instructions  -->
<?php
}
