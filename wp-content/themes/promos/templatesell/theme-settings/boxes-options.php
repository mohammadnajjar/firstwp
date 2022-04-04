<?php
$GLOBALS['promos_theme_options'] = promos_get_options_value();

/*Promo Section Options*/

$wp_customize->add_section( 'promos_promo_section', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Boxes Below Slider Settings', 'promos' ),
    'panel'          => 'promos_panel',
) );

/*callback functions boxes*/
if ( !function_exists('promos_promo_active_callback') ) :
        function promos_promo_active_callback(){
        global $promos_theme_options;
        $enable_promo = absint($promos_theme_options['promos_enable_promo']);
        if( 1 == $enable_promo ){
            return true;
        }
        else{
            return false;
        }
    }
endif;

/*Boxes Enable Option*/
$wp_customize->add_setting( 'promos_options[promos_enable_promo]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['promos_enable_promo'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
) );

$wp_customize->add_control( 'promos_options[promos_enable_promo]', array(
    'label'     => __( 'Enable Boxes', 'promos' ),
    'description' => __('Enable and select the category to show the boxes below slider.', 'promos'),
    'section'   => 'promos_promo_section',
    'settings'  => 'promos_options[promos_enable_promo]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );

/*Promo Category Selection*/
$wp_customize->add_setting( 'promos_options[promos-promo-select-category]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['promos-promo-select-category'],
    'sanitize_callback' => 'absint'

) );

$wp_customize->add_control(
    new Promos_Customize_Category_Dropdown_Control(
        $wp_customize,
        'promos_options[promos-promo-select-category]',
        array(
            'label'     => __( 'Category For Boxes', 'promos' ),
            'description' => __('From the dropdown select the category for the boxes. Category having post will display in below boxes section.', 'promos'),
            'section'   => 'promos_promo_section',
            'settings'  => 'promos_options[promos-promo-select-category]',
            'type'      => 'category_dropdown',
            'priority'  => 5,
            'active_callback'=>'promos_promo_active_callback'
        )
    )
);