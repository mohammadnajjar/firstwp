<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Meta News
 */

?>
		<?php global $meta_news_settings; ?>
		<?php if ( !is_page_template('templates/front-page-template.php') ) { ?>
				</div><!-- row -->
			</div><!-- .container -->
		<?php } ?>
	</div><!-- #content .site-content-->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( $meta_news_settings['meta_news_footer_featured_posts_hide'] === 0 ) {

			$footer_meta_news_cat = absint($meta_news_settings['meta_news_footer_featured_post_categories']);

			$footer_post_type = array(
				'posts_per_page' => 4,
				'post__not_in' => get_option('sticky_posts'),
				'post_type' => array(
					'post'
				),
			);
			if ( $meta_news_settings['meta_news_footer_featured_latest_post'] == 'category' ) {
				$footer_post_type['category__in'] = $footer_meta_news_cat;
			}

			$footer_meta_news_get_featured_post = new WP_Query($footer_post_type); ?>

				<div class="featured-stories">
					<div class="container">
					<h2 class="stories-title"><span><?php echo esc_html($meta_news_settings['meta_news_footer_featured_posts_title']); ?></span></h2>
					<div class="row">
						<?php while ($footer_meta_news_get_featured_post->have_posts()) {
							$footer_meta_news_get_featured_post->the_post(); ?>
							<div class="col-sm-6 col-lg-3 post-col">
								<div class="post-boxed<?php echo (get_post_format()) ? ' format-'.get_post_format() : ''; ?>">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-img-wrap">
											<a href="<?php the_permalink(); ?>" class="a-post-img">
												<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'large')); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
											</a>
										</div><!-- .post-img-wrap -->
									<?php } ?>
									<div class="post-content">
										<?php if ( $meta_news_settings['meta_news_posts_meta_hide_posts_category'] === 0 ) { ?>
											<div class="entry-meta category-meta">
												<div class="cat-links"><?php the_category(' '); ?></div>
											</div><!-- .entry-meta -->
										<?php } ?>
										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
										<?php if ( ('post' === get_post_type()) && (($meta_news_settings['meta_news_posts_meta_hide_posts_date'] === 0) || ($meta_news_settings['meta_news_posts_meta_hide_posts_author'] === 0) || (($meta_news_settings['meta_news_posts_meta_hide_posts_comment'] === 0) && comments_open() && get_comments_number())) ) { ?>
											<div class="entry-meta">
												<?php if ( $meta_news_settings['meta_news_posts_meta_hide_posts_date'] === 0 ) {
													meta_news_posted_on();
												}
												if ( $meta_news_settings['meta_news_posts_meta_hide_posts_author'] === 0 ) {
													meta_news_posted_by();
												}
												if ( ($meta_news_settings['meta_news_posts_meta_hide_posts_comment'] === 0) && comments_open() && get_comments_number() ) { ?>
													<div class="comments">
														<?php comments_popup_link( __('No Comments', 'meta-news'), __('1 Comment', 'meta-news'), __('% Comments', 'meta-news'), '', __('Comments Off', 'meta-news') ); ?>
													</div><!-- .comments -->
												<?php } ?>
											</div>
										<?php } ?>
									</div><!-- .post-content -->
								</div><!-- .post-boxed -->
							</div><!-- .col-sm-6 .col-lg-3 .post-col -->
						<?php }
						// Reset Post Data
						wp_reset_postdata(); ?>
					</div><!-- .row -->
					</div><!-- .container -->
				</div><!-- .featured-stories -->
		<?php } ?>

		<?php if ( is_active_sidebar('meta_news_footer_sidebar') || is_active_sidebar('meta_news_footer_column2') || is_active_sidebar('meta_news_footer_column3') || is_active_sidebar('meta_news_footer_column4') ) { ?>
			<div class="widget-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-lg-3">
							<?php
								// Calling the Footer Sidebar Column 1
								if ( is_active_sidebar( 'meta_news_footer_sidebar' ) ) :
									dynamic_sidebar( 'meta_news_footer_sidebar' );
								endif;
							?>
						</div><!-- footer sidebar column 1 -->
						<div class="col-sm-6 col-lg-3">
							<?php
								// Calling the Footer Sidebar Column 2
								if ( is_active_sidebar( 'meta_news_footer_column2' ) ) :
									dynamic_sidebar( 'meta_news_footer_column2' );
								endif;
							?>
						</div><!-- footer sidebar column 2 -->
						<div class="col-sm-6 col-lg-3">
							<?php
								// Calling the Footer Sidebar Column 3
								if ( is_active_sidebar( 'meta_news_footer_column3' ) ) :
									dynamic_sidebar( 'meta_news_footer_column3' );
								endif;
							?>
						</div><!-- footer sidebar column 3 -->
						<div class="col-sm-6 col-lg-3">
							<?php
								// Calling the Footer Sidebar Column 4
								if ( is_active_sidebar( 'meta_news_footer_column4' ) ) :
									dynamic_sidebar( 'meta_news_footer_column4' );
								endif;
							?>
						</div><!-- footer sidebar column 4 -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .widget-area -->
		<?php } ?>
		<div class="site-info">
			<div class="container">
				<div class="row site-info-row">
					<div class="site-info-main col-lg">
						<div class="copyright">
							<div class="theme-link">
								<?php echo esc_html__('Copyright &copy; ','meta-news') . meta_news_the_year() . meta_news_site_link(); ?></div><?php if ( function_exists('the_privacy_policy_link') ) {
								the_privacy_policy_link('<div class="privacy-link">', '</div>');
							}
							echo meta_news_author_link() . meta_news_wp_link(); ?>
						</div><!-- .copyright -->
					</div><!-- .site-info-main -->
					<?php
					if ( meta_news_is_social_profiles_links() > 0 ) { ?>
						<div class="site-info-right col-lg-auto">
							<div class="social-profiles">
								<?php esc_html( meta_news_social_profiles() ); ?>
							</div>
						</div>
					<?php } ?>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<div class="back-to-top"><a title="<?php esc_attr_e('Go to Top','meta-news');?>" href="#masthead"></a></div>
</div><!-- #page -->
<div class="modal fade" id="search-modal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">
			<svg x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;">
				<path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717 L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859 c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287 l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285 L284.286,256.002z"/>
			</svg>
		</span>
	</button>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<?php get_search_form(); ?>
			</div><!-- .modal-body -->
		</div><!-- .modal-content -->
	</div><!-- .modal-dialog -->
</div><!-- .modal .fade #search-modal -->

<?php wp_footer(); ?>

</body>
</html>
