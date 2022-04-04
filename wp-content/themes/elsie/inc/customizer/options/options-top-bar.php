<?php
/**
 * Top bar Customizer options
 *
 * @package Elsie
 */

/**
 * Top
 */
$wp_customize->add_section(
	'elsie_header_top_bar',
	array(
		'title'         => esc_html__( 'Top bar', 'elsie' ),
		'priority'      => 11,
		'panel'			=> 'elsie_header_panel'
	)
);

$wp_customize->add_setting(
	'top_bar_tabs',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Tabs( $wp_customize, 'top_bar_tabs',
	array(
		'linked'		=> 'top_bar_tabs',
		'label'    		=> esc_html__( 'Settings', 'elsie' ),
		'label2'    	=> esc_html__( 'Styling', 'elsie' ),
		'connected'		=> 'elsie_header_top_bar',
		'connected2'	=> 'elsie_header_top_bar_styling',
		'section'  		=> 'elsie_header_top_bar',
	)
) );


$wp_customize->add_setting(
	'enable_top_bar',
	array(
		'default'           => 0,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'enable_top_bar',
		array(
			'label'         	=> esc_html__( 'Enable top bar', 'elsie' ),
			'section'       	=> 'elsie_header_top_bar',
			'settings'      	=> 'enable_top_bar',
		)
	)
);

$wp_customize->add_setting( 'topbar_width',
	array(
		'default' 			=> 'container',
		'sanitize_callback' => 'elsie_sanitize_text'
	)
);
$wp_customize->add_control( new Elsie_Radio_Buttons( $wp_customize, 'topbar_width',
	array(
		'label'   => esc_html__( 'Section width', 'elsie' ),
		'section' => 'elsie_header_top_bar',
		'columns' => 2,
		'choices' => array(
			'container' 		=> esc_html__( 'Contain', 'elsie' ),
			'container-fluid' 	=> esc_html__( 'Full', 'elsie' ),
		),
		'active_callback' 	=> 'elsie_top_bar_active_callback',
	)
) );

$elsie_tb_elements = array(
	'none' 			=> esc_html__( 'None', 'elsie' ),
	'social' 		=> esc_html__( 'Social profile', 'elsie' ),
	'navigation' 	=> esc_html__( 'Secondary menu', 'elsie' ),
	'text' 			=> esc_html__( 'Text / HTML', 'elsie' ),
	'contact' 		=> esc_html__( 'Contact', 'elsie' ),
);

/**
 * Left
 */
$wp_customize->add_setting(
	'top_bar_left_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'top_bar_left_title',
	array(
		'label'    			=> esc_html__( 'Left side', 'elsie' ),
		'section'  			=> 'elsie_header_top_bar',
		'active_callback' 	=> 'elsie_top_bar_active_callback',
		'priority'      	=> 20
	)
) );

$wp_customize->add_setting(
	'top_bar_left',
	array(
		'default'           => 'contact',
		'sanitize_callback' => 'elsie_sanitize_select',
	)
);
$wp_customize->add_control(
	'top_bar_left',
	array(
		'type'      		=> 'select',
		'label'     		=> esc_html__( 'Select element', 'elsie' ),
		'section'   		=> 'elsie_header_top_bar',
		'choices'   		=> $elsie_tb_elements,
		'active_callback' 	=> 'elsie_top_bar_active_callback',
		'priority'      	=> 20
	)
);

$wp_customize->add_setting(
	'top_bar_right_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'top_bar_right_title',
	array(
		'label'    			=> esc_html__( 'Right side', 'elsie' ),
		'section'  			=> 'elsie_header_top_bar',
		'active_callback' 	=> 'elsie_top_bar_active_callback',
		'priority'      	=> 30
	)
) );

$wp_customize->add_setting(
	'top_bar_right',
	array(
		'default'           => 'text',
		'sanitize_callback' => 'elsie_sanitize_select',
	)
);
$wp_customize->add_control(
	'top_bar_right',
	array(
		'type'      		=> 'select',
		'label'     		=> esc_html__( 'Select element', 'elsie' ),
		'section'   		=> 'elsie_header_top_bar',
		'choices'   		=> $elsie_tb_elements,
		'active_callback' 	=> 'elsie_top_bar_active_callback',
		'priority'      	=> 30
	)
);

/**
 * Elements
 */
