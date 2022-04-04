<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Meta News
 */

get_header();

	meta_news_layout_primary(); ?>
	<div class="column-inner">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'meta-news' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="row post-wrap">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

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
