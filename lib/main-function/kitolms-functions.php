<?php

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kitolms_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    } 
}
add_action( 'wp_head', 'kitolms_pingback_header' );


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function kitolms_skip_link_focus_fix() {
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'kitolms_skip_link_focus_fix' );


/*-----------------------------------------------------
*              Custom Excerpt Length
*----------------------------------------------------*/
if(!function_exists('kitolms_excerpt_max_charlength')):
    function kitolms_excerpt_max_charlength($charlength) {
        $excerpt = get_the_excerpt();
        $charlength++;

        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                return mb_substr( $subex, 0, $excut );
            } else {
                return $subex;
            }
        } else {
            return $excerpt;
        }
    }
endif;


/*-------------------------------------------*
 *      Kitolms Pagination
 *------------------------------------------- */
if(!function_exists('kitolms_pagination')):
    function kitolms_pagination( $page_numb , $max_page ){
        $pagination = paginate_links( array(
            'base'          => get_pagenum_link(1) . '%_%',
            'format'        => '?paged=%#%',
            'type'          => 'array', 
            'current'       => $page_numb,
            'total'         => $max_page,
            'prev_text'     => '<span class="ti-arrow-left"></span>',
            'next_text'     => '<span class="ti-arrow-right"></span>',
        )); ?>

        <?php if ( ! empty( $pagination ) ) { ?>
            <ul class="pagination p-center">
                <?php foreach ( $pagination as $page_link ) : ?>
                    <li class="page-item <?php if ( strpos( $page_link, 'current' ) !== false ) { echo 'active'; } ?>">
                        <?php echo wp_kses_post($page_link); ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php 
        }
    }
endif;


/*-------------------------------------------*
 *      Kitolms Widget Registration
 *------------------------------------------*/
if(!function_exists('kitolms_widdget_init')):

    function kitolms_widdget_init()
    {
        $bottomcolumn = get_theme_mod( 'bottom_column', '3' );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'kitolms' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'kitolms' ),
                'before_title'  => '<h4 class="title widget_title">',
                'after_title'   => '</h4>',
                'before_widget' => '<div id="%1$s" class="single_widgets widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );      

        register_sidebar(
            array( 
                'name'          => esc_html__( 'Footer1', 'kitolms' ),
                'id'            => 'bottom1',
                'description'   => esc_html__( 'Widgets in this area will be shown in footer section.' , 'kitolms'),
                'before_title'  => '<h4 class="widget_title">',
                'after_title'   => '</h4>',
                'before_widget' => '<div class="footer_widget">',
                'after_widget'  => '</div>'
            )
        );

        register_sidebar(
            array( 
                'name'          => esc_html__( 'Footer2', 'kitolms' ),
                'id'            => 'bottom2',
                'description'   => esc_html__( 'Widgets in this area will be shown in footer section.' , 'kitolms'),
                'before_title'  => '<h4 class="widget_title">',
                'after_title'   => '</h4>',
                'before_widget' => '<div class="col-lg-4 col-md-4"><div class="footer_widget">',
                'after_widget'  => '</div></div>'
            )
        );
    }

    add_action('widgets_init','kitolms_widdget_init');
endif;


