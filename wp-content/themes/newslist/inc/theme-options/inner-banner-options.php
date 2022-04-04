<?php

/**
 * Inner banner options in customizer
 *
 * @return void
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */

function newslist_inner_banner_options()
{
	Newslist_Customizer::set(array(
		# Theme Option > color options
		'section' => array(
			'id'       => 'header_image',
			'priority' => 27,
			'prefix' => false,
		),
		'fields'  => array(
			array(
				'id'      	  => 'ib-blog-title',
				'label'   	  => esc_html__( 'Title', 'newslist' ),
				'description' => esc_html__( 'It is displayed when home page is latest posts.', 'newslist' ),
				'default' 	  => esc_html__( 'Latest Blog', 'newslist'),
				'type'	  	  => 'text',
				'priority'    => 10,
			),
			array(
				'id'	  	  => 'ib-title-size',
				'label'   	  => esc_html__( 'Font Size', 'newslist' ),
				'description' => esc_html__( 'The value is in px. Defaults to 40px.', 'newslist' ),
				'default' => array(
					'desktop' => 40,
					'tablet'  => 32,
					'mobile'  => 32,
				),
				'input_attrs' =>  array(
					'min'   => 1,
					'max'   => 60,
					'step'  => 1,
				),
				'type' => 'slider',
				'priority' => 20
			),
			array(
				'id'      => 'ib-title-color',
				'label'   => esc_html__( 'Text Color', 'newslist' ),
				'type'    => 'color-picker',
				'default' => '#ffffff',
				'priority' => 30
			),
			array(
				'id' 	   => 'ib-background-color',
				'label'    => esc_html__( 'Overlay Color', 'newslist' ),
				'default'  => 'rgba(0, 0, 0, 0.49)',
				'type' 	   => 'color-picker',
				'priority' => 40,
			),
			array(
				'id'      => 'ib-text-align',
				'label'   => esc_html__( 'Alignment', 'newslist' ),
				'type'    => 'buttonset',
				'default' => 'banner-content-center',
				'choices' => array(
					'banner-content-left'   => esc_html__( 'Left', 'newslist' ),
					'banner-content-center' => esc_html__( 'Center', 'newslist' ),
					'banner-content-right'  => esc_html__( 'Right', 'newslist' ),
				),
				'priority' => 50
			),
			array(
				'id'      => 'ib-image-attachment',
				'label'   => esc_html__( 'Image Attachment', 'newslist' ),
				'type'    => 'buttonset',
				'default' => 'banner-background-scroll',
				'choices' => array(
					'banner-background-scroll'           => esc_html__( 'Scroll', 'newslist' ),
					'banner-background-attachment-fixed' => esc_html__( 'Fixed', 'newslist' ),
				),
				'priority' => 60
			),
			array(
				'id'      	=> 'ib-height',
				'label'   	=> esc_html__( 'Height (px)', 'newslist' ),
				'type'    	=> 'slider',
				'description' => esc_html__( 'The value is in px. Defaults to 420px.', 'newslist' ),
				'default' => array(
					'desktop' => 300,
					'tablet'  => 300,
					'mobile'  => 300,
				),
				'input_attrs' =>  array(
					'min'   => 1,
					'max'   => 1000,
					'step'  => 1,
				),
			),
			'priority' => 70
		),
	));
}
add_action( 'init', 'newslist_inner_banner_options' );
