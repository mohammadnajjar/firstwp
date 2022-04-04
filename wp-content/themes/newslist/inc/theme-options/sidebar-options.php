<?php
/**
 * Register sidebar Options
 *
 * @return void
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 */
function newslist_sidebar_options() {
	Newslist_Customizer::set(array(
		# Theme Options
		'panel'   => 'panel',
		# Theme Options >Sidebar Layout > Settings
		'section' => array(
			'id'     => 'sidebar-options',
			'title'  => esc_html__( 'Sidebar Options', 'newslist' ),
		),
		'fields' => array(
			# sb - Sidebar
			array(
				'id'      => 'sidebar-position',
				'label'   => esc_html__( 'Sidebar Position', 'newslist' ),
				'type'    => 'buttonset',
				'default' => 'right-sidebar',
				'choices' => array(
					'left-sidebar'  => esc_html__( 'Left', 'newslist' ),
					'right-sidebar' => esc_html__('Right', 'newslist' ),
					'no-sidebar'    => esc_html__( 'None', 'newslist' ),
				)
			),
		),
	));
}
add_action( 'init', 'newslist_sidebar_options' );