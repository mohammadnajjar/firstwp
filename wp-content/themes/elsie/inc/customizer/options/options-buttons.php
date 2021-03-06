<?php
/**
 * Buttons Customizer options
 *
 * @package Elsie
 */
/**
 * Buttons
 */
$wp_customize->add_section(
	'elsie_buttons',
	array(
		'title'         => esc_html__( 'Buttons', 'elsie' ),
		'panel'			=> 'elsie_general_panel'
	)
);

$wp_customize->add_setting(
	'global_button_background',
	array(
		'default'           => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'global_button_background',
		array(
			'label'         	=> esc_html__( 'Button background color', 'elsie' ),
			'section'       	=> 'elsie_buttons',
			'settings'      	=> 'global_button_background',
		)
	)
);

$wp_customize->add_setting(
	'global_button_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'global_button_color',
		array(
			'label'         	=> esc_html__( 'Button color', 'elsie' ),
			'section'       	=> 'elsie_buttons',
			'settings'      	=> 'global_button_color',
		)
	)
);

$wp_customize->add_setting(
	'global_button_background_hover',
	array(
		'default'           => '#950b0b',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'global_button_background_hover',
		array(
			'label'         	=> esc_html__( 'Button background color (hover)', 'elsie' ),
			'section'       	=> 'elsie_buttons',
			'settings'      	=> 'global_button_background_hover',
		)
	)
);

$wp_customize->add_setting(
	'global_button_color_hover',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'global_button_color_hover',
		array(
			'label'         	=> esc_html__( 'Button color (hover)', 'elsie' ),
			'section'       	=> 'elsie_buttons',
			'settings'      	=> 'global_button_color_hover',
		)
	)
);

$wp_customize->add_setting( 'global_button_padding_tb_desktop', array(
	'default'   		=> 15,
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'global_button_padding_tb_tablet', array(
	'default'			=> 15,
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'global_button_padding_tb_mobile', array(
	'default'			=> 15,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Elsie_Responsive_Number( $wp_customize, 'global_button_padding_tb',
	array(
		'label' => esc_html__( 'Vertical padding', 'elsie' ),
		'section' => 'elsie_buttons',
		'settings'   => array (
			'global_button_padding_tb_desktop',
			'global_button_padding_tb_tablet',
			'global_button_padding_tb_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 50,
			'step'  => 1,
			'unit'	=> 'px'
		),		
	)
) );

$wp_customize->add_setting( 'global_button_padding_lr_desktop', array(
	'default'   		=> 36,
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'global_button_padding_lr_tablet', array(
	'default'			=> 36,
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'global_button_padding_lr_mobile', array(
	'default'			=> 36,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Elsie_Responsive_Number( $wp_customize, 'global_button_padding_lr',
	array(
		'label' => esc_html__( 'Horizontal padding', 'elsie' ),
		'section' => 'elsie_buttons',
		'settings'   => array (
			'global_button_padding_lr_desktop',
			'global_button_padding_lr_tablet',
			'global_button_padding_lr_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 50,
			'step'  => 1,
			'unit'	=> 'px'
		),		
	)
) );

$wp_customize->add_setting( 'global_button_border_radius',
	array(
		'default' 			=> 0,
		'sanitize_callback' => 'elsie_sanitize_range'
	)
);
$wp_customize->add_control( new Elsie_Slider_Control( $wp_customize, 'global_button_border_radius',
	array(
		'label' => esc_html__( 'Border radius', 'elsie' ),
		'section' 			=> 'elsie_buttons',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
			'unit' => 'px'
		),
	)
) );

$wp_customize->add_setting( 'global_button_font_size_desktop', array(
	'default'   		=> 13,
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'global_button_font_size_tablet', array(
	'default'			=> 13,
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'global_button_font_size_mobile', array(
	'default'			=> 13,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Elsie_Responsive_Number( $wp_customize, 'global_button_font_size',
	array(
		'label' => esc_html__( 'Font size', 'elsie' ),
		'section' => 'elsie_buttons',
		'settings'   => array (
			'global_button_font_size_desktop',
			'global_button_font_size_tablet',
			'global_button_font_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 50,
			'step'  => 1,
			'unit'	=> 'px'
		),		
	)
) );

$wp_customize->add_setting( 'global_button_transform',
	array(
		'default' 			=> 'uppercase',
		'sanitize_callback' => 'elsie_sanitize_text',
	)
);
$wp_customize->add_control( new Elsie_Radio_Buttons( $wp_customize, 'global_button_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'elsie' ),
		'section' => 'elsie_buttons',
		'columns' => 4,
		'choices' => array(
			'none' 			=> esc_html__( '-', 'elsie' ),
			'lowercase' 	=> esc_html__( 'aa', 'elsie' ),
			'capitalize' 	=> esc_html__( 'Aa', 'elsie' ),
			'uppercase' 	=> esc_html__( 'AA', 'elsie' ),
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'global_button_letter_spacing',
	array(
		'default' 			=> 1,
		'sanitize_callback' => 'elsie_sanitize_range'
	)
);
$wp_customize->add_control( new Elsie_Slider_Control( $wp_customize, 'global_button_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing', 'elsie' ),
		'section' => 'elsie_buttons',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
			'unit' => 'px'
		),
	)
) );