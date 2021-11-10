<?php 
    if ( ! get_theme_mod( 'enable_sub_header', true ) && !is_page() ) {
        return;
    }

    $output = ''; 
    $sub_img = array();
    global $post;

    /**
    *   Subheader Banner Background Image 
    */ 
    if(!function_exists('kitolms_sub_header')){
        function kitolms_sub_header(){
            $banner_img = get_theme_mod( 'sub_header_banner_img', get_parent_theme_file_uri().'/assets/images/banner.jpg' );
            $banner_color = get_theme_mod( 'sub_header_banner_color', '#f7f8f9' );
            if( $banner_img ){
                $kitolms_output = 'style="background-image:url('.esc_url( $banner_img ).'); background-size: cover; background-position: 50% 50%;"';
                return $kitolms_output;
            }else{
                $kitolms_output = 'style="background-color:'.esc_attr( $banner_color ).';"';
                return $kitolms_output;
            } 
        }
    }

    if( isset($post->post_name) ){
        if(!empty($post->ID)){
            if(function_exists('rwmb_meta')){
                $image_attached = esc_attr(get_post_meta( $post->ID , 'kitolms_subtitle_images', true ));
                if(!empty($image_attached)){
                    $sub_img = wp_get_attachment_image_src( $image_attached , 'blog-full'); 
                    $output = 'style="background-image:url('.esc_url($sub_img[0]).'); background-size: cover; background-position: 50% 50%;"';
                }else{
                    $output = kitolms_sub_header();
                }  
            }else{
                $output = kitolms_sub_header();
            } 
        }else{
            $output = kitolms_sub_header();
        }
    }else{
        $output = kitolms_sub_header();
    }
?> 

<?php if (!is_front_page() || is_blog()) { ?>
 
<section class="page-title bg-cover" <?php print wp_kses_post($output);?> data-overlay="8">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="breadcrumbs-wrap">
                    <?php
                        global $wp_query;
                        if(isset($wp_query->queried_object->name)){
                            if (get_theme_mod( 'header_title_enable', true )) {
                                if($wp_query->queried_object->name != ''){
                                    if($wp_query->queried_object->name == 'product' ){
                                        echo '<h1 class="breadcrumb-title">'.esc_html__('Shop','kitolms').'</h1>';
                                    }else{
                                        echo '<h1 class="breadcrumb-title">'.wp_kses_post($wp_query->queried_object->name).'</h1>';    
                                    }
                                }else{
                                    echo '<h1 class="breadcrumb-title">'.esc_html(get_the_title()).'</h1>';
                                }
                            }
                        }else{

                            if( is_search() ){
                                if (get_theme_mod( 'subtitle_enable', true )) {
                                    if (get_theme_mod( 'header_subtitle_text', '' )){
                                        echo '<h3 class="page-subleading">'. wp_kses_post(get_theme_mod( 'header_subtitle_text','' )).'</h3>';
                                    }
                                }
                                if (get_theme_mod( 'header_title_enable', true )) {
                                    echo '<h1 class="breadcrumb-title">'.esc_html__('Search','kitolms').'</h1>';
                                }
                            }
                            else if( is_home() ){
                                if (get_theme_mod( 'subtitle_enable', true )) {
                                    if (get_theme_mod( 'header_subtitle_text', '' )){
                                        echo '<h3 class="page-subleading">'. wp_kses_post(get_theme_mod( 'header_subtitle_text','' )).'</h3>';
                                    }
                                }
                                if (get_theme_mod( 'header_title_enable', true )) {
                                    if (get_theme_mod( 'header_title_text', 'Latest Blog' )){
                                        echo '<h1 class="breadcrumb-title">'. wp_kses_post(get_theme_mod( 'header_title_text','Latest Blog' )).'</h1>';
                                    }
                                }
                            }
                            else if( is_single()){

                                if (get_theme_mod( 'subtitle_enable', true )) {
                                    if (get_theme_mod( 'header_subtitle_text', '' )){
                                        echo '<h3 class="page-subleading">'. wp_kses_post(get_theme_mod( 'header_subtitle_text','' )).'</h3>';
                                    }
                                }
                                if (get_theme_mod( 'header_title_enable', true )) {
                                    if (get_post_type() == 'event') {
                                        echo '<h1 class="breadcrumb-title">'. esc_html__( 'Event Details','kitolms' ).'</h1>';
                                    } elseif (get_post_type() == 'album') {
                                        echo '<h1 class="breadcrumb-title">'. esc_html__( 'Albums','kitolms' ).'</h1>';
                                    } elseif (get_post_type() == 'gallery') {
                                        echo '<h1 class="breadcrumb-title">'. esc_html__( 'Gallery','kitolms' ).'</h1>';
                                    } elseif (get_post_type() == 'performer') {
                                        echo '<h1 class="breadcrumb-title">'. esc_html__( 'Performer','kitolms' ).'</h1>';
                                    }elseif(get_post_type() == 'product'){
                                        echo '<h2 class="breadcrumb-title">'.esc_html__('Product Details','kitolms').'</h1>';
                                    }else {
                                        if (get_theme_mod( 'header_title_text', 'Latest Blog' )){
                                            echo '<h1 class="breadcrumb-title">'. wp_kses_post(get_theme_mod( 'header_title_text','Latest Blog' )).'</h1>';
                                        }
                                    }
                                }
                            }
                            else{
                                if (get_theme_mod( 'header_title_enable', true )) {
                                    echo '<h1 class="breadcrumb-title">'.esc_html(get_the_title()).'</h1>';
                                }
                            }
                        }
                    ?>

                    <nav class="transparent">
                        <ol class="breadcrumb p-0">
                            <?php kitolms_breadcrumbs(); ?>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>
