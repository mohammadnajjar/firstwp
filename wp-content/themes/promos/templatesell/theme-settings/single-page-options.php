<?php
$GLOBALS['promos_theme_options'] = promos_get_options_value();

/*Single Page Options*/
$wp_customize->add_section('promos_single_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Single Page Settings', 'promos'),
    'panel' => 'promos_panel',
));

/*Featured Image Option*/
$wp_customize->add_setting('promos_options[promos-single-page-featured-image]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-single-page-featured-image'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
));

$wp_customize->add_control('promos_options[promos-single-page-featured-image]', array(
    'label' => __('Enable Featured Image on Single Posts', 'promos'),
    'description' => __('You can hide images on single post from here.', 'promos'),
    'section' => 'promos_single_page_section',
    'settings' => 'promos_options[promos-single-page-featured-image]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Single Page Sidebar Layout*/
$wp_customize->add_setting('promos_options[promos-sidebar-single-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-sidebar-single-page'],
    'sanitize_callback' => 'promos_sanitize_select'
));

$wp_customize->add_control( 
    new Promos_Radio_Image_Control(
        $wp_customize,
    'promos_options[promos-sidebar-single-page]', array(
    'choices' => promos_sidebar_position_array(),
    'label' => __('Select Sidebar', 'promos'),
    'description' => __('From Appearance > Customize > Widgets and add the widgets on the respected widget areas.', 'promos'),
    'section' => 'promos_single_page_section',
    'settings' => 'promos_options[promos-sidebar-single-page]',
    'type' => 'select',
    'priority' => 15,
)));

/*Related Post Options*/
$wp_customize->add_setting('promos_options[promos-single-page-related-posts]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-single-page-related-posts'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
));

$wp_customize->add_control('promos_options[promos-single-page-related-posts]', array(
    'label' => __('Related Posts', 'promos'),
    'description' => __('2 posts of same category will appear.', 'promos'),
    'section' => 'promos_single_page_section',
    'settings' => 'promos_options[promos-single-page-related-posts]',
    'type' => 'checkbox',
    'priority' => 15,
));


/*callback functions related posts*/
if (!function_exists('promos_related_post_callback')) :
        function promos_related_post_callback()
    {
        global $promos_theme_options;
        $related_posts = absint($promos_theme_options['promos-single-page-related-posts']);
        if (1 == $related_posts) {
            return true;
        } else {
            return false;
        }
    }
endif;

/*Related Post Title*/
$wp_customize->add_setting('promos_options[promos-single-page-related-posts-title]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-single-page-related-posts-title'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('promos_options[promos-single-page-related-posts-title]', array(
    'label' => __('Related Posts Title', 'promos'),
    'description' => __('Enter the suitable title.', 'promos'),
    'section' => 'promos_single_page_section',
    'settings' => 'promos_options[promos-single-page-related-posts-title]',
    'type' => 'text',
    'priority' => 15,
    'active_callback' => 'promos_related_post_callback'
));

/*Social Share Options*/
$wp_customize->add_setting('promos_options[promos-single-social-share]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-single-social-share'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
));

$wp_customize->add_control('promos_options[promos-single-social-share]', array(
    'label' => __('Social Sharing', 'promos'),
    'description' => __('Enable Social Sharing on Single Posts.', 'promos'),
    'section' => 'promos_single_page_section',
    'settings' => 'promos_options[promos-single-social-share]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Tag Option*/
$wp_customize->add_setting('promos_options[promos-single-page-tags-option]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-single-page-tags-option'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
));

$wp_customize->add_control('promos_options[promos-single-page-tags-option]', array(
    'label' => __('Enable Tags on Single Posts', 'promos'),
    'description' => __('You can hide tags on single post from here.', 'promos'),
    'section' => 'promos_single_page_section',
    'settings' => 'promos_options[promos-single-page-tags-option]',
    'type' => 'checkbox',
    'priority' => 15,
));
