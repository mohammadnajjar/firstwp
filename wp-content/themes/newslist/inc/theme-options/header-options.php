<?php
if( !function_exists( 'newslist_acb_banner_image' ) ):
	/**
	* Active callback function of banner image
	*
	* @static
	* @access public
	* @return boolen
	* @since 1.0.0
	*
	* @package Newslist WordPress Theme
	*/
	function newslist_acb_banner_image( $control ){
		$value = $control->manager->get_setting( Newslist_Helper::with_prefix( 'banner' ) )->value();
		return $value;
	}
endif;
function newslist_banner_image() {
    Newslist_Customizer::set(array(
        #Theme option
        'panel'     => 'panel',
        #Theme Option > Banner Image
        'section'   => array(
            'id'         => 'banner',
            'title'      => esc_html__(  'Header Options', 'newslist' ),
            'priority' => 1
        ),
        'fields' => array(
            array(
                'id'    => 'banner-image',
                'label' => esc_html__( 'Header Banner Image',  'newslist'),
                'type' => 'image',
            ),
            array(
                'id'    => 'banner-link',
                'label' => esc_html__( 'Add link to the image', 'newslist' ),
                'type' => 'text', 
            ),
            array(
                'id'    => 'banner-link-open-newtab',
                'label' => esc_html__( 'Open link in new tab', 'newslist' ),
                'type' => 'toggle',
                'default'   => false
            ),
        ),
    ));
}

add_action ( 'init', 'newslist_banner_image');