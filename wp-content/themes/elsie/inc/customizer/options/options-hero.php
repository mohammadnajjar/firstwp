<?php
/**
 * Hero Customizer options
 *
 * @package Elsie
 */


/**
 * Hero
 */
$wp_customize->add_section(
	'elsie_header_hero',
	array(
		'title'         => esc_html__( 'Hero', 'elsie' ),
		'priority'      => 11,
		'panel'			=> 'elsie_header_panel'
	)
);

$wp_customize->add_setting( 'elsie_hero_type', array(
	'sanitize_callback' => 'elsie_sanitize_select',
	'default' 			=> 'header_image',
) );

$wp_customize->add_control( 'elsie_hero_type', array(
	'type' => 'select',
	'section' => 'elsie_header_hero',
	'label' => esc_html__( 'Hero type', 'elsie' ),
	'choices' => array(
		'disabled' 		=> esc_html__( 'Disabled', 'elsie' ),
		'header_image' 	=> esc_html__( 'Static Image', 'elsie' ),
		'post_grid' 	=> esc_html__( 'Post grid', 'elsie' ),
	),
	'priority' => 9
) );

//Get header image control
$wp_customize->add_setting(
	'hero_header_image_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'hero_header_image_title',
	array(
		'label'    			=> esc_html__( 'Image', 'elsie' ),
		'section'  			=> 'elsie_header_hero',
		'active_callback'	=> 'elsie_hero_header_image_active_callback',
		'priority' => 9
	)
) );

$wp_customize->get_control( 'header_image' )->section 			= 'elsie_header_hero';
$wp_customize->get_control( 'header_image' )->priority 			= 10;
$wp_customize->get_control( 'header_image' )->active_callback 	= 'elsie_hero_header_image_active_callback';


$wp_customize->add_setting(
	'hero_enable_overlay',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'hero_enable_overlay',
		array(
			'label'         	=> esc_html__( 'Enable image overlay?', 'elsie' ),
			'section'       	=> 'elsie_header_hero',
			'active_callback'	=> 'elsie_hero_header_image_active_callback'
		)
	)
);

$wp_customize->add_setting( 'hero_image_overlay_color',
	array(
		'default' 			=> 'rgba(0,0,0,0.4)',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'elsie_hex_rgba_sanitize'
	)
);
$wp_customize->add_control( new Elsie_Alpha_Color( $wp_customize, 'hero_image_overlay_color',
	array(
		'label' 			=> esc_html__( 'Overlay color', 'elsie' ),
		'section' 			=> 'elsie_header_hero',
        'active_callback'   => 'elsie_hero_header_image_overlay_active_callback'
	)
) );


//Layout
$wp_customize->add_setting(
	'hero_layout_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'hero_layout_title',
	array(
		'label'    			=> esc_html__( 'Layout', 'elsie' ),
		'section'  			=> 'elsie_header_hero',
		'active_callback'	=> 'elsie_hero_layout_callback'
	)
) );

$wp_customize->add_setting( 'header_hero_width',
	array(
		'default' 			=> 'nocontainer',
		'sanitize_callback' => 'elsie_sanitize_text'
	)
);
$wp_customize->add_control( new Elsie_Radio_Buttons( $wp_customize, 'header_hero_width',
	array(
		'label'   => esc_html__( 'Section width', 'elsie' ),
		'section' => 'elsie_header_hero',
		'columns' => 3,
		'choices' => array(
			'container' 		=> esc_html__( 'Contain', 'elsie' ),
			'container-wide' 	=> esc_html__( 'Wide', 'elsie' ),
			'nocontainer' 		=> esc_html__( 'Full', 'elsie' ),
		),
		'active_callback'	=> 'elsie_hero_layout_callback'
	)
) );

