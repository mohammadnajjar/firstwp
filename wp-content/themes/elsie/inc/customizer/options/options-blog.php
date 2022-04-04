<?php
/**
 * Blog Customizer options
 *
 * @package Elsie
 */

$wp_customize->add_panel( 'elsie_panel_blog', array(
	'priority'       => 19,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Blog', 'elsie' ),
) );

/**
 * Archives
 */
$wp_customize->add_section(
	'elsie_section_blog_archives',
	array(
		'title'         => esc_html__( 'Blog archives', 'elsie'),
		'priority'      => 11,
		'panel'         => 'elsie_panel_blog',
	)
);

$wp_customize->add_setting(
	'blog_archives_tabs',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Tabs( $wp_customize, 'blog_archives_tabs',
	array(
		'linked'			=> 'blog_archives_tabs',
		'label'    		=> esc_html__( 'Settings', 'elsie' ),
		'label2'    	=> esc_html__( 'Styling', 'elsie' ),
		'connected'		=> 'elsie_section_blog_archives',
		'connected2'	=> 'elsie_section_blog_archives_styling',
		'section'  		=> 'elsie_section_blog_archives',
	)
) );

$wp_customize->add_setting(
	'blog_layout_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_layout_title',
	array(
		'label'    			=> esc_html__( 'Layout', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives',
	)
) );

