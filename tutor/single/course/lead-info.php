<?php
/**
 * Template for displaying lead info
 *
 * @since v.1.0.0
 *
 * @author Rejuan Ahamed
 
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

global $post, $authordata;
$profile_url = tutor_utils()->profile_url($authordata->ID);
?>

<?php
    $disable_course_duration = get_tutor_option('disable_course_duration');
    $disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
    $disable_update_date = get_tutor_option('disable_course_update_date');
    $course_duration = get_tutor_course_duration_context();

    $course_id = get_the_ID();
    $is_enrolled = tutor_utils()->is_enrolled($course_id);
?>

<?php
    $course_categories = get_tutor_course_categories();
    if(is_array($course_categories) && count($course_categories)){
        $i = '0';
        foreach ($course_categories as $course_category){
            $i = $i + 1;
            $category_name = $course_category->name;
            $category_link = get_term_link($course_category->term_id);
            echo "<div class='crs_cates cl_".$i."'><span>$category_name</span></div>";
        }
        $i++;
    } 
?>

<div class="ed_header_caption">
    <h2 class="ed_title"><?php the_title(); ?></h2>
    <ul>
        <?php if( !empty($course_duration) && !$disable_course_duration){ ?>
            <li><i class="ti-calendar"></i>
                <?php echo esc_html($course_duration); ?>
            </li>
        <?php } ?>

        <li>
            <?php $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id); ?>
            <?php 
                if($tutor_lesson_count) {
					echo '<i class="ti-control-forward"></i><span>' . $tutor_lesson_count . ' ' . __('Lectures', 'kitolms') . '</span>';
				}
			?>
        </li>

        <?php if( !$disable_total_enrolled){ ?>
            <li><i class="ti-user"></i><?php echo (int) tutor_utils()->count_enrolled_users_by_course(); ?> <?php esc_html_e('Student Enrolled', 'kitolms') ?></li>
        <?php } ?>
    </ul>
</div>

<?php do_action('tutor_course/single/lead_meta/after'); ?>
<?php do_action('tutor_course/single/excerpt/before'); ?>
<?php
$excerpt = tutor_get_the_excerpt();
$disable_about = get_tutor_option('disable_course_about');
if (! empty($excerpt) && ! $disable_about){ ?>
    <div class="ed_header_short">
        <p><?php echo esc_html($excerpt); ?></p>
    </div>
<?php } ?>

<?php do_action('tutor_course/single/excerpt/after'); ?>

<!-- Course review count -->
<?php
$disable = get_tutor_option('disable_course_review');
if ( ! $disable){
    ?>
    <div class="ed_rate_info">
        <?php $course_rating = tutor_utils()->get_course_rating(); ?>  
        <div class="tutor-single-rating-count star_info">
            <?php tutor_utils()->star_rating_generator($course_rating->rating_avg); ?>
        </div>
        
        <div class="review_counter">
            <strong class="high"><?php echo esc_html($course_rating->rating_avg); ?></strong>
            <?php echo esc_html($course_rating->rating_count); ?> <?php esc_html_e('Reviews', 'kitolms'); ?>
        </div>
    </div>
<?php } ?>