$wp_customize->add_setting(
	'post_grid_layout',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Elsie_Radio_Images(
		$wp_customize,
		'post_grid_layout',
		array(
			'label'    		=> esc_html__( 'Post grid layout', 'elsie' ),
			'section'  => 'elsie_header_hero',
			'columns'	=> 2,
			'choices'  => array(
				'default' => array(
					'label' => esc_html__( '3-Post Grid', 'elsie' ),
					'url'   => '%s/assets/img/hero1.svg'
				),
				'grid5' => array(
					'label' => esc_html__( '5-Post Grid', 'elsie' ),
					'url'   => '%s/assets/img/hero2.svg'
				),
				'columns4' => array(
					'label' => esc_html__( '4 columns', 'elsie' ),
					'url'   => '%s/assets/img/hero3.svg'
				),
				'mixed' => array(
					'label' => esc_html__( 'Mixed', 'elsie' ),
					'url'   => '%s/assets/img/hero4.svg'
				),				
			),
			'priority' 			=> 10,
			'active_callback'	=> 'elsie_hero_post_grid_active_callback'
		)
	)
); 

/**
 * Source
 */
$wp_customize->add_setting(
	'post_grid_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'post_grid_title',
	array(
		'label'    => esc_html__( 'Post settings', 'elsie' ),
		'section'  => 'elsie_header_hero',
		'active_callback'	=> 'elsie_hero_post_grid_active_callback'
	)
) );


$wp_customize->add_setting( 'post_grid_source', array(
	'sanitize_callback' => 'elsie_sanitize_select',
	'default' 			=> 'post',
) );

$wp_customize->add_control( 'post_grid_source', array(
	'type' 		=> 'select',
	'section' 	=> 'elsie_header_hero',
	'label' 	=> esc_html__( 'Post type', 'elsie' ),
	'choices' 	=> elsie_post_types_helper(),
	'active_callback'	=> 'elsie_hero_post_grid_active_callback'
) );


$wp_customize->add_setting( 'post_grid_ids',
	array(
		'default' => '',
		'sanitize_callback' => 'elsie_sanitize_post_array'
	)
);
$wp_customize->add_control( new Elsie_Posts_Dropdown( $wp_customize, 'post_grid_ids',
	array(
		'label' => esc_html__( 'Select your posts', 'elsie' ),
		'section' => 'elsie_header_hero',
		'input_attrs' => array(
			'posts_per_page' 	=> -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page
			'orderby' 			=> 'name',
			'order' 			=> 'ASC',
			'post_type' 		=> 'post'
		),
		'active_callback'	=> 'elsie_hero_post_grid_posts_callback'
	)
) );

$wp_customize->add_setting( 'pages_grid_ids',
	array(
		'default' => '',
		'sanitize_callback' => 'elsie_sanitize_post_array'
	)
);
$wp_customize->add_control( new Elsie_Posts_Dropdown( $wp_customize, 'pages_grid_ids',
	array(
		'label' => esc_html__( 'Select your pages', 'elsie' ),
		'section' => 'elsie_header_hero',
		'input_attrs' => array(
			'posts_per_page' 	=> -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page
			'orderby' 			=> 'name',
			'order' 			=> 'ASC',
			'post_type' 		=> 'page'
		),
		'active_callback'	=> 'elsie_hero_post_grid_pages_callback'
	)
) );

/**
 * Display
 */
$wp_customize->add_setting(
	'hero_display_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'hero_display_title',
	array(
		'label'    			=> esc_html__( 'Display', 'elsie' ),
		'section'  			=> 'elsie_header_hero',
		'active_callback'	=> 'elsie_hero_layout_callback'
	)
) );

$wp_customize->add_setting(
	'hero_front_page',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'hero_front_page',
		array(
			'label'         	=> esc_html__( 'Display the hero on your static homepage', 'elsie' ),
			'section'       	=> 'elsie_header_hero',
			'active_callback'	=> 'elsie_hero_layout_callback'
		)
	)
);

$wp_customize->add_setting(
	'hero_blog_page',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'hero_blog_page',
		array(
			'label'         	=> esc_html__( 'Display the hero on your blog page', 'elsie' ),
			'section'       	=> 'elsie_header_hero',
			'active_callback'	=> 'elsie_hero_layout_callback'
		)
	)
);

