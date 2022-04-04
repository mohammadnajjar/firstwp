<?php
/*Footer Options*/
$wp_customize->add_section('promos_footer_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Footer Settings', 'promos'),
    'panel' => 'promos_panel',
));


/*Copyright Setting*/
$wp_customize->add_setting('promos_options[promos-footer-copyright]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-footer-copyright'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('promos_options[promos-footer-copyright]', array(
    'label' => __('Copyright Text', 'promos'),
    'description' => __('Enter your own copyright text.', 'promos'),
    'section' => 'promos_footer_section',
    'settings' => 'promos_options[promos-footer-copyright]',
    'type' => 'text',
    'priority' => 15,
));
