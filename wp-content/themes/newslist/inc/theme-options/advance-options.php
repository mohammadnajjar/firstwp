<?php
if ( !function_exists( 'newslist_acb_custom_header_one' ) ) :
	/**
	 * Active callback function of header top bar
	 *
	 * @static
	 * @access public
	 * @return boolen
	 * @since 1.0.0
	 *
	 * @package Newslist WordPress theme
	 */
	function newslist_acb_custom_header_one( $control )	{
		$value = $control->manager->get_setting( Newslist_Helper::with_prefix( 'container-width' ) )->value();
		return 'default' == $value;
	}
endif;

/**
 * Register Advanced Options
 *
 * @return void
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 */
function newslist_advanced_options() {
	Newslist_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Header
		'section' => array(
			'id'    => 'advance-options',
			'title' => esc_html__( 'Advanced Options', 'newslist' ),
		),
		# Theme Option > Header > settings
		'fields' => array(
			array(
				'id'	=> 'pre-loader',
				'label' => esc_html__( 'Show Preloader', 'newslist' ),
				'default' => false,
				'type'  => 'toggle',
			),
			array(
				'id'      =>  'container-width',
				'label'   => esc_html__( 'Site Layout', 'newslist' ),
				'type'    => 'buttonset',
				'default' => 'default',
				'choices' => array(
					'default' => esc_html__( 'Default', 'newslist' ),
					'box'	  => esc_html__( 'Boxed', 'newslist' ),
				)
			),
			array(
				'id'          	  => 'container-custom-width',
				'label'   	  	  => esc_html__( 'Container Width', 'newslist' ),
				'active_callback' => 'acb_custom_header_one',
				'type'        	  => 'range',
				'default'     	  => '1140',
				'input_attrs' 	  =>  array(
					'min'   => 400,
					'max'   => 2000,
					'step'  => 5,
				),
			),
			array(
				'id' => 'related-post',
				'type' => 'text',
				'label' => esc_html__( 'Change Related Post Title', 'newslist' ),
				'default' => esc_html__( 'Related Post', 'newslist' ),
				'partial' => array(
					'selector' => '.newslist-related-post-title',
				),
			),
		),
	));
}
add_action( 'init', 'newslist_advanced_options' );
