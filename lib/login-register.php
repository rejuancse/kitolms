<ul class="nav-menu nav-menu-social align-to-right">
    <?php if(get_theme_mod('en_header_search', true)) { ?>
        <li class="search account-drop">
            <div class="input-with-icon header-search-wrap">
                <?php if(shortcode_exists('course_search')) echo do_shortcode('[course_search class="kitolms-header-search"]'); ?>
            </div>
        </li>
    <?php } ?>

    <?php 
    $en_header_shopping_cart = get_theme_mod('en_header_shopping_cart', true);
    if($en_header_shopping_cart){ ?>
        <?php echo kitolms_header_cart(); ?>
    <?php } ?>
  
    <?php if(is_user_logged_in()){ ?>
        <li class="nav-submenu-open">
            <div class="btn-group account-drop">
                <?php
                $user_id = get_current_user_id();
                $user = get_user_by('ID', $user_id);
                ?>
                <a href="javascript:void(0);" class="crs_yuo12 btn btn-order-by-filt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        if(function_exists('tutor_utils')){
                            echo tutor_utils()->get_tutor_avatar(get_current_user_id(), 'thumbnail');
                        }else{
                            $get_avatar_url = get_avatar_url(get_current_user_id(), 'thumbnail'); ?>
                            <img class='avater-img' alt="<?php echo esc_html($user->display_name); ?>" src="<?php echo esc_url($get_avatar_url); ?>" />
                        <?php }
                    ?>
                </a>
                <div class="dropdown-menu pull-right animated flipInX">
                    <div class="drp_menu_headr">
                        <h4>
                            <?php _e('Hi,', 'kitolms'); ?>
                            <?php echo esc_html($user->display_name, 'kitolms'); ?>
                        </h4>
                    </div>

                    <ul>
                        <?php
                            if(function_exists('tutor_utils')) {
                                $dashboard_page_id = tutor_utils()->get_option('tutor_dashboard_page_id');
                                $dashboard_pages = tutor_utils()->tutor_dashboard_pages();
        
                                foreach ($dashboard_pages as $dashboard_key => $dashboard_page){
                                    $menu_title = $dashboard_page;
                                    $menu_link = tutils()->get_tutor_dashboard_page_permalink($dashboard_key);
                                    $separator = false;
                                    if (is_array($dashboard_page)){
                                        if(!current_user_can(tutor()->instructor_role)) continue;
                                        $menu_title = tutor_utils()->array_get('title', $dashboard_page);
                                        /**
                                         * Add new menu item property "url" for custom link
                                         */
                                        if (isset($dashboard_page['url'])){
                                            $menu_link = $dashboard_page['url'];
                                        }
                                        if (isset($dashboard_page['type']) && $dashboard_page['type'] == 'separator'){
                                            $separator = true;
                                        }
                                    }
                                    
                                    if(isset($menu_title) && !empty($menu_title)) {
                                        if($menu_title == 'Logout') {
                                            echo "<li><a href='".esc_url($menu_link)."'><i class='fa fa-unlock-alt'></i> ".esc_html($menu_title)."</a></li>";
                                        } else {
                                            echo "<li><a href='".esc_url($menu_link)."'>".esc_html($menu_title)."</a></li>";
                                        }
                                    }
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </li>
    <?php } else { ?>
        <?php 
        $header_login_btn_text = get_theme_mod('header_login_btn_text', 'Sign In'); 
        $header_reg_btn_text = get_theme_mod('header_reg_btn_text', 'Get Started'); 
        $header_register_url = get_theme_mod('header_register_url', '#'); 
        ?>
        <?php if(get_theme_mod('header_login_btn', true)) { ?>
            <li>
                <a href="#" class="alio_green" data-toggle="modal" data-target="#login">
                    <i class="fas fa-sign-in-alt mr-1"></i><span class="dn-lg"><?php echo esc_html($header_login_btn_text); ?></span>
                </a>
            </li>
        <?php } ?>

        <?php if(get_theme_mod('header_started_btn', true)) { ?>
            <li>
                <div class="add-listing btn theme-bg">
                    <a href="<?php echo esc_url($header_register_url); ?>" class="text-white"><?php echo esc_html($header_reg_btn_text); ?></a>
                </div>
            </li>
        <?php } ?>
    <?php } ?>
</ul>
