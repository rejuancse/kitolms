<?php get_header();
/*
*Template Name: 404 Page Template
*/
?>

<?php 
$error_bg = get_theme_mod( '404_logo', get_parent_theme_file_uri().'/assets/images/404.png' );
$description = get_theme_mod( '404_description', esc_html__('Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper', 'kitolms') );
$kitolms_btn_text = get_theme_mod( '404_title', esc_html__('Back To Home', 'kitolms') );
?>

<!-- ============================ User Dashboard ================================== -->
<section class="error-wrap">
	<div class="container">
		<div class="row justify-content-center">
			
			<div class="col-lg-6 col-md-10">
				<div class="text-center">
					
					<img src="<?php echo esc_url($error_bg); ?>" class="img-fluid" alt="<?php  esc_html_e( '404 page', 'kitolms' ); ?>">
					<p><?php  echo esc_html($description); ?></p>
					<a class="btn theme-bg text-white btn-md" href="<?php echo esc_url( home_url('/') ); ?>"><?php  echo esc_html($kitolms_btn_text); ?></a>
					
				</div>
			</div>
			
		</div>
	</div>
</section>
<!-- ============================ User Dashboard End ================================== -->
<?php get_footer(); ?>
