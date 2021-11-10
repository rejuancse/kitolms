<?php 
    global $post;
    $cat_list = [];
    $cat_items = wp_get_post_terms(get_the_ID(), 'course-category', array("fields" => "all"));
    foreach ( $cat_items as $cat_item ) {           
        $cat_list[] = $cat_item->term_id;
    } 
    $tag_list = [];
    $tag_items = wp_get_post_terms(get_the_ID(), 'course-tag', array("fields" => "all"));
    foreach ( $tag_items as $tag_item ) {
        $tag_list[] = $tag_item->term_id;
    } 
    $course_args = array(
        'post_type' 		=> 'courses',
        'post_status' 		=> 'publish',
        'post__not_in' => array($post->ID),
    ); 
    $course_args['posts_per_page'] = get_theme_mod('related_course_slider_total_item', 20);
    $course_args['tax_query'] = array (
        'relation' => 'OR',
        array(
            'taxonomy' => 'course-category',
            'field' => 'term_id',
            'terms' => $cat_list,
        ),
        array(
            'taxonomy' => 'course-tag',
            'field' => 'term_id',
            'terms' => $tag_list,
        )
    );
    $related_posts = get_posts($course_args);
    $i = 0;
    $max_new_post = get_theme_mod('new_course_count', 5);
    $related_course_title = get_theme_mod('related_course_title', 'More Courses to get <b>You Started</b>');
    $slide_opacity_en = get_theme_mod('slider_opacity_en', true) ? '' : ' opacity-disable';

?>

<section>
    <div class="container">
        
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
                <h4>Related Courses</h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="slide_items">
                
                    <!-- Single Item -->
                    <?php 
                    foreach ($related_posts as $related_post){ 
                        $i++;
                        setup_postdata($related_post);
                        $best_selling = get_post_meta($related_post->ID, 'kitolms_best_selling', true);
                        $price = apply_filters('get_tutor_course_price', null, $related_post->ID);
                        $src = wp_get_attachment_image_src(get_post_thumbnail_id($related_post->ID), 'kitolms-medium');
                        
                    ?>
                    <div class="lios_item">	
                        <div class="crs_grid shadow_none brd">
                            <div class="crs_grid_thumb">
                                <a href="<?php echo esc_url(get_the_permalink($related_post->ID)); ?>" class="crs_detail_link">
                                    <img src="<?php echo esc_url($src[0]); ?>" class="img-fluid rounded" alt="<?php echo get_the_title($related_post->ID); ?>" />
                                </a>
                                <div class="crs_locked_ico">
                                    <i class="fa fa-lock"></i>
                                </div>                               
                            </div>
                            <div class="crs_grid_caption">
                                <div class="crs_flex">
                                    <div class="crs_fl_first">
                                        <?php
                                            $course_categories = get_tutor_course_categories();
                                            if(is_array($course_categories) && count($course_categories)){
                                                foreach ($course_categories as $course_category){
                                                    $category_name = $course_category->name;
                                                    $category_link = get_term_link($course_category->term_id); ?>
                                                    <div class="crs_cates cl_6">
                                                        <span><?php echo esc_html($category_name); ?></span>
                                                    </div>
                                                <?php }
                                            } 
                                        ?>
                                    </div>
                                    <div class="crs_fl_last">
                                        <div class="crs_price">
                                            <?php if($price == !null){ ?>
                                                <h2><span class="theme-cl"><?php echo wp_kses_post($price); ?></span></h2>
                                            <?php }else{ ?>
                                                <h2><span class="theme-cl"><?php esc_html_e('Free', 'kitolms'); ?></span></h2>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="crs_title">
                                    <h4>
                                        <a href="<?php echo esc_url(get_the_permalink($related_post->ID)); ?>" class="crs_title_link"><?php echo get_the_title($related_post->ID); ?></a>
                                    </h4>
                                </div>
                                <div class="crs_info_detail">
                                    <ul>
                                        <li><i class="fa fa-clock text-danger"></i><span><?php echo get_tutor_course_duration_context(); ?></span></li>
                                        <?php
                                            $lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                                            if($lesson_count) {?>
                                            <li>
                                                <i class="fa fa-video text-success"></i>
                                                <span><?php echo esc_html($lesson_count);?> <?php echo esc_html__('Lectures', 'kitolms'); ?></span>
                                            </li>
                                        <?php } ?>
                                        <li>
                                            <i class="fa fa-signal text-warning"></i>
                                            <span>
                                                <?php echo get_tutor_course_level($related_post->ID); ?>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="crs_grid_foot">
                                <div class="crs_flex">
                                    <div class="crs_fl_first">
                                        <div class="crs_tutor">
                                            <div class="crs_tutor_thumb">
                                                <?php global $post;
                                                    $author_id=$post->post_author;
                                                    if(function_exists('tutor_utils')){ ?>
                                                        <a href="<?php echo tutor_utils()->profile_url($author_id); ?>">
                                                            <div class="img-fluid circle">
                                                                <?php echo tutor_utils()->get_tutor_avatar($author_id, 'thumbnail'); ?>
                                                            </div>
                                                        </a>
                                                    <?php }else{
                                                        $get_avatar_url = get_avatar_url($author_id, 'thumbnail'); ?>
                                                        <img class="img-fluid circle" alt="<?php echo the_author_meta( 'display_name' , $author_id ); ?>" src="<?php echo esc_url($get_avatar_url); ?>" />
                                                    <?php }
                                                ?>
                                            </div>
                                            <div class="crs_tutor_name">
                                                <a href="<?php echo tutor_utils()->profile_url($author_id); ?>">
                                                    <?php echo the_author_meta( 'display_name' , $author_id ); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="crs_fl_last">
                                        <div class="foot_list_info">
                                            <ul>
                                                <li>
                                                    <div class="elsio_ic">
                                                        <i class="fa fa-star text-warning"></i>
                                                    </div>
                                                    <div class="elsio_tx">
                                                        <div class="tutor-single-course-rating">
                                                            <?php $course_rating = tutor_utils()->get_course_rating(); ?>
                                                            <?php echo esc_html($course_rating->rating_avg); ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        
    </div>
</section>
