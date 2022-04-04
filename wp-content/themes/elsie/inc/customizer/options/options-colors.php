<?php
/**
 * Colors Customizer options
 *
 * @package Elsie
 */

$elsie_colors = elsie_theme_colors();

$wp_customize->add_setting(
	'colors_general_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'colors_general_title',
	array(
		'label'    			=> esc_html__( 'General', 'elsie' ),
		'section'       	=> 'colors',
		'priority' => 0
		)
) ); 

$wp_customize->add_setting(
	'accent_color',
	array(
		'default'           => $elsie_colors['color-accent'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'accent_color',
		array(
			'label'         	=> esc_html__( 'Accent color', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);

$wp_customize->add_setting(
	'accent_color_dark',
	array(
		'default'           => $elsie_colors['color-accent-dark'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'accent_color_dark',
		array(
			'label'         	=> esc_html__( 'Dark Accent color', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);

$wp_customize->add_setting(
	'body_color',
	array(
		'default'           => $elsie_colors['color-text'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'body_color',
		array(
			'label'         	=> esc_html__( 'Body text color', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'content_link_color',
	array(
		'default'           => $elsie_colors['color-accent'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'content_link_color',
		array(
			'label'         	=> esc_html__( 'Content link color', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'content_link_color_hover',
	array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'content_link_color_hover',
		array(
			'label'         	=> esc_html__( 'Content link color (hover)', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);

$wp_customize->add_setting(
	'colors_general_headings',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'colors_general_headings',
	array(
		'label'    			=> esc_html__( 'Headings', 'elsie' ),
		'section'       	=> 'colors',
		)
) );

$wp_customize->add_setting(
	'color_heading1',
	array(
		'default'           => $elsie_colors['color-headings'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'color_heading1',
		array(
			'label'         	=> esc_html__( 'Heading 1', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_heading2',
	array(
		'default'           => $elsie_colors['color-headings'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'color_heading2',
		array(
			'label'         	=> esc_html__( 'Heading 2', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading3',
	array(
		'default'           => $elsie_colors['color-headings'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'color_heading3',
		array(
			'label'         	=> esc_html__( 'Heading 3', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading4',
	array(
		'default'           => $elsie_colors['color-headings'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'color_heading4',
		array(
			'label'         	=> esc_html__( 'Heading 4', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading5',
	array(
		'default'           => $elsie_colors['color-headings'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'color_heading5',
		array(
			'label'         	=> esc_html__( 'Heading 5', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading6',
	array(
		'default'           => $elsie_colors['color-headings'],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'color_heading6',
		array(
			'label'         	=> esc_html__( 'Heading 6', 'elsie' ),
			'section'       	=> 'colors',
		)
	)
);