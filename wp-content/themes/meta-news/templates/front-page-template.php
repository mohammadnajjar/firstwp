<?php
/**
 * Template Name: Front Page Template
 *
 * Displays the Front Page Layout of the theme.
 *
 * @package Theme Horse
 * @subpackage Meta News
 * @since Meta News 1.1
 */
get_header(); ?>

	<main id="main" class="site-main" role="main">
		<?php if ( is_active_sidebar('meta_news_front_page_3column_section_column1') || is_active_sidebar('meta_news_front_page_3column_section_column2') || is_active_sidebar('meta_news_front_page_3column_section_column3') ) : ?>
			<div class="frontpage-3col-sidebar-section">
				<div class="container">
					<div class="row justify-content-center site-content-row">

						<div class="col-lg-5 widget-area frontpage-sidebar-1 frontpage-secondary sticky-column-bottom">
							<div class="column-inner">
								<?php dynamic_sidebar( 'meta_news_front_page_3column_section_column1' ); ?>
							</div><!-- .column-inner -->
						</div><!-- .col-lg-5 .widget-area .frontpage-sidebar-1 .frontpage-secondary .sticky-column-bottom -->

						<div class="col-lg-3 widget-area frontpage-sidebar-2 frontpage-secondary sticky-column-bottom">
							<div class="column-inner">
								<?php dynamic_sidebar( 'meta_news_front_page_3column_section_column2' ); ?>
							</div><!-- .column-inner -->
						</div><!-- .col-lg-3 .widget-area .frontpage-sidebar-2 .frontpage-secondary .sticky-column-bottom -->

						<div class="col-lg-4 widget-area frontpage-sidebar-3 frontpage-secondary sticky-column-bottom">
							<div class="column-inner">
								<?php dynamic_sidebar( 'meta_news_front_page_3column_section_column3' ); ?>
							</div><!-- .column-inner -->
						</div><!-- .col-lg-4 .widget-area .frontpage-sidebar-3 .frontpage-secondary .sticky-column-bottom -->

					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .frontpage-3col-sidebar-section -->
		<?php endif;

		if ( is_active_sidebar('meta_news_front_page_2column_section_column1') || is_active_sidebar('meta_news_front_page_2column_section_column2') ) : ?>
			<div class="frontpage-2col-sidebar-section">
				<div class="container">
					<div class="row justify-content-center site-content-row">

						<div class="col-lg-6 widget-area frontpage-sidebar-4 frontpage-primary sticky-column-bottom">
							<div class="column-inner">
								<?php dynamic_sidebar( 'meta_news_front_page_2column_section_column1' ); ?>
							</div><!-- .column-inner -->
						</div><!-- .col-lg-6 .widget-area .frontpage-sidebar-4 .frontpage-primary .sticky-column-bottom -->

						<div class="col-lg-6 widget-area frontpage-sidebar-5 frontpage-primary sticky-column-bottom">
							<div class="column-inner">
								<?php dynamic_sidebar( 'meta_news_front_page_2column_section_column2' ); ?>
							</div><!-- .column-inner -->
						</div><!-- .col-lg-6 .widget-area .frontpage-sidebar-5 .frontpage-primary .sticky-column-bottom -->

					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- frontpage-2col-sidebar-section -->
		<?php endif; ?>

	</main><!-- #main .site-main -->

<?php get_footer();