<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php if ( is_single() ) { body_class( 'blog-page' ); } else { body_class(); } ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
} 

/** Layout Header Style */
$layout = get_theme_mod( 'boxfull_en', 'fullwidth' ); 
$header_fixed = get_theme_mod( 'header_fixed', false ) ? 'sticky-menu' : '';
$header_transparent = get_theme_mod('header_transparent', false);
$transparent = ($header_transparent === true) ? (!is_blog()) ? 'header-transparent dark-text' : 'header-light head-shadow' : 'header-light head-shadow'; ?> 

<!-- #main-wrapper -->
<div id="main-wrapper" class="hfeed site <?php echo esc_attr($layout); ?>">	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kitolms' ); ?></a>

	<!-- Start Navigation -->
	<div class="header <?php echo esc_html($transparent).' '.esc_html($header_fixed); ?>">

		<div class="container">
			<nav id="navigation" class="navigation navigation-landscape">
				<div class="nav-header">
					<a class="nav-brand" href="<?php echo esc_url(home_url()); ?>">
						<?php
							$logoimg   = get_theme_mod( 'logo', get_parent_theme_file_uri().'/assets/images/logo.png' );
							$logotext  = get_theme_mod( 'logo_text', 'Kitolms' );
							$logotype  = get_theme_mod( 'logo_style', 'logoimg' );

							if($logotype == 'logoimg') {
								if(!empty($logoimg)){
									echo '<img 
											class="enter-logo img-responsive" 
											src="'.esc_url($logoimg).'" 
											alt="'.esc_html('Logo', 'Kitolms').'"
											title="'.esc_html('Logo', 'Kitolms').'"
									/>';
								}else{
									echo get_bloginfo('name');
								}
							}else{
								if(!empty($logotext)){
									echo '<h2 class="logo-text">'.esc_html($logotext).'</h2>';
								}else{
									echo get_bloginfo('name');
								}
							}
						?>
					</a>
					<div class="nav-toggle"></div>
					<div class="mobile_nav">
						<ul>
							<li>
								<a href="javascript:void(0);" data-toggle="modal" data-target="#login" class="crs_yuo12 w-auto text-white theme-bg">
									<span class="embos_45"><i class="fas fa-sign-in-alt mr-1"></i><?php _e('Sign In', 'kitolms'); ?></span>
								</a>
							</li>
						</ul>
					</div>
				</div>

				<!-- Main menu -->
				<div class="nav-menus-wrapper">
					<?php if ( has_nav_menu( 'primary' ) ) { ?>
						<?php 
							wp_nav_menu(  array(
									'theme_location' => 'primary',
									'container'      => '', 
									'menu_class'     => 'nav-menu',
									'fallback_cb'    => 'wp_page_menu',
									'depth'          => 4,
								)
							); 
						?>      
					<?php } ?>

					<!-- Login/Registration sections -->
					<?php get_template_part( 'lib/login', 'register' ); ?>
				</div>
			</nav>
		</div>
	</div>
	<!-- End Navigation -->
	<div class="clearfix"></div>
	