if ( ! function_exists( 'kitolms_fonts_url' ) ) :
    function kitolms_fonts_url() {
        $fonts_url = '';

        $open_sans = _x( 'on', 'Poppins font: on or off', 'kitolms' );

        if ( 'off' !== $open_sans ) {
            $font_families = array();

            if ( 'off' !== $open_sans ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
            }

            $query_args = array(
                'family'  => urlencode( implode( '|', $font_families ) ),
                'subset'  => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw( $fonts_url );
    }
endif;


/*-------------------------------------------------------
*           Kitolms Breadcrumb
*-------------------------------------------------------*/
if(!function_exists('kitolms_breadcrumbs')):
    function kitolms_breadcrumbs(){ ?>
        <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'kitolms') ?></a></li>
        <?php
            if(function_exists('is_product')){
                $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                if(is_product()){
                    echo "<li class='breadcrumb-item'><a class='text-light' href='".esc_url($shop_page_url)."'>".__('Shop', 'kitolms')."</a></li>";
                }
            }
        ?>
        <li class="breadcrumb-item active theme-cl">
            <span>
                <?php 
                $the_date = get_the_date(); 
                if ( is_tag() ) { ?>
                <?php esc_html_e('Posts Tagged ', 'kitolms') ?><span class="raquo"></span><?php single_tag_title(); ?>
                <?php } elseif (is_day()) { ?>
                <?php esc_html_e('Posts made in', 'kitolms') ?> <?php echo date_i18n( 'F jS, Y', strtotime($the_date)); ?>
                <?php } elseif (is_month()) { ?>
                <?php esc_html_e('Posts made in', 'kitolms') ?> <?php echo date_i18n( 'F, Y', strtotime($the_date)); ?>
                <?php } elseif (is_year()) { ?>
                <?php esc_html_e('Posts made in', 'kitolms') ?> <?php echo date_i18n( 'Y', strtotime($the_date)); ?>
                <?php } elseif (is_search()) { ?>
                <?php esc_html_e('Search results for', 'kitolms') ?> <?php the_search_query() ?>
                <?php } elseif (is_single()) { ?>
                    <?php $category = get_the_category();
                        if ( $category ) {
                            $catlink = get_category_link( $category[0]->cat_ID );
                            echo ('<a class="text-light" href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo">'.__( 'Single Post', 'kitolms' ).'</span> ');
                        } elseif (get_post_type() == 'product'){
                            echo esc_attr(get_the_title());
                        }
                    ?>
                <?php } elseif (is_category()) { ?>
                    <?php single_cat_title(); ?>
                <?php } elseif (is_tax()) { ?>
                    <?php
                    $kitolms_taxonomy_links = array();
                    $kitolms_term = get_queried_object();
                    $kitolms_term_parent_id = $kitolms_term->parent;
                    $kitolms_term_taxonomy = $kitolms_term->taxonomy;
                    while ( $kitolms_term_parent_id ) {
                        $kitolms_current_term = get_term( $kitolms_term_parent_id, $kitolms_term_taxonomy );
                        $kitolms_taxonomy_links[] = '<a class="text-light" href="' . esc_url( get_term_link( $kitolms_current_term, $kitolms_term_taxonomy ) ) . '" title="' . esc_attr( $kitolms_current_term->name ) . '">' . esc_html( $kitolms_current_term->name ) . '</a>';
                        $kitolms_term_parent_id = $kitolms_current_term->parent;
                    }
                    if ( !empty( $kitolms_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', esc_url(array_reverse( $kitolms_taxonomy_links ) )) . ' <span class="raquo"></span> ';
                        echo esc_html( $kitolms_term->name );
                } elseif (is_author()) {
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();
                    esc_html_e('Posts by ', 'kitolms'); echo ' ', esc_attr($curauth->nickname);
                } elseif (is_page()) {
                    echo esc_attr(get_the_title());
                } elseif (is_home()) {
                    esc_html_e('Blog', 'kitolms');
                }elseif (is_archive()){
                    esc_html_e('Course Archive', 'kitolms');
                } ?>
            </span>
        </li> 
    <?php
    }
endif;


/** 
 * conditional functions
 * */ 
function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

/** 
 * Main Menu custom class add
 * */ 
add_filter( 'kitolms_comment_form_default_fields', 'kitolms_comment_form_change_cookies_consent' );
function kitolms_comment_form_change_cookies_consent( $fields ) {
	$commenter = wp_get_current_commenter();

	$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

	$fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' /> ' .'<label for="wp-comment-cookies-consent">'.__( 'Save my name, email in this browser for the next time I comment.', 'kitolms' ).'</label></p>';
	return $fields;
}

/* -------------------------------------------
 *   Show Header Cart
 * ------------------------------------------- */
if ( ! function_exists( 'kitolms_header_cart' ) ) {
    function kitolms_header_cart() {
        if(!function_exists('wc_get_cart_url')) return;
        ?>

        <li class="cart-icon account-drop">
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Cart', 'kitolms' ); ?>">
                <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'kitolms' ), WC()->cart->get_cart_contents_count() ) );?></span>
            </a>
        </li>
  
        <?php
    }
}

