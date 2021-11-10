<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

$banner_img = get_theme_mod( 'sub_header_banner_img', false );

do_action( 'woocommerce_before_lost_password_form' );
?>

<!-- ============================ Login Wrap ================================== -->
<section>
	<div class="container">
		<div class="row justify-content-center">
		
			<div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
				<form method="post" class="woocommerce-ResetPassword lost_reset_password">
					<div class="crs_log_wrap">
						<div class="crs_log__thumb">
							<img src="<?php echo esc_url($banner_img); ?>" class="img-fluid" alt="<?php  esc_html_e( 'Forgot Password banner image', 'kitolms' ); ?>" />
						</div>
						<div class="crs_log__caption">
							<div class="rcs_log_123">
								<div class="rcs_ico"><i class="fas fa-lock"></i></div>
							</div>
							
							<div class="rcs_log_124">
								<div class="Lpo09"><h4><?php esc_html_e( 'Forgot password', 'kitolms' ); ?></h4></div>

								<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'kitolms' ) ); ?></p>

								<div class="form-group">
									<label><?php esc_html_e( 'Enter Email', 'kitolms' ); ?></label>
									<input class="form-control" type="text" name="user_login" id="user_login" autocomplete="username" placeholder="<?php esc_html_e('support@wpkitolms.com', 'kitolms'); ?>" />
								</div>

								<div class="clear"></div>
								
								<?php do_action( 'woocommerce_lostpassword_form' ); ?>

								<div class="form-group">
									<input type="hidden" name="wc_reset_password" value="true" />
									<button type="submit" class="btn full-width btn-md theme-bg text-white" value="<?php esc_attr_e( 'Forgot password', 'kitolms' ); ?>"><?php esc_html_e( 'Forgot password', 'kitolms' ); ?></button>
								</div>

								<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
							</div>
						</div>
						<div class="crs_log__footer d-flex justify-content-between">
							<div class="fhg_45"><p class="musrt"><?php esc_html_e( 'Don\'t have account?', 'kitolms' ); ?> <a href="signup.html" class="theme-cl">SignUp</a></p></div>
						</div>
					</div>
				</form>
				<?php do_action( 'woocommerce_after_lost_password_form' ); ?>
			</div>

		</div>
	</div>
</section>
<!-- ============================ Login Wrap ================================== -->
