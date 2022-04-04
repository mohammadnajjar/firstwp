<?php
/**
 * Create options for posts.
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 */

function newslist_post_options() {
    Newslist_Customizer::set(array(
        # Theme Options
        'panel' => 'panel',
        # Theme Options > Page Options > Settings
        'section' => array(
            'id' => 'post-options',
            'title' => esc_html__( 'Post Options', 'newslist' ),
        ),
        'fields' => array(
            array(
                'id' => 'post-category',
                'label'   =>  esc_html__( 'Show Categories', 'newslist' ),
                'default' => 1,
                'type' => 'toggle',
            ),
            array(
                'id' => 'post-date',
                'label'  => esc_html__( 'Show Date', 'newslist' ),
                'default' => 1,
                'type' => 'toggle',
            ),
            array(
                'id' => 'post-author',
                'label' =>  esc_html__( 'Show Author', 'newslist' ),
                'default' => 1,
                'type' => 'toggle',
            ),
            array(
                'id' => 'excerpt_length',
                'label' => esc_html__( 'Excerpt Length', 'newslist' ),
                'description' => esc_html__( 'Defaults to 10.', 'newslist' ),
                'default' => 10,
                'type' => 'number',
            ),
            array(
                'id' => 'read-more-text',
                'label' => esc_html__( 'Read More Text', 'newslist' ),
                'default' => esc_html__( 'Read More', 'newslist' ),
                'type' => 'text'
            ),
            array(
                'id' => 'post-per-row',
                'label' => esc_html__( 'Post Per Row', 'newslist' ),
                'type' => 'buttonset',
                'default' => '2',
                'choices' => array(
                    '1' => esc_html__( '1', 'newslist' ),
                    '2' => esc_html__( '2', 'newslist' ),
                    '3' => esc_html__( '3', 'newslist' ),
                    '4' => esc_html__( '4', 'newslist' )
                )
            ),
        ),
    ));
}

add_action( 'init', 'newslist_post_options' );