add_filter( 'woocommerce_add_to_cart_fragments', 'kitolms_cart_link_fragment' );
if ( ! function_exists( 'kitolms_cart_link_fragment' ) ) {
    function kitolms_cart_link_fragment( $fragments ) {
        global $woocommerce;
        ob_start(); ?>

        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Cart', 'kitolms' ); ?>">
            <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'kitolms' ), WC()->cart->get_cart_contents_count() ) );?></span>
        </a>

        <?php
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;  
    }
}


/**
 * Add bootstrap class in checkout page.
 */
add_filter('woocommerce_checkout_fields', 'kitilmsaddBootstrapToCheckoutFields' );
function kitilmsaddBootstrapToCheckoutFields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group'; 

            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}

/**
 * Add new fields above 'Update' button.
 *
 * @param WP_User $user User object.
 */
function kitolms_additional_profile_fields( $user ) {

    $facebook = get_the_author_meta( 'facebook', $user->ID);
    $twitter = get_the_author_meta( 'twitter', $user->ID );
    $linkedin = get_the_author_meta( 'linkedin', $user->ID );
    $youtube = get_the_author_meta( 'youtube', $user->ID );
    $dribbble = get_the_author_meta( 'dribbble', $user->ID );

    ?>
    <h3><?php esc_html('Social Share Link add', 'kitolms') ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="facebook"><?php esc_html('Facebook', 'kitolms') ?></label></th>
            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_url($facebook); ?>" placeholder="<?php esc_attr('Facebook', 'kitolms') ?>">
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php esc_html('Twitter', 'kitolms') ?></label></th>
            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_url($twitter); ?>" placeholder="<?php esc_attr('Twitter URL...', 'kitolms') ?>">
            </td>
        </tr>
        <tr>
            <th><label for="linkedin"><?php esc_html('Linkedin', 'kitolms') ?></label></th>
            <td>
                <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_url($linkedin); ?>" placeholder="<?php esc_attr('Linkedin URL...', 'kitolms') ?>">
            </td>
        </tr>
        <tr>
            <th><label for="youtube"><?php esc_html('YouTube', 'kitolms') ?></label></th>
            <td>
                <input type="text" name="youtube" id="youtube" value="<?php echo esc_url($youtube); ?>" placeholder="<?php esc_attr('YouTube URL...', 'kitolms') ?>">
            </td>
        </tr>
        <tr>
            <th><label for="dribbble"><?php esc_html('Dribbble', 'kitolms') ?></label></th>
            <td>
                <input type="text" name="dribbble" id="dribbble" value="<?php echo esc_url($dribbble); ?>" placeholder="<?php esc_attr('Dribbble URL...', 'kitolms') ?>">
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'show_user_profile', 'kitolms_additional_profile_fields' );
add_action( 'edit_user_profile', 'kitolms_additional_profile_fields' );

/**
 * Save additional profile fields.
 *
 * @param  int $user_id Current user ID.
 */
function kitolms_save_profile_fields( $user_id ) {

    if ( ! current_user_can( 'edit_user', $user_id ) ) {
   	 return false;
    }
    if ( isset( $_POST['facebook'] )  ) {
        update_user_meta( $user_id, 'facebook', sanitize_text_field($_POST['facebook']) );
    }
    if ( isset( $_POST['twitter'] ) ) {
        update_user_meta( $user_id, 'twitter', sanitize_text_field($_POST['twitter']) );
    }
    if ( isset( $_POST['linkedin'] ) ) {
        update_user_meta( $user_id, 'linkedin', sanitize_text_field($_POST['linkedin']) );
    }
    if ( isset( $_POST['youtube'] ) ) {
        update_user_meta( $user_id, 'youtube', sanitize_text_field($_POST['youtube']) );
    }
    if ( isset( $_POST['dribbble'] ) ) {
        update_user_meta( $user_id, 'dribbble', sanitize_text_field($_POST['dribbble']) );
    } 
}

add_action( 'personal_options_update', 'kitolms_save_profile_fields' );
add_action( 'edit_user_profile_update', 'kitolms_save_profile_fields' );


