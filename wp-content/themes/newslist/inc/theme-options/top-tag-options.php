<?php
if( !function_exists( 'newslist_abc_top_tag' ) ):
	/**
	* Active callback function of top tag post
	*
	* @static
	* @access public
	* @return boolen
	* @since 1.0.0
	*
	* @package Newslist WordPress Theme
	*/
	function newslist_abc_top_tag( $control ){
		$value = $control->manager->get_setting( Newslist_Helper::with_prefix( 'top-tag-status' ) )->value();
		return $value;
	}
endif;
function newslist_top_tag_options() {
    Newslist_Customizer::set(array(
        # Theme option
        'panel' => 'panel',
        # Theme Option > Top Bar
        'section' => array(
            'id' => 'top-tag-status',
            'title' => esc_html__( 'Top Tag Options', 'newslist' ),
            'priority' =>6,
        ),
        'fields' => array(
            array(
                'id' => 'top-tag-status',
                'label' => esc_html__( 'Enable', 'newslist' ),
                'default' => false,
                'type' => 'toggle'
            ), 
            array(
                'id' => 'top-tag-title',
                'label' => esc_html__( 'Title', 'newslist' ),
                'default' => esc_html__( 'Top Tag', 'newslist' ),
                'type' => 'text',
                'active_callback' => 'abc_top_tag',
                'partial' => array(
                    'selector' => '.newslist-tags'
                )
            ),
            array(
                'id' => 'top-tag-list',
                'label' => esc_html__( 'Select Tags', 'newslist' ),
                'default' => 0,
                'type' => 'multiple-select',
                'active_callback' => 'abc_top_tag',
                'description' => esc_html__( 'Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.', 'newslist' ),
                'choices' => Newslist_Theme::get_tags_list(),
            ),
            array( 
                'id' => 'top-tag-bg-color',
                'label' => esc_html__( 'Tag background color', 'newslist' ),
                'default' => '#0a0808',
                'type' => 'color-picker',
                'active_callback' => 'abc_top_tag',
            ),
            array(
                'id' => 'top-tag-bg-color-hover',
                'label' => esc_html__( 'Tag background color hover', 'newslist' ),
                'default' => '#0a0808', 
                'type' => 'color-picker',
                'active_callback' => 'abc_top_tag',
            ),
            array(
                'id' => 'top-tag-text-color',
                'label' => esc_html__( 'Tag text color', 'newslist' ),
                'default' => '#ffffff',
                'type' => 'color-picker',
                'active_callback' => 'abc_top_tag',
            ),
            array(
                'id' => 'newslist-time',
                'label' => esc_html__( 'Show time and date', 'newslist' ),
                'default' => true, 
                'type' => 'toggle',
                'active_callback' => 'abc_top_tag'
            ),
        ),
    ));
}
add_action('init', 'newslist_top_tag_options');
