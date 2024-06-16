<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<!-- ============================ Product Detail Start================================== -->
<div class="pr_detail">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
					<div class="woocommerce single_product quick_view_wrap">
						<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
						
						<div class="summary entry-summary">
							<div class="woo_inner">
								<?php do_action( 'woocommerce_single_product_summary' ); ?>
							</div>
						</div>
					</div>

					<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
				</div>

				<?php do_action( 'woocommerce_after_single_product' ); ?>
			</div>
		</div>
	</div>
</div>
<!-- ============================ Product Detail End ================================== -->			
