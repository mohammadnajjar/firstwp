<?php 
/* Primary Color Section Inside Core Color Option */
$wp_customize->add_setting( 'promos_options[promos_primary_color]',
    array(
        'default'           => $default['promos_primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(                 
        $wp_customize,
        'promos_options[promos_primary_color]',
        array(
            'label'       => esc_html__( 'Primary Color', 'promos' ),
            'description' => esc_html__( 'Change your whole site color from here. More are available in premium version.', 'promos' ),
            'section'     => 'colors',  
        )
    )
);

