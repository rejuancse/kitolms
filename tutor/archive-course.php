<?php

/**
 * Template for displaying courses
 *
 * @since v.1.0.0
 *
 * @author Rejuan Ahamed
 *
 * @package TutorLMS/Templates
 * @version 1.5.8
 */

get_header(); 

/**
 * Subheader
 */
get_template_part('lib/sub-header');

/**
 * Kitolms archive course shortcode
 */
do_shortcode('[kitolms-course]');

/**
 * Footer
 */
get_footer();
