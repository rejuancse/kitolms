<div class="property_video sm">
    <?php
        if(tutor_utils()->has_video_in_single()){
            tutor_course_video();
        } else{
            get_tutor_course_thumbnail();
        }
    ?>
</div>

<?php do_action('tutor_course/single/enroll_box/after_thumbnail'); ?>

<div class="ed_view_price pl-4">
    <span><?php esc_html_e('Acctual Price', 'kitolms'); ?></span>
    <h2 class="theme-cl"><?php tutor_course_price(); ?></h2>
</div>

<div class="ed_view_features half_list">
    <?php tutor_course_material_includes_html(); ?>
</div>
<div class="ed_view_link">
    <?php tutor_single_course_add_to_cart(); ?>
</div>
