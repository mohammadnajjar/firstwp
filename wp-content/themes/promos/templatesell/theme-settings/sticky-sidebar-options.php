<?php 
/*Sticky Sidebar*/
$wp_customize->add_section( 'promos_sticky_sidebar', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Sticky Sidebar Settings', 'promos' ),
   'panel' 		 => 'promos_panel',
) );

/*Sticky Sidebar Setting*/
$wp_customize->add_setting( 'promos_options[promos-enable-sticky-sidebar]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['promos-enable-sticky-sidebar'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
) );

$wp_customize->add_control( 'promos_options[promos-enable-sticky-sidebar]', array(
    'label'     => __( 'Enable Sticky Sidebar', 'promos' ),
    'description' => __('Enable and Disable sticky sidebar from this section.', 'promos'),
    'section'   => 'promos_sticky_sidebar',
    'settings'  => 'promos_options[promos-enable-sticky-sidebar]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );