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

?> 

<!-- #main-wrapper -->
<div id="main-wrapper" class="hfeed site <?php echo esc_attr($layout); ?>">	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kitolms' ); ?></a>

	<header id="masthead" class="site-header header">
		<div class="container">
			<div class="main-menu-wrap row clearfix">
				<div class="col-sm-6 col-md-3 col-9 align-self-center">
					<div class="kitolms-navbar-header">
						<div class="logo-wrapper">
							<?php if( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
								the_custom_logo();
							}else { ?>
								<h1 class="site-title">
									<a href="<?php echo esc_url(home_url()); ?>"><?php echo esc_html(get_bloginfo('name'));?> </a>
								</h1>
								<?php $tagline = get_bloginfo('description'); ?>
								<?php if ( $tagline!='' ) { ?>
									<p class="logo_tagline"><?php bloginfo('description'); ?></p><!-- Site Tagline --> 
								<?php } ?>
							<?php } ?>
						</div>     
					</div><!--/#kitolms-navbar-header-->   
				</div><!--/.col-sm-2-->

				<!-- Mobile Menu in Search -->
				<div class="mobile-register col-sm-6 col-md-9 col-3 d-lg-none align-self-center align-self-end">
					<div class="navbar-header clearfix">
						<button id="kitolms-navmenu" class="menu-toggle navbar-toggle kitolms-navmenu-button" aria-controls="primary-menu" aria-expanded="false" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="slicknav_icon kitolms-navmenu-button-open"></span>
						</button>
					</div>
				</div>

				<div class="col-sm-6 col-md-9 col-6 common-menu d-none d-lg-block">
					<?php if ( has_nav_menu( 'primary' ) ) { ?>
						<div id="main-menu" class="main-navigation common-menu-wrap">
							<?php 
								wp_nav_menu(  array(
										'theme_location' => 'primary',
										'container'      => '', 
										'menu_class'     => 'nav',
										'fallback_cb'    => 'wp_page_menu',
										'depth'          => 3,
									)
								); 
							?>
						</div><!--/#main-menu-->
					<?php } ?>
				</div><!--/.col-sm-9--> 

				<ul id="primary-menu" class="nav navbar-nav nav-menu">
					<div id="mobile-menu" class="hidden-lg-up d-lg-none">
						<div class="collapse navbar-collapse">
							<?php 
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( array(
										'theme_location'      => 'primary',
										'container'           => false,
										'menu_class'          => 'nav navbar-nav',
										'fallback_cb'         => 'wp_page_menu',
										'depth'               => 4,
										'walker'              => new kitolms_mobile_navwalker()
										)
									); 
								}
							?>
						</div>
					</div><!--/.#mobile-menu-->
				</ul>
			</div><!--/.main-menu-wrap-->     
		</div><!--/.container--> 
	</header><!--/.header-->

	<!-- End Navigation -->
	<div class="clearfix"></div>
	