// Course Price Type
function kitolms_course_price_type($type = null){
    $types = apply_filters('kitolms_course_level', array(
        'free'    => __('Free', 'kitolms'),
        'paid'      => __('Paid', 'kitolms'),
    ));

    if ($type){
        if (isset($types[$type])){
            return $types[$type];
        }else{
            return '';
        }
    }

    return $types;
}

/*-------------------------------------------------------
*           Kitolms CSS Generator
*-------------------------------------------------------*/
if(!function_exists('Kitolms_Css_Generator')){
    function Kitolms_Css_Generator(){

        $output = '';
        
        if( get_theme_mod( 'custom_preset_en', true ) ){
            $body_color = get_theme_mod('body_bg_color', '#ffffff');
            $major_color = get_theme_mod('major_color', '#03b97c');
            $heading_color = get_theme_mod('heading_color', '#333d46');
            $text_color = get_theme_mod('text_color', '#3c4852');
            $link_color = get_theme_mod('link_color', '#30384e');
            $paragraph_color = get_theme_mod('paragraph_color', '#4e6579');
            $overlay_color = get_theme_mod('overlay_color', '#03b97c1a');
            $output = "
                body{
                    --kitolms-body-color: $body_color;
                    --kitolms-major-color: $major_color;
                    --kitolms-heading-color: $heading_color;
                    --kitolms-text-color: $text_color;
                    --kitolms-link-color: $link_color;
                    --kitolms-paragraph-color: $paragraph_color;
                    --kitolms-overlay-color: $overlay_color;
                }
            ";
        }

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        # body
        if ( get_theme_mod( 'body_font_size', '15' ) ) { $bstyle .= 'font-size:'.(int) esc_attr(get_theme_mod( 'body_font_size', '15' ) ).'px;'; }
        if ( get_theme_mod( 'body_google_font', 'Muli' ) ) { $bstyle .= 'font-family:'.esc_attr(get_theme_mod( 'body_google_font', 'Muli' ) ).';'; }
        if ( get_theme_mod( 'body_font_weight', '400' ) ) { $bstyle .= 'font-weight: '.(int) esc_attr(get_theme_mod( 'body_font_weight', '400' ) ).';'; }
        if ( get_theme_mod('body_font_height', '20') ) { $bstyle .= 'line-height: '.(int) esc_attr(get_theme_mod('body_font_height', '20') ).'px;'; }

        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '14' ) ) { $mstyle .= 'font-size:'.(int) esc_attr(get_theme_mod( 'menu_font_size', '14' ) ).'px;'; }
        if ( get_theme_mod( 'menu_google_font', 'Jost' ) ) { $mstyle .= 'font-family:'.esc_attr(get_theme_mod( 'menu_google_font', 'Jost' ) ).';'; }
        if ( get_theme_mod( 'menu_font_weight', '500' ) ) { $mstyle .= 'font-weight: '.(int) esc_attr(get_theme_mod( 'menu_font_weight', '500' ) ).';'; }
        if ( get_theme_mod('menu_font_height', '18') ) { $mstyle .= 'line-height: '.(int) esc_attr(get_theme_mod('menu_font_height', '18') ).'px;'; }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '36' ) ) { $h1style .= 'font-size:'.(int) esc_attr(get_theme_mod( 'h1_font_size', '36' ) ).'px;'; }
        if ( get_theme_mod( 'h1_google_font', 'Jost' ) ) { $h1style .= 'font-family:'.esc_attr(get_theme_mod( 'h1_google_font', 'Jost' ) ).';'; }
        if ( get_theme_mod( 'h1_font_weight', '600' ) ) { $h1style .= 'font-weight: '.(int) esc_attr(get_theme_mod( 'h1_font_weight', '600' ) ).';'; }
        if ( get_theme_mod('h1_font_height', '40') ) { $h1style .= 'line-height: '.(int) esc_attr(get_theme_mod('h1_font_height', '40') ).'px;'; }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) { $h2style .= 'font-size:'.(int) esc_attr(get_theme_mod( 'h2_font_size', '36' ) ).'px;'; }
        if ( get_theme_mod( 'h2_google_font', 'Jost' ) ) { $h2style .= 'font-family:'.esc_attr(get_theme_mod( 'h2_google_font', 'Jost' ) ).';'; }
        if ( get_theme_mod( 'h2_font_weight', '600' ) ) { $h2style .= 'font-weight: '.(int) esc_attr(get_theme_mod( 'h2_font_weight', '500' ) ).';'; }
        if ( get_theme_mod('h2_font_height', '36') ) { $h2style .= 'line-height: '.(int) esc_attr(get_theme_mod('h2_font_height', '36') ).'px;'; }

        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) { $h3style .= 'font-size:'.(int) esc_attr(get_theme_mod( 'h3_font_size', '26' ) ).'px;'; }
        if ( get_theme_mod( 'h3_google_font', 'Jost' ) ) { $h3style .= 'font-family:'.esc_attr(get_theme_mod( 'h3_google_font', 'Jost' ) ).';'; }
        if ( get_theme_mod( 'h3_font_weight', '600' ) ) { $h3style .= 'font-weight: '.(int) esc_attr(get_theme_mod( 'h3_font_weight', '500' ) ).';'; }
        if ( get_theme_mod('h3_font_height', '28') ) { $h3style .= 'line-height: '.(int) esc_attr(get_theme_mod('h3_font_height', '28') ).'px;'; }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) { $h4style .= 'font-size:'.(int) esc_attr(get_theme_mod( 'h4_font_size', '18' ) ).'px;'; }
        if ( get_theme_mod( 'h4_google_font', 'Jost' ) ) { $h4style .= 'font-family:'.esc_attr(get_theme_mod( 'h4_google_font', 'Jost' ) ).';'; }
        if ( get_theme_mod( 'h4_font_weight', '600' ) ) { $h4style .= 'font-weight: '.(int) esc_attr(get_theme_mod( 'h4_font_weight', '500' ) ).';'; }
        if ( get_theme_mod('h4_font_height', '26') ) { $h4style .= 'line-height: '.(int) esc_attr(get_theme_mod('h4_font_height', '26') ).'px;'; }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '14' ) ) { $h5style .= 'font-size:'.(int) esc_attr(get_theme_mod( 'h5_font_size', '14' ) ).'px;'; }
        if ( get_theme_mod( 'h5_google_font', 'Jost' ) ) { $h5style .= 'font-family:'.esc_attr(get_theme_mod( 'h5_google_font', 'Jost' ) ).';'; }
        if ( get_theme_mod( 'h5_font_weight', '600' ) ) { $h5style .= 'font-weight: '.(int) esc_attr(get_theme_mod( 'h5_font_weight', '500' ) ).';'; }
        if ( get_theme_mod('h5_font_height', '26') ) { $h5style .= 'line-height: '.(int) esc_attr(get_theme_mod('h5_font_height', '26') ).'px;'; }

        $output .= 'body{'.$bstyle.'}';
        $output .= '.nav-menu>li>a, 
        .nav-menus-wrapper .input-with-icon .form-control, 
        .account-drop .dropdown-menu ul li a, 
        .nav-dropdown>li>a {'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5, h6{'.$h5style.'}';

        //body
        if (get_theme_mod( 'body_bg_img') && get_theme_mod('boxfull_en') == 'boxwidth') {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'"); background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .'; background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .'; background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
       
        /**
         * Header Section
         *  */ 
        // Logo
        $logo_width = get_theme_mod( 'logo_width', 0 );
        $logo_height = get_theme_mod( 'logo_height', 0 );
        if($logo_width){
            $output .= '.nav-brand img{width:'.(int) esc_attr(get_theme_mod( 'logo_width', 150 )).'px; max-width:none;}';
        }
        if ($logo_height) {
            $output .= '.nav-brand img{height:'.esc_attr(get_theme_mod( 'logo_height' )).'px;}';
        }

        $output .= '.hfeed .header.header-light{ background: '.esc_attr( get_theme_mod( 'header_color', '#ffffff' ) ) .'; }';
        $output .= '.hfeed .header.header-fixed { background: '.esc_attr( get_theme_mod( 'sticky_header_color', '#fafafa' ) ) .'; }';
        $output .= '.header-transparent.dark-text .nav-menu>li>a, .account-drop .dropdown-menu ul li a, .header-transparent.dark-text .nav-menu>li>a.cart-contents:before { color: '.esc_attr( get_theme_mod( 'navbar_color', '#404656' ) ) .'; }';
        $output .= '.header-transparent.dark-text .submenu-indicator-chevron { border-color: '. esc_attr(get_theme_mod( 'navbar_color', '#404656' )) .'; }';
        $output .= '.hfeed .header { padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.hfeed .header { padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';

        /**
         * Sub Header
         */
        $output .= '.breadcrumbs-wrap .breadcrumb-title {font-size:'.(int) esc_attr(get_theme_mod( 'sub_header_title_size', '36' ) ).'px;}';
        $output .= 'section.page-title.bg-cover {padding:'.(int) esc_attr(get_theme_mod( 'sub_header_padding_top', '80' ) ).'px 0 '.esc_attr(get_theme_mod( 'sub_header_padding_bottom', '80' ) ).'px; margin-bottom: '.esc_attr(get_theme_mod( 'sub_header_margin_bottom', '0' ) ).'px;}';
        $output .= '.breadcrumbs-wrap .breadcrumb-title, .breadcrumb-item a {color:'.esc_attr(get_theme_mod( 'sub_header_text_color', '#fff' ) ).';}';


        /**
         * Footer Style
         */
        $output .= 'footer.skin-dark-footer, .dark-footer .footer-bottom { background: '.esc_attr( get_theme_mod( 'footer_bg_color', '#1d2636' ) ) .'; }';
        $output .= 'footer.skin-dark-footer h4 { color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#ffffff' ) ) .'; }';
        # Link Color
        $output .= 'footer.skin-dark-footer .footer_widget ul li a, footer.skin-dark-footer, footer.skin-dark-footer a { color: '.esc_attr( get_theme_mod( 'copyright_link_color', '#fff' ) ) .'; }';
        $output .= 'footer.skin-dark-footer .footer_widget ul li a:hover, footer.skin-dark-footer .footer_widget ul li a:focus { color: '.esc_attr( get_theme_mod( 'copyright_hover_color', '#ffffff' ) ) .'; }';
        $output .= '.footer-middle { padding-top: '. (int) esc_attr( get_theme_mod( 'footer_padding_top', '60' ) ) .'px; }';
        $output .= '.footer-middle { padding-bottom: '. (int) esc_attr( get_theme_mod( 'footer_padding_bottom', '60' ) ) .'px; }';

        $output .= "body.error404, body.page-template-404 {
            width: 100%;
            height: 100%;
            min-height: 100%;
        }";

        return $output;
    }
}