$wp_customize->add_setting(
	'blog_layout',
	array(
		'default'           => 'classic',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Elsie_Radio_Images(
		$wp_customize,
		'blog_layout',
		array(
			'label'    		=> esc_html__( 'Blog layout', 'elsie' ),
			'section'  => 'elsie_section_blog_archives',
			'columns'	=> 2,
			'choices'  => array(
				'list' => array(
					'label' => esc_html__( 'List', 'elsie' ),
					'url'   => '%s/assets/img/list.svg'
				),
				'grid' => array(
					'label' => esc_html__( 'Grid', 'elsie' ),
					'url'   => '%s/assets/img/grid.svg'
				),	
				'classic' => array(
					'label' => esc_html__( 'Classic', 'elsie' ),
					'url'   => '%s/assets/img/classic.svg'
				),		
				'masonry' => array(
					'label' => esc_html__( 'Masonry', 'elsie' ),
					'url'   => '%s/assets/img/masonry.svg'
				),											
			),
			'priority' 			=> 10,
		)
	)
); 

$wp_customize->add_setting( 'blog_grid_columns',
	array(
		'default' 			=> 'columns2',
		'sanitize_callback' => 'elsie_sanitize_text'
	)
);
$wp_customize->add_control( new Elsie_Radio_Buttons( $wp_customize, 'blog_grid_columns',
	array(
		'label'   => esc_html__( 'Columns', 'elsie' ),
		'section' => 'elsie_section_blog_archives',
		'columns' => 3,
		'choices' => array(
			'columns2' 	=> '2',
			'columns3' 	=> '3',
			'columns4' 	=> '4',
		),
		'active_callback'	=> 'elsie_blog_grid_callback'
	)
) );


$wp_customize->add_setting(
	'blog_sidebar_layout',
	array(
		'default'           => 'sidebar-right',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Elsie_Radio_Images(
		$wp_customize,
		'blog_sidebar_layout',
		array(
			'label'    		=> esc_html__( 'Sidebar layout', 'elsie' ),
			'section'  => 'elsie_section_blog_archives',
			'columns'	=> 3,
			'choices'  => array(
				'no-sidebar' => array(
					'label' => esc_html__( 'None', 'elsie' ),
					'url'   => '%s/assets/img/nosidebar.svg'
				),
				'sidebar-left' => array(
					'label' => esc_html__( 'Left', 'elsie' ),
					'url'   => '%s/assets/img/leftsidebar.svg'
				),	
				'sidebar-right' => array(
					'label' => esc_html__( 'Right', 'elsie' ),
					'url'   => '%s/assets/img/rightsidebar.svg'
				),												
			),
			'priority' 			=> 10,
		)
	)
); 

$wp_customize->add_setting(
	'posts_navigation',
	array(
		'default'           => 'pagination',
		'sanitize_callback' => 'elsie_sanitize_select',
	)
);
$wp_customize->add_control(
	'posts_navigation',
	array(
		'type'      => 'select',
		'label'     => esc_html__( 'Posts navigation', 'elsie' ),
		'section'   => 'elsie_section_blog_archives',
		'choices'   => array(
			'none' 			=> esc_html__( 'None', 'elsie' ),
			'pagination' 	=> esc_html__( 'Pagination', 'elsie' ),
			'navigation' 	=> esc_html__( 'Older/Newer posts links', 'elsie' ),
		),
	)
);  

$wp_customize->add_setting(
	'blog_elements_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_elements_title',
	array(
		'label'    			=> esc_html__( 'Post card', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives',
	)
) );

$wp_customize->add_setting( 'post_item_elements', array(
	'default'  => array( 'loop_category', 'loop_post_title', 'loop_post_meta', 'loop_image', 'loop_post_excerpt', 'loop_read_more' ),
	'sanitize_callback'	=> 'elsie_sanitize_blog_post_elements'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'post_item_elements', array(
	'label'   		=> esc_html__( 'Elements', 'elsie' ),
	'description'   => esc_html__( 'Drag and drop post elements', 'elsie' ),
	'section' => 'elsie_section_blog_archives',
	'choices' => array(
		'loop_image' 		=> esc_html__( 'Featured image', 'elsie' ),
		'loop_category' 	=> esc_html__( 'Categories', 'elsie' ),
		'loop_post_title' 	=> esc_html__( 'Title', 'elsie' ),
		'loop_post_excerpt' => esc_html__( 'Excerpt', 'elsie' ),
		'loop_read_more' 	=> esc_html__( 'Read more link', 'elsie' ),
		'loop_post_meta' 	=> esc_html__( 'Author & Date', 'elsie' ),
	),
) ) );

$wp_customize->add_setting(
	'post_card_style',
	array(
		'default'           => 'regular',
		'sanitize_callback' => 'elsie_sanitize_select',
	)
);
$wp_customize->add_control(
	'post_card_style',
	array(
		'type'      => 'select',
		'label'     => esc_html__( 'Card style', 'elsie' ),
		'section'   => 'elsie_section_blog_archives',
		'choices'   => array(
			'regular' 	=> esc_html__( 'Regular', 'elsie' ),
			'boxed' 	=> esc_html__( 'Boxed', 'elsie' ),
		),
	)
);  

$wp_customize->add_setting( 'post_card_content_align',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'elsie_sanitize_text',
		'transport'			=> 'postMessage'
	)
);
$wp_customize->add_control( new Elsie_Radio_Buttons( $wp_customize, 'post_card_content_align',
	array(
		'label'   => esc_html__( 'Content alignment', 'elsie' ),
		'section' => 'elsie_section_blog_archives',
		'columns' => 3,
		'choices' => array(
			'left' 		=> '<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M12.83 352h262.34A12.82 12.82 0 00288 339.17v-38.34A12.82 12.82 0 00275.17 288H12.83A12.82 12.82 0 000 300.83v38.34A12.82 12.82 0 0012.83 352zm0-256h262.34A12.82 12.82 0 00288 83.17V44.83A12.82 12.82 0 00275.17 32H12.83A12.82 12.82 0 000 44.83v38.34A12.82 12.82 0 0012.83 96zM432 160H16a16 16 0 00-16 16v32a16 16 0 0016 16h416a16 16 0 0016-16v-32a16 16 0 00-16-16zm0 256H16a16 16 0 00-16 16v32a16 16 0 0016 16h416a16 16 0 0016-16v-32a16 16 0 00-16-16z"/></svg>',
			'center' 	=> '<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 160H16a16 16 0 00-16 16v32a16 16 0 0016 16h416a16 16 0 0016-16v-32a16 16 0 00-16-16zm0 256H16a16 16 0 00-16 16v32a16 16 0 0016 16h416a16 16 0 0016-16v-32a16 16 0 00-16-16zM108.1 96h231.81A12.09 12.09 0 00352 83.9V44.09A12.09 12.09 0 00339.91 32H108.1A12.09 12.09 0 0096 44.09V83.9A12.1 12.1 0 00108.1 96zm231.81 256A12.09 12.09 0 00352 339.9v-39.81A12.09 12.09 0 00339.91 288H108.1A12.09 12.09 0 0096 300.09v39.81a12.1 12.1 0 0012.1 12.1z"/></svg>',
			'right' 	=> '<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M16 224h416a16 16 0 0016-16v-32a16 16 0 00-16-16H16a16 16 0 00-16 16v32a16 16 0 0016 16zm416 192H16a16 16 0 00-16 16v32a16 16 0 0016 16h416a16 16 0 0016-16v-32a16 16 0 00-16-16zm3.17-384H172.83A12.82 12.82 0 00160 44.83v38.34A12.82 12.82 0 00172.83 96h262.34A12.82 12.82 0 00448 83.17V44.83A12.82 12.82 0 00435.17 32zm0 256H172.83A12.82 12.82 0 00160 300.83v38.34A12.82 12.82 0 00172.83 352h262.34A12.82 12.82 0 00448 339.17v-38.34A12.82 12.82 0 00435.17 288z"/></svg>',
		),
	)
) );

$wp_customize->add_setting( 'post_card_element_spacing',
	array(
		'default' 			=> 12,
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'elsie_sanitize_range'
	)
);
$wp_customize->add_control( new Elsie_Slider_Control( $wp_customize, 'post_card_element_spacing',
	array(
		'label' => esc_html__( 'Element spacing', 'elsie' ),
		'section' => 'elsie_section_blog_archives',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
			'unit' => 'px'
		),
	)
) );

