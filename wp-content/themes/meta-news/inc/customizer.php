<?php
/**
 * Meta News Theme Customizer
 *
 * @package Meta News
 */

if ( ! class_exists( 'WP_Customize_Section' ) ) {
	return null;
}

function meta_news_support_register($wp_customize){
	class Meta_News_Customize_Meta_News_Support extends WP_Customize_Control {
		public function render_content() { ?>
		<div class="theme-info">
			<a title="<?php esc_attr_e( 'Review Meta News', 'meta-news' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/theme/meta-news/reviews/' ); ?>" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'Rate Meta News', 'meta-news' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/theme-instruction/meta-news/' ); ?>" title="<?php esc_attr_e( 'Meta News Theme Instructions', 'meta-news' ); ?>" target="_blank" rel="noopener noreferrer">
			<?php esc_html_e( 'Theme Instructions', 'meta-news' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/support-forum/' ); ?>" title="<?php esc_attr_e( 'Support Forum', 'meta-news' ); ?>" target="_blank" rel="noopener noreferrer">
			<?php esc_html_e( 'Support Forum', 'meta-news' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/demos/meta-news/' ); ?>" title="<?php esc_attr_e( 'Meta News Demo', 'meta-news' ); ?>" target="_blank" rel="noopener noreferrer">
			<?php esc_html_e( 'View Demo', 'meta-news' ); ?>
			</a>
		</div>
		<?php
		}
	}

	class Meta_News_Customize_drop_down_Category_Control extends WP_Customize_Control {
		/**
		 * The type of customize control being rendered.
		 */
		public $type = 'select';
		/**
		 * Displays the multiple select on the customize screen.
		 */
		public function render_content() {
			$meta_news_categories = get_categories(); ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php foreach ($meta_news_categories as $category) : ?>
						<option value="<?php echo esc_attr($category->cat_ID); ?>">
							<?php echo esc_html($category->cat_name); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</label>
			<?php
		}
	}
}
add_action('customize_register', 'meta_news_support_register');

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Meta_News_Customize_Section_Upsell extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
				<a href="{{ data.pro_url }}" class="upgrade-to-pro" target="_blank" rel="noopener noreferrer">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

function meta_news_customize_custom_sections( $wp_customize ) {
	// Register custom section types.
	$wp_customize->register_section_type( 'Meta_News_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section( new Meta_News_Customize_Section_Upsell( $wp_customize, 'theme_upsell', array(
		'title'					=> esc_html__( 'Meta News Pro', 'meta-news' ),
		'pro_text'				=> esc_html__( 'Upgrade to Pro', 'meta-news' ),
		'pro_url'				=> 'https://www.themehorse.com/themes/meta-news-pro',
		'priority'				=> 1,
	) ) );
}
add_action( 'customize_register', 'meta_news_customize_custom_sections');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function meta_news_customize_register( $wp_customize ) {
	global $meta_news_settings;
	$meta_news_settings = meta_news_get_option_defaults();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'meta_news_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'meta_news_customize_partial_blogdescription',
		) );
	}

	// Section => Site Identity
	$wp_customize->add_setting( 'meta_news_header_sitebranding_center', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_header_sitebranding_center', array(
		'label'					=> __('Site Branding Centred ', 'meta-news'),
		'description'			=> __('Set the Logo above for effect.','meta-news'),
		'section'				=> 'title_tagline',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_header_sitebranding_inline', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_header_sitebranding_inline', array(
		'label'					=> __('Site Branding Inline ', 'meta-news'),
		'description'			=> __('Set the Logo above for effect.','meta-news'),
		'section'				=> 'title_tagline',
		'type'					=> 'checkbox',
	) );

	// Section => Layout
	$wp_customize->add_section( 'meta_news_content_layout_section', array(
		'title' 					=> __('Layout','meta-news'),
		'priority'				=> 121,
	) );
	$wp_customize->add_setting('meta_news_content_layout', array(
		'default'				=> 'right',
		'sanitize_callback'	=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('meta_news_content_layout', array(
		'label'			=> __('Global Layout Setting','meta-news'),
		'description'			=> __('Below options are global setting. Set individual layout from specific page/post.','meta-news'),
		'section'				=> 'meta_news_content_layout_section',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'right'					=> __('Right Sidebar','meta-news'),
			'left'					=> __('Left Sidebar','meta-news'),
			'nosidebar'				=> __('No Sidebar','meta-news'),
			'fullwidth'				=> __('No Sidebar Full Width','meta-news'),
		),
	) );

	// Section => Social Profiles
	$wp_customize->add_section('meta_news_social_profiles_setting', array(
		'title'					=> __('Social Profiles', 'meta-news'),
		'priority'				=> 131,
	) );
	$social_profiles =  meta_news_social_profiles_list();
	foreach( $social_profiles as $key => $value ) {
		$wp_customize->add_setting($key, array(
			'default'				=> '',
			'sanitize_callback'		=> 'esc_url_raw',
		) );
		$wp_customize->add_control($key, array(
			'label'					=> $value['title'],
			'section'				=> 'meta_news_social_profiles_setting',
			'type'					=> 'text',
		) );
	}

	// Section => Header
	$wp_customize->add_section('meta_news_custom_header_setting', array(
		'title'					=> __('Header', 'meta-news'),
		'priority'				=> 141,
	) );
	$wp_customize->add_setting('meta_news_top_bar_social_profiles', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
	) );
	$wp_customize->add_control( 'meta_news_top_bar_social_profiles', array(
		'label'					=> __('Hide Social Profiles', 'meta-news'),
		'section'				=> 'meta_news_custom_header_setting',
		'type'					=> 'checkbox',
		'active_callback'		=> 'meta_news_is_social_profiles_set'
	) );
	$wp_customize->add_setting( 'meta_news_top_bar_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_top_bar_hide', array(
		'label'					=> __('Hide Top Bar', 'meta-news'),
		'section'				=> 'meta_news_custom_header_setting',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_nav_uppercase', array(
		'default'				=> 1,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
	) );
	$wp_customize->add_control( 'meta_news_nav_uppercase', array(
		'label'					=> __('Navigation Uppercase', 'meta-news'),
		'section'				=> 'meta_news_custom_header_setting',
		'type'					=> 'checkbox'
	) );
	$wp_customize->add_setting( 'meta_news_breadcrumbs_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
	) );
	$wp_customize->add_control( 'meta_news_breadcrumbs_hide', array(
		'label'					=> __('Hide Breadcrumbs', 'meta-news'),
		'section'				=> 'meta_news_custom_header_setting',
		'type'					=> 'checkbox'
	) );
	$wp_customize->add_setting( 'meta_news_header_background',array(
		'sanitize_callback'		=> 'esc_url_raw',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'meta_news_header_background', array(
		'label'					=> __('Background Image', 'meta-news'),
		'section'				=> 'meta_news_custom_header_setting',
	) ) );
	$wp_customize->add_setting('meta_news_header_bg_overlay', array(
		'default'				=> 'none',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('meta_news_header_bg_overlay', array(
		'label'					=> __('Background Overlay','meta-news'),
		'section'				=> 'meta_news_custom_header_setting',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'dark'					=> __('Dark Overlay','meta-news'),
			'light'					=> __('Light Overlay','meta-news'),
			'none'					=> __('None','meta-news'),
		),
	) );
	$wp_customize->add_setting( 'meta_news_header_add_image',array(
		'sanitize_callback'		=> 'esc_url_raw',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'meta_news_header_add_image', array(
		'label'					=> __('Advertisement Image', 'meta-news'),
		'section'				=> 'meta_news_custom_header_setting',
	) ) );
	$wp_customize->add_setting('meta_news_header_add_link', array(
		'default'				=> '',
		'sanitize_callback'		=> 'esc_url_raw',
	) );
	$wp_customize->add_control('meta_news_header_add_link', array(
		'label'					=> __('Advertisement Image Url', 'meta-news'),
		'section'				=> 'meta_news_custom_header_setting',
		'type'					=> 'text',
	) );

	// Section => Top Stories Post
	$wp_customize->add_section( 'meta_news_top_stories', array(
		'title'					=> __('Top Stories Post', 'meta-news'),
		'priority'				=> 151,
	));
	$wp_customize->add_setting( 'meta_news_top_stories_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_top_stories_hide', array(
		'label'					=> __('Hide Top Stories Post', 'meta-news'),
		'section'				=> 'meta_news_top_stories',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting('meta_news_top_stories_style', array(
		'default'				=> 'style_1',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('meta_news_top_stories_style', array(
		'label'					=> __('Display Style','meta-news'),
		'section'				=> 'meta_news_top_stories',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'style_1'					=> __('Style 1','meta-news'),
			'style_2'					=> __('Style 2','meta-news'),
		),
	) );
	$wp_customize->add_setting('meta_news_top_stories_title', array(
		'default'				=> __('TOP STORIES', 'meta-news'),
		'sanitize_callback'		=> 'sanitize_text_field',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( 'meta_news_top_stories_title', array(
		'label'					=> __('Label', 'meta-news'),
		'section'				=> 'meta_news_top_stories',
		'active_callback'		=> 'meta_news_is_top_stories_set',
		'type'					=> 'text',
	));
	$wp_customize->add_setting( 'meta_news_top_stories_latest_post', array(
		'default'				=> 'latest',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_top_stories_latest_post', array(
		'section'				=> 'meta_news_top_stories',
		'active_callback'		=> 'meta_news_is_top_stories_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'latest'				=> __('Show Latest Posts','meta-news'),
			'category'				=> __('Show Posts from Category','meta-news'),
		),
	) );
	$wp_customize->add_setting( 'meta_news_top_stories_categories', array(
		'default'				=> array(),
		'sanitize_callback'		=> 'meta_news_sanitize_select',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new Meta_News_Customize_drop_down_Category_Control( $wp_customize, 'meta_news_top_stories_categories', array(
		'label'				=> __('Choose Category', 'meta-news'),
		'section'			=> 'meta_news_top_stories',
		'active_callback'	=> 'meta_news_is_top_stories_latest_post_set',
		'type'				=> 'select'
	) ) );

	// Panel => Banner
	$wp_customize->add_panel( 'meta_news_banner_settings', array(
		'title'					=> __('Banner', 'meta-news'),
		'priority'				=> 161,
	));

	// Section => Banner Settings
	$wp_customize->add_section( 'meta_news_banner_global_settings', array(
		'title'					=> __('Banner Settings', 'meta-news'),
		'panel'					=> 'meta_news_banner_settings',
	));
	$wp_customize->add_setting('meta_news_banner_display', array(
		'default'				=> 'front-blog',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('meta_news_banner_display', array(
		'label'					=> __('Display Option','meta-news'),
		'description'			=> __('Make sure Banner Sections are enable.','meta-news'),
		'section'				=> 'meta_news_banner_global_settings',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'front-only'			=> __('Show on Homepage only','meta-news'),
			'front-blog'			=> __('Show on both Homepage and Posts Page','meta-news'),
		),
	) );

	// Section => Featured Slider
	$wp_customize->add_section( 'meta_news_banner_slider', array(
		'title'					=> __('Featured Slider', 'meta-news'),
		'panel'					=> 'meta_news_banner_settings',
	));
	$wp_customize->add_setting( 'meta_news_banner_slider_posts_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_banner_slider_posts_hide', array(
		'label'					=> __('Hide Featured Slider', 'meta-news'),
		'section'				=> 'meta_news_banner_slider',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting('meta_news_banner_slider_posts_title', array(
		'default'				=> __('MAIN STORIES', 'meta-news'),
		'sanitize_callback'		=> 'sanitize_text_field',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( 'meta_news_banner_slider_posts_title', array(
		'label'					=> __('Posts Title', 'meta-news'),
		'section'				=> 'meta_news_banner_slider',
		'active_callback'		=> 'meta_news_is_banner_slider_posts_set',
		'type'					=> 'text',
	));
	$wp_customize->add_setting( 'meta_news_banner_slider_latest_post', array(
		'default'				=> 'latest',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_banner_slider_latest_post', array(
		'section'				=> 'meta_news_banner_slider',
		'active_callback'		=> 'meta_news_is_banner_slider_posts_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'latest'				=> __('Show Latest Posts','meta-news'),
			'category'				=> __('Show Posts from Category','meta-news'),
		),
	) );
	$wp_customize->add_setting( 'meta_news_banner_slider_post_categories', array(
		'default'				=> array(),
		'sanitize_callback'		=> 'meta_news_sanitize_select',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new Meta_News_Customize_drop_down_Category_Control( $wp_customize, 'meta_news_banner_slider_post_categories', array(
		'label'					=> __('Choose Category', 'meta-news'),
		'section'				=> 'meta_news_banner_slider',
		'active_callback'		=> 'meta_news_is_banner_slider_latest_post_set',
		'type'					=> 'select'
	) ) );

	// Section => Featured Posts 1
	$wp_customize->add_section( 'meta_news_banner_featured_posts_1', array(
		'title'					=> __('Featured Posts 1', 'meta-news'),
		'panel'					=> 'meta_news_banner_settings',
	));
	$wp_customize->add_setting( 'meta_news_banner_featured_posts_1_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_banner_featured_posts_1_hide', array(
		'label'					=> __('Hide Featured Posts 1', 'meta-news'),
		'section'				=> 'meta_news_banner_featured_posts_1',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting('meta_news_banner_featured_posts_1_title', array(
		'default'				=> __('EDITOR\'S PICK', 'meta-news'),
		'sanitize_callback'		=> 'sanitize_text_field',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( 'meta_news_banner_featured_posts_1_title', array(
		'label'					=> __('Posts Title', 'meta-news'),
		'section'				=> 'meta_news_banner_featured_posts_1',
		'active_callback'		=> 'meta_news_is_banner_featured_posts_1_set',
		'type'					=> 'text',
	));
	$wp_customize->add_setting( 'meta_news_banner_featured_posts_1_latest_post', array(
		'default'				=> 'latest',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_banner_featured_posts_1_latest_post', array(
		'section'				=> 'meta_news_banner_featured_posts_1',
		'active_callback'		=> 'meta_news_is_banner_featured_posts_1_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'latest'				=> __('Show Latest Posts','meta-news'),
			'category'				=> __('Show Posts from Category','meta-news'),
		),
	) );
	$wp_customize->add_setting( 'meta_news_banner_featured_posts_1_post_categories', array(
		'default'				=> array(),
		'sanitize_callback'		=> 'meta_news_sanitize_select',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new Meta_News_Customize_drop_down_Category_Control( $wp_customize, 'meta_news_banner_featured_posts_1_post_categories', array(
		'label'					=> __('Choose Category', 'meta-news'),
		'section'				=> 'meta_news_banner_featured_posts_1',
		'active_callback'		=> 'meta_news_is_banner_featured_posts_1_latest_post_set',
		'type'					=> 'select'
	) ) );

	// Section => Featured Posts 2
	$wp_customize->add_section( 'meta_news_banner_featured_posts_2', array(
		'title'					=> __('Featured Posts 2', 'meta-news'),
		'panel'					=> 'meta_news_banner_settings',
	));
	$wp_customize->add_setting( 'meta_news_banner_featured_posts_2_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_banner_featured_posts_2_hide', array(
		'label'					=> __('Hide Featured Posts 2', 'meta-news'),
		'section'				=> 'meta_news_banner_featured_posts_2',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting('meta_news_banner_featured_posts_2_title', array(
		'default'				=> __('TRENDING STORIES', 'meta-news'),
		'sanitize_callback'		=> 'sanitize_text_field',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( 'meta_news_banner_featured_posts_2_title', array(
		'label'					=> __('Posts Title', 'meta-news'),
		'section'				=> 'meta_news_banner_featured_posts_2',
		'active_callback'		=> 'meta_news_is_banner_featured_posts_2_set',
		'type'					=> 'text',
	));
	$wp_customize->add_setting( 'meta_news_banner_featured_posts_2_latest_post', array(
		'default'				=> 'latest',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_banner_featured_posts_2_latest_post', array(
		'section'				=> 'meta_news_banner_featured_posts_2',
		'active_callback'		=> 'meta_news_is_banner_featured_posts_2_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'latest'				=> __('Show Latest Posts','meta-news'),
			'category'				=> __('Show Posts from Category','meta-news'),
		),
	) );
	$wp_customize->add_setting( 'meta_news_banner_featured_posts_2_post_categories', array(
		'default'				=> array(),
		'sanitize_callback'		=> 'meta_news_sanitize_select',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new Meta_News_Customize_drop_down_Category_Control( $wp_customize, 'meta_news_banner_featured_posts_2_post_categories', array(
		'label'					=> __('Choose Category', 'meta-news'),
		'section'				=> 'meta_news_banner_featured_posts_2',
		'active_callback'		=> 'meta_news_is_banner_featured_posts_2_latest_post_set',
		'type'					=> 'select'
	) ) );

	// Section => Header Featured Posts
	$wp_customize->add_section( 'meta_news_header_featured_posts', array(
		'title'					=> __('Header Featured Posts', 'meta-news'),
		'priority'				=> 171,
	));
	$wp_customize->add_setting( 'meta_news_header_featured_posts_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_header_featured_posts_hide', array(
		'label'					=> __('Hide Header Featured Posts', 'meta-news'),
		'section'				=> 'meta_news_header_featured_posts',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting('meta_news_header_featured_posts_banner_display', array(
		'default'				=> 'front-blog',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('meta_news_header_featured_posts_banner_display', array(
		'label'					=> __('Display Option','meta-news'),
		'section'				=> 'meta_news_header_featured_posts',
		'active_callback'		=> 'meta_news_is_header_featured_posts_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'front-only'			=> __('Show on Homepage only','meta-news'),
			'front-blog'			=> __('Show on both Homepage and Posts Page','meta-news'),
		),
	) );
	$wp_customize->add_setting('meta_news_header_featured_posts_title', array(
		'default'				=> __('POPULAR STORIES', 'meta-news'),
		'sanitize_callback'		=> 'sanitize_text_field',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( 'meta_news_header_featured_posts_title', array(
		'label'					=> __('Posts Title', 'meta-news'),
		'section'				=> 'meta_news_header_featured_posts',
		'active_callback'		=> 'meta_news_is_header_featured_posts_set',
		'type'					=> 'text',
	));
	$wp_customize->add_setting( 'meta_news_header_featured_latest_post', array(
		'default'				=> 'latest',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_header_featured_latest_post', array(
		'section'				=> 'meta_news_header_featured_posts',
		'active_callback'		=> 'meta_news_is_header_featured_posts_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'latest'				=> __('Show Latest Posts','meta-news'),
			'category'				=> __('Show Posts from Category','meta-news'),
		),
	) );
	$wp_customize->add_setting( 'meta_news_header_featured_post_categories', array(
		'default'				=> array(),
		'sanitize_callback'		=> 'meta_news_sanitize_select',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new Meta_News_Customize_drop_down_Category_Control( $wp_customize, 'meta_news_header_featured_post_categories', array(
		'label'					=> __('Choose Category', 'meta-news'),
		'section'				=> 'meta_news_header_featured_posts',
		'active_callback'		=> 'meta_news_is_header_featured_latest_post_set',
		'type'					=> 'select'
	) ) );

	// Section => Footer Featured Posts
	$wp_customize->add_section( 'meta_news_footer_featured_posts', array(
		'title'					=> __('Footer Featured Posts', 'meta-news'),
		'priority'				=> 181,
	));
	$wp_customize->add_setting( 'meta_news_footer_featured_posts_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_footer_featured_posts_hide', array(
		'label'					=> __('Hide Footer Featured Posts', 'meta-news'),
		'section'				=> 'meta_news_footer_featured_posts',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting('meta_news_footer_featured_posts_title', array(
		'default'				=> __('RECOMMENDED', 'meta-news'),
		'sanitize_callback'		=> 'sanitize_text_field',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( 'meta_news_footer_featured_posts_title', array(
		'label'					=> __('Posts Title', 'meta-news'),
		'section'				=> 'meta_news_footer_featured_posts',
		'active_callback'		=> 'meta_news_is_footer_featured_posts_set',
		'type'					=> 'text',
	));
	$wp_customize->add_setting( 'meta_news_footer_featured_latest_post', array(
		'default'				=> 'latest',
		'sanitize_callback'		=> 'meta_news_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_footer_featured_latest_post', array(
		'section'				=> 'meta_news_footer_featured_posts',
		'active_callback'		=> 'meta_news_is_footer_featured_posts_set',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'latest'				=> __('Show Latest Posts','meta-news'),
			'category'				=> __('Show Posts from Category','meta-news'),
		),
	) );
	$wp_customize->add_setting( 'meta_news_footer_featured_post_categories', array(
		'default'				=> array(),
		'sanitize_callback'		=> 'meta_news_sanitize_select',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new Meta_News_Customize_drop_down_Category_Control( $wp_customize, 'meta_news_footer_featured_post_categories', array(
		'label'					=> __('Choose Category', 'meta-news'),
		'section'				=> 'meta_news_footer_featured_posts',
		'active_callback'		=> 'meta_news_is_footer_featured_latest_post_set',
		'type'					=> 'select'
	) ) );

	// Section => Posts Meta
	$wp_customize->add_section( 'meta_news_posts_meta', array(
		'title'					=> __('Posts Meta', 'meta-news'),
		'priority'				=> 191,
	));
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_posts_category', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_posts_category', array(
		'label'					=> __('Hide Category Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_posts_date', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_posts_date', array(
		'label'					=> __('Hide Date Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_posts_author', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_posts_author', array(
		'label'					=> __('Hide Author Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_posts_comment', array(
		'default'				=> 1,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_posts_comment', array(
		'label'					=> __('Hide Comment Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_single_post_category', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_single_post_category', array(
		'label'					=> __('Hide Single Post Category Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_single_post_date', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_single_post_date', array(
		'label'					=> __('Hide Single Post Date Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_single_post_author', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_single_post_author', array(
		'label'					=> __('Hide Single Post Author Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_single_post_comment', array(
		'default'				=> 1,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_single_post_comment', array(
		'label'					=> __('Hide Single Post Comment Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_posts_meta_hide_single_post_tags', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_posts_meta_hide_single_post_tags', array(
		'label'					=> __('Hide Single Post Tags Meta', 'meta-news'),
		'section'				=> 'meta_news_posts_meta',
		'type'					=> 'checkbox',
	) );

	// Section => NewCard Settings
	$wp_customize->add_section( 'meta_news_main_global_settings', array(
		'title'					=> __('Additional Theme Settings', 'meta-news'),
		'priority'				=> 191,
	));
	$wp_customize->add_setting( 'meta_news_featured_image_single', array(
		'default'				=> 1,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_featured_image_single', array(
		'label'					=> __('Show Featured Image in Posts Single', 'meta-news'),
		'section'				=> 'meta_news_main_global_settings',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_featured_image_page', array(
		'default'				=> 1,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_featured_image_page', array(
		'label'					=> __('Show Featured Image in Page', 'meta-news'),
		'section'				=> 'meta_news_main_global_settings',
		'type'					=> 'checkbox',
	) );
	$wp_customize->add_setting( 'meta_news_archive_title_label_hide', array(
		'default'				=> 0,
		'sanitize_callback'		=> 'meta_news_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'meta_news_archive_title_label_hide', array(
		'label'					=> __('Hide Archive Title Label', 'meta-news'),
		'section'				=> 'meta_news_main_global_settings',
		'type'					=> 'checkbox',
	) );


	// Section => Meta News Support
	$wp_customize->add_section('meta_news_support', array(
		'title'					=> __('Meta News Support', 'meta-news'),
		'priority'				=> 191,
	));
	$wp_customize->add_setting('meta_news_support', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control( new Meta_News_Customize_Meta_News_Support( $wp_customize, 'meta_news_support', array(
		'label'					=> __('Meta News Support','meta-news'),
		'section'				=> 'meta_news_support'
	) ) );
}
add_action( 'customize_register', 'meta_news_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function meta_news_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function meta_news_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function meta_news_customizer_control_scripts() {
	wp_enqueue_style( 'meta-news-customize-controls', get_template_directory_uri() . '/assets/css/customize-controls.css' );
	wp_enqueue_script( 'meta-news-customizer-control-js', get_template_directory_uri() . '/assets/js/customizer-control.js', array(), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'meta_news_customizer_control_scripts', 0 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function meta_news_customize_preview_js() {
	wp_enqueue_script( 'meta-news-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'meta_news_customize_preview_js' );

/**
 * Sanitize the values
 */
if ( ! function_exists( 'meta_news_sanitize_choices' ) ) {
	/**
	 * Sanitization: select
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return mixed Sanitized value.
	 */
	function meta_news_sanitize_choices($input, $setting) {

		// Ensure input is a slug.
		$input = sanitize_key($input);

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control($setting->id)->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}
}

if ( ! function_exists( 'meta_news_sanitize_integer' ) ) {
	/**
	 * Sanitization: number_absint
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return int Sanitized number.
	 */
	function meta_news_sanitize_integer($input) {
		return absint($input);
	}
}

if ( ! function_exists( 'meta_news_sanitize_select' ) ) {
	/**
	 * Sanitization: text
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string Sanitized content.
	 */
	function meta_news_sanitize_select($input) {
		if ($input !== '') {
			return $input;
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'meta_news_is_social_profiles_set' ) ) {
	/**
	 * Check if social profiles is set.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_social_profiles_set($control) {

		if ( meta_news_is_social_profiles_links() > 0 ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_top_stories_set' ) ) {
	/**
	 * Check if top stories is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_top_stories_set($control) {

		if ( 0 === $control->manager->get_setting('meta_news_top_stories_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_top_stories_latest_post_set' ) ) {
	/**
	 * Check if top stories is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_top_stories_latest_post_set($control) {

		if ( 'category' === $control->manager->get_setting('meta_news_top_stories_latest_post')->value() && 0 === $control->manager->get_setting('meta_news_top_stories_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_header_featured_posts_set' ) ) {
	/**
	 * Check if Featured Posts is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_header_featured_posts_set($control) {

		if ( 0 === $control->manager->get_setting('meta_news_header_featured_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_header_featured_latest_post_set' ) ) {
	/**
	 * Check if post category is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_header_featured_latest_post_set($control) {

		if ( 'category' === $control->manager->get_setting('meta_news_header_featured_latest_post')->value() && 0 === $control->manager->get_setting('meta_news_header_featured_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_footer_featured_posts_set' ) ) {
	/**
	 * Check if Featured Posts is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_footer_featured_posts_set($control) {

		if ( 0 === $control->manager->get_setting('meta_news_footer_featured_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_footer_featured_latest_post_set' ) ) {
	/**
	 * Check if post category is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_footer_featured_latest_post_set($control) {

		if ( 'category' === $control->manager->get_setting('meta_news_footer_featured_latest_post')->value() && 0 === $control->manager->get_setting('meta_news_footer_featured_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_banner_slider_posts_set' ) ) {
	/**
	 * Check if Banner Slider Posts is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_banner_slider_posts_set($control) {

		if ( 0 === $control->manager->get_setting('meta_news_banner_slider_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_banner_slider_latest_post_set' ) ) {
	/**
	 * Check if banner slider category is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_banner_slider_latest_post_set($control) {

		if ( 'category' === $control->manager->get_setting('meta_news_banner_slider_latest_post')->value() && 0 === $control->manager->get_setting('meta_news_banner_slider_posts_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_banner_featured_posts_1_set' ) ) {
	/**
	 * Check if Banner Featured Posts 1 is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_banner_featured_posts_1_set($control) {

		if ( 0 === $control->manager->get_setting('meta_news_banner_featured_posts_1_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_banner_featured_posts_1_latest_post_set' ) ) {
	/**
	 * Check if banner featured post 1 category is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_banner_featured_posts_1_latest_post_set($control) {

		if ( 'category' === $control->manager->get_setting('meta_news_banner_featured_posts_1_latest_post')->value() && 0 === $control->manager->get_setting('meta_news_banner_featured_posts_1_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_banner_featured_posts_2_set' ) ) {
	/**
	 * Check if Banner Featured Posts 2 is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_banner_featured_posts_2_set($control) {

		if ( 0 === $control->manager->get_setting('meta_news_banner_featured_posts_2_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'meta_news_is_banner_featured_posts_2_latest_post_set' ) ) {
	/**
	 * Check if banner featured post 2 category is enable.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function meta_news_is_banner_featured_posts_2_latest_post_set($control) {

		if ( 'category' === $control->manager->get_setting('meta_news_banner_featured_posts_2_latest_post')->value() && 0 === $control->manager->get_setting('meta_news_banner_featured_posts_2_hide')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}