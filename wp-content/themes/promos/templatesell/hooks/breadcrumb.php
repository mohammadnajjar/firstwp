<?php
/**
 * Functions to manage breadcrumbs
 */
if (!function_exists('promos_breadcrumb_options')) :
    function promos_breadcrumb_options()
    {
        global $promos_theme_options;
        if (1 == $promos_theme_options['promos-extra-breadcrumb']) {
            promos_breadcrumbs();
        }
    }
endif;
add_action('promos_breadcrumb_options_hook', 'promos_breadcrumb_options');

/**
 * BreadCrumb Settings
 */
if (!function_exists('promos_breadcrumbs')):
    function promos_breadcrumbs()
    {
        global $promos_theme_options;
        $breadcrumb_from = $promos_theme_options['promos-breadcrumb-selection-option'];        
        if ((function_exists('yoast_breadcrumb')) && ($breadcrumb_from == 'yoast-breadcrumb')) {
            yoast_breadcrumb();
        }elseif('rankmath' == $breadcrumb_from && (function_exists('rank_math_the_breadcrumbs'))) {
          rank_math_the_breadcrumbs();
        }elseif ((function_exists('bcn_display')) && ($breadcrumb_from == 'navxt-breadcrumb')) {
            bcn_display();
        }else{

            if (!function_exists('promos_breadcrumb_trail')) {
                require get_template_directory() . '/templatesell/breadcrumbs/breadcrumbs.php';
            }
            $breadcrumb_args = array(
                'container' => 'div',
                'show_browse' => false
            );        
            promos_breadcrumb_trail($breadcrumb_args);
        }
    }
endif;
add_action('promos_breadcrumbs_hook', 'promos_breadcrumbs');