$wp_customize->add_setting(
	'blog_elements_image_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_elements_image_title',
	array(
		'label'    			=> esc_html__( 'Featured images', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives',
		'active_callback'	=> 'elsie_blog_featured_image_callback'
	)
) );

$wp_customize->add_setting(
	'blog_image_hover',
	array(
		'default'           => 'opacity',
		'sanitize_callback' => 'elsie_sanitize_select',
	)
);
$wp_customize->add_control(
	'blog_image_hover',
	array(
		'type'      => 'select',
		'label'     => esc_html__( 'Hover effects', 'elsie' ),
		'section'   => 'elsie_section_blog_archives',
		'choices'   => array(
			'none' 		=> esc_html__( 'None', 'elsie' ),
			'opacity' 	=> esc_html__( 'Opacity', 'elsie' ),
			'zoomin' 	=> esc_html__( 'Zoom in', 'elsie' ),
			'zoominr' 	=> esc_html__( 'Zoom in & rotate', 'elsie' ),
		),
		'active_callback'	=> 'elsie_blog_featured_image_callback'
	)
);  

$wp_customize->add_setting( 'blog_image_radius',
	array(
		'default' 			=> 0,
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'elsie_sanitize_range'
	)
);
$wp_customize->add_control( new Elsie_Slider_Control( $wp_customize, 'blog_image_radius',
	array(
		'label' => esc_html__( 'Image radius', 'elsie' ),
		'section' => 'elsie_section_blog_archives',
		'input_attrs' => array(
			'min' => 0,
			'max' => 300,
			'step' => 1,
			'unit' => 'px'
		),
		'active_callback'	=> 'elsie_blog_featured_image_callback'
	)
) );

$wp_customize->add_setting(
	'blog_image_stretch',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'blog_image_stretch',
		array(
			'label'         	=> esc_html__( 'Stretch image to card edges', 'elsie' ),
			'section'       	=> 'elsie_section_blog_archives',
			'active_callback'	=> 'elsie_blog_card_boxed_callback'
		)
	)
);

$wp_customize->add_setting(
	'blog_elements_cats_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_elements_cats_title',
	array(
		'label'    			=> esc_html__( 'Categories', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives',
		'active_callback'	=> 'elsie_blog_cats_callback'
	)
) );

