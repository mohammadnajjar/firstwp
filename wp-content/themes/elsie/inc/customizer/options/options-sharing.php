<?php
/**
 * Blog Customizer options
 *
 * @package Elsie
 */


/**
 * Social
 */
$wp_customize->add_section(
	'elsie_section_single_sharing',
	array(
		'title'         => esc_html__( 'Sharing', 'elsie'),
		'panel'         => 'elsie_panel_blog',
	)
);
$wp_customize->add_setting(
	'enable_share_facebook',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_facebook',
		array(
			'label'         	=> esc_html__( 'Enable Facebook', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_twitter',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_twitter',
		array(
			'label'         	=> esc_html__( 'Enable Twitter', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_linkedin',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_linkedin',
		array(
			'label'         	=> esc_html__( 'Enable Linkedin', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_reddit',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_reddit',
		array(
			'label'         	=> esc_html__( 'Enable Reddit', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_whatsapp',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_whatsapp',
		array(
			'label'         	=> esc_html__( 'Enable Whatsapp', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_pinterest',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_pinterest',
		array(
			'label'         	=> esc_html__( 'Enable Pinterest', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_pinterest',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_pinterest',
		array(
			'label'         	=> esc_html__( 'Enable Pinterest', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_telegram',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_telegram',
		array(
			'label'         	=> esc_html__( 'Enable Telegram', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_weibo',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_weibo',
		array(
			'label'         	=> esc_html__( 'Enable Weibo', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_vk',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_vk',
		array(
			'label'         	=> esc_html__( 'Enable VK', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_ok',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_ok',
		array(
			'label'         	=> esc_html__( 'Enable OK', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_xing',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_xing',
		array(
			'label'         	=> esc_html__( 'Enable Xing', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);
$wp_customize->add_setting(
	'enable_share_mail',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_share_mail',
		array(
			'label'         	=> esc_html__( 'Enable Mail', 'elsie' ),
			'section'       	=> 'elsie_section_single_sharing',
		)
	)
);