<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Meta News
 */

get_header();

meta_news_layout_primary();
?>
	<div class="column-inner">
		<main id="main" class="site-main">

		<?php if ( is_home() && !is_front_page() ) {

			if ( ($meta_news_settings['meta_news_banner_display'] === 'front-blog' && ($meta_news_settings['meta_news_banner_slider_posts_hide'] === 0 || $meta_news_settings['meta_news_banner_featured_posts_1_hide'] === 0 || $meta_news_settings['meta_news_banner_featured_posts_2_hide'] === 0)) || $meta_news_settings['meta_news_header_featured_posts_hide'] === 0 ) { ?>

				<h2 class="stories-title"><span><?php echo get_the_title(get_option('page_for_posts')); ?></span></h2>

			<?php } else { ?>

				<header class="page-header">
					<h2 class="page-title"><?php echo get_the_title(get_option('page_for_posts')); ?> </h2>
				</header><!-- .page-header -->

			<?php }

		}

		if ( have_posts() ) : ?>
			<div class="row post-wrap">
				<?php /* Start the Loop */
				 while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile; ?>
			</div><!-- .row .post-wrap -->

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
