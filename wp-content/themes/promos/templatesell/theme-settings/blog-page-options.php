<?php
/*Blog Page Options*/
$wp_customize->add_section('promos_blog_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Blog Settings', 'promos'),
    'panel' => 'promos_panel',
));
/*Blog Page Sidebar Layout*/

$wp_customize->add_setting('promos_options[promos-sidebar-blog-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-sidebar-blog-page'],
    'sanitize_callback' => 'promos_sanitize_select'
));

$wp_customize->add_control( new Promos_Radio_Image_Control(
        $wp_customize,
    'promos_options[promos-sidebar-blog-page]', array(
    'choices' => promos_blog_sidebar_position_array(),
    'label' => __('Blog and Archive Sidebar', 'promos'),
    'description' => __('This sidebar will work blog and archive pages.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-sidebar-blog-page]',
    'type' => 'select',
    'priority' => 15,
)));

/*Image Layout Options For Blog Page*/
$wp_customize->add_setting('promos_options[promos-blog-image-layout]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-blog-image-layout'],
    'sanitize_callback' => 'promos_sanitize_select'
));

$wp_customize->add_control('promos_options[promos-blog-image-layout]', array(
    'choices' => array(
        'full-image' => __('Full Image', 'promos'),
        'left-image' => __('Left Image', 'promos'),
        'right-image' => __('Right Image', 'promos'),
    
    ),
    'label' => __('Blog Page Layout', 'promos'),
    'description' => __('This will work only on Full layout Option', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-blog-image-layout]',
    'type' => 'select',
    'priority' => 15,
));
/*Image crop or full*/
$wp_customize->add_setting('promos_options[promos-blog-image-crop-full]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-blog-image-crop-full'],
    'sanitize_callback' => 'promos_sanitize_select'
));

$wp_customize->add_control('promos_options[promos-blog-image-crop-full]', array(
    'choices' => array(
        'cropped-image' => __('Cropped Image', 'promos'),
        'original-image' => __('Original Full Image', 'promos'),
    
    ),
    'label' => __('Cropped or Original Image in Blog Page', 'promos'),
    'description' => __('Once you select this full image will appear. We recommend to use the equal image size if you use original image size.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-blog-image-crop-full]',
    'type' => 'select',
    'priority' => 15,
));

/*Blog Page Show content from*/
$wp_customize->add_setting('promos_options[promos-content-show-from]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-content-show-from'],
    'sanitize_callback' => 'promos_sanitize_select'
));

$wp_customize->add_control('promos_options[promos-content-show-from]', array(
    'choices' => array(
        'excerpt' => __('Show from Excerpt', 'promos'),
        'content' => __('Show from Content', 'promos'),
    ),
    'label' => __('Select Content Display From', 'promos'),
    'description' => __('You can enable excerpt from Screen Options inside post section of dashboard', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-content-show-from]',
    'type' => 'select',
    'priority' => 15,
));


/*Blog Page excerpt length*/
$wp_customize->add_setting('promos_options[promos-excerpt-length]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-excerpt-length'],
    'sanitize_callback' => 'absint'

));

$wp_customize->add_control('promos_options[promos-excerpt-length]', array(
    'label' => __('Excerpt Length', 'promos'),
    'description' => __('Enter the number per Words to show the content in blog page.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-excerpt-length]',
    'type' => 'number',
    'priority' => 15,
));

/*Blog Page Pagination Options*/
$wp_customize->add_setting('promos_options[promos-pagination-options]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-pagination-options'],
    'sanitize_callback' => 'promos_sanitize_select'

));

$wp_customize->add_control('promos_options[promos-pagination-options]', array(
    'choices' => array(
        'numeric' => __('Numeric Pagination', 'promos'),
        'default' => __('Default Pagination', 'promos'),
    ),
    'label' => __('Pagination Types', 'promos'),
    'description' => __('Choose Required Pagination Type', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-pagination-options]',
    'type' => 'select',
    'priority' => 15,
));

/*Blog Page read more text*/
$wp_customize->add_setting('promos_options[promos-read-more-text]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('promos_options[promos-read-more-text]', array(
    'label' => __('Read More Text', 'promos'),
    'description' => __('Read more text for blog and archive page.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-read-more-text]',
    'type' => 'text',
    'priority' => 15,
));

/*Exclude Category in Blog Page*/
$wp_customize->add_setting('promos_options[promos-blog-exclude-category]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-blog-exclude-category'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('promos_options[promos-blog-exclude-category]', array(
    'label' => __('Exclude categories in Blog Listing', 'promos'),
    'description' => __('Enter categories ids with comma separated eg: 2,7,14,47.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-blog-exclude-category]',
    'type' => 'text',
    'priority' => 15,
));


/*Social Share in blog page*/
$wp_customize->add_setting('promos_options[promos-show-hide-share]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-show-hide-share'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
));

$wp_customize->add_control('promos_options[promos-show-hide-share]', array(
    'label' => __('Show Social Share', 'promos'),
    'description' => __('Options to Enable Social Share in blog and archive page.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-show-hide-share]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Category Show hide*/
$wp_customize->add_setting('promos_options[promos-show-hide-category]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-show-hide-category'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
));

$wp_customize->add_control('promos_options[promos-show-hide-category]', array(
    'label' => __('Show Category', 'promos'),
    'description' => __('Option to hide the category on the blog page.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-show-hide-category]',
    'type' => 'checkbox',
    'priority' => 15,
));
/*Date Show hide*/
$wp_customize->add_setting('promos_options[promos-show-hide-date]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-show-hide-date'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
));

$wp_customize->add_control('promos_options[promos-show-hide-date]', array(
    'label' => __('Show Date', 'promos'),
    'description' => __('Option to hide the date on the blog page.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-show-hide-date]',
    'type' => 'checkbox',
    'priority' => 15,
));
/*Author Show hide*/
$wp_customize->add_setting('promos_options[promos-show-hide-author]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['promos-show-hide-author'],
    'sanitize_callback' => 'promos_sanitize_checkbox'
));

$wp_customize->add_control('promos_options[promos-show-hide-author]', array(
    'label' => __('Show Author', 'promos'),
    'description' => __('Option to hide the author on the blog page.', 'promos'),
    'section' => 'promos_blog_page_section',
    'settings' => 'promos_options[promos-show-hide-author]',
    'type' => 'checkbox',
    'priority' => 15,
));