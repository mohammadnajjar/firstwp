<?php
/**
 * Upsell Customizer options
 *
 * @package Elsie
 */

$wp_customize->register_section_type( Elsie_Upsell::class );

$wp_customize->add_section(
	new Elsie_Upsell( $wp_customize, 'elsie_pro', [
		'title'       => esc_html__( 'Elsie Pro', 'elsie' ),
		'button_text' => esc_html__( 'See Pro Features', 'elsie' ),
		'button_url'  => 'https://elfwp.com/themes/elsie/?utm_source=customizer&utm_medium=elsie_customizer&utm_campaign=Elsie',
		'priority'      => 0,
	] )
);