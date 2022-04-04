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
	'elsie_featured_boxes',
	array(
		'title'         => esc_html__( 'Featured boxes', 'elsie' ),
		'priority'      => 12,
		'panel'			=> 'elsie_header_panel'
	)
);

$wp_customize->add_setting(
	'featured_boxes_tabs',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Tabs( $wp_customize, 'featured_boxes_tabs',
	array(
		'linked'			=> 'featured_boxes_tabs',
		'label'    		=> esc_html__( 'Settings', 'elsie' ),
		'label2'    	=> esc_html__( 'Styling', 'elsie' ),
		'connected'		=> 'elsie_featured_boxes',
		'connected2'	=> 'elsie_featured_boxes_styling',
		'section'  		=> 'elsie_featured_boxes',
	)
) );

$wp_customize->add_setting(
	'featured_boxes_front_page',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'featured_boxes_front_page',
		array(
			'label'         	=> esc_html__( 'Display the featured boxes on your homepage', 'elsie' ),
			'section'       	=> 'elsie_featured_boxes',
		)
	)
);

$wp_customize->add_setting(
	'featured_boxes_blog_page',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'featured_boxes_blog_page',
		array(
			'label'         	=> esc_html__( 'Display the featured boxes on your blog', 'elsie' ),
			'section'       	=> 'elsie_featured_boxes',
		)
	)
);



$wp_customize->add_setting(
	'featured_box1_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'featured_box1_title',
	array(
		'label'    => esc_html__( 'Box 1', 'elsie' ),
		'section'  => 'elsie_featured_boxes',
		'active_callback'   => 'elsie_featured_boxes_callback'
	)
) );

$wp_customize->add_setting(
	'featured_box_img1',
	array(
		'default' => get_stylesheet_directory_uri() . '/assets/img/box1.jpg',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'featured_box_img1',
		array(
		   'label'          => esc_html__( 'Image', 'elsie' ),
		   'type'           => 'image',
		   'section'        => 'elsie_featured_boxes',
		   'active_callback' 	=> 'elsie_featured_boxes_callback'
		)
	)
);

$wp_customize->add_setting(
	'featured_box_title1',
	array(
		'sanitize_callback' => 'elsie_sanitize_text',
		'default'           => esc_html__( 'Travel', 'elsie' ),
		'transport'			=> 'postMessage'
	)       
);
$wp_customize->add_control( 'featured_box_title1', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_featured_boxes',
	'label'       		=> esc_html__( 'Title', 'elsie' ),
	'active_callback'   => 'elsie_featured_boxes_callback'
) );


$wp_customize->add_setting(
	'featured_box_link1',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'featured_box_link1', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_featured_boxes',
	'label'       		=> esc_html__( 'Link', 'elsie' ),
	'active_callback'   => 'elsie_featured_boxes_callback'
) );

$wp_customize->add_setting(
	'featured_box2_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'featured_box2_title',
	array(
		'label'    => esc_html__( 'Box 2', 'elsie' ),
		'section'  => 'elsie_featured_boxes',
		'active_callback'   => 'elsie_featured_boxes_callback'
	)
) );

$wp_customize->add_setting(
	'featured_box_img2',
	array(
		'default' => get_stylesheet_directory_uri() . '/assets/img/box2.jpg',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'featured_box_img2',
		array(
		   'label'          => esc_html__( 'Image', 'elsie' ),
		   'type'           => 'image',
		   'section'        => 'elsie_featured_boxes',
		   'active_callback' 	=> 'elsie_featured_boxes_callback'
		)
	)
);

$wp_customize->add_setting(
	'featured_box_title2',
	array(
		'sanitize_callback' => 'elsie_sanitize_text',
		'default'           => esc_html__( 'Fashion', 'elsie' ),
		'transport'			=> 'postMessage'
	)       
);
$wp_customize->add_control( 'featured_box_title2', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_featured_boxes',
	'label'       		=> esc_html__( 'Title', 'elsie' ),
	'active_callback'   => 'elsie_featured_boxes_callback'
) );


$wp_customize->add_setting(
	'featured_box_link2',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'featured_box_link2', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_featured_boxes',
	'label'       		=> esc_html__( 'Link', 'elsie' ),
	'active_callback'   => 'elsie_featured_boxes_callback'
) );

