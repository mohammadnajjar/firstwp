<?php
/**
 * Register font size and choice to display logo or title.
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 */

/**
* Register Site Identity Options
*
* @return void
* @since 1.0.0
*
* @package Newslist WordPress theme
*/
function newslist_site_identity(){
	Newslist_Customizer::set(array(
		# Site Identity > title size || title or logo
		'section' => array(
			'id' => 'title_tagline',
			'prefix' => false,
		),
		'fields'  => array(
			array(
				'id'	  	  => 'title-size',
				'label'   	  => esc_html__( 'Title Size', 'newslist' ),
				'description' => esc_html__( 'The value is in px.' , 'newslist' ),
				'default' => array(
					'desktop' => 22,
					'tablet'  => 22,
					'mobile'  => 22,
				),
				'input_attrs' =>  array(
					'min'   => 1,
					'max'   => 60,
					'step'  => 1,
				),
				'type'    => 'slider',
			),
			array(
				'id'	  	  => 'tagline-size',
				'label'   	  => esc_html__( 'Tagline Size', 'newslist' ),
				'description' => esc_html__( 'The value is in px.' , 'newslist' ),
				'default' => array(
					'desktop' => 14,
					'tablet'  => 14,
					'mobile'  => 14,
				),
				'input_attrs' =>  array(
					'min'   => 1, 
					'max'   => 35,
					'step'  => 1,
				),
				'type'    => 'slider',
			),
			array(
				'id'	  	  => 'logo-size',
				'label'   	  => esc_html__( 'Logo Size', 'newslist' ),
				'description' => esc_html__( 'The value is in px.' , 'newslist' ),
				'default' => array(
					'desktop' => 200,
					'tablet'  => 200,
					'mobile'  => 200,
				),
				'input_attrs' =>  array(
					'min'   => 1,
					'max'   => 500,
					'step'  => 1,
				),
				'type'    => 'slider',
			)
		)	
	));
}
add_action( 'init', 'newslist_site_identity' );