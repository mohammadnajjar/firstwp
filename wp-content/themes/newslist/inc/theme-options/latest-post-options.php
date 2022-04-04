<?php 
if( !function_exists( 'newslist_acb_top_stories' ) ):
	/**
	* Active callback function of top stories post
	*
	* @static
	* @access public
	* @return boolen
	* @since 1.0.0
	*
	* @package Newslist WordPress Theme
	*/
	function newslist_acb_top_stories( $control ){
		$value = $control->manager->get_setting( Newslist_Helper::with_prefix( 'latest-post-status' ) )->value();
		return $value;
	}
endif;

if( !function_exists( 'newslist_acb_top_stories_type' ) ):
	/**
	* Active callback function of top stories type
	*
	* @static
	* @access public
	* @return boolen
	* @since 1.0.0
	*
	* @package Newslist WordPress Theme
	*/
	function newslist_acb_top_stories_type( $control ) {
		$top_story = $control->manager->get_setting( Newslist_Helper::with_prefix( 'latest-post-status' ) )->value();
		$type = $control->manager->get_setting( Newslist_Helper::with_prefix( 'latest-post-type' ) )->value();
		return $top_story && 'category' == $type;
	}
endif;
function newslist_latest_post() {
    Newslist_Customizer::set(array(
        //Add theme options to panel
        'panel' => 'panel', 
        //Add section 
        'section' => array(
            'id' => 'latest-post',
            'title' => esc_html__( 'Latest Post Options', 'newslist' ),
            'priority' => 7,
        ),
        'fields' => array(
            array(
                'id' => 'latest-post-status',
                'label' => esc_html__( 'Enable', 'newslist' ),
                'default' => true,
                'type' => 'toggle',
            ),
            array(
                'id'        => 'latest-post-title',
                'label'     => esc_html__( 'Add title', 'newslist' ),
                'default' => esc_html__( 'Latest Post', 'newslist' ),
                'active_callback' => 'acb_top_stories',
                'type' => 'text',
            ),
            array(
                'id' => 'latest-no-post',
                'label' => esc_html__( 'Number of posts to display', 'newslist' ),
                'active_callback' => 'acb_top_stories',
                'default' => 2,
                'type' => 'number',
            ),
            array(
                'id' => 'latest-post-type',
                'title' => esc_html__( 'Latest Post Type', 'newslist' ),
                'active_callback' => 'acb_top_stories',
                'type' => 'buttonset',                
                'default' => 'latest',
                'choices' => array(
                    'latest' => esc_html__( 'Latest Post', 'newslist' ),
                    'category' => esc_html__( 'From category', 'newslist' ),
                ),
            ),
            array(
                'id'    => 'latest-post-cat',
                'title'  => esc_html__( 'Latest post by category', 'newslist' ),
                'active_callback' => 'acb_top_stories_type',
                'default' => 1,                
                'type' => 'newslist-category-dropdown',
            ),
        ),
    ));
}

add_action( 'init', 'newslist_latest_post' );
