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
$opacity = get_theme_mod('banner_opacity', '8'); ?>

<!-- ============================ Page Title Start================================== -->
<div class="ed_detail_head bg-cover" style="background:#f4f4f4 url('<?php echo esc_url($banner); ?>');" data-overlay="<?php echo esc_html($opacity); ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-7">
                <div class="ed_detail_wrap light">
                    <?php do_action( 'tutor_course/single/enrolled/before/inner-wrap' ); ?>
					<?php tutor_course_enrolled_lead_info(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Course Detail ================================== -->
<section class="gray pt-3">
    <div <?php tutor_post_class('tutor-single-anouncement-wrap tutor-page-wrap'); ?>>
        <div class="row justify-content-between">
            <div class="col-lg-8 col-md-12 order-lg-first">
                <div class="tab_box_info mt-4">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Overview Detail -->
                        <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab" aria-expanded="true">
                            <!-- Overview -->
                            <div class="edu_wraper">
                                <?php tutor_course_enrolled_nav(); ?>
                                <?php tutor_course_question_and_answer(); ?>
                                <?php do_action( 'tutor_course/single/enrolled/before/inner-wrap' ); ?>
                            </div>
                        </div>
                        <!-- Announcements -->
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
<!-- ============================ Course Detail ================================== -->

<?php
do_action('tutor_course/single/enrolled/after/wrap');
$related_course_slider = get_theme_mod('related_course_slider', true);
if($related_course_slider) {
    get_template_part( 'tutor/related', 'course' );
}

get_footer();
