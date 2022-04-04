<?php
/**
 * Block styles
 *
 * @package Elsie
 */


/**
 * Register theme based blog styles
 */
function elsie_register_block_styles() {

	register_block_style( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
		'core/post-template',
		array(
			'name'  => 'elsie-counter',
			'label' => __( 'With counter', 'elsie' ),		
		)
	);

	register_block_style( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
		'core/post-terms',
		array(
			'name'  => 'elsie-solid-cats',
			'label' => __( 'Solid', 'elsie' ),
			'isdefault' => true,		
		)
	);

	register_block_style( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
		'core/heading',
		array(
			'name'  => 'elsie-no-margins',
			'label' => __( 'No margins', 'elsie' ),
		)
	);
	
}
add_action( 'init', 'elsie_register_block_styles' );