<?php 
/*Extra Options*/

        $wp_customize->add_section( 'promos_extra_options', array(
            'priority'       => 20,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Breadcrumb Settings', 'promos' ),
            'panel'          => 'promos_panel',
        ) );



        /*Breadcrumb Enable*/
        $wp_customize->add_setting( 'promos_options[promos-extra-breadcrumb]', array(
            'capability'        => 'edit_theme_options',
            'transport' => 'refresh',
            'default'           => $default['promos-extra-breadcrumb'],
            'sanitize_callback' => 'promos_sanitize_checkbox'
        ) );

        $wp_customize->add_control( 'promos_options[promos-extra-breadcrumb]', array(
            'label'     => __( 'Enable Breadcrumb', 'promos' ),
            'description' => __( 'Breadcrumb will appear on all pages except home page. More settings will be on the premium version.', 'promos' ),
            'section'   => 'promos_extra_options',
            'settings'  => 'promos_options[promos-extra-breadcrumb]',
            'type'      => 'checkbox',
            'priority'  => 15,
        ) );

/*Select the breadcrumb from plugins or themes.*/
$wp_customize->add_setting('promos_options[promos-breadcrumb-selection-option]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-breadcrumb-selection-option'],
    'sanitize_callback' => 'promos_sanitize_select'
));

$wp_customize->add_control('promos_options[promos-breadcrumb-selection-option]', array(
    'choices' => array(
        'theme-breadcrumb' => __('Theme Breadcrumb', 'promos'),
        'yoast-breadcrumb' => __('Yoast SEO Breadcrumb', 'promos'),
        'rankmath' => __('Rank Math Plugin', 'promos'),
        'navxt-breadcrumb' => __('NavXT Breadcrumb', 'promos'),    
    ),
    'label' => __('Select the Breadcrumb', 'promos'),
    'description' => __('After enable the breadcrumb, you need to install Yoast SEO, Rank Math or Breadcrumb NavXT plugin for added breadcrumb option.', 'promos'),
    'section' => 'promos_extra_options',
    'settings' => 'promos_options[promos-breadcrumb-selection-option]',
    'type' => 'select',
    'priority' => 15,
));