$wp_customize->add_setting(
	'post_cats_style',
	array(
		'default'           => 'link',
		'sanitize_callback' => 'elsie_sanitize_select',
	)
);
$wp_customize->add_control(
	'post_cats_style',
	array(
		'type'      => 'select',
		'label'     => esc_html__( 'Style', 'elsie' ),
		'section'   => 'elsie_section_blog_archives',
		'choices'   => array(
			'solid' 	=> esc_html__( 'Solid', 'elsie' ),
			'link' 		=> esc_html__( 'Link', 'elsie' ),
		),
		'active_callback'	=> 'elsie_blog_cats_callback'
	)
); 

$wp_customize->add_setting(
	'post_cats_position',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'elsie_sanitize_select',
	)
);
$wp_customize->add_control(
	'post_cats_position',
	array(
		'type'      => 'select',
		'label'     => esc_html__( 'Position', 'elsie' ),
		'section'   => 'elsie_section_blog_archives',
		'choices'   => array(
			'default' 	=> esc_html__( 'Default', 'elsie' ),
			'absolute' 	=> esc_html__( 'Over image', 'elsie' ),
		),
		'active_callback'	=> 'elsie_blog_cats_callback'
	)
); 

$wp_customize->add_setting(
	'blog_elements_content_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_elements_content_title',
	array(
		'label'    			=> esc_html__( 'Excerpt', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives',
		'active_callback'	=> 'elsie_blog_excerpt_callback'
	)
) );


$wp_customize->add_setting(
	'excerpt_length',
	array(
		'sanitize_callback' => 'absint',
		'default'           => 22,
	)       
);
$wp_customize->add_control( 'excerpt_length', array(
	'type'        => 'number',
	'section'     => 'elsie_section_blog_archives',
	'label'       => esc_html__( 'Excerpt length', 'elsie' ),
	'input_attrs' => array(
		'min'   => 0,
		'max'   => 200,
		'step'  => 1,
	),
	'active_callback'	=> 'elsie_blog_excerpt_callback'
) );


$wp_customize->add_setting(
	'blog_elements_postmeta_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_elements_postmeta_title',
	array(
		'label'    			=> esc_html__( 'Author & Date', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives',
		'active_callback'   => 'elsie_blog_post_meta_callback'
	)
) );
$wp_customize->add_setting(
	'blog_elements_show_author',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'blog_elements_show_author',
		array(
			'label'         	=> esc_html__( 'Show author', 'elsie' ),
			'section'       	=> 'elsie_section_blog_archives',
			'active_callback'   => 'elsie_blog_post_meta_callback'
		)
	)
);

$wp_customize->add_setting(
	'blog_elements_show_date',
	array(
		'default'           => 1,
		'sanitize_callback' => 'elsie_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Elsie_Toggle_Control(
		$wp_customize,
		'blog_elements_show_date',
		array(
			'label'         	=> esc_html__( 'Show date', 'elsie' ),
			'section'       	=> 'elsie_section_blog_archives',
			'active_callback'   => 'elsie_blog_post_meta_callback'
		)
	)
);

$wp_customize->add_setting(
	'blog_elements_readmore_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_elements_readmore_title',
	array(
		'label'    			=> esc_html__( 'Read more link', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives',
		'active_callback'   => 'elsie_blog_read_more_callback'
	)
) );

$wp_customize->add_setting(
	'read_more_text',
	array(
		'sanitize_callback' => 'elsie_sanitize_text',
		'default'           => esc_html__( 'Read more', 'elsie' ),
	)       
);
$wp_customize->add_control( 'read_more_text', array(
	'type'        => 'text',
	'section'     => 'elsie_section_blog_archives',
	'label'       => esc_html__( 'Read more text', 'elsie' ),
	'active_callback'   => 'elsie_blog_read_more_callback'
) );

/**
 * Styling
 */
$wp_customize->add_section(
	'elsie_section_blog_archives_styling',
	array(
		'title'         => esc_html__( 'Blog archives styling', 'elsie'),
		'priority'      => 11,
		'panel'         => 'elsie_panel_blog',
	)
);

$wp_customize->add_setting(
	'blog_archives_tabs_styling',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Tabs( $wp_customize, 'blog_archives_tabs_styling',
	array(
		'linked'			=> 'blog_archives_tabs',
		'label'    		=> esc_html__( 'Settings', 'elsie' ),
		'label2'    	=> esc_html__( 'Styling', 'elsie' ),
		'connected'		=> 'elsie_section_blog_archives',
		'connected2'	=> 'elsie_section_blog_archives_styling',
		'section'  		=> 'elsie_section_blog_archives_styling',
	)
) );

