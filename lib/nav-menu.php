<!-- Mobile Menu in Search -->
<div class="mobile-register col-sm-6 col-md-9 col-6 hidden-lg-up align-self-center align-self-end"> 
    <div id="site-navigation" class="main-navigation toggled">
        <div class="navbar-header clearfix">
            <button id="kitolms-navmenu" class="menu-toggle navbar-toggle kitolms-navmenu-button" aria-controls="primary-menu" aria-expanded="false" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="slicknav_icon kitolms-navmenu-button-open"></span>
            </button>
        </div>
    </div><!-- #site-navigation -->
</div>

<?php if ( has_nav_menu( 'primary' ) ) { ?>
    <div id="main-menu" class="common-menu-wrap">
        <?php 
            wp_nav_menu(  array(
                    'theme_location' => 'primary',
                    'container'      => '', 
                    'menu_class'     => 'nav',
                    'fallback_cb'    => 'wp_page_menu',
                    'depth'          => 4,
                )
            );
        ?>      
    </div><!--/#main-menu-->
<?php } ?>

<div id="site-navigation" class="main-navigation toggled">
    <ul id="primary-menu" class="nav navbar-nav nav-menu">
        <div id="mobile-menu" class="hidden-lg-up">
            <div class="collapse navbar-collapse">
                <?php 
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array(
                            'theme_location'      => 'primary',
                            'container'           => false,
                            'menu_class'          => 'nav navbar-nav',
                            'fallback_cb'         => 'wp_page_menu',
                            'depth'               => 3,
                            'walker'              => new kitolms_mobile_navwalker()
                            )
                        ); 
                    }
                ?>
            </div>
        </div><!--/.#mobile-menu-->
    </ul>
</div><!-- #site-navigation -->
