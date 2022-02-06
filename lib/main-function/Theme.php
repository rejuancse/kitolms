<?php

namespace kitolms;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Kitolms_Theme {

    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_filter( 'body_class', array($this, 'kitolms_body_class'));
        add_action('wp_enqueue_scripts', array($this, 'kitolms_style'));
        add_action('after_setup_theme', array($this, 'kitolms_setup'));
    }

    public function kitolms_setup(){
        load_theme_textdomain( 'kitolms', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'kitolms-large', 1140, 570, true );
        add_image_size( 'kitolms-medium', 370, 250, true );
        add_image_size( 'kitolms-blog', 385, 314, true );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );

        $starter_content = array(
            'widgets'     => array(

                'bottom1' => array(
                    'text_world' => array(
                        'text',
                        array(
                            'title' => 'Do You Need Help With Anything?',
                            'text'  => 'Receive updates, hot deals, tutorials, discounts sent straignt in your inbox every month',
                        )
                    ),
                    'search',
                ),

                // Add the core-defined business info widget to the footer 1 area.
                'bottom2' => array(
                    'text_business_info',
                    'text_about',
                    'recent-posts',
                ),
            ),
    
            // Specify the core-defined pages to create and add custom thumbnails to some of them.
            'posts'       => array(
                'home',
                'about',
                'contact',
                'blog',
                'homepage-section',
                'my-account' => array(
                    'title' => '{{account-espresso}}',
                ),
            ),
    
            // Default to a static front page and assign the front and posts pages.
            'options'     => array(
                'show_on_front'  => 'page',
                'page_on_front'  => '{{home}}',
                'page_for_posts' => '{{blog}}',
            ),
    
            // Set the front page section theme mods to the IDs of the core-registered pages.
            'theme_mods'  => array(
                'panel_1' => '{{homepage-section}}',
                'panel_2' => '{{about}}',
                'panel_3' => '{{blog}}',
                'panel_4' => '{{contact}}',
                'panel_5' => '{{my-account}}',
            ),
    
            // Set up nav menus for each of the two areas registered in the theme.
            'nav_menus'   => array(
                // Assign a menu to the "top" location.
                'primary'    => array(
                    'name'  => esc_html__( 'Primary Menu', 'kitolms' ),
                    'items' => array(
                        'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                        'page_about',
                        'page_blog',
                        'page_contact',
                    ),
                ),
            ),
        );
        add_theme_support( 'starter-content', $starter_content );

        # Custom Logo.
        add_theme_support( 'custom-logo');

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'kitolms' ),
					'shortName' => __( 'S', 'kitolms' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'kitolms' ),
					'shortName' => __( 'M', 'kitolms' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'kitolms' ),
					'shortName' => __( 'L', 'kitolms' ),
					'size'      => 36,
					'slug'      => 'large',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Geen', 'kitolms' ),
					'slug'  => 'geen',
					'color' => '#03b97c',
				),
				array(
					'name'  => __( 'Black', 'kitolms' ),
					'slug'  => 'black',
					'color' => '#3c4852',
				),
				array(
					'name'  => __( 'Dark Gray', 'kitolms' ),
					'slug'  => 'dark-gray',
					'color' => '#4e6579',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height.
		add_theme_support( 'custom-line-height' );

        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
    }

    public function kitolms_style() {
        wp_enqueue_style( 'kitolms-google-font', '//fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i,800,800i,900%7cJost:wght@400;500;600;700&display=swap',false,'all');
        wp_enqueue_media();

        /* CSS Document */
        wp_enqueue_style( 'kitolms-animation', KITOLMS_CSS . 'plugins/animation.css',false,'all');
        wp_enqueue_style( 'kitolms-magnific-popup', KITOLMS_CSS . 'plugins/magnific-popup.css',false,'all');
        wp_enqueue_style( 'kitolms-bootstrap', KITOLMS_CSS . 'plugins/bootstrap.min.css',false,'all');
        wp_enqueue_style( 'kitolms-date-picker', KITOLMS_CSS . 'plugins/date-picker.css',false,'all');
        wp_enqueue_style( 'kitolms-select2', KITOLMS_CSS . 'plugins/select2.css',false,'all');
        wp_enqueue_style( 'kitolms-slick', KITOLMS_CSS . 'plugins/slick.css',false,'all');
        wp_enqueue_style( 'kitolms-slick-theme', KITOLMS_CSS . 'plugins/slick-theme.css',false,'all');
        wp_enqueue_style( 'kitolms-themify', KITOLMS_CSS . 'plugins/themify.css',false,'all');
        wp_enqueue_style( 'kitolms-morris', KITOLMS_CSS . 'plugins/morris.css',false,'all');
        wp_enqueue_style( 'kitolms-font-awesome', KITOLMS_CSS . 'plugins/font-awesome.css',false,'all');
        wp_enqueue_style( 'kitolms-flaticon', KITOLMS_CSS . 'plugins/flaticon.css',false,'all');
        wp_enqueue_style( 'kitolms-main', KITOLMS_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'kitolms-style',get_stylesheet_uri());
        wp_add_inline_style( 'kitolms-style', Kitolms_Css_Generator() );

        # JS.
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('kitolms-magnific-popup', KITOLMS_JS.'jquery.magnific-popup.min.js',array(),false,true);
        wp_enqueue_script('kitolms-popper', KITOLMS_JS.'popper.min.js',array(),false,true);
        wp_enqueue_script('kitolms-bootstrap-min',  KITOLMS_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('kitolms-select2', KITOLMS_JS.'select2.min.js',array(),false,true);
        wp_enqueue_script('kitolms-slick', KITOLMS_JS.'slick.js',array(),false,true);
        wp_enqueue_script('kitolms-moment', KITOLMS_JS.'moment.min.js',array(),false,true);
        wp_enqueue_script('kitolms-metisMenu',  KITOLMS_JS.'metisMenu.min.js',array(),false,true);
        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}
        wp_enqueue_script('kitolms-navigation', KITOLMS_JS.'navigation.js',array(),false,true);
        wp_enqueue_script( 'kito-focus-fix', KITOLMS_JS . 'skip-link-focus-fix.js', array(), false, true );
        wp_enqueue_script('kitolms-custom', KITOLMS_JS.'custom.js',array(),false,true);
        wp_enqueue_script('kitolms-main', KITOLMS_JS .'main.js',array(),false,true);

        // For Ajax URL
        global $wp;
        wp_localize_script( 'kitolms-main', 'ajax_object', array(
            'ajaxurl'           => admin_url( 'admin-ajax.php' ),
            'redirecturl'       => home_url($wp->request),
            'loadingmessage'    => __('Sending user info, please wait...', 'kitolms')
        ));
    }

    /* -------------------------------------------
     *              Custom body class
     * ------------------------------------------- */
    public function kitolms_body_class( $classes ) {
        if ( is_singular() ) {
            // Adds `singular` to singular pages.
            $classes[] = 'singular';
        } else {
            // Adds `hfeed` to non singular pages.
            $classes[] = 'hfeed';
        }
        return $classes;
    }
}

new Kitolms_Theme();
