<?php
/**
 * Footer Setting
 *
 * @package Best_Shop
 */
if( ! function_exists( 'best_shop_customize_register_footer' ) ) :

function best_shop_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => esc_html__( 'Footer Settings', 'best-shop' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
            'panel'    => 'theme_options',
            'description' => __( 'Customize footer copyright and link. Footer link can be changed in Pro version.', 'best-shop' ),

        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => best_shop_default_settings('footer_copyright'),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'       => esc_html__( 'Footer Copyright Text', 'best-shop' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector'        => '.footer-bottom .site-info .copy-right',
        'render_callback' => 'best_shop_get_footer_copyright',
    ) );
    
    
    //Link
    
    $wp_customize->add_setting(
        'footer_link',
        array(
            'default'           => best_shop_default_settings('footer_link'),
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
    'footer_link',
    array(
        'label'       => esc_html__( 'Footer Link', 'best-shop' ),
        'section'     => 'footer_settings',
        'type'        => 'url',
        'active_callback' => 'best_shop_pro',
    )
    );

    $wp_customize->selective_refresh->add_partial( 'footer_link', array(
    'selector'        => '.footer-bottom .site-info .link',
    'render_callback' => 'best_shop_get_footer_copyright',
    
    ) );
        
}
endif;
add_action( 'customize_register', 'best_shop_customize_register_footer' );