//Post title
$wp_customize->add_setting(
	'blog_archives_post_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_archives_post_title',
	array(
		'label'    			=> esc_html__( 'Post title', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives_styling',
	)
) );

$wp_customize->add_setting(
	'blog_archives_title_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'blog_archives_title_color',
		array(
			'label'    => esc_html__( 'Color', 'elsie' ),
			'section'  => 'elsie_section_blog_archives_styling',
		)
	)
);

$wp_customize->add_setting( 'blog_archives_title_size_desktop', array(
	'default'   => 38,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'blog_archives_title_size_tablet', array(
	'default'	=> 32,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'blog_archives_title_size_mobile', array(
	'default'	=> 24,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Elsie_Responsive_Number( $wp_customize, 'blog_archives_title_size',
	array(
		'label' => esc_html__( 'Font size', 'elsie' ),
		'section' => 'elsie_section_blog_archives_styling',
		'settings'   => array (
			'blog_archives_title_size_desktop',
			'blog_archives_title_size_tablet',
			'blog_archives_title_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
			'unit'	=> 'px'
		),		
	)
) );

$wp_customize->add_setting( 'blog_archives_title_transform',
	array(
		'default' 			=> 'none',
		'sanitize_callback' => 'elsie_sanitize_text',
		'transport'	=> 'postMessage',
	)
);
$wp_customize->add_control( new Elsie_Radio_Buttons( $wp_customize, 'blog_archives_title_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'elsie' ),
		'section' => 'elsie_section_blog_archives_styling',
		'columns' => 4,
		'choices' => array(
			'none' 			=> esc_html__( '-', 'elsie' ),
			'lowercase' 	=> esc_html__( 'aa', 'elsie' ),
			'capitalize' 	=> esc_html__( 'Aa', 'elsie' ),
			'uppercase' 	=> esc_html__( 'AA', 'elsie' ),
		),
	)
) );

//Meta
$wp_customize->add_setting(
	'blog_blog_archives_meta',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Elsie_Title( $wp_customize, 'blog_blog_archives_meta',
	array(
		'label'    			=> esc_html__( 'Meta', 'elsie' ),
		'section'  			=> 'elsie_section_blog_archives_styling',
	)
) );

$wp_customize->add_setting(
	'blog_archives_meta_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'blog_archives_meta_color',
		array(
			'label'    => esc_html__( 'Color', 'elsie' ),
			'section'  => 'elsie_section_blog_archives_styling',
		)
	)
);

$wp_customize->add_setting( 'blog_archives_meta_size_desktop', array(
	'default'   => 13,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'blog_archives_meta_size_tablet', array(
	'default'	=> 13,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'blog_archives_meta_size_mobile', array(
	'default'	=> 13,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Elsie_Responsive_Number( $wp_customize, 'blog_archives_meta_size',
	array(
		'label' => esc_html__( 'Font size', 'elsie' ),
		'section' => 'elsie_section_blog_archives_styling',
		'settings'   => array (
			'blog_archives_meta_size_desktop',
			'blog_archives_meta_size_tablet',
			'blog_archives_meta_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
			'unit'	=> 'px'
		),		
	)
) );

$wp_customize->add_setting( 'blog_archives_meta_transform',
	array(
		'default' 			=> 'none',
		'sanitize_callback' => 'elsie_sanitize_text',
		'transport'	=> 'postMessage',
	)
);
$wp_customize->add_control( new Elsie_Radio_Buttons( $wp_customize, 'blog_archives_meta_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'elsie' ),
		'section' => 'elsie_section_blog_archives_styling',
		'columns' => 4,
		'choices' => array(
			'none' 			=> esc_html__( '-', 'elsie' ),
			'lowercase' 	=> esc_html__( 'aa', 'elsie' ),
			'capitalize' 	=> esc_html__( 'Aa', 'elsie' ),
			'uppercase' 	=> esc_html__( 'AA', 'elsie' ),
		),
	)
) );