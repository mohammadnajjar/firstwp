<?php
/**
 * Creates option for footer
 *
 * Register footer Options
 *
 * @return void
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */

function newslist_footer_options() {
	Newslist_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Footer Options
		'section' => array(
			'id'    => 'footer',
			'title' => esc_html__( 'Footer Options', 'newslist' ),
		),
		# Theme Option > Header > settings
		'fields' => array(
			array(
				'id'      => 'footer-copyright-text',
				'label'   => esc_html__( 'Copyright Text', 'newslist' ),
				'default' => esc_html__( 'Copyright &copy; All right reserved', 'newslist' ),
				'type'    => 'textarea',
				'partial' =>	array(
					'selector'	=>	'span#newslist-copyright'
				)
			),
			array(
				'id'      => 'footer-social-menu',
				'label'   => esc_html__( 'Show Social Menu', 'newslist' ),
				'description' => esc_html__( 'Please add Social menus for enabling Social menus. Go to Menus for setting up', 'newslist' ),
				'default' => true,
				'type'    => 'toggle',
			)
		)
	));
}
# use widgets_init hook as we need default value of layout-footer while registering sidebar.
# init hook is too late
add_action( 'widgets_init', 'newslist_footer_options' );
