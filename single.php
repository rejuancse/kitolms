<?php get_header(); ?>
<?php get_template_part('lib/sub-header'); ?>

<!-- ============================ Blog Detail Start ================================== -->
<section class="gray">		
    <div class="container">
        <!-- row Start -->
        <div class="row">
            <!-- Blog Detail -->
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <?php if ( have_posts() ) :  ?> 
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>                            
                    <?php endwhile; ?>    
                <?php else: ?>
                <?php get_template_part( 'post-format/content', 'none' ); ?>
                <?php endif; ?>
            </div>
            <!-- Single blog Grid -->
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <?php get_sidebar(); ?>
            </div>
        </div>
        <!-- /row -->					
    </div>      
</section>
<!-- ============================ Blog Detail End ================================== -->

<?php get_footer();
