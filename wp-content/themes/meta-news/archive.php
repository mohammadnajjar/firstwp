<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Meta News
 */

get_header();

	meta_news_layout_primary(); ?>
	<div class="column-inner">
		<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' ); ?>
				</header><!-- .page-header -->

				<div class="row post-wrap">
					<?php /* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile; ?>
				</div><!-- .row .post-wrap-->

				<?php the_posts_pagination( array(
					'prev_text' => __( 'Previous', 'meta-news' ),
					'next_text' => __( 'Next', 'meta-news' ),
					)
				);

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- .column-inner -->
	</div><!-- #primary -->

<?php
do_action('meta_news_sidebar');
get_footer();