$wp_customize->add_setting(
	'featured_box3_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'featured_box3_title',
	array(
		'label'    => esc_html__( 'Box 3', 'elsie' ),
		'section'  => 'elsie_featured_boxes',
		'active_callback'   => 'elsie_featured_boxes_callback'
	)
) );

$wp_customize->add_setting(
	'featured_box_img3',
	array(
		'default' => get_stylesheet_directory_uri() . '/assets/img/box3.jpg',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'featured_box_img3',
		array(
		   'label'          => esc_html__( 'Image', 'elsie' ),
		   'type'           => 'image',
		   'section'        => 'elsie_featured_boxes',
		   'active_callback' 	=> 'elsie_featured_boxes_callback'
		)
	)
);

$wp_customize->add_setting(
	'featured_box_title3',
	array(
		'sanitize_callback' => 'elsie_sanitize_text',
		'default'           => esc_html__( 'Contact', 'elsie' ),
		'transport'			=> 'postMessage'
	)       
);
$wp_customize->add_control( 'featured_box_title3', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_featured_boxes',
	'label'       		=> esc_html__( 'Title', 'elsie' ),
	'active_callback'   => 'elsie_featured_boxes_callback'
) );


$wp_customize->add_setting(
	'featured_box_link3',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'featured_box_link3', array(
	'type'        		=> 'text',
	'section'     		=> 'elsie_featured_boxes',
	'label'       		=> esc_html__( 'Link', 'elsie' ),
	'active_callback'   => 'elsie_featured_boxes_callback'
) );

//Partials
$wp_customize->selective_refresh->add_partial( 'featured_box_title1', array(
	'selector'          => '.box-title-text1',
	'render_callback'   => 'elsie_partial_featured_box_title1',
) );  
$wp_customize->selective_refresh->add_partial( 'featured_box_title2', array(
	'selector'          => '.box-title-text2',
	'render_callback'   => 'elsie_partial_featured_box_title2',
) );  
$wp_customize->selective_refresh->add_partial( 'featured_box_title3', array(
	'selector'          => '.box-title-text3',
	'render_callback'   => 'elsie_partial_featured_box_title3',
) );  


/**
 * Styling
 */
$wp_customize->add_section(
	'elsie_featured_boxes_styling',
	array(
		'title'         => esc_html__( 'Styling', 'elsie' ),
		'priority'      => 11,
		'panel'			=> 'elsie_header_panel'
	)
);
$wp_customize->add_setting(
	'featured_boxes_tabs_styling',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Tabs( $wp_customize, 'featured_boxes_tabs_styling',
	array(
		'linked'		=> 'featured_boxes_tabs',
		'label'    		=> esc_html__( 'Settings', 'elsie' ),
		'label2'    	=> esc_html__( 'Styling', 'elsie' ),
		'connected'		=> 'elsie_featured_boxes',
		'connected2'	=> 'elsie_featured_boxes_styling',
		'section'  		=> 'elsie_featured_boxes_styling',
		'priority'      => 10,
	)
) );
$wp_customize->add_setting(
	'featured_button_background',
	array(
		'default'           => '#f4f2f1',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'featured_button_background',
		array(
			'label'         	=> esc_html__( 'Box label background color', 'elsie' ),
			'section'       	=> 'elsie_featured_boxes_styling',
			'settings'      	=> 'featured_button_background',
		)
	)
);

$wp_customize->add_setting(
	'featured_button_color',
	array(
		'default'           => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'featured_button_color',
		array(
			'label'         	=> esc_html__( 'Box label color', 'elsie' ),
			'section'       	=> 'elsie_featured_boxes_styling',
			'settings'      	=> 'featured_button_color',
		)
	)
);

$wp_customize->add_setting(
	'featured_button_background_hover',
	array(
		'default'           => '#950b0b',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'featured_button_background_hover',
		array(
			'label'         	=> esc_html__( 'Box label background color (hover)', 'elsie' ),
			'section'       	=> 'elsie_featured_boxes_styling',
			'settings'      	=> 'featured_button_background_hover',
		)
	)
);

$wp_customize->add_setting(
	'featured_button_color_hover',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'featured_button_color_hover',
		array(
			'label'         	=> esc_html__( 'Box label color (hover)', 'elsie' ),
			'section'       	=> 'elsie_featured_boxes_styling',
			'settings'      	=> 'featured_button_color_hover',
		)
	)
);