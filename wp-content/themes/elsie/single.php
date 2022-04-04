<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Elsie
 */

get_header();
?>

	<?php do_action( 'elsie_single_before' ); ?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'elsie_post_content_before' );

			get_template_part( 'template-parts/content', 'single' );

			do_action( 'elsie_post_content_after' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php do_action( 'elsie_single_after' ); ?>

<?php
do_action( 'elsie_sidebar' );
get_footer();
