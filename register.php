<?php
/*
 * Template Name: Register Page
 */
get_header();

$banner_img = get_theme_mod( 'sub_header_banner_img', false ); ?>

<!-- ============================ Signup Wrap ================================== -->
<section>
    <div class="container">
        <div class="row justify-content-center">
        
            <?php if(!is_user_logged_in()) { ?> 
            <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
                <form form id="registerform" action="login" method="post">
                    <div class="crs_log_wrap">

                        <div class="crs_log__thumb">
                            <img src="<?php echo esc_url($banner_img); ?>" class="img-fluid" alt="<?php  esc_html_e( 'Signup banner image', 'kitolms' ); ?>" />
                        </div>

                        <div class="crs_log__caption">
                            <div class="rcs_log_123">
                                <div class="rcs_ico"><i class="fas fa-user"></i></div>
                            </div>
                            
                            <div class="rcs_log_124">
                                <div class="Lpo09"><h4><?php esc_html_e( 'Login Your Account', 'kitolms' ); ?></h4></div>
                                <p class="status"></p>
                                <div class="form-group row mb-0">
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label><?php esc_html_e( 'First Name', 'kitolms' ); ?></label>
                                            <input type="text" id="first_name" class="form-control" name="first_name" placeholder="<?php esc_attr_e('First Name', 'kitolms'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label><?php esc_html_e( 'Last Name', 'kitolms' ); ?></label>
                                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="<?php esc_attr_e('Last Name', 'kitolms'); ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><?php esc_html_e( 'Enter Email', 'kitolms' ); ?></label>
                                    <input type="text" id="email" class="form-control" name="email" placeholder="<?php esc_attr_e('Email', 'kitolms'); ?>">
                                </div>

                                <div class="form-group">
                                    <label><?php esc_html_e( 'Username', 'kitolms' ); ?></label>
                                    <input type="text" id="username" class="form-control" name="username" placeholder="<?php esc_attr_e('Username', 'kitolms'); ?>">
                                </div>

                                <div class="form-group">
                                    <label><?php esc_html_e( 'Password', 'kitolms' ); ?></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="<?php esc_attr_e('*******', 'kitolms'); ?>">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn register_button full-width btn-md theme-bg text-white"><?php esc_html_e( 'Sign Up', 'kitolms' ); ?></button>
                                </div>
                                <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
                            </div>

                            <!-- Social Share -->
                            <!-- <div class="rcs_log_125">
                                <span>Or SignUp with Social Info</span>
                            </div>
                            <div class="rcs_log_126">
                                <ul class="social_log_45 row">
                                    <li class="col-xl-4 col-lg-4 col-md-4 col-4"><a href="javascript:void(0);" class="sl_btn"><i class="ti-facebook text-info"></i>Facebook</a></li>
                                    <li class="col-xl-4 col-lg-4 col-md-4 col-4"><a href="javascript:void(0);" class="sl_btn"><i class="ti-google text-danger"></i>Google</a></li>
                                    <li class="col-xl-4 col-lg-4 col-md-4 col-4"><a href="javascript:void(0);" class="sl_btn"><i class="ti-twitter theme-cl"></i>Twitter</a></li>
                                </ul>
                            </div> -->
                        </div>
                        <!-- <div class="crs_log__footer d-flex justify-content-between">
                            <div class="fhg_45"><p class="musrt">Already have account? <a href="#" class="theme-cl">Login</a></p></div>
                            <div class="fhg_45"><p class="musrt"><a href="#" class="text-danger">Forgot Password?</a></p></div>
                        </div> -->
                    </div>
                </form>
            </div>
            <?php }else { ?>
                <div class="Lpo09">
                    <h2><?php esc_html_e('You Are Already Logged In', 'kitolms'); ?></h2>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- ============================ Signup Wrap ================================== -->

<?php get_footer();
