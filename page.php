<?php get_header(); ?>
<?php get_template_part('lib/sub-header'); ?>

<section id="content">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="lmp_caption">
                    <?php while ( have_posts() ): the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                            <div class="row">
                                <div class="entry-thumbnail col-md-12">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="entry-content wrap">
                            <?php
                                the_content( 
                                    sprintf( 
                                        __( 'Continue reading%s', 'kitolms' ), 
                                        '<span>'.get_the_title().'</span>' 
                                    ) 
                                );
                                wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'kitolms' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                ) ); ?>
                        </div>
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                            comments_template();
                            endif;
                        ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer();
