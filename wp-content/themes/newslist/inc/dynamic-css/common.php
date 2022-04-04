<?php
/**
 * Common css for all devices
 *
 * @since 1.0.0
 * @package Newslist WordPress Theme
 */

add_action( 'init', Newslist_Helper::fn_prefix( 'custom_width' ), 99 );
add_action( 'customize_preview_init', Newslist_Helper::fn_prefix( 'custom_width' ), 150 );

/**
 * Adjust custom width
 *
 * @since 1.0.0
 * @package Newslist WordPress Theme
 */
function newslist_custom_width() {
	// echo newslist_get( 'container-width' );die;
	if ( 'default' == newslist_get( 'container-width' ) ) :
		# container width
		$style = array(
			array(
				'selector' => '.container',
				'props' => array(
					'max-width' => 'container-custom-width',
				)
			)
		);

		Newslist_Css::add_styles( $style, 'md' );
	endif;
}

add_action( 'init', 'newslist_all_device_css' );
/**
 * Register dynamic css
 *
 * @since 1.0.0
 * @package Newslist WordPress Theme
 */
function newslist_all_device_css() {
	$style = array(
		# Primary Color
		array(
			'selector' => '.newslist-navigation-n-options, span.newsline-time,  .newslist-latest-post-wrapper .newslist-latest-post-inner 
			.newslist-latest-post, .newslist-latest-post-wrapper .newslist-latest-post-inner .newslist-latest-post .newslist-latest-post-title span:before,
			.newslist-header-wrapper .newslist-header-top .newslist-time-wrapper .newslist-digital-clock-wrapper span.newslist-time, 
			.newslist-social-menu ul a:before, .widget-area .widget h2.widget-title:before,
			.newslist-time-wrapper .newslist-digital-clock-wrapper span.newslist-time, .newslist-you-missed .newslist-you-missed-title h2,
			.slick-slider .newslist-arrow-prev, .slick-slider .newslist-arrow-next, .comment-respond .comment-form input[type="submit"]',
			'.newslist-navigation-n-options, span.newslist-time, .newslist-latest-post-wrapper .newslist-latest-post-inner .newslist-latest-post,
			.newslist-latest-post-wrapper .newslist-latest-post-inner .newslist-latest-post .newslist-latest-post-title span:before, 
			.newslist-header-wrapper .newslist-header-top .newslist-time-wrapper .newslist-digital-clock-wrapper span.newslist-time, 
			.newslist-social-menu ul a:before, .widget-area .widget h2.widget-title, .widget-area .widget h2.widget-title:before,
			.newslist-time-wrapper .newslist-digital-clock-wrapper span.newslist-time, .newslist-you-missed .newslist-you-missed-title h2,
			.slick-slider .newslist-arrow-prev, .slick-slider .newslist-arrow-next, .newslist-sidebar-inner-box .newslist-related-post-title, 
			.comment-respond .comment-form input[type="submit, .newslist-btns-wrapper .newslist-woocommerce-cart .cart-icon span"]', 
			'props' => array(
				'background-color' => 'primary-color',
			)
		),
		array(
			'selector' => '#infinite-handle span, .newslist-main-menu > ul li a, .newslist-main-menu div > ul li a, .newslist-btns-wrapper .newslist-woocommerce-cart .cart-icon',
			'props' => array(
				'color' => 'primary-menu-item-color',
			)
		),
		array(
			'selector' => 'a.cart-icon span',
			'props' => array(
				'background' => 'primary-menu-item-color',
			)
		),
		array(
			'selector' => Newslist_Helper::with_prefix_selector( '.product-with-slider %s-arrow svg, .product-with-slider %s-arrow svg:hover' ),
			'props' => array(
				'fill' => 'primary-color',
			)
		),
		array(
			'selector' => Newslist_Helper::with_prefix_selector( '%s-post .entry-content-stat + a:hover, %s-bottom-header-wrapper %s-header-icons %s-search-icon, .pagination .nav-links > *, ul.wc-block-grid__products li.wc-block-grid__product del span.woocommerce-Price-amount.amount, .woocommerce ul.products li.product a.woocommerce-LoopProduct-link del span.woocommerce-Price-amount.amount, ul.wc-block-grid__products li.wc-block-grid__product del, .woocommerce ul.products li.product .star-rating, ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title a:hover, .single-product .product .entry-summary .product_meta > span a, .single-product .stars a, .single-product .star-rating span::before, .wc-block-grid__product-rating .wc-block-grid__product-rating__stars span:before, .single-product .product .entry-summary .star-rating span::before, .single-product .product .entry-summary a.woocommerce-review-link, .woocommerce .star-rating, .woocommerce del, li.wc-layered-nav-rating a, .woocommerce ul.products li.product-category.product h2 mark.count, a.cart-icon, a.cart-icon:visited' ),
			'props' => array(
				'color' => 'primary-color',
			)
		),
		array(
			'selector' => Newslist_Helper::with_prefix_selector( '.pagination .nav-links > *, %s-post.sticky, .newslist-you-missed .newslist-you-missed-title' ), 
			'props' => array(
				'border-color' => 'primary-color',
			)
		),
		array(
			'selector' => Newslist_Helper::with_prefix_selector( '.pagination .nav-links > *, %s-post.sticky' ), 
			'props' => array(
				'border-color' => 'primary-color',
			)
		),

		// tag-color picker

		array(
			'selector' =>'.newlist-tag-wrapper .newslist-tag-inner .newlist-tag-list li a, 
			.post .post-categories li a, .wp-block-tag-cloud a, 
			.newlist-tag-wrapper .newslist-tag-inner .newslist-tag .newlist-tag-list li a, .post-categories li a,
			.newslist-time-wrapper .newslist-digital-clock-wrapper span.newslist-time', 
			'props' => array(
				'background-color' => 'top-tag-bg-color',
			)
		),
		array(
			'selector' => '.newlist-tag-wrapper .newslist-tag-inner .newlist-tag-list li a:hover, 
			.newlist-tag-wrapper .newslist-tag-inner .newslist-tag .newlist-tag-list li a:hover, 
			.post-categories li a:hover, .slick-slider .newslist-arrow-prev:hover svg, .slick-slider .newslist-arrow-next:hover, 
			.newslist-time-wrapper .newslist-digital-clock-wrapper span.newslist-time:hover, .wp-block-tag-cloud a:hover', 
			'props' => array(
				'background-color' => 'top-tag-bg-color-hover',
			)
		),
		array(
			'selector' => '.newlist-tag-wrapper .newslist-tag-inner .newlist-tag-list li a, 
			.post .post-categories li a, .wp-block-tag-cloud a, 
			.newlist-tag-wrapper .newslist-tag-inner .newslist-tag .newlist-tag-list li a, .post-categories li a, 
			.newslist-time-wrapper .newslist-digital-clock-wrapper span.newslist-time',
			'props' => array(
				'color' => 'top-tag-text-color',
			)
		),

		# Typography
		array(
			'selector' => '.site-branding .site-title, .site-branding .site-description, .site-title a',
			'props'    => array(
				'font-family' => 'site-info-font'
			)
		),
		array(
			'selector' => 'body',
			'props'    => array(
				'font-family' => 'body-font'
			)
		),
		array(
			'selector'  => 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a',
			'props'	=> array(
				'font-family' => 'heading-font',
			),
		),
		# Color Options
		array(
			'selector'  => 'body, body p, body div, .woocommerce-Tabs-panel, div#tab-description, .woocommerce-tabs.wc-tabs-wrapper',
			'props'		=> array(
				'color' => 'body-paragraph-color',
			),
		),
		array(
			'selector'  => Newslist_Helper::with_prefix_selector( '%s-main-menu > ul > li > a, %s-search-icons, %s-search-icons:visited, .newslist-btns-wrapper .newslist-woocommerce-cart .cart-icon i' ),
			'props'		=> array(
				'color' => 'primary-menu-item-color',
			),
		),
		array(
			'selector'  => 'body a, body a:visited, .newslist-post .post-title a, 
			.newslist-latest-post-wrapper .newslist-latest-post-inner .newslist-latest-post-slider a',
			'props'		=> array(
				'color' => 'link-color',
			),
		),
		array(
			'selector'  => 'body a:hover, .newslist-post .post-title a:hover,  .site-branding .site-title a:hover, 
			.post-content-wrap p > a:hover, .newslist-post .newslist-comments a:hover, 
			.footer-bottom-section .credit-link a:hover, .footer-widget ul li a:hover, .footer-widget a:hover,
			.wrap-breadcrumb ul li a:hover, .wrap-breadcrumb ul li a span:hover, #secondary .widget a:hover,
			#secondary .widget ul li a:hover, .newslist-latest-post-wrapper .newslist-latest-post-inner .newslist-latest-post-slider a:hover,
			.wp-block-tag-cloud a:hover, .post-navigation .nav-links > div a:hover span, body a:hover, .newslist-btns-wrapper .newslist-woocommerce-cart .cart-icon i:hover',
			'props'		=> array(
				'color' => 'link-hover-color',
			),
		),
		array(
			'selector'  => '#secondary .widget-title, .sidebar-order aside section h2',
			'props'		=> array(
				'color' => 'sb-widget-title-color',
			),
		),
		array(
			'selector'  => '#secondary .widget, #secondary .widget a, #secondary .widget ul li a',
			'props'		=> array(
				'color' => 'sb-widget-content-color',
			),
		),
		array(
			'selector'  => '.footer-widget .widget-title, .footer-widget .footer-widget-wrapper section .widget-title,
			.footer-widget .footer-widget-wrapper section h2',
			'props'		=> array(
				'color' => 'footer-title-color',
			),
		),
		array(
			'selector'  => '.footer-top-section',
			'props'		=> array(
				'background-color' => 'footer-top-background-color',
			),
		),
		array(
			'selector'  => '.footer-bottom-section',
			'props'		=> array(
				'background-color' => 'footer-copyright-background-color',
			),
		),
		array(
			'selector'  => '.footer-widget, .footer-widget p, .footer-widget span, .footer-widget ul li a,  
			#calendar_wrap #wp-calendar th, #calendar_wrap td, #calendar_wrap caption, #calendar_wrap td a, 
			.footer-widget ul li, .footer-widget .footer-widget-wrapper section p',
			'props'		=> array(
				'color' => 'footer-content-color',
			),
		),
		array(
			'selector'  => '.footer-bottom-section span, .footer-bottom-section .credit-link',
			'props'		=> array(
				'color' => 'footer-copyright-text-color',
			),
		),
		# inner banner
		array(
			'selector' => Newslist_Helper::with_prefix_selector( '%s-inner-banner-wrapper:after' ),
			'props'    => array(
				'background-color' => 'ib-background-color'
			)
		),
		array(
			'selector' => Newslist_Helper::with_prefix_selector( '%s-inner-banner-wrapper %s-inner-banner .entry-title' ),
			'props'    => array(
				'color' => 'ib-title-color'
			)
		),
		# Breadcrumb
		array(
			'selector'  => '.wrap-breadcrumb ul.trail-items li a:after',
			'props'		=> array(
				'content' => 'bc-separator',
			),
		),
		array(
			'selector'  => '.wrap-breadcrumb ul li a, .wrap-breadcrumb ul li span, .taxonomy-description p',
			'props'		=> array(
				'color' => 'ib-title-color'
			),
		),
	);
	Newslist_Css::add_styles( $style, 'md' );
}
