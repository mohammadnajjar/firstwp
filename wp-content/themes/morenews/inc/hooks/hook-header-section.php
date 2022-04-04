<?php
if (!function_exists('morenews_header_section')) :
    /**
     * Banner Slider
     *
     * @since MoreNews 1.0.0
     *
     */
    function morenews_header_section()
    {

        $morenews_header_layout = morenews_get_option('header_layout');


        ?>

        <header id="masthead" class="<?php echo esc_attr($morenews_header_layout); ?> morenews-header">
            <?php morenews_get_block('layout-default', 'header');  ?>
        </header>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('morenews_action_header_section', 'morenews_header_section', 40);

//Load main nav menu
if (!function_exists('morenews_main_menu_nav_section')):

    function morenews_main_menu_nav_section()
    {

        ?>
        <div class="navigation-container">
            <nav class="main-navigation clearfix">

                                        <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                        <a href="javascript:void(0)" class="aft-void-menu">
                                            <span class="screen-reader-text">
                                            <?php esc_html_e('Primary Menu', 'morenews'); ?>
                                        </span>
                                        <i class="ham"></i>
                                        </a>
                                    </span>


                <?php
                $morenews_global_show_home_menu = morenews_get_option('global_show_primary_menu_border');
                wp_nav_menu(array(
                    'theme_location' => 'aft-primary-nav',
                    'menu_id' => 'primary-menu',
                    'container' => 'div',
                    'container_class' => 'menu main-menu menu-desktop ' . $morenews_global_show_home_menu,
                ));
                ?>
            </nav>
        </div>


    <?php }
endif;

add_action('morenews_action_main_menu_nav', 'morenews_main_menu_nav_section', 40);

//load search form
if (!function_exists('morenews_load_search_form_section')):

    function morenews_load_search_form_section()
    {
        ?>
        <div class="af-search-wrap">
            <div class="search-overlay">
                <a href="#" title="Search" class="search-icon">
                    <i class="fa fa-search"></i>
                </a>
                <div class="af-search-form">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>

    <?php }

endif;
add_action('morenews_load_search_form', 'morenews_load_search_form_section');


//watch online
if (!function_exists('morenews_load_watch_online_section')):

    function morenews_load_watch_online_section()
    {

        $morenews_aft_enable_custom_link = morenews_get_option('show_watch_online_section');
        if ($morenews_aft_enable_custom_link):
            $morenews_aft_custom_link = morenews_get_option('aft_custom_link');
            $morenews_aft_custom_link = !empty($morenews_aft_custom_link) ? $morenews_aft_custom_link : '#';
            $morenews_aft_custom_icon = morenews_get_option('aft_custom_icon');
            $morenews_aft_custom_title = morenews_get_option('aft_custom_title');
            if (!empty($morenews_aft_custom_title)):
                ?>
                <div class="custom-menu-link">
                    <a href="<?php echo esc_url($morenews_aft_custom_link); ?>">
                        <?php if (!empty($morenews_aft_custom_icon)): ?>
                            <i class="<?php echo esc_attr($morenews_aft_custom_icon); ?>" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php echo esc_html($morenews_aft_custom_title); ?>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    <?php }

endif;
add_action('morenews_load_watch_online', 'morenews_load_watch_online_section');

//Load off canvas section
if (!function_exists('morenews_load_off_canvas_section')):

    function morenews_load_off_canvas_section()
    {
        if (is_active_sidebar('express-off-canvas-panel')) :
            ?>


            <span class="offcanvas">
				<a href="#" class="offcanvas-nav">
					<div class="offcanvas-menu">
						<span class="mbtn-top"></span>
						<span class="mbtn-mid"></span>
						<span class="mbtn-bot"></span>
					</div>
				</a>
			</span>
        <?php
        endif;
    }

endif;
add_action('morenews_load_off_canvas', 'morenews_load_off_canvas_section');

//load date part
if (!function_exists('morenews_load_date_section')):
    function morenews_load_date_section()
    {
        $morenews_show_date = morenews_get_option('show_date_section');
        if ($morenews_show_date == true): ?>
            <span class="topbar-date">
        <?php
        echo wp_kses_post(date_i18n(get_option('date_format')));
        ?>
    </span>
        <?php endif;
    }
endif;
add_action('morenews_load_date', 'morenews_load_date_section');

//load social icon menu
if (!function_exists('morenews_load_social_menu_section')):

    function morenews_load_social_menu_section()
    {
        ?>
        <?php
        $morenews_show_social_menu = morenews_get_option('show_social_menu_section');
        if (has_nav_menu('aft-social-nav') && $morenews_show_social_menu == true): ?>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'aft-social-nav',
                'link_before' => '<span class="screen-reader-text">',
                'link_after' => '</span>',
                'container' => 'div',
                'container_class' => 'social-navigation'
            ));
            ?>

        <?php endif; ?>
    <?php }

endif;

add_action('morenews_load_social_menu', 'morenews_load_social_menu_section');

//Load site branding section

if (!function_exists('morenews_load_site_branding_section')):
    function morenews_load_site_branding_section()
    {
        $morenews_class = '';
        $morenews_site_title_uppercase = morenews_get_option('site_title_uppercase');
        if($morenews_site_title_uppercase){
            $morenews_class = 'uppercase-site-title';
        }
        ?>
        <div class="site-branding <?php echo esc_attr($morenews_class); ?>">
            <?php
            the_custom_logo();
            if (is_front_page() || is_home()) : ?>
                <h1 class="site-title font-family-1">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-anchor"
                       rel="home"><?php bloginfo('name'); ?></a>
                </h1>
            <?php else : ?>
                <p class="site-title font-family-1">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-anchor"
                       rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>

            <?php
            $morenews_description = get_bloginfo('description', 'display');
            if ($morenews_description || is_customize_preview()) : ?>
                <p class="site-description"><?php echo esc_html($morenews_description); ?></p>
            <?php
            endif; ?>
        </div>

    <?php }

endif;
add_action('morenews_load_site_branding', 'morenews_load_site_branding_section');