/**
 * Elements
 */
$wp_customize->add_setting(
	'hero_elements_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'hero_elements_title',
	array(
		'label'    			=> esc_html__( 'Elements', 'elsie' ),
		'section'  			=> 'elsie_header_hero',
		'active_callback'	=> 'elsie_hero_post_grid_active_callback'
	)
) );

$wp_customize->add_setting(
	'hero_show_cats',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'hero_show_cats',
		array(
			'label'         	=> esc_html__( 'Show categories', 'elsie' ),
			'section'       	=> 'elsie_header_hero',
			'active_callback'	=> 'elsie_hero_post_grid_active_callback'
		)
	)
);

$wp_customize->add_setting(
	'hero_show_author',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'hero_show_author',
		array(
			'label'         	=> esc_html__( 'Show author', 'elsie' ),
			'section'       	=> 'elsie_header_hero',
			'active_callback'	=> 'elsie_hero_post_grid_active_callback'
		)
	)
);

$wp_customize->add_setting(
	'hero_show_date',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'hero_show_date',
		array(
			'label'         	=> esc_html__( 'Show date', 'elsie' ),
			'section'       	=> 'elsie_header_hero',
			'active_callback'	=> 'elsie_hero_post_grid_active_callback'
		)
	)
);


/**
 * Static image content
 */
$wp_customize->add_setting(
	'hero_static_image_content_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'hero_static_image_content_title',
	array(
		'label'    			=> esc_html__( 'Content', 'elsie' ),
		'section'  			=> 'elsie_header_hero',
		'active_callback'	=> 'elsie_hero_header_image_active_callback'
	)
) );


$wp_customize->add_setting(
	'hero_before_title',
	array(
		'sanitize_callback' => 'elsie_sanitize_text',
		'default'           => esc_html__( 'Hello, I\'m Elsie', 'elsie'),
		'transport'         => 'postMessage'
	)       
);
$wp_customize->add_control( 'hero_before_title', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_header_hero',
	'label'       		=> esc_html__( 'Before title', 'elsie' ),
	'active_callback'   => 'elsie_hero_header_image_active_callback',
) );

$wp_customize->add_setting(
	'hero_title',
	array(
		'sanitize_callback' => 'elsie_sanitize_text',
		'default'           => esc_html__( 'Welcome to my website', 'elsie'),
		'transport'         => 'postMessage'
	)       
);
$wp_customize->add_control( 'hero_title', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_header_hero',
	'label'       		=> esc_html__( 'Title', 'elsie' ),
	'active_callback'   => 'elsie_hero_header_image_active_callback'
) );

$wp_customize->add_setting(
	'hero_button_url',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'hero_button_url', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_header_hero',
	'label'       		=> esc_html__( 'Button link', 'elsie' ),
	'active_callback'   => 'elsie_hero_header_image_active_callback'
) );

$wp_customize->add_setting(
	'hero_button_text',
	array(
		'sanitize_callback' => 'elsie_sanitize_text',
		'default'           => esc_html__( 'Learn more', 'elsie' ),
	)       
);
$wp_customize->add_control( 'hero_button_text', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_header_hero',
	'label'       		=> esc_html__( 'Button text', 'elsie' ),
	'active_callback'   => 'elsie_hero_header_image_active_callback'
) );

$wp_customize->add_setting(
	'hero_button_newtab',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'hero_button_newtab',
		array(
			'label'         	=> esc_html__( 'Open the button link in a new tab', 'elsie' ),
			'section'       	=> 'elsie_header_hero',
			'active_callback'   => 'elsie_hero_header_image_active_callback'
		)
	)
);

//Partials
$wp_customize->selective_refresh->add_partial( 'hero_before_title', array(
	'selector'          => '.hero-before-title',
	'render_callback'   => 'elsie_partial_hero_before_title',
) );  
$wp_customize->selective_refresh->add_partial( 'hero_title', array(
	'selector'          => '.hero-title',
	'render_callback'   => 'elsie_partial_hero_title',
) );  