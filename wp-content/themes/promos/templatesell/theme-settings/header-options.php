<?php
$GLOBALS['promos_theme_options'] = promos_get_options_value();

/*Header Options*/
$wp_customize->add_section('promos_header_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Header Settings', 'promos'),
    'panel' => 'promos_panel',
));


/*Header Search Enable Option*/
$wp_customize->add_setting( 'promos_options[promos_enable_search]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['promos_enable_search'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
) );

$wp_customize->add_control( 'promos_options[promos_enable_search]', array(
    'label'     => __( 'Enable Search', 'promos' ),
    'description' => __('It will help to display the search in Menu.', 'promos'),
    'section'   => 'promos_header_section',
    'settings'  => 'promos_options[promos_enable_search]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );

/*Enable Social Icons In Header*/
$wp_customize->add_setting( 'promos_options[promos_enable_top_header_social]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['promos_enable_top_header_social'],
   'sanitize_callback' => 'promos_sanitize_checkbox'
) );

$wp_customize->add_control( 'promos_options[promos_enable_top_header_social]', array(
   'label'     => __( 'Enable Social Icons', 'promos' ),
   'description' => __('You can show the social icons here. Manage social icons from Appearance > Menus. Social Menu will display here.', 'promos'),
   'section'   => 'promos_header_section',
   'settings'  => 'promos_options[promos_enable_top_header_social]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );

/*Mobile menu icon option*/
$wp_customize->add_setting('promos_options[promos_mobile_menu_option]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos_mobile_menu_option'],
    'sanitize_callback' => 'promos_sanitize_select'
));

$wp_customize->add_control('promos_options[promos_mobile_menu_option]', array(
    'choices' => array(
        'menu-text' => __('Menu Text in Mobile', 'promos'),
        'menu-icon' => __('Hamberger Menu in Mobile', 'promos'),
    ),
    'label' => __('Select the Mobile Menu Type', 'promos'),
    'description' => __('You can either select the text mode or hamberger menu in mobile layout.', 'promos'),
    'section' => 'promos_header_section',
    'settings' => 'promos_options[promos_mobile_menu_option]',
    'type' => 'select',
    'priority' => 15,
));

/*callback functions mobile menu type*/
if (!function_exists('promos_mobile_menu_type_callback')) :
    function promos_mobile_menu_type_callback()
    {
        global $promos_theme_options;
        $mobile_menu_type = esc_attr($promos_theme_options['promos_mobile_menu_option']);
        if ( 'menu-text' == $mobile_menu_type) {
            return true;
        } else {
            return false;
        }
    }
endif;

/*Mobile Menu Text*/
$wp_customize->add_setting( 'promos_options[promos_mobile_menu_text]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['promos_mobile_menu_text'],
    'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'promos_options[promos_mobile_menu_text]', array(
    'label'     => __( 'Enter the Mobile Menu Text', 'promos' ),
    'description' => __('In the Mobile view mode, you can see Menu text. Change this text from here. It will only available on the mobile view mode.', 'promos'),
    'section'   => 'promos_header_section',
    'settings'  => 'promos_options[promos_mobile_menu_text]',
    'type'      => 'text',
    'priority'  => 15,
    'active_callback' => 'promos_mobile_menu_type_callback',

) );