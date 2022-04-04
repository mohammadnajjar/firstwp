<?php
/**
 * Register widget area and Sidebar.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Meta News
 */
/****************************************************************************************/

/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function meta_news_widgets_init() {

	// Registering Right Sidebar
	register_sidebar( array(
		'name' 				=> __('Right Sidebar', 'meta-news') ,
		'id' 				=> 'meta_news_right_sidebar',
		'description' 		=> __('Shows widgets at Right Side.', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	)	);

	// Registering Left Sidebar
	register_sidebar( array(
		'name' 				=> __('Left Sidebar', 'meta-news') ,
		'id' 				=> 'meta_news_left_sidebar',
		'description' 		=> __('Shows widgets at Left Side.', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	) );

	// Registering Front Page Template Sidebar 3 Column Section - Column 1
	register_sidebar(array(
		'name' 				=> __('Front Page 3 Col - Column 1', 'meta-news') ,
		'id' 				=> 'meta_news_front_page_3column_section_column1',
		'description' 		=> __('Shows widgets on Front Page Template 3 Column Section - Column 1. Suitable widget: TH: Horizontal/Vertical Posts, TH: Card/Block Posts and TH: Recent Posts', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h2 class="widget-title"><span>',
		'after_title' 		=> '</span></h2>',
	));

	// Registering Front Page Template Sidebar 3 Column Section - Column 2
	register_sidebar(array(
		'name' 				=> __('Front Page 3 Col - Column 2', 'meta-news') ,
		'id' 				=> 'meta_news_front_page_3column_section_column2',
		'description' 		=> __('Shows widgets on Front Page Template 3 Column Section - Column 2. Suitable widget: TH: Horizontal/Vertical Posts, TH: Card/Block Posts and TH: Recent Posts', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h2 class="widget-title"><span>',
		'after_title' 		=> '</span></h2>',
	));

	// Registering Front Page Template Sidebar 3 Column Section - Column 3
	register_sidebar(array(
		'name' 				=> __('Front Page 3 Col - Column 3', 'meta-news') ,
		'id' 				=> 'meta_news_front_page_3column_section_column3',
		'description' 		=> __('Shows widgets on Front Page Template 3 Column Section - Column 3. Suitable widget: TH: Horizontal/Vertical Posts, TH: Card/Block Posts and TH: Recent Posts', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h2 class="widget-title"><span>',
		'after_title' 		=> '</span></h2>',
	));

	// Registering Front Page Template Sidebar 2 Column Section - Column 1
	register_sidebar(array(
		'name' 				=> __('Front Page 2 Col - Column 1', 'meta-news') ,
		'id' 				=> 'meta_news_front_page_2column_section_column1',
		'description' 		=> __('Shows widgets on Front Page Template 2 Column Section - Column 1. Suitable widget: TH: Horizontal/Vertical Posts, TH: Card/Block Posts and TH: Recent Posts', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h2 class="widget-title"><span>',
		'after_title' 		=> '</span></h2>',
	));

	// Registering Front Page Template Sidebar 2 Column Section - Column 2
	register_sidebar(array(
		'name' 				=> __('Front Page 2 Col - Column 2', 'meta-news') ,
		'id' 				=> 'meta_news_front_page_2column_section_column2',
		'description' 		=> __('Shows widgets on Front Page Template 2 Column Section - Column 2. Suitable widget: TH: Horizontal/Vertical Posts, TH: Card/Block Posts and TH: Recent Posts', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h2 class="widget-title"><span>',
		'after_title' 		=> '</span></h2>',
	));

	// Registering Footer Sidebar 1
	register_sidebar( array(
		'name' 				=> __('Footer - Column 1', 'meta-news') ,
		'id' 				=> 'meta_news_footer_sidebar',
		'description' 		=> __('Shows widgets at Footer Column 1.', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	) );

	// Registering Footer Sidebar 2
	register_sidebar( array(
		'name' 				=> __('Footer - Column 2', 'meta-news'),
		'id' 				=> 'meta_news_footer_column2',
		'description' 		=> __('Shows widgets at Footer Column 2.', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	) );

	// Registering Footer Sidebar 3
	register_sidebar( array(
		'name' 				=> __('Footer - Column 3', 'meta-news'),
		'id' 				=> 'meta_news_footer_column3',
		'description' 		=> __('Shows widgets at Footer Column 3.', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	) );

	// Registering Footer Sidebar 4
	register_sidebar( array(
		'name' 				=> __('Footer - Column 4', 'meta-news'),
		'id' 				=> 'meta_news_footer_column4',
		'description' 		=> __('Shows widgets at Footer Column 4.', 'meta-news'),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	) );

	// Registering WooCommerce Sidebar
	if ( class_exists( 'woocommerce' ) ) {
		register_sidebar( array(
			'name' 				=> __('WooCommerce Sidebar', 'meta-news'),
			'id' 				=> 'meta_news_woocommerce_sideber',
			'description' 		=> __('Shows widgets at WooCommerce Sidebar.', 'meta-news'),
			'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</div>',
			'before_title' 		=> '<h3 class="widget-title"><span>',
			'after_title' 		=> '</span></h3>',
		) );
	}

	register_widget("meta_news_horizontal_vertical_posts");
	register_widget("meta_news_card_block_posts");
	register_widget("meta_news_recent_posts");
}
add_action('widgets_init', 'meta_news_widgets_init');

/**
 * Load Widgets
 */
require get_template_directory() . '/inc/widgets/meta-news-horizontal-vertical-posts.php';
require get_template_directory() . '/inc/widgets/meta-news-card-block-posts.php';
require get_template_directory() . '/inc/widgets/meta-news-recent-posts.php';
