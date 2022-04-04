<?php
/**
 * Promos Theme Customizer
 *
 * @package Promos
 */

if ( !function_exists('promos_default_theme_options_values') ) :

    function promos_default_theme_options_values() {

        $default_theme_options = array(

            /*Logo Options*/
            'promos_logo_width_option' => '700',

            /*Top Header*/
            'promos_enable_top_header_social'=> 0,

            /*Header Image*/
            'promos_enable_header_image_overlay'=> 0,
            'promos_slider_overlay_color'=> '#000000',
            'promos_slider_overlay_transparent'=> '0.1',
            'promos_header_image_height'=> '100',

            /*Header Options*/
            'promos_enable_search'  => 0,

            /*Menu Options*/
            'promos_mobile_menu_text'  => esc_html__('Menu','promos'),
            'promos_mobile_menu_option'=> 'menu-text',

            /*Colors Options*/
            'promos_primary_color'  => '#f50649',

            /*Slider Options*/
            'promos_enable_slider'      => 0,
            'promos-select-category'    => 0,
    
            /*Boxes Section */
            'promos_enable_promo'       => 0,
            'promos-promo-select-category'=> 0,
            
            /*Blog Page*/
            'promos-sidebar-blog-page' => 'right-sidebar',
            'promos-blog-image-layout' => 'left-image',
            'promos-content-show-from' => 'excerpt',
            'promos-excerpt-length'    => 25,
            'promos-pagination-options'=> 'numeric',
            'promos-read-more-text'    => esc_html__('Read More','promos'),
            'promos-blog-exclude-category'=> '',
            'promos-show-hide-share'   => 0,
            'promos-show-hide-category'=> 1,
            'promos-show-hide-date'=> 1,
            'promos-show-hide-author'=> 1,
            'promos-blog-image-crop-full'=> 'original-image',

            /*Single Page */
            'promos-single-page-featured-image' => 1,
            'promos-single-page-related-posts'  => 1,
            'promos-single-page-related-posts-title' => esc_html__('You may like','promos'),
            'promos-sidebar-single-page'=> 'single-right-sidebar',
            'promos-single-social-share' => 0,
            'promos-single-page-tags-option'=>0,

            /*Sticky Sidebar*/
            'promos-enable-sticky-sidebar' => 0,

            /*Footer Section*/
            'promos-footer-copyright'  => esc_html__('&#169; All Rights Reserved 2022','promos'),

            /*Breadcrumb Options*/
            'promos-extra-breadcrumb' => 1,
            'promos-breadcrumb-selection-option'=> 'theme-breadcrumb',

        );
return apply_filters( 'promos_default_theme_options_values', $default_theme_options );
}
endif;
/**
 *  Promos Theme Options and Settings
 *
 * @since Promos 1.0.0
 *
 * @param null
 * @return array promos_get_options_value
 *
 */
if ( !function_exists('promos_get_options_value') ) :
    function promos_get_options_value() {
        $promos_default_theme_options_values = promos_default_theme_options_values();
        $promos_get_options_value = get_theme_mod( 'promos_options');
        if( is_array( $promos_get_options_value )){
            return array_merge( $promos_default_theme_options_values, $promos_get_options_value );
        }
        else{
            return $promos_default_theme_options_values;
        }
    }
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function promos_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
    if ( isset( $wp_customize->selective_refresh ) ) {
      $wp_customize->selective_refresh->add_partial( 'blogname', array(
         'selector'        => '.site-title a',
         'render_callback' => 'promos_customize_partial_blogname',
     ) );
      $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
         'selector'        => '.site-description',
         'render_callback' => 'promos_customize_partial_blogdescription',
     ) );
  }
  $default = promos_default_theme_options_values();

  require get_template_directory() . '/templatesell/theme-settings/theme-settings.php';

}
add_action( 'customize_register', 'promos_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function promos_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function promos_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function promos_customize_preview_js() {
	wp_enqueue_script( 'promos-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20200412', true );
}
add_action( 'customize_preview_init', 'promos_customize_preview_js' );

/*
** Customizer Styles
*/
function promos_panels_css() {
     wp_enqueue_style('promos-customizer-css', get_template_directory_uri() . '/css/customizer-style.css', array(), '4.5.0');
}
add_action( 'customize_controls_enqueue_scripts', 'promos_panels_css' );