/*
* KitoLms Customize Register
*/ 
function kitolms_customize_register( $wp_customize ) {

	// Add Content section.
	$wp_customize->add_section(
		'kitolms_content_options',
		array(
			'title'    => esc_html__( 'KitoLms Options', 'kitolms' ),
			'priority' => 10,
		)
	);

    //  =============================
	//  = Button Name              =
	//  =============================
	$wp_customize->add_setting('kitolms_btn_name', array(
		'default'        => 'Get Started',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
        'sanitize_callback'  => 'esc_attr',
	));

	$wp_customize->add_control('kitolms_btn_name', array(
		'label'      => __('Button Name', 'kitolms'),
		'section'    => 'kitolms_content_options',
		'settings'   => 'kitolms_btn_name',
		'transport'  => 'refresh'
	));  

	//  =============================
	//  = Button URL              =
	//  =============================
	$wp_customize->add_setting('kitolms_btn_url', array(
		'default'        => '#',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
        'sanitize_callback'  => 'esc_attr',
	));

	$wp_customize->add_control('kitolms_btn_url', array(
		'label'      => __('Button URL', 'kitolms'),
		'section'    => 'kitolms_content_options',
		'settings'   => 'kitolms_btn_url',
		'transport'  => 'refresh'
	));   
}
add_action( 'customize_register', 'kitolms_customize_register' );
