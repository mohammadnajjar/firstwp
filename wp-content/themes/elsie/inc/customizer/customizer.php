<?php
/**
 * Elsie Theme Customizer
 *
 * @package Elsie
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function elsie_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'title_tagline' )->panel 		= 'elsie_header_panel';
	$wp_customize->get_section( 'title_tagline' )->priority 	= 1;
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->get_section( 'background_image' )->panel 	= 'elsie_general_panel';
	
	/**
	 * Controls
	 */
	// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require get_template_directory() . '/inc/customizer/custom-controls/repeater/class_elsie_repeater.php';
	require get_template_directory() . '/inc/customizer/custom-controls/responsive-number/class_elsie_responsive_number.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_tabs.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_toggle.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_radio_images.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_info.php';
	require get_template_directory() . '/inc/customizer/custom-controls/typography/class_elsie_typography.php';
	require get_template_directory() . '/inc/customizer/custom-controls/slider/class_elsie_slider.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_title.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_posts.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_radio_buttons.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_multiselect.php';
	require get_template_directory() . '/inc/customizer/custom-controls/class_elsie_upsell.php';
	require get_template_directory() . '/inc/customizer/custom-controls/alpha-color/class_elsie_alpha_color.php';
	// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

	$wp_customize->register_control_type( '\Kirki\Control\sortable' );



	// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	/**
	 * Sanitize
	 */
	require get_template_directory() . '/inc/customizer/sanitize.php';

	/**
	 * Options
	 */
	require get_template_directory() . '/inc/customizer/options/options-top-bar.php';
	require get_template_directory() . '/inc/customizer/options/options-header.php';
	require get_template_directory() . '/inc/customizer/options/options-hero.php';
	require get_template_directory() . '/inc/customizer/options/options-featured-boxes.php';
	require get_template_directory() . '/inc/customizer/options/options-typography.php';
	require get_template_directory() . '/inc/customizer/options/options-breadcrumbs.php';
	require get_template_directory() . '/inc/customizer/options/options-blog.php';
	require get_template_directory() . '/inc/customizer/options/options-blog-single.php';
	require get_template_directory() . '/inc/customizer/options/options-sharing.php';
	require get_template_directory() . '/inc/customizer/options/options-footer.php';
	require get_template_directory() . '/inc/customizer/options/options-colors.php';
	require get_template_directory() . '/inc/customizer/options/options-buttons.php';
	require get_template_directory() . '/inc/customizer/options/options-upsell.php';

	/**
	 * Callbacks
	 */
	require get_template_directory() . '/inc/customizer/callbacks.php';	
	// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound			


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'elsie_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'elsie_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Register general panel
	 */
	$wp_customize->add_panel(
		'elsie_general_panel',
		array(
			'title'         => esc_html__( 'General', 'elsie' ),
			'priority'      => 1,
		)
	);
}
add_action( 'customize_register', 'elsie_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function elsie_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function elsie_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function elsie_customize_preview_js() {
	wp_enqueue_script( 'elsie-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), ELSIE_VERSION, true );
}
add_action( 'customize_preview_init', 'elsie_customize_preview_js' );

function elsie_customizer_scripts() {
	wp_enqueue_script( 'elsie-customizer-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery', 'jquery-ui-core' ), '20201211', true );

	wp_enqueue_style( 'elsie-customizer-styles', get_template_directory_uri() . '/assets/css/customizer.min.css' );
}
add_action( 'customize_controls_print_footer_scripts', 'elsie_customizer_scripts' );