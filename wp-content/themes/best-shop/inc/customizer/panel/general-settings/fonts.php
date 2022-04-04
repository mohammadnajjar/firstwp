<?php

/**
 * Google Fonts Option.
 * @package Best_Shop
 */
    
function best_shop_customize_register_font( $wp_customize ) {
    
    
    /** contact Page Settings */
    $wp_customize->add_section( 
        'google_font_settings',
         array(
            'priority'    => 47,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Fonts', 'best-shop' ),
            'description' => __( 'Customize contact section details. Header fonts selection is available in Pro version.', 'best-shop' ),
            'panel'    => 'theme_options',
        ) 
    );
    
    
	$wp_customize->add_setting(
		'heading_font',
		array(
			'default'           => best_shop_default_settings('heading_font'),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'heading_font',
		array(
			'section'           => 'google_font_settings',
			'label'             => __( 'Heading Font Family:', 'best-shop' ),
			'type'              => 'text',
            'active_callback'   => 'best_shop_pro',
		)
	);

    //2
	$wp_customize->add_setting(
		'body_font',
		array(
			'default'           => best_shop_default_settings('body_font'),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'body_font',
		array(
			'section'           => 'google_font_settings',
			'label'             => __( 'Body Font Family:', 'best-shop' ),
			'type'              => 'text',
		)
	);



}

add_action( 'customize_register', 'best_shop_customize_register_font' );


