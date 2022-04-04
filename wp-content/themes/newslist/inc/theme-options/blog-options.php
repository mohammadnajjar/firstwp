<?php

/**
 * Register blog Options
 *
 * @return void
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 */
function newslist_blog_options()
{
	Newslist_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > color options
		'section' => array(
			'id'       => 'blog-section',
			'title'    => esc_html__('Blog Options', 'newslist'),
			'priority' => 25
		),
		'fields'  => array(
			array(
				'id'	=> 'meta-sections-order',
				'label' => esc_html__('Archive Meta Order', 'newslist'),
				'description' => esc_html__('Please make sure that you have enabled all sections under "Post Options"', 'newslist'),
				'type'  => 'newslist-section-order',
				'default' => json_encode(array(
					'title', 'date', 'category', 'excerpt', 'comment'
				)),
				'choices' => array(
					'title' => esc_html__('Title', 'newslist'),
					'date' => esc_html__('Date', 'newslist'),
					'category' => esc_html('Category', 'newslist'),
					'excerpt' => esc_html__('Excerpt', 'newslist'),
					'comment' => esc_html__('Comment', 'newslist')
				),
				'transport'   => 'refresh'
			),
		),
	));
}
add_action('init', 'newslist_blog_options');