//Header social
$wp_customize->add_setting( 'top_bar_social',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'elsie_sanitize_urls'
	)
);
$wp_customize->add_control( new Elsie_Repeater_Control( $wp_customize, 'top_bar_social',
	array(
		'label' 		=> esc_html__( 'Social profile', 'elsie' ),
		'description' 	=> esc_html__( 'Add links to your social profiles here', 'elsie' ),
		'section' 		=> 'elsie_header_top_bar',
		'button_labels' => array(
			'add' => esc_html__( 'Add new link', 'elsie' ),
		),
		'active_callback' 	=> 'elsie_social_top_bar_callback'
	)
) );


//Header custom text
$wp_customize->add_setting(
	'top_bar_text',
	array(
		'default'           => esc_html__( 'Your custom text', 'elsie' ),
		'sanitize_callback' => 'elsie_sanitize_text',
	)
);
$wp_customize->add_control(
	'top_bar_text',
	array(
		'label' 			=> esc_html__( 'Custom text', 'elsie' ),
		'section' 			=> 'elsie_header_top_bar',
		'type' 				=> 'text',
		'active_callback' 	=> 'elsie_text_top_bar_callback'
	)
);

//Header contact
$wp_customize->add_setting(
	'top_bar_contact_phone',
	array(
		'default'           => esc_html__( '+999.999.999', 'elsie' ),
		'sanitize_callback' => 'elsie_sanitize_text',
	)
);
$wp_customize->add_control(
	'top_bar_contact_phone',
	array(
		'label' 			=> esc_html__( 'Phone number', 'elsie' ),
		'section' 			=> 'elsie_header_top_bar',
		'type' 				=> 'text',
		'active_callback' 	=> 'elsie_contact_top_bar_callback'
	)
);

$wp_customize->add_setting(
	'top_bar_contact_email',
	array(
		'default'           => esc_html__( 'office@example.org', 'elsie' ),
		'sanitize_callback' => 'elsie_sanitize_text',
	)
);
$wp_customize->add_control(
	'top_bar_contact_email',
	array(
		'label' 			=> esc_html__( 'Email address', 'elsie' ),
		'section' 			=> 'elsie_header_top_bar',
		'type' 				=> 'text',
		'active_callback' 	=> 'elsie_contact_top_bar_callback'
	)
);

$wp_customize->add_setting( 'top_bar_navigation',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Elsie_Info( $wp_customize, 'top_bar_navigation',
		array(
			'label' 			=> '<a href="javascript:wp.customize.panel( \'nav_menus\' ).focus();">' . esc_html__( 'Click here to configure your menu', 'elsie' ),
			'section' 			=> 'elsie_header_top_bar',
			'attr'				=> 1,
			'active_callback' 	=> 'elsie_nav_top_bar_callback'
		)
	)
);


/**
 * Styling
 */
$wp_customize->add_section(
	'elsie_header_top_bar_styling',
	array(
		'title'         => esc_html__( 'Top bar styling', 'elsie' ),
		'priority'      => 11,
		'panel'			=> 'elsie_header_panel'
	)
);

$wp_customize->add_setting(
	'top_bar_tabs_styling',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Tabs( $wp_customize, 'top_bar_tabs_styling',
	array(
		'linked'			=> 'top_bar_tabs',
		'label'    		=> esc_html__( 'Settings', 'elsie' ),
		'label2'    	=> esc_html__( 'Styling', 'elsie' ),
		'connected'		=> 'elsie_header_top_bar',
		'connected2'	=> 'elsie_header_top_bar_styling',
		'section'  		=> 'elsie_header_top_bar_styling',
	)
) );

$wp_customize->add_setting(
	'top_bar_background_color',
	array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'top_bar_background_color',
		array(
			'label'    => esc_html__( 'Background color', 'elsie' ),
			'section'  => 'elsie_header_top_bar_styling',
		)
	)
);

$wp_customize->add_setting(
	'top_bar_color',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'top_bar_color',
		array(
			'label'    => esc_html__( 'Color', 'elsie' ),
			'section'  => 'elsie_header_top_bar_styling',
		)
	)
);

$wp_customize->add_setting( 'topbar_padding_desktop', array(
	'default'   => 8,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'topbar_padding_tablet', array(
	'default'	=> 8,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'topbar_padding_mobile', array(
	'default'	=> 8,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Elsie_Responsive_Number( $wp_customize, 'topbar_padding',
	array(
		'label' => esc_html__( 'Vertical spacing', 'elsie' ),
		'section' => 'elsie_header_top_bar_styling',
		'settings'   => array (
			'topbar_padding_desktop',
			'topbar_padding_tablet',
			'topbar_padding_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
			'unit'	=> 'px'
		),		
	)
) );