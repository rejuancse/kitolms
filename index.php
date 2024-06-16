<?php get_header(); ?>
<?php get_template_part('lib/sub-header')?>

<!-- ============================ article Start ================================== -->
<section class="min" id="content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <div class="sec-heading center">
                    <?php if(get_theme_mod( 'blog_page_title', true )) : ?>
                        <h2><?php echo wp_kses_post(get_theme_mod( 'blog_page_title', 'Latest News & Articles' )); ?></h2>
                    <?php endif; ?>
                    <?php if(get_theme_mod( 'blog_page_intro', true )) : ?>
                        <p><?php echo esc_html(get_theme_mod( 'blog_page_intro', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.' )); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php
                $col = get_theme_mod( 'blog_column', 4 );
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post(); ?>

                    <!-- Single Item -->
                    <div class="col-xl-<?php echo esc_attr($col);?> col-lg-4 col-md-<?php echo esc_attr($col);?> col-sm-12">
                        <div class="blg_grid_box">
                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                        </div>
                    </div>

                <?php
                    endwhile;
                else:
                    get_template_part( 'post-format/content', 'none' );
                endif;
            ?>
        </div>

        <?php
            $page_numb = max( 1, get_query_var('paged') );
            $max_page = $wp_query->max_num_pages;
            kitolms_pagination( $page_numb, $max_page );
        ?>
    </div>
</section>
<div class="clearfix"></div>
<!-- ============================ article End ================================== -->

<?php get_footer();
