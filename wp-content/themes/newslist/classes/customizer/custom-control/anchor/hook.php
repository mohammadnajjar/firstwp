<?php

/**
 * This file is used to register multiple setting for a slider
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 */

if ( !class_exists( 'Newslist_Customizer_Anchor_Integration' ) ) {
	class Newslist_Customizer_Anchor_Integration extends Newslist_Customizer {

		public static $type  = 'anchor';
		public static $class = 'Newslist_Anchor_Customize_Section';

		public function __construct() {
			self::add_custom_control(array(
				'type'     => self::$type,
				'class'    => self::$class,
				'sanitize' => false
			));

			self::add_custom_section(array(
				'type'  => self::$type,
				'class' => self::$class
			));

			add_filter( self::fn_prefix( 'customizer_get_section_arg' ), array( __CLASS__, 'args' ), 10, 3 );
		}

		public static function args( $args, $panel_id, $section )	{
			if ( isset( $section['url'] ) ) {
				$args['url'] = $section['url'];
			}

			return $args;
		}
	}

	new Newslist_Customizer_Anchor_Integration();
}
