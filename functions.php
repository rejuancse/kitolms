<?php
define( 'KITOLMS_CSS', get_template_directory_uri().'/assets/css/' );
define( 'KITOLMS_JS', get_template_directory_uri().'/assets/js/' );
define( 'KITOLMS_DIR', get_template_directory() );
define( 'KITOLMS_URI', trailingslashit(get_template_directory_uri()) );

/*-------------------------------------------*
 *              Register Navigation
 *------------------------------------------- */
register_nav_menus( array(
    'primary' => esc_html__( 'Primary Menu', 'kitolms' ),
) );

/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
require_once( KITOLMS_DIR . '/lib/class-tgm-plugin-activation.php');

/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( KITOLMS_DIR . '/lib/main-function/Theme.php');

/*-------------------------------------------------------
 *				Kitolms Core
 *-------------------------------------------------------*/
require_once( KITOLMS_DIR . '/lib/main-function/kitolms-functions.php');

// mobile menu
require_once( KITOLMS_DIR . '/lib/menu/mobile-navwalker.php');


// Comments
include( get_parent_theme_file_path('lib/Kitolms_Comments.php') );

// Comments Callback Function
include( get_parent_theme_file_path('lib/kitolms-comments.php') );

/* -------------------------------------------
 * 				Custom body class
 * ------------------------------------------- */
add_action( 'after_setup_theme', 'kitolms_woocommerce_support' );
function kitolms_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/* -------------------------------------------
 * 		Custom menu add in Primany menu
 * ------------------------------------------- */
add_filter( 'wp_nav_menu_items', 'kitolms_custom_menu_item', 10, 2 );
function kitolms_custom_menu_item ( $items, $args ) {

    $kitolms_btn_name = get_theme_mod('kitolms_btn_name', 'Get Started');
    $kitolms_btn_url = get_theme_mod('kitolms_btn_url');

    $items .= '<li class="menu-item">
        <a href="'.esc_url($kitolms_btn_url).'" class="text-white add-listing btn theme-bg">'.$kitolms_btn_name.'</a> 
    </li>';
    return $items;
}
