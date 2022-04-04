<?php
/**
 * Add sidebar class in body
 *
 * @since Promos 1.0.0
 *
 */

add_filter('body_class', 'promos_body_class');
function promos_body_class($classes)
{
    $classes[] = 'at-sticky-sidebar';
    global $promos_theme_options;
    
    if (is_singular()) {
        $sidebar = $promos_theme_options['promos-sidebar-single-page'];
        if ($sidebar == 'single-no-sidebar') {
            $classes[] = 'single-no-sidebar';
        } elseif ($sidebar == 'single-left-sidebar') {
            $classes[] = 'single-left-sidebar';
        } elseif ($sidebar == 'single-middle-column') {
            $classes[] = 'single-middle-column';
        } else {
            $classes[] = 'single-right-sidebar';
        }
    }
    
    $sidebar = $promos_theme_options['promos-sidebar-blog-page'];
    if ($sidebar == 'no-sidebar') {
        $classes[] = 'no-sidebar';
    } elseif ($sidebar == 'left-sidebar') {
        $classes[] = 'left-sidebar';
    } elseif ($sidebar == 'middle-column') {
        $classes[] = 'middle-column';
    } else {
        $classes[] = 'right-sidebar';
    }
    return $classes;
}

/**
 * Filter to hide text Category from category page
 *
 * @since Promos 1.0.9
 *
 */
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});