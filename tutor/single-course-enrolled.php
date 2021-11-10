<?php
/**
 * Template for displaying single course
 *
 * @since v.1.0.0
 *
 * @author Rejuan Ahamed
 
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

get_header();

do_action('tutor_course/single/enrolled/before/wrap');
$banner = get_theme_mod('course_banner_img', get_parent_theme_file_uri().'/assets/images/banner.jpg');
$opacity = get_theme_mod('banner_opacity', '8');
?>

<!-- ============================ Page Title Start================================== -->
<div class="ed_detail_head bg-cover" style="background:#f4f4f4 url('<?php echo esc_url($banner); ?>');" data-overlay="<?php echo esc_html($opacity); ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-7">
                <div class="ed_detail_wrap light">
                    <?php do_action('tutor_course/single/enrolled/before/inner-wrap'); ?>
                    <?php tutor_course_enrolled_lead_info(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- Single Enrolled Course -->
<section class="gray pt-3">
    <div <?php tutor_post_class('tutor-full-width-course-top tutor-course-top-info tutor-page-wrap'); ?>>
        <div class="row justify-content-between">
            <div class="col-lg-8 col-md-12 order-lg-first">

                <div class="tab_box_info mt-4">
                    <ul class="nav nav-pills mb-3 light" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="pill" href="#overview" role="tab" aria-controls="overview" aria-selected="true" aria-expanded="true"><?php esc_html_e('Overview', 'kitolms'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="curriculum-tab" data-toggle="pill" href="#curriculum" role="tab" aria-controls="curriculum" aria-selected="false"><?php esc_html_e('Curriculum', 'kitolms'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="instructors-tab" data-toggle="pill" href="#instructors" role="tab" aria-controls="instructors" aria-selected="false" aria-expanded="false"><?php esc_html_e('Instructor', 'kitolms'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="pill" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false"><?php esc_html_e('Reviews', 'kitolms'); ?></a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <!-- Overview Detail -->
                        <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab" aria-expanded="true">
                            <!-- Overview -->
                            <div class="edu_wraper">
                                <?php tutor_course_content(); ?>
                            </div>
                            
                            <!-- Overview -->
                            <div class="edu_wraper">
                                <?php tutor_course_benefits_html(); ?>
                            </div>

                            <div class="edu_wraper">
                                <?php tutor_course_enrolled_nav(); ?>
                            </div>
                        </div>
                        
                        <!-- Curriculum Detail -->
                        <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                            <div class="edu_wraper">
                                <?php tutor_course_topics(); ?>
                            </div>
                        </div>
                        
                        <!-- Instructor Detail -->
                        <div class="tab-pane fade" id="instructors" role="tabpanel" aria-labelledby="instructors-tab" aria-expanded="false">
                            <div class="single_instructor">
                                <div class="single_instructor_caption">
                                    <?php tutor_course_instructors_html(); ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reviews Detail -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <!-- Overall Reviews -->
                            <div class="rating-overview">
                                <!-- <div class="rating-overview-box"> -->
                                    <?php tutor_course_target_reviews_html(); ?>
                                    <?php tutor_course_target_review_form_html(); ?>
                                    <?php do_action('tutor_course/single/enrolled/after/sidebar'); ?>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .tutor-col-8 -->

            <div class="col-lg-4 col-md-12  order-lg-last">
                <div class="ed_view_box style_3 ovrlio stick_top">
                    <?php do_action('tutor_course/single/enrolled/before/sidebar'); ?>
                    <?php tutor_course_enroll_box(); ?>
                    <?php tutor_course_requirements_html(); ?>
                    <?php tutor_course_tags_html(); ?>
                    <?php tutor_course_target_audience_html(); ?>
                    <?php do_action('tutor_course/single/enrolled/after/sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php do_action('tutor_course/single/enrolled/after/wrap'); ?>

<?php get_footer();
