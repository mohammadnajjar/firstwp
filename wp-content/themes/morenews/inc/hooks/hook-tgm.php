<?php
/**
 * Recommended plugins
 *
 * @package MoreNews
 */

if ( ! function_exists( 'morenews_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function morenews_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'AF Companion', 'morenews' ),
                'slug'     => 'af-companion',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Elespare – News Magazine and Blog Widgets and Template Kits for Elementor with Header/Footer Builder', 'morenews' ),
                'slug'     => 'elespare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Blockspare - Beautiful Page Building Gutenberg Blocks for WordPress', 'morenews' ),
                'slug'     => 'blockspare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Latest Posts Block Lite', 'morenews' ),
                'slug'     => 'latest-posts-block-lite',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Magic Content Box Lite', 'morenews' ),
                'slug'     => 'magic-content-box-lite',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'WP Post Author', 'morenews' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),

        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'morenews_recommended_plugins' );
