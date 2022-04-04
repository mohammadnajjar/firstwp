<?php
/**
 * Meta News functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Meta News
 */

if ( ! function_exists( 'meta_news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function meta_news_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Meta News, use a find and replace
		 * to change 'meta-news' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'meta-news', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'meta-news' ),
			'right-section' => __( 'Top Bar Navigation', 'meta-news' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'meta_news_custom_background_args', array(
			'default-color' => 'f4f6f9',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 260,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add Support for post-formats
		add_theme_support( 'post-formats', array(
			'image', 'video', 'audio', 'quote', 'link'
		) );

		// Add Support for Wide Alignment
		add_theme_support( 'align-wide' );

		// Add WooCommerce Support
		add_theme_support( 'woocommerce' );
		// Add WooCommerce Product gallery features (zoom, swipe, lightbox)
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'meta_news_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function meta_news_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'meta_news_content_width', 1110 );
}
add_action( 'after_setup_theme', 'meta_news_content_width', 0 );

/**
 * Returns a "Continue reading" link for excerpts
 */
function meta_news_continue_reading($more) {
	if (!is_admin()) {
		return '&hellip; ';
	}
	return $more;
}
add_filter('excerpt_more', 'meta_news_continue_reading');

/**
 * Sets the post excerpt length to 17 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function meta_news_excerpt_length($length) {
	if (!is_admin()) {
		return 30;
	}
	return $length;
}
add_filter('excerpt_length', 'meta_news_excerpt_length');

if (!function_exists('wp_body_open')) {
	function wp_body_open() {
		do_action('wp_body_open');
	}
}

/**
 * Remove archive labels.
 *
 * @param  string $title Current archive title to be displayed.
 * @return string        Modified archive title to be displayed.
 */

function meta_news_archive_title($title) {

	$meta_news_settings = meta_news_get_option_defaults();

	if ( $meta_news_settings['meta_news_archive_title_label_hide'] === 1 ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		} elseif ( is_year() ) {
			$title = get_the_date( esc_html_x( 'Y', 'yearly archives date format','meta-news' ));
		} elseif ( is_month() ) {
			$title = get_the_date( esc_html_x( 'F Y', 'monthly archives date format','meta-news' ));
		} elseif ( is_day() ) {
			$title = get_the_date( esc_html_x( 'F j, Y', 'daily archives date format','meta-news' ));
		}
	}
	return $title;
}

add_filter( 'get_the_archive_title', 'meta_news_archive_title' );

/**
 * Enqueue scripts and styles.
 */
function meta_news_scripts() {
	$meta_news_settings = meta_news_get_option_defaults();
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/library/bootstrap/css/bootstrap.min.css', array(), '4.0.0');
	wp_enqueue_style('font-awesome-style', get_template_directory_uri().'/assets/library/font-awesome/css/all.min.css');

	wp_register_style( 'meta-news-google-fonts', '//fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap', array(), null);
	wp_enqueue_style( 'meta-news-google-fonts' );

	wp_enqueue_script('popper-script', get_template_directory_uri().'/assets/library/bootstrap/js/popper.min.js', array('jquery'), '1.12.9', true);
	wp_enqueue_script('bootstrap-script', get_template_directory_uri().'/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), '4.0.0', true);

	if ( ( is_front_page() || is_home() ) && ( $meta_news_settings['meta_news_top_stories_hide'] === 0 || $meta_news_settings['meta_news_banner_slider_posts_hide'] === 0 ) ) {
		wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/library/owl-carousel/owl.carousel.min.css', array(), '2.3.4');
		wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/library/owl-carousel/owl.carousel.min.js', array('jquery'), '2.3.4', true);
		wp_enqueue_script('meta-news-owl-carousel', get_template_directory_uri().'/assets/library/owl-carousel/owl.carousel-settings.js', array('owl-carousel'), false, true);
	}

	wp_enqueue_script('jquery-match-height', get_template_directory_uri() . '/assets/library/match-height/jquery.matchHeight-min.js', array('jquery'), '0.7.2', true);
	wp_enqueue_script('meta-news-match-height', get_template_directory_uri() . '/assets/library/match-height/jquery.matchHeight-settings.js', array('jquery-match-height'), false, true);

	wp_enqueue_style( 'meta-news-style', get_stylesheet_uri() );

	wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'meta-news-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ( is_front_page() || is_home() ) && $meta_news_settings['meta_news_top_stories_hide'] == 0 ) {
		wp_enqueue_script('jquery-marquee', get_template_directory_uri().'/assets/library/jquery.marquee/jquery.marquee.min.js', array('jquery'), false, true);
		wp_enqueue_script('meta-news-jquery-marquee', get_template_directory_uri().'/assets/library/jquery.marquee/jquery.marquee-settings.js', array('jquery-marquee'), false, true);
	}

	wp_enqueue_script('meta-news-scripts', get_template_directory_uri().'/assets/js/scripts.js', array('jquery'), false, true);
}
add_action( 'wp_enqueue_scripts', 'meta_news_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Widgets and Sidebar file
 */
require get_template_directory() . '/inc/widgets/meta-news-widgets-init.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/functions.php';

/**
 * Load footer info page
 */
require get_template_directory() . '/inc/meta-news-footer-info.php';

/**
 * Load meta-news metaboxes
 */
require get_template_directory() . '/inc/meta-news-metaboxes.php';

/**
 * Load meta-news default option
 */
require get_template_directory() . '/inc/meta-news-default-option.php';

/**
 * Load Register the required plugins
 */
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

/**
 * Theme Details Page.
 */
require get_template_directory() . '/inc/theme-info/info.php';

