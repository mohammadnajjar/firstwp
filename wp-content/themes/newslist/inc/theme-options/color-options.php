<?php

/**
 * Register breadcrumb Options
 *
 * @return void
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 */
function newslist_color_options() {
	Newslist_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > color options
		'section' => array(
			'id'       => 'color-section',
			'title'    => esc_html__( 'Color Options', 'newslist' ),
			'priority' => 5
		),
		'fields'  => array(
			array(
				'id'      => 'primary-color',
				'label'   => esc_html__( 'Primary Color', 'newslist' ),
				'default' => '#000',
				'type'    => 'color-picker',
			),
			array(
				'id'      => 'body-paragraph-color',
				'label'   => esc_html__( 'Body Text Color', 'newslist' ),
				'default' => '#5f5f5f',
				'type'    => 'color-picker',
			),
			array(
				'id'      => 'primary-menu-item-color',
				'label'   => esc_html__( 'Primary Menu Item color', 'newslist' ),
				'default' => '#fff',
				'type'    => 'color-picker',
			),
			array(
				'id'   => 'line-1',
				'type' => 'horizontal-line',
			),
			array(
				'id'      => 'link-color',
				'label'   => esc_html__( 'Link Color', 'newslist' ),
				'default' => '#222222',
				'type'    => 'color-picker',
			),
			array(
				'id'      => 'link-hover-color',
				'label'   => esc_html__( 'Link Hover Color', 'newslist' ),
				'default' => '#dd3333',
				'type'    => 'color-picker',
			),
			array(
				'id'   => 'line-2',
				'type' => 'horizontal-line',
			),
			array(
				'id'      => 'sb-widget-title-color',
				'label'   => esc_html__( 'Sidebar Widget Title Color', 'newslist' ),
				'default' => '#000000',
				'type'    => 'color-picker',
			),
			array(
				'id'      => 'sb-widget-content-color',
				'label'   => esc_html__( 'Sidebar Widget Content Color', 'newslist' ),
				'default' => '#282835',
				'type'    => 'color-picker',
			),
			array(
				'id'   => 'line-3',
				'type' => 'horizontal-line',
			),
			array(
				'id'      => 'footer-title-color',
				'label'   => esc_html__( 'Footer Widget Title Color', 'newslist' ),
				'default' => '#fff',
				'type'    => 'color-picker',
			),
			array(
				'id'      => 'footer-content-color',
				'label'   => esc_html__( 'Footer Widget Content Color', 'newslist' ),
				'default' => '#a8a8a8',
				'type'    => 'color-picker',
			),
			array(
				'id'   => 'line-4',
				'type' => 'horizontal-line',
			),
			array(
				'id'      => 'footer-top-background-color',
				'label'   => esc_html__( 'Footer Background Color', 'newslist' ),
				'default' => '#28292a',
				'type'    => 'color-picker',
			),
			array(
				'id'      => 'footer-copyright-background-color',
				'label'   => esc_html__( 'Footer Copyright Background Color', 'newslist' ),
				'default' => '#0c0808',
				'type'    => 'color-picker',
			),
			array(
				'id'      => 'footer-copyright-text-color',
				'label'   => esc_html__( 'Footer Copyright Text Color', 'newslist' ),
				'default' => '#ffffff',
				'type'    => 'color-picker',
			),
		),
	));
}
add_action( 'init', 'newslist_color_options' );
