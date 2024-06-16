<?php get_header(); ?>
<?php get_template_part('lib/sub-header')?>

<section>
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                  <div class="site-content">
                      <?php woocommerce_content(); ?>
                  </div>
              </div> <!-- #content -->
         </div> <!-- .row -->
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>
