<?php
/**
* Register Go to pro button
*
* @since 1.0.1
*
* @package Newslist WordPress Theme
*/
function newslist_go_to_pro(){
	Newslist_Customizer::set(array(
		'section' => array(
			'id'       => 'go-to-pro', 
			'type'     => 'anchor',
			'title'    => esc_html__( 'Newslist Pro - Unlock Features', 'newslist' ),
			'url'      => esc_url( 'https://risethemes.com/product-downloads/newslist-pro/' ),
			'priority' => 0
		)
	) );
}
add_action( 'init', 'newslist_go_to_pro' );