<?php

/**
 * Breadcrumb options in customizer 
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */

if (!function_exists('newslist_acb_breadcrumb')) :
	/**
	 * Active callback function for breadcrumb action.
	 *
	 * @return boolen
	 * @since 1.0.0
	 *
	 * @package Newslist WordPress theme
	 */
	function newslist_acb_breadcrumb( $control )
	{
		$value = $control->manager->get_setting( Newslist_Helper::with_prefix( 'show-breadcrumb' ) )->value();
		return $value == 1 ? true : false;
	}
endif;

/**
 * Register breadcrumb Options
 *
 * @return void
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 */
function newslist_breadcrumb_options()
{
	Newslist_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > color options
		'section' => array(
			'id'       => 'breadcrumb-section',
			'title'    => esc_html__( 'Breadcrumb Options', 'newslist' ),
			'priority' => 25
		),
		'fields'  => array(
			array(
				'id'	  => 'show-breadcrumb',
				'label'   => esc_html__( 'Show Breadcrumb', 'newslist' ),
				'default' => true,
				'type'    => 'toggle',
			),
			#bc - breadcrumb
			array(
				'id'      		  => 'bc-separator',
				'label'   		  => esc_html__( 'Separator', 'newslist' ),
				'type'    		  => 'icon',
				'active_callback' => 'acb_breadcrumb',
				'default' 		  => 'f105',
				'choices' 	=> array(
					'f105' => 'fa fa-angle-right',
					'002f' => 'fa-slash',
					'f061' => 'fa fa-arrow-right',
					'f178' => 'fa fa-long-arrow-right',
					'f101' => 'fa fa-angle-double-right',
				)
			),
			array(
				'id'	  	  => 'bc-size',
				'label'   	  => esc_html__( 'Font Size', 'newslist' ),
				'description' => esc_html__( 'The value is in px.  Defaults to 16px.', 'newslist' ),
				'default' => array(
					'desktop' => 16,
					'tablet'  => 16,
					'mobile'  => 16,
				),
				'input_attrs' =>  array(
					'min'   => 1,
					'max'   => 60,
					'step'  => 1,
				),
				'type' => 'slider'
			),
		),
	));
}
add_action( 'init', 'newslist_breadcrumb_options' );
