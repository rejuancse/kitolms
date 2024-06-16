<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-1">

    <?php if ( is_active_sidebar( 'bottom1' ) || is_active_sidebar( 'bottom2' ) ) : ?>
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="footer_widget">
                            <?php dynamic_sidebar('bottom1'); ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-7 ml-auto">
                        <div class="row">
                            <?php dynamic_sidebar('bottom2'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <p class="mb-0">
                        <?php
                        /* translators: 1: Theme name, 2: Theme author. */
                        printf( esc_html__( '%1$s %2$s.', 'kitolms' ), 'Proudly powered by KITOLMS. ', 'All Rights Reserved' );
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->

<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>

</div>

<?php wp_footer(); ?>

</div>
</body>
</html>
