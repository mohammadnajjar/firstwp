<?php

/**
 * Resets all the value of customizer
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */

if ( !function_exists( 'newslist_get_setting_id' ) ) :
	add_action(
		Newslist_Helper::fn_prefix( 'customize_register_start' ),
		'newslist_get_setting_id',
		30,
		2
	);
	/**
	 * Get all the setting id to reset the data.
	 *
	 * @return array
	 * @since 1.0.0
	 *
	 * @package Newslist WordPress theme
	 */
	function newslist_get_setting_id( $instance, $wp_customize ) {
		Newslist_Customizer::set(array(
			# Theme option
			'panel' => 'panel',
			# Theme Option > Reset options
			'section' => array(
				'id'    => 'reset-section',
				'title' => esc_html__( 'Reset Options', 'newslist' ),
			),
			'fields' => array(
				array(
					'id' 	      => 'reset-options',
					'type'        => 'reset',
					'settings'    => array_keys( $instance::$settings ),
					'label'       => esc_html__( 'Reset', 'newslist' ),
					'description' => esc_html__( 'Reseting will delete all the data. Once reset, you will not be able to get back those data.', 'newslist' ),
				),
			),
		));
	}
endif;
