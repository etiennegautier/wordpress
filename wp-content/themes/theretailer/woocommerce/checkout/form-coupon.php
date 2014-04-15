<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( ! $woocommerce->cart->coupons_enabled() )
	return;

$info_message = apply_filters('woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'theretailer' ));
?>

<div class="theretaier_coupon_code_checkout"><?php echo $info_message; ?> <a href="#" class="showcoupon"><?php _e( 'Click here to enter your code', 'theretailer' ); ?></a></div>

<form class="checkout_coupon" method="post" style="display:none">

	<p class="form-row">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'theretailer' ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row">
		<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'theretailer' ); ?>" />
	</p>

	<div class="clear"></div>
</form>