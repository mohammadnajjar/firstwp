<?php

if ( !function_exists( 'meta_news_get_option_defaults' ) ) {
	/**
	 * Function for default option.
	 */
	function meta_news_get_option_defaults() {
		$meta_news_array_of_default_settings = array(
			'meta_news_header_sitebranding_center'						=> get_theme_mod('meta_news_header_sitebranding_center', 0),
			'meta_news_header_sitebranding_inline'						=> get_theme_mod('meta_news_header_sitebranding_inline',0),
			'meta_news_content_layout' 								=> get_theme_mod('meta_news_content_layout','right'),
			'meta_news_nav_uppercase'									=> get_theme_mod('meta_news_nav_uppercase',1),
			'meta_news_breadcrumbs_hide'								=> get_theme_mod('meta_news_breadcrumbs_hide',0),
			'meta_news_top_bar_hide'									=> get_theme_mod('meta_news_top_bar_hide',0),
			'meta_news_top_bar_social_profiles'						=> get_theme_mod('meta_news_top_bar_social_profiles',0),
			'meta_news_header_bg_overlay' 								=> get_theme_mod('meta_news_header_bg_overlay','none'),
			'meta_news_header_background'								=> get_theme_mod('meta_news_header_background',''),
			'meta_news_header_add_image'								=> get_theme_mod('meta_news_header_add_image',''),
			'meta_news_header_add_link'								=> get_theme_mod('meta_news_header_add_link',''),
			'meta_news_top_stories_hide'								=> get_theme_mod('meta_news_top_stories_hide', 0),
			'meta_news_top_stories_title'								=> get_theme_mod('meta_news_top_stories_title', 'TOP STORIES'),
			'meta_news_top_stories_style'								=> get_theme_mod('meta_news_top_stories_style', 'style_1'),
			'meta_news_top_stories_latest_post'						=> get_theme_mod('meta_news_top_stories_latest_post', 'latest'),
			'meta_news_top_stories_categories'							=> get_theme_mod('meta_news_top_stories_categories', array()),
			'meta_news_banner_display'									=> get_theme_mod('meta_news_banner_display', 'front-blog'),
			'meta_news_banner_slider_posts_hide'						=> get_theme_mod('meta_news_banner_slider_posts_hide', 0),
			'meta_news_banner_slider_posts_title'						=> get_theme_mod('meta_news_banner_slider_posts_title', 'MAIN STORIES'),
			'meta_news_banner_slider_latest_post'						=> get_theme_mod('meta_news_banner_slider_latest_post', 'latest'),
			'meta_news_banner_slider_post_categories' 					=> get_theme_mod('meta_news_banner_slider_post_categories', array()),
			'meta_news_banner_featured_posts_1_hide'					=> get_theme_mod('meta_news_banner_featured_posts_1_hide', 0),
			'meta_news_banner_featured_posts_1_title'					=> get_theme_mod('meta_news_banner_featured_posts_1_title', 'EDITOR\'S PICK'),
			'meta_news_banner_featured_posts_1_latest_post'			=> get_theme_mod('meta_news_banner_featured_posts_1_latest_post', 'latest'),
			'meta_news_banner_featured_posts_1_post_categories' 		=> get_theme_mod('meta_news_banner_featured_posts_1_post_categories', array()),
			'meta_news_banner_featured_posts_2_hide'					=> get_theme_mod('meta_news_banner_featured_posts_2_hide', 0),
			'meta_news_banner_featured_posts_2_title'					=> get_theme_mod('meta_news_banner_featured_posts_2_title', 'TRENDING STORIES'),
			'meta_news_banner_featured_posts_2_latest_post'			=> get_theme_mod('meta_news_banner_featured_posts_2_latest_post', 'latest'),
			'meta_news_banner_featured_posts_2_post_categories' 		=> get_theme_mod('meta_news_banner_featured_posts_2_post_categories', array()),
			'meta_news_header_featured_posts_hide'						=> get_theme_mod('meta_news_header_featured_posts_hide', 0),
			'meta_news_header_featured_posts_banner_display'			=> get_theme_mod('meta_news_header_featured_posts_banner_display', 'front-blog'),
			'meta_news_header_featured_posts_title'					=> get_theme_mod('meta_news_header_featured_posts_title', 'POPULAR STORIES'),
			'meta_news_header_featured_latest_post'					=> get_theme_mod('meta_news_header_featured_latest_post', 'latest'),
			'meta_news_header_featured_post_categories'				=> get_theme_mod('meta_news_header_featured_post_categories', array()),
			'meta_news_footer_featured_posts_hide'						=> get_theme_mod('meta_news_footer_featured_posts_hide', 0),
			'meta_news_footer_featured_posts_title'					=> get_theme_mod('meta_news_footer_featured_posts_title', 'RECOMMENDED'),
			'meta_news_footer_featured_latest_post'					=> get_theme_mod('meta_news_footer_featured_latest_post', 'latest'),
			'meta_news_footer_featured_post_categories'				=> get_theme_mod('meta_news_footer_featured_post_categories', array()),
			'meta_news_featured_image_page'							=> get_theme_mod('meta_news_featured_image_page', 1),
			'meta_news_featured_image_single'							=> get_theme_mod('meta_news_featured_image_single', 1),
			'meta_news_archive_title_label_hide'						=> get_theme_mod('meta_news_archive_title_label_hide', 0),
			'meta_news_posts_meta_hide_posts_category'					=> get_theme_mod('meta_news_posts_meta_hide_posts_category', 0),
			'meta_news_posts_meta_hide_posts_date'						=> get_theme_mod('meta_news_posts_meta_hide_posts_date', 0),
			'meta_news_posts_meta_hide_posts_author'					=> get_theme_mod('meta_news_posts_meta_hide_posts_author', 0),
			'meta_news_posts_meta_hide_posts_comment'					=> get_theme_mod('meta_news_posts_meta_hide_posts_comment', 1),
			'meta_news_posts_meta_hide_single_post_category'			=> get_theme_mod('meta_news_posts_meta_hide_single_post_category', 0),
			'meta_news_posts_meta_hide_single_post_date'				=> get_theme_mod('meta_news_posts_meta_hide_single_post_date', 0),
			'meta_news_posts_meta_hide_single_post_author'				=> get_theme_mod('meta_news_posts_meta_hide_single_post_author', 0),
			'meta_news_posts_meta_hide_single_post_comment'			=> get_theme_mod('meta_news_posts_meta_hide_single_post_comment', 1),
			'meta_news_posts_meta_hide_single_post_tags'				=> get_theme_mod('meta_news_posts_meta_hide_single_post_tags', 0),
		);
		return apply_filters( 'meta_news_get_option_defaults', $meta_news_array_of_default_settings );
	}
}

if ( !function_exists( 'meta_news_social_profiles_list' ) ) {
	/**
	 * Function for default option.
	 */
	function meta_news_social_profiles_list() {
		$meta_news_array_social_profiles = array(
			'meta_news_social_profile_facebook' 			=> array( 'class' => 'facebook-f', 'title' => __('Facebook', 'meta-news') ),
			'meta_news_social_profile_instagram' 			=> array( 'class' => 'instagram', 'title' => __('Instagram', 'meta-news') ),
			'meta_news_social_profile_twitter' 			=> array( 'class' => 'twitter', 'title' => __('Twitter', 'meta-news') ),
			'meta_news_social_profile_youtube' 			=> array( 'class' => 'youtube', 'title' => __('Youtube', 'meta-news') ),
		);
		return $meta_news_array_social_profiles;
	}
}