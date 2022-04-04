<?php
/**
 * Newslist functions and definitions
 *
 * Newslist only works in WordPress 4.7 or later.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newslist WordPress theme
 */

define( 'NEWSLIST_PREFIX', 'newslist' );
define( 'NEWSLIST_VERSION', '1.0.4' );

require get_parent_theme_file_path( '/classes/class-helper.php' );

final class Newslist_Theme extends Newslist_Helper{
    /**
     * constructor
     *
     * @since 1.0.0 
     *
     * @package Newslist WordPress Theme
     */
    public function __construct() {
        # Get access to parent constructor
        parent::__construct();

        # loads the customizer and custom control
        self::include( array( 'loader' ), 'classes/customizer' );

        # loads meta fields to page and post add/edit page
        self::include(array(
            'meta-fields',
        ), 'classes/meta-fields' );

        # load framework-css and breadcrumb file
        self::include(array(
            'css',
            'breadcrumb'
        ), 'classes');

        # adds the css for different devices
        self::include(array(
            'common',
            'responsive',
        ), 'inc/dynamic-css', '');

        # activate different plugin support
        self::include(array(
            'jetpack',
        ), 'classes/support');

        # tgm plugin recommendation class
        self::include(array(
            'tgm-plugin-activation',
        ), 'classes/tgm');

        # load theme-options files
        self::load_theme_options();

        /******************
         *  Action Hooks  *
         ******************/
        # enqueue the script and style.
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts' ) );
        # Enqueue block assets
        add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'editor_assets' ) );
        # adds the theme suppports
        add_action( 'after_setup_theme', array( __CLASS__, 'supports' ) );
        # register the sidebars
        add_action( 'widgets_init', array( __CLASS__, 'sidebars' ) );
        # register nav bars
        add_action( 'after_setup_theme', array( __CLASS__, 'nav_menu' ) );
        # Register or modify customizer options
        add_action( 'customize_register', array( __CLASS__, 'customize_register' ) );

        # add meta fields on post & page
        add_action('init', array( __CLASS__, 'meta_fields' ) );

        /******************
         *  Filter Hooks  *
         ******************/
        # modify excerpt
        // add_filter( 'the_excerpt', array( __CLASS__, 'excerpt' ) );
        # modify content
        add_filter( 'the_content', array( __CLASS__, 'content' ) );
        # adds sidebar classes in body tag
        add_filter( 'body_class', array( __CLASS__, 'get_sidebar_class' ) );
        # adds blog layout classes in body tag
        add_filter( 'body_class', array( __CLASS__, 'get_body_classes' ) );

        add_filter( 'woocommerce_add_to_cart_fragments', array( __CLASS__, 'add_to_cart_fragment' ) );

        /*************************
         *  Custom Action Hooks  *
         *************************/
        add_action( self::fn_prefix( 'header' ), array( __CLASS__, 'header' ) );
        #adds custom after header
        add_action( self::fn_prefix( 'after_header' ), array(__CLASS__, 'after_header' ) );
        #add latest post after header
        add_action( self::fn_prefix( 'after_header' ), array( __CLASS__, 'add_latest_post' ) );
        # adds search icon on header
        add_action( self::fn_prefix( 'after_primary_menu' ), array( __CLASS__, 'add_search_icon' ), 20 );
        #woocommerce cart icon on header
        add_action( self::fn_prefix( 'after_primary_menu' ), array( __CLASS__, 'add_cart_icon'));
        # adds menu toggler for small device
        add_action( self::fn_prefix( 'after_primary_menu' ), array( __CLASS__, 'menu_toggler'), 60);
        # displays the inner banner and breadcrumb
        add_action( self::fn_prefix( 'after_header' ), array( __CLASS__, 'the_inner_banner_content'));
        #displays footer featured news
        add_action( self::fn_prefix( 'blog_after_main_content' ), array( __CLASS__, 'footer_featured_news' ));

        /*************************
         *  Custom Filter Hooks  *
         *************************/
        # adds inner banner position classes
        add_filter( self::fn_prefix( 'inner_banner_classes' ), array( __CLASS__, 'inner_banner_class' ) );
        # show or hide category
        add_filter( self::fn_prefix( 'show_post_category' ), array( __CLASS__, 'show_post_category' ) );
        # show or hide date
        add_filter( self::fn_prefix('show_post_date'), array( __CLASS__, 'show_post_date' ) );
        # show or hide author
        add_filter( self::fn_prefix('show_post_author'), array( __CLASS__, 'show_post_author' ) );
        # show or hide breadcrumb
        add_filter( self::fn_prefix( 'show_breadcrumb' ), array( __CLASS__, 'show_breadcrumb' ) );
        # show or hide breadcrumb
        add_filter( self::fn_prefix( 'show_preloader' ), array( __CLASS__, 'show_preloader' ) ) ;
        # show or hide blog title
        add_filter( self::fn_prefix( 'blog_title' ), array( __CLASS__, 'get_blog_title' ) );
        # returns the excerpt length
        add_filter( self::fn_prefix( 'excerpt_length' ), array( __CLASS__, 'get_excerpt_length' ) );
        # disable footer widget
        add_filter( self::fn_prefix( 'disable_footer_widget' ), array( __CLASS__, 'get_footer_widget' ) );
        /*************************
         *  Footer Hook          *
         *************************/
        # hook to display footer widget
        add_action( self::fn_prefix( 'footer' ), array( __CLASS__, 'footer_widget_content' ) );
        # hook to display copyright text
        add_action( self::fn_prefix( 'copyright' ), array( __CLASS__, 'footer_copyright' ) );
        # hook to display social menu
        add_action( self::fn_prefix('copyright'), array( __CLASS__, 'footer_social_menu' ), 20 );
        # hook to display author name
        add_action( self::fn_prefix('copyright'), array(__CLASS__, 'footer_author' ), 30 );

        /**
         * adds class in footer if author is disabled
         * need to check pro, so it is called inside init hook
         * @since 1.0.0
         */
        add_action( 'init', function () {
            add_filter( self::fn_prefix( 'footer_classes' ), array( __CLASS__, 'footer_class' ) );
        });

        #rise-block plugin recommendation
        add_action( 'tgmpa_register', array( __CLASS__, 'register_required_plugins' ) );

        # if child theme is activated then save all settings of parent
        add_action( 'switch_theme', array( __CLASS__, 'save_setting_for_child' ), 10, 2 );
    }

    /**
     * Get all cart items
     *
     * @static
     * @access public
     * @since  1.0.0
     * @return object
     *
     * @package Newslist WordPress Theme
     */
    public static function add_to_cart_fragment( $fragments ) {
        $fragments['total-cart-items'] =  WC()->cart->cart_contents_count;
        return $fragments;
    }

    /**
     * Check footer widget status from page
     *
     * @static
     * @access public
     * @since  1.0.0
     * @return bool
     *
     * @package Newslist WordPress Theme
     */
    public static function get_footer_widget() {
        $disable_footer = self::get_meta( 'disable-footer-widget' );
        if ( is_page() && $disable_footer ) {
            return true;
        } elseif ( self::is_active_plugin('woocommerce') && is_shop() && $disable_footer ) {        # since 1.0.0
            return true;
        } elseif ( self::is_static_blog_page() && $disable_footer ) {                               # since 1.0.0
            return true;
        }
    }

    /**
     * Register or modify customizer options
     *
     * @static
     * @access public
     * @since  1.0.0
     * @return void
     *
     * @package Newslist WordPress Theme
     */
    public static function customize_register( $wp_customize ) {
        $color_section = self::with_prefix( 'color-section' );
        $wp_customize->get_control( 'header_textcolor' )->section = $color_section;
        $wp_customize->get_control( 'background_color' )->section = $color_section;

        $wp_customize->get_control( 'header_textcolor' )->section = 'title_tagline';
        $wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Identity Color', 'newslist' );

        # changing header image to Inner Banner options and adding inside theme option panel
        $wp_customize->get_section( 'header_image' )->title = esc_html__( 'Inner Banner Options', 'newslist' );
        $wp_customize->get_section( 'header_image' )->panel = self::with_prefix( 'panel' );
    }

    /**
     * Add meta fields for post and page
     *
     * @static
     * @access public
     * @return void
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function meta_fields() {
        # meta box for sidebar options
        $post_types = array( 'page', 'post' );
        $label = esc_html__( 'Newslist Settings', 'newslist' );
        foreach ( $post_types as $type ) {
            $post = new Newslist_Meta_Fields( $type );
            $options = array(
                'sidebar-position' => array(
                    'type'    => 'select',
                    'label'   => esc_html__( 'Sidebar Position:', 'newslist' ),
                    'default' => 'customizer',
                    'choices' => array(
                        'customizer'    => esc_html__( 'From customizer', 'newslist' ),
                        'left-sidebar'  => esc_html__( 'Left', 'newslist' ),
                        'right-sidebar' => esc_html__( 'Right', 'newslist' ),
                        'no-sidebar'    => esc_html__( 'Hide', 'newslist' ),
                    ),
                ),
            );

            if ( 'page' == $type ) {
                $page_options = array(
                    'disable-inner-banner' => array(
                        'type'  => 'checkbox',
                        'label' => esc_html__( 'Disable Banner', 'newslist' ),
                    ),
                    'disable-footer-widget' => array(
                        'type'  => 'checkbox',
                        'label' => esc_html__( 'Disable Footer Widget', 'newslist' ),
                    ),
                );

                $options = array_merge( $options, $page_options );
            }

            $post->add_meta_box( $label, $options );
        }
    }

    /**
     * print header
     *
     * @static
     * @return string
     * @since 1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function header() {
        get_template_part( 'templates/header/header', 'main' );
    }

    /**
     * Add a wrapper on inner banner and breadcrumb
     *
     * @static
     * @access public
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function the_inner_banner_content() {
        $disable = false;
        # inner banner should not load in 404 page,
        if (
            # don't load it in 404 page
            is_404() ||
            ((
                is_page() ||                                # don't load if disabled on page
                self::is_woo_shop_page() ||                 # don't load if disabled on woocommerce shop page
                self::is_static_blog_page() ||              # don't load if disabled on static blog page
                self::is_static_front_page()                # don't load if disabled on static homepage
            ) && self::get_meta( 'disable-inner-banner' )) ||
            # remove banner on woocommerce category page
            self::is_woo_product_category() ||
            # don't load it if it is blog page and title is empty
            (is_home() && is_front_page() && !self::get_blog_title())
        ) {
            $disable = true;
        }

        # since 1.0.0
        if ( apply_filters( self::fn_prefix( 'disable_inner_banner_content' ), $disable ) ) {
            return;
        }
        get_template_part( 'templates/content/content', 'banner' );
    }

    /**
     * know if the page is woocommerce shop or not

     *
     * @static
     * @access public
     * @return bool
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function is_woo_shop_page() {
        if ( self::is_active_plugin( 'woocommerce' ) && is_shop() ) {
            return true;
        }
    }

    /**
     * know if the page is woocommerce single or not
     *
     * @static
     * @access public
     * @return bool
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function is_woo_single_page() {
        if ( self::is_active_plugin( 'woocommerce' ) && is_product() ) {
            return true;
        }
    }

    /**
     * know if the page is woocommerce category or not
     *
     * @static
     * @access public
     * @return bool
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function is_woo_product_category() {
        if ( self::is_active_plugin( 'woocommerce' ) && is_product_category() ) {
            return true;
        }
    }

    /**
     * Add a wrapper on excerpt
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function excerpt( $e ) {
        $more = sprintf(
            '<a href="%1$s">%2$s<i class="fa fa-long-arrow-right" aria-hidden="true"></i> <span class="screen-reader-text"><?php   ?></span></a>',
            esc_url( get_the_permalink() ),
            esc_html__( 'Read More', 'newslist' )
        );
        $new_content = str_replace( self::excerpt_more(), '', $e );
        if ( strlen( $new_content ) != strlen( $e ) ) {
            return '<div class="entry-content-stat post-content">' . $new_content . '</div>' . $more;
        }
        return '<div class="entry-content-stat post-content">' . $e . '</div>';
    }

    /**
     * Add a wrapper on content
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function content ($c ) {
        return empty( $c ) ? $c : '<div class="post-content">' . $c . '</div>';
    }

    /**
     * Get excerpt length from customizer
     *
     * @static
     * @access public
     * @return interger
     * @since 1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function get_excerpt_length() {
        return newslist_get( 'excerpt_length' );
    }

    /**
     * when home page is latest posts this the custom title will be displayed.
     *
     * @static
     * @access public
     * @return string or false
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function get_blog_title() {
        $ib_blog_title = newslist_get( 'ib-blog-title' );
        if ( empty( $ib_blog_title ) ) {
            return false;
        } else {
            return $ib_blog_title;
        }
    }

    /**
     * Show or Hide Breadcrumb
     *
     * @static
     * @access public
     * @return boolean
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function show_breadcrumb() {
        if ( is_front_page() || is_home() ) {
            return false;
        }
        return newslist_get( 'show-breadcrumb' );
    }

    /**
     * Show or Hide Preloader
     *
     * @static
     * @access public
     * @return boolean
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function show_preloader() {
        return newslist_get( 'pre-loader' );
    }

    /**
     * Show or Hide post author in post and archive page
     *
     * @static
     * @access public
     * @return boolean
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function show_post_author() {
        return newslist_get( 'post-author' );
    }

    /**
     * Show or Hide post date in post and archive page
     *
     * @static
     * @access public
     * @return boolean
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function show_post_date() {
        return newslist_get( 'post-date' );
    }

    /**
     * Show or Hide post categories in post and archive page
     *
     * @static
     * @access public
     * @return boolean
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function show_post_category() {
        return newslist_get( 'post-category' );
    }

    /**
     * Enqueue Gutenberg assets.
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function editor_assets() {
        $scripts = array(
            array(
                'handler'   => self::with_prefix( 'block-editor-styles' ),
                'style'     => 'assets/css/block-editor-styles.css',
                'in_footer' => false,
            ),
        );
        self::enqueue( $scripts );
    }

    /**
     * Add different supports to the theme
     *
     * @static
     * @access public
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */

    public static function supports() {
        # Gutenberg wide images.
        add_theme_support( 'align-wide' );
        add_theme_support( 'wp-block-styles ');

        # Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        # Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        # Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        /*woocommerce support*/
        add_theme_support( 'woocommerce' );

        # Switch default core markup for search form, comment form, and comments.
        # to output valid HTML5.
        add_theme_support(
            'html5',
            array(
                'search-form',
                'gallery',
                'caption',
            )
        );

        # Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( self::fn_prefix( 'custom_background_args' ), array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        # Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        # Post formats.
        add_theme_support(
            'post-formats',
            array(
                'gallery',
                'image',
                'link',
                'quote',
                'video',
                'audio',
                'status',
                'aside',
            )
        );

        # Add theme support for Custom Logo.
        add_theme_support(
            'custom-logo',
            array(
                'width'       => 180,
                'height'      => 60,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );

        # Customize Selective Refresh Widgets.
        add_theme_support( 'customize-selective-refresh-widgets ');
        add_theme_support( 'post-thumbnails' );

        /**
         * This variable is intended to be overruled from themes.
         * Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
         * phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
         */
        $GLOBALS['content_width'] = apply_filters ('content_width_setup', 640 );

        /**
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'newslist', self::get_theme_path( 'languages' ) );
    }

    /**
     * Register sidebar in theme
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function sidebars() {
        # sidebar in post and pages
        register_sidebar(array(
            'name' => esc_html__( 'Sidebar', 'newslist' ),
            'id' => self::fn_prefix( 'sidebar' ),
            'description' => esc_html__( 'Widgets in this area will be shown on side of the page.', 'newslist' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        register_sidebar(array(
            'name'          =>esc_html__( 'Footer Widget Area', 'newslist' ),
            'id'            => self::fn_prefix( 'footer_widget_area' ),
            'description'   => esc_html__( 'Widgets in this area will be displayed in the footer. If empty then column will not be displayed.', 'newslist' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));  
    }
    /**
     * Register navigation bar
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function nav_menu() {
        register_nav_menus(
            array(
                'primary' => esc_html__( 'Primary', 'newslist' ),
                'social-menu-header' => esc_html__( 'Header social menu', 'newslist' ),
                'social-menu-footer' => esc_html__( 'Footer social menu', 'newslist' )
            )
        );
    }

    /**
     * Includes the customizer theme options
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */

    public static function load_theme_options() {
        self::include(array(
            'site-identity',
            'header-options',
            'typography',
            'inner-banner-options',
            'breadcrumb-options',
            'footer-options',
            'footer-featured-options',
            'color-options',
            'post-options',
            'blog-options',
            'sidebar-options',
            'reset-options',
            'advance-options',
            'top-tag-options',
            'latest-post-options',
            'go-to-pro',
        ), 'inc/theme-options', '' );
    }

    /**
     * Enqueue styles and scripts
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function scripts() {
        $scripts = array(
            array(
                'handler' => 'main-style',
                'style'   => 'style.css',
                'minified' => false,
            ),
            array(
                'handler' => 'bootstrap',
                'style'   => 'assets/css/vendor/bootstrap/bootstrap.css',
                'version' => '4.3.1',
            ),
            #font awesome is register in customier icon-select control
            array(
                'handler' => 'font-awesome',
                'style'   => 'assets/css/vendor/font-awesome/css/font-awesome.css',
                'version' => '4.7.0'
            ),
            array(
                'handler'  => 'google-font',
                'style'    => self::get_google_font(),
                'absolute' => true,
            ),
            array(
                'handler' => 'block-style',
                'style'   => 'assets/css/blocks.css',
            ),

            array(
                'handler' => 'slick-script',
                'script'   =>'assets/js/slick.js',
                'minified' => false
            ),
            array(
                'handler' => 'slick-style',
                'style'  => 'assets/css/vendor/slick.css',
                'minified' => false                
            ),
            array(
                'handler' => 'theme-style',
                'style'   => 'assets/css/main.css',
            ),
            array(
                'handler' => 'jquery-marquee',
                'script'  => 'assets/js/jquery.marquee.js',
                'minified' => false
            ),
            array(
                'handler' => 'theme-script',
                'script'  => 'assets/js/main.js',
            ),
        );

        # load rtl.css if site is RTL
        if ( is_rtl() ) {
            $scripts[] = array(
                'handler' => self::with_prefix( 'rtl' ),
                'style'   => 'rtl.css',
                'minified' => false,
            );
        }
        self::enqueue( $scripts );

        # enqueue comment-reply.js in single page only
        if ( ( is_single() || is_page() ) && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Get class of sidebar to display in site
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function get_sidebar_class( $classes ) {
        $page_template = is_page_template('page-templates/full-width.php');
        
        if ( $page_template || is_search() || self::is_woo_single_page() || self::is_woo_product_category() ) {
            $classes[] = self::with_prefix( 'no-sidebar' );
        } else {
            $customizer_position = newslist_get( 'sidebar-position' );
            $post_position       = self::get_meta( 'sidebar-position' );
            $post_position = $post_position == '' ? 'customizer' : $post_position;
            if ( !self::is_woo_shop_page() && ( is_attachment() || is_archive() || self::is_latest_post_page() || 'customizer' == $post_position ) ) {
                $classes[] = self::with_prefix( $customizer_position );
            } elseif ( $post_position ) {
                if ( self::is_woo_shop_page() && 'customizer' == $post_position ) {
                    $post_position = $customizer_position;
                }
                $classes[] = self::with_prefix( $post_position );
            }
        }
        return apply_filters( self::with_prefix( 'get_sidebar_class' ), $classes );
    }

    /**
     * Determines sidebar is active or not
     *
     * @static
     * @access public
     * @return boolean
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function is_sidebar_active() {
        $cls = self::get_sidebar_class( array() );
        return !in_array( self::with_prefix('no-sidebar'), $cls );
    }

    /**
     * Adds sidebar in pages
     *
     * @static
     * @access public
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function the_sidebar() {
        if ( self::is_sidebar_active() ) : ?>
            <div class="col-md-4 col-lg-4 sidebar-order">
                <?php get_sidebar(); ?>
            </div>
        <?php endif;
    }

    /**
     * Add class to manage position of inner-banner.
     *
     * @static
     * @access public
     * @return array
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function inner_banner_class( $classes ) {
        $classes[] = newslist_get( 'ib-text-align' );
        if ( has_header_image() ) {
            $classes[] = newslist_get( 'ib-image-attachment' );
        }
        $classes[] = self::with_prefix( 'inner-banner-wrapper' );
        return $classes;
    }

    /**
     * Add class to display blog ( list or grid ).
     *
     * @static
     * @access public
     * @return array
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function get_body_classes( $classes ) {
        # Container class
        if ( 'box' == newslist_get( 'container-width' ) ) {
            $classes[] = self::with_prefix( 'container-box' );
        }

        if( '1' == newslist_get( 'post-per-row' ) ) {
            $classes[] = self::with_prefix( 'post-one' );
        }
        return $classes;
    }

    /**
     * Rise blocks plugin recommendation
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function register_required_plugins() {
        $plugins = array(
            array(
                'name'     => esc_html__( 'Rise Blocks - A Complete Gutenberg Page builder', 'newslist' ),
                'slug'     => 'rise-blocks',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'RT Easy Builder – Advanced addons for Elementor', 'newslist' ),
                'slug'     => 'rt-easy-builder-advanced-addons-for-elementor',
                'required' => false,
            ),
        );
        tgmpa($plugins);
    }

    /**
     * Adds Search icon in header
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function add_search_icon() { ?>
        <div class="<?php echo self::with_prefix( 'header-icons' ); ?>">
            <a href="#" class="<?php echo self::with_prefix( array ( 'search-icons', 'toggle-search' ) ); ?>">
                <i class="fa fa-search"></i>
            </a>
        </div>
    <?php }

    /**
     * Adds menu toggler for small devies
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function menu_toggler() { ?>
        <button class="menu-toggler" id="menu-icon">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span class="screen-reader-text"> <?php echo esc_html__( 'Menu Icon', 'newslist' ); ?></span>
        </button>
    <?php }

    /**
     * Adds cart icon on header if woocommerce is active
     *
     * @static
     * @access public
     * @since  1.0.0
     * @return bool
     *
     * @package Newslist WordPress Theme
     */
    public static function add_cart_icon() {
        if ( !self::is_active_plugin( 'woocommerce' ) ) {
            return;
        }
        if ( is_cart() || is_checkout() ) {
            return;
        }
        $count = WC()->cart->cart_contents_count;
        $string  = wc_get_cart_url(); ?>
        <div class="newslist-woocommerce-cart"> 
            <a href="<?php echo esc_url( $string ); ?>" class="cart-icon">
                <i class="fa fa-shopping-cart"></i>
                <span><?php echo ( $count > 0 ) ? esc_html( $count ) : 0; ?></span>
            </a>
        </div>
<?php
    }

    /**
     * Get Footer widget content
     *
     * @static
     * @access public
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function footer_widget_content() {
        get_template_part( 'templates/footer/footer', 'widget' );
    }

    /**
     * Get copyright text for footer
     *
     * @static
     * @access public
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function footer_copyright() {
        get_template_part( 'templates/footer/footer', 'copyright' );
    }

    /**
     * Get social menu for footer
     *
     * @static
     * @access public
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function footer_social_menu() {
        if ( !newslist_get( 'footer-social-menu' ) ) {
            return;
        }
        get_template_part( 'templates/footer/footer', 'social' );
    }

    /**
     * Get author section
     *
     * @static
     * @access public
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function footer_author() {
        get_template_part( 'templates/footer/footer', 'author' );
    }

    /**
     * Get class to fix design on footer
     *
     * @static
     * @access public
     * @return string
     * @since 1.00
     *
     * @package Newslist WordPress Theme
     */
    public static function footer_class( $classes ) {
        if ( !newslist_get( 'footer-author-show' )) {
            $classes[] = self::with_prefix( 'author-disabled' );
        }
        return $classes;
    }

    /**
     * if child theme is activated then save all settings of parent
     *
     * $previous - get the previously active theme, $parent - get the parent
     * of current theme, will be false if no parent, $stylesheet - current stylesheet name
     * $lastActive - has the theme being activated ever been activated before?
     * before if condition - if previouly active theme is the parent of the child
     * theme being activated and it has never been activated before
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function save_setting_for_child( $new_name, \WP_Theme $new_theme ) {
        $previous = get_option( 'theme_switched', -1 );
        $parent = $new_theme->parent() ? $new_theme->get_template() : false;
        $stylesheet = get_option( 'stylesheet' );
        $lastActive = get_option( $stylesheet . '_last_active', false );
        if ( !$lastActive && $parent === $previous ) {
            # update "last_active" option so following code won't run again for this theme
            update_option( $stylesheet . '_last_active', current_time( 'timestamp', 1 ) );
            # get the theme mods of the parent
            $previousMods = get_option ( 'theme_mods_' . $parent, array() );
            # update theme mods from parent theme to child theme
            update_option( 'theme_mods_' . $stylesheet, $previousMods );
        }
    }

    /**
     * Get class for post per row
     *
     * @static
     * @access public
     * @since 1.0.06
     * @return string
     *
     * @package Newslist WordPress Theme
     */
    public static function the_post_per_row_class( $class = '' ) {
        $post_per_row = newslist_get( 'post-per-row' );
        if ( '1' == $post_per_row ) {
            $class = 'col-md-12';
        } elseif ( '2' == $post_per_row ) {
            $class = 'col-12 col-sm-6';
        } elseif ( '3' == $post_per_row ) {
            $class = 'col-12 col-sm-4';
        } elseif ( '4' == $post_per_row ) {
            $class = 'col-12 col-sm-3';
        }
        echo esc_attr( $class );
    }

    /**
     * Get top tag section
     *
     * @static
     * @access public
     * @since  1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function after_header() {
        if ( !newslist_get( 'top-tag-status' ) ) {
            return;
        }
        get_template_part( 'templates/content/content', 'top-tag' );
    }

    /**
     * Get latest post section
     *
     * @static
     * @access public
     * @since  1.0.0
     * 
     * @package Newslist WordPress Theme
     */

    public static function add_latest_post() {
        if ( !newslist_get( 'latest-post-status' ) ) {
            return;
        }
        get_template_part( 'templates/content/content', 'latest-post' );
    }

    /**
     * Get array for tags
     *
     * @static
     * @access public
     * @since 1.0.0
     * @return string
     *
     * @package Newslist WordPress Theme
     */
    public static function get_tags_list() {
        $val = array( 0 => esc_html__( '--select--', 'newslist' ) );
        $tags = get_tags();
        foreach ( $tags as $t ) {
            $val[$t->term_id] = $t->name;
        }
        return $val;
    }

    /**
     * Get according to type
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Newslist WordPress Theme
     */
    public static function get_posts_by_type( $type, $cat_id, $post_to_display = false ) {
        $posts = array();
        if ( 'latest' == $type ) {
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => $post_to_display ? $post_to_display : -1,
                'post_status' => 'publish'
            ));
            foreach ( $recent_posts as $post ) {
                $posts[] = $post[ 'ID' ];
            }
        } elseif ( 'category' == $type ) {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $post_to_display ? $post_to_display : -1,
                'ignore_sticky_posts' => 1,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            if  ($cat_id ) {
                $args[ 'cat' ] = $cat_id;
            }
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $posts[] = get_the_ID();
                }
            }
            wp_reset_postdata();
        }
        if ( empty( $posts ) ) {
            return false;
        } else {
            return $posts;
        }
    }

    /**
     * Get footer featured news
     *
     * @static
     * @access public
     * @since 1.0.0
     * @return object
     *
     * @package Newslist WordPress Theme
     */
    public static function footer_featured_news() {
        if (is_archive() || is_search() || !newslist_get( 'enable-footer-featured-news' ) ) {
            return;
        }
        get_template_part( 'templates/blog/footer-featured', 'news' );
    }

    /**
     * Get category related post
     *
     * @static
     * @access public
     * @since 1.0.0
     * @return object
     *
     * @package Newslist WordPress Theme
     */
    public static function the_cats_related_post() {
        $post_id = get_the_ID();
        $cat_ids = array();
        $categories = get_the_category( $post_id );
        if ( !empty( $categories ) ) {
            foreach ( $categories as $category ) {
                $cat_ids[] = $category->term_id;
            }
        }
        $query_args = array(
            'category__in'      => $cat_ids,
            'post_type'             => 'post',
            'post__not_in'       => array( $post_id ),
            'posts_per_page'  => 3,
        );
        $related_cats_post = new WP_Query( $query_args );
        if ( $related_cats_post->have_posts() ) { ?>
            <h2 class="newslist-related-post-title">
                <?php esc_html_e( newslist_get( 'related-post' ) ); ?>
            </h2>
            <div class="newslist-related-post-inner">
                <?php  while ( $related_cats_post->have_posts() ) {
                    $related_cats_post->the_post();
                    if( has_post_thumbnail( ) ) {
                        $url = get_the_post_thumbnail_url();
                    } else {
                        $url = get_template_directory_uri()."/assets/img/default-image.jpg";
                    }
                    $thumb_id = get_post_thumbnail_id( get_the_ID() );
                    $alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
                    set_query_var( 'post_url', array(
                        'url' => $url,
                        'alt' => $alt,
                    ) );
                    get_template_part( 'templates/content/content-single', 'related' );
                }
            }
            wp_reset_postdata(); ?> 
            </div>
            <?php
            }
}

new Newslist_Theme();
