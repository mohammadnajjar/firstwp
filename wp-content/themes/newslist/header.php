<?php

/**
 * The Header for our theme.
 *
 * @since 1.0.0 
 *
 * @package Newslist WordPress theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="<?php echo get_bloginfo( 'name' ); ?> " content="width=device-width, initial-scale=1">
	<meta description="<?php echo get_bloginfo( 'description' ); ?>" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php Newslist_Helper::schema_body( 'body' );
		body_class(); ?>>
	<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} ?>
	<?php do_action( Newslist_Helper::fn_prefix ('after_body' ) );

	do_action( Newslist_Helper::fn_prefix( 'before_header' ) );

	do_action( Newslist_Helper::fn_prefix( 'header' ) );

	do_action( Newslist_Helper::fn_prefix( 'after_header' ) );
