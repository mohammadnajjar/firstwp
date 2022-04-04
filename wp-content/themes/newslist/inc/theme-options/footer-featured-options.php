<?php 

if( !function_exists( 'newslist_acb_enable_footer_featured')):
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
    function newslist_acb_enable_footer_featured( $control ) {
        $value = $control->manager->get_setting( Newslist_Helper::with_prefix( 'enable-footer-featured-news' ) )->value();
		return $value;
    }
endif;

if( !function_exists( 'newslist_acb_enable_footer_featured_cat' ) ):
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
	function newslist_acb_enable_footer_featured_cat( $control ){
		$top_story = $control->manager->get_setting( Newslist_Helper::with_prefix( 'enable-footer-featured-news' ) )->value();
		$type = $control->manager->get_setting( Newslist_Helper::with_prefix( 'footer-featured-type' ) )->value();
		return $top_story && 'category' == $type;
	}
endif;

/**
* Blog page Footer Features options
*
* @return void
* @since 1.0.0
*
* @package Newslist WordPress Theme
*/

function newslist_footer_featured_options() {
    Newslist_Customizer::set(array(
		#Theme Option
        'panel'     => 'panel',
        # Theme Option > Footer Featured News Options
        'section' => array(
            'id'            => 'footer_featured_news',
            'title'         => esc_html__( 'Footer Featured News', 'newslist' ),
            'priority'   => 10,
        ),
        'fields' => array(
            array(
                'id'        => 'enable-footer-featured-news',
                'label'    => esc_html__( 'Enable', 'newslist' ),
                'default' => true,
                'type'      => 'toggle',
            ),
            array(
                'id'        => 'footer-featured-title',
                'label'     => esc_html__( 'Title', 'newslist' ),
                'default' => esc_html__( 'You Missed', 'newslist' ),
				'active_callback' =>  'acb_enable_footer_featured',
                'type'  => 'text',
                'partial' =>array(
                    'selector' => '.newslist-you-missed h2',
                ),
            ), 
			array(
				'id'	=> 'footer-featured-type',
				'label' => esc_html__( 'Featured News Type', 'newslist' ),
				'active_callback' => 'acb_enable_footer_featured',
				'type'    => 'buttonset',
				'default' => 'latest',
				'choices' => array(
                    'latest' 	=> esc_html__( 'Latest Post', 'newslist' ),
                    'category'	=> esc_html__( 'From Category', 'newslist' ),
                ),
			),
			array(
				'id' => 'footer-featured-cat',
				'label' => esc_html__( 'Select Category', 'newslist' ),
				'default' => 1,
				'active_callback' => 'acb_enable_footer_featured_cat',
				'type' => 'newslist-category-dropdown',
            ),
        ),
    ));
}
add_action( 'init', 'newslist_footer_featured_options' );