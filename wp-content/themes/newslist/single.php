<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */
get_header();
?>
<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr( Newslist_Theme::is_sidebar_active() ? 'col-lg-8' : 'col-lg-12' ); ?> content-order">
				<div id="primary" class="content-area">
					<main id="main" class="post-main-content" role="main">
						<?php
						# Loop Start
						while ( have_posts() ) :
							the_post();
						?>
							<article <?php Newslist_Helper::schema_body( 'article' ); ?> class="newslist-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-content">
									<?php
										the_content();

										Newslist_Helper::post_content_navigation();

										get_template_part ('templates/meta', 'info' );

									?>								
								</div><!-- .entry-content -->
							</article><!-- #post-<?php the_ID(); ?> -->
							<div class="newslist-sidebar-inner-box">
								<?php Newslist_Helper::single_post_navigation(); ?>
							</div>
							<div class="newslist-sidebar-inner-box">						
								<?php if ( comments_open() || get_comments_number() ) {
									comments_template();
								} ?>
							</div>
							<div class="newslist-sidebar-inner-box">
								<?php Newslist_Theme::the_cats_related_post(); ?>
							</div>
						<?php endwhile; ?>
					</main>
				</div> 
			</div>
			<?php Newslist_Theme::the_sidebar(); ?>
		</div>	
	</div>
</div>
<?php get_footer(); ?>