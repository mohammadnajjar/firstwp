<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elsie
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php 
	do_action( 'elsie_single_item_content_before', $is_page = false );

	do_action( 'elsie_single_item_content', $is_page = false );
	
	do_action( 'elsie_single_item_content_after', $is_page = false );
?>

</article><!-- #post-<?php the_ID(); ?> -->