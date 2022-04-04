<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Meta News
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class('theme-body'); ?>>
<?php wp_body_open();
global $meta_news_settings;
$meta_news_settings = meta_news_get_option_defaults(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'meta-news' ); ?></a>
	<?php if (has_header_video() || has_header_image()) {
		the_custom_header_markup();
	} ?>

	<header id="masthead" class="site-header">
		<?php if ( $meta_news_settings['meta_news_top_bar_hide'] == 0 ) { ?>
			<div class="info-bar<?php echo ( has_nav_menu('right-section') ) ? ' infobar-links-on' : ''; ?>">
				<div class="container">
					<div class="info-bar-wrap">
					<div class="row gutter-10">
						<div class="col-12 col-sm contact-section">
							<ul><li class="date"><?php echo esc_html(date_i18n("l, F j, Y")); ?></li></ul>
						</div><!-- .contact-section -->

						<?php if ( meta_news_is_social_profiles_links() > 0 && $meta_news_settings['meta_news_top_bar_social_profiles'] === 0 ) { ?>
							<div class="col-sm-auto social-profiles order-md-3">
								<button class="infobar-social-profiles-toggle"><?php esc_html_e('Responsive Menu', 'meta-news' ); ?></button>
								<?php esc_html( meta_news_social_profiles() ); ?>
							</div><!-- .social-profile -->
						<?php }

						if ( has_nav_menu('right-section') ) { ?>
							<div class="col-sm-auto infobar-links order-md-2">
								<button class="infobar-links-menu-toggle"><?php esc_html_e('Responsive Menu', 'meta-news' ); ?></button>
								<?php wp_nav_menu( array(
									'theme_location'	=> 'right-section',
									'container'			=> '',
									'depth'				=> 1,
									'items_wrap'      	=> '<ul class="clearfix">%3$s</ul>',
								) ); ?>
							</div><!-- .infobar-links -->
						<?php } ?>
					</div><!-- .row -->
					</div><!-- .info-bar-wrap -->
          		</div><!-- .container -->
        	</div><!-- .infobar -->
        <?php } ?>
		<div class="navbar-head<?php echo ($meta_news_settings['meta_news_header_background'] !== '') ? ' navbar-bg-set' : '' ; echo ($meta_news_settings['meta_news_header_bg_overlay'] === 'dark') ? ' header-overlay-dark' : '' ; echo ($meta_news_settings['meta_news_header_bg_overlay'] === 'light') ? ' header-overlay-light' : '' ;?>" <?php if ($meta_news_settings['meta_news_header_background'] !== '') { ?> style="background-image:url('<?php echo esc_url($meta_news_settings['meta_news_header_background']); ?>');"<?php } ?>>
			<div class="container">
				<div class="navbar-head-inner">
					<div class="site-branding<?php echo ($meta_news_settings['meta_news_header_sitebranding_inline'] === 1) ? ' brand-inline' : '' ; echo ($meta_news_settings['meta_news_header_sitebranding_center'] === 1) ? ' text-center' : '' ;?>">
						<?php the_custom_logo(); ?>
						<div class="site-title-wrap">
							<?php if ( is_page_template('templates/front-page-template.php') || is_home() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
							<?php endif;
								$meta_news_description = get_bloginfo( 'description', 'display' );
								if ( $meta_news_description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo $meta_news_description; /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>
						</div><!-- .site-title-wrap -->
					</div><!-- .site-branding .navbar-brand -->
					<?php if ( $meta_news_settings['meta_news_header_add_image'] !== '' ) { ?>
						<div class="navbar-ad-section">
							<?php if ( $meta_news_settings['meta_news_header_add_link'] !== '' ) { ?>
								<a href="<?php echo esc_url( $meta_news_settings['meta_news_header_add_link'] ); ?>" target="_blank" rel="noopener noreferrer" class="navbar-ad">
							<?php } ?>
							<img class="img-fluid" src="<?php echo esc_url( $meta_news_settings['meta_news_header_add_image'] ); ?>" alt="<?php esc_attr_e('Banner Add', 'meta-news'); ?>">
							<?php if ( $meta_news_settings['meta_news_header_add_link'] !== '' ) { ?>
								</a>
							<?php } ?>
						</div><!-- .navbar-ad-section -->
					<?php } ?>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .navbar-head -->
		<nav class="navbar">
			<div class="container">
				<div class="navigation-icons-wrap">
					<button class="navbar-toggler menu-toggle" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'meta-news'); ?>"></button>
					<a href="#" class="search-modal-toggle" data-toggle="modal" data-target="#search-modal"><i class="fas fa-search"></i></a>
				</div><!-- .navigation-icons-wrap -->
			</div><!-- .container -->
			<div class="navbar-inner">
				<div class="container">
					<div class="navigation-wrap">
						<div class="navbar-main">
							<div class="collapse navbar-collapse" id="navbarCollapse">
								<div id="site-navigation" class="main-navigation<?php echo ($meta_news_settings['meta_news_nav_uppercase'] == 1) ? " nav-uppercase" : "";?>" role="navigation">
									<?php
									if ( has_nav_menu('primary') ) {
										wp_nav_menu( array(
											'theme_location'	=> 'primary',
											'container'			=> '',
											'items_wrap'		=> '<ul class="nav-menu navbar-nav">%3$s</ul>',
										) );
									} else {
										wp_page_menu( array(
											'before' 			=> '<ul class="nav-menu navbar-nav">',
											'after'				=> '</ul>',
										) );
									}
									?>
								</div><!-- #site-navigation .main-navigation -->
							</div><!-- .navbar-collapse -->
						</div><!-- .navbar-main -->
						<div class="navbar-right">
							<div class="navbar-element-item navbar-search">
								<a href="#" class="search-modal-toggle" data-toggle="modal" data-target="#search-modal"><i class="fas fa-search"></i></a>
							</div><!-- .navbar-element-item .navbar-search -->
						</div><!-- .navbar-right -->
					</div><!-- .navigation-wrap -->
				</div><!-- .container -->
			</div><!-- .navbar-inner -->
		</nav><!-- .navbar -->

		<?php if ( ( is_front_page() || is_home() ) && $meta_news_settings['meta_news_top_stories_hide'] === 0 ) {

			$meta_news_cat_tp = absint($meta_news_settings['meta_news_top_stories_categories']);

			$post_type_tp = array(
				'posts_per_page' => 5,
				'post__not_in' => get_option('sticky_posts'),
				'post_type' => array(
					'post'
				),
			);
			if ( $meta_news_settings['meta_news_top_stories_latest_post'] == 'category' ) {
				$post_type_tp['category__in'] = $meta_news_cat_tp;
			}

			$meta_news_get_top_stories = new WP_Query($post_type_tp); ?>
			<div class="top-stories-bar<?php echo ($meta_news_settings['meta_news_top_stories_style'] == 'style_2') ? " style-marquee" : " style-multi-col multi-col-default";?>">
				<div class="container">
					<div class="top-stories-inner">
						<div class="row">
							<?php if ($meta_news_settings['meta_news_top_stories_title'] !== "") { ?>
								<div class="col-sm-auto top-stories-label-wrap">
									<div class="top-stories-label top-stories-label-1">
										<span class="flash-icon"></span>
										<span class="label-txt">
											<?php echo esc_html($meta_news_settings['meta_news_top_stories_title']); ?>
										</span>
									</div><!-- .top-stories-label -->
								</div><!-- .col-sm-auto .top-stories-label-wrap -->
							<?php } ?>
							<div class="col-12 top-stories-lists<?php echo ($meta_news_settings['meta_news_top_stories_style'] == 'style_2') ? " col-sm" : "";?>">
								<div class="<?php echo ($meta_news_settings['meta_news_top_stories_style'] == 'style_2') ? "marquee" : "owl-carousel";?>">
									<?php while ($meta_news_get_top_stories->have_posts()) {
										$meta_news_get_top_stories->the_post(); ?>
										<div class="top-stories-item">
											<div class="top-stories-cnt-bx">
												<?php if ( $meta_news_settings['meta_news_top_stories_style'] === 'style_1' ) { ?>
													<div class="entry-meta">
														<div class="date"><?php echo esc_html( get_the_time( get_option('date_format') ) ); ?></div>
													</div>
												<?php }
												the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
											</div><!-- .top-stories-cnt-bx -->
										</div>
									<?php }
									// Reset Post Data
									wp_reset_postdata(); ?>
								</div>
							</div><!-- .col-12 .top-stories-lists -->
						</div><!-- .row -->
					</div><!-- .top-stories-inner -->
				</div><!-- .container -->
			</div><!-- .top-stories-bar -->
		<?php } ?>

		<?php if ( ( ( is_front_page() || ( is_home() && $meta_news_settings['meta_news_banner_display'] === 'front-blog' ) ) && ( $meta_news_settings['meta_news_banner_slider_posts_hide'] === 0 || $meta_news_settings['meta_news_banner_featured_posts_1_hide'] === 0 || $meta_news_settings['meta_news_banner_featured_posts_2_hide'] === 0 ) ) || ( ( is_front_page() || ( is_home() && $meta_news_settings['meta_news_header_featured_posts_banner_display'] === 'front-blog' ) ) && $meta_news_settings['meta_news_header_featured_posts_hide'] === 0 ) ) { ?>

			<div class="featured-section">
				<?php if ( ( is_front_page() || ( is_home() && $meta_news_settings['meta_news_banner_display'] === 'front-blog' ) ) && ( $meta_news_settings['meta_news_banner_slider_posts_hide'] === 0 || $meta_news_settings['meta_news_banner_featured_posts_1_hide'] === 0 || $meta_news_settings['meta_news_banner_featured_posts_2_hide'] === 0 ) ) {

					$col_wrap_class = '';
					$col_slider_class = '';
					$col_mid_class = '';
					$col_mid_child_class = '';

					if ( $meta_news_settings['meta_news_banner_featured_posts_1_hide'] === 0 && $meta_news_settings['meta_news_banner_featured_posts_2_hide'] === 0 ) {
						$col_slider_class = 'col-lg-5 col-xl-6';
						$col_mid_class = 'col-sm-6 col-lg-3pt5 col-xl-3';
						$col_mid_child_class = 'col-12';
					} elseif ( ($meta_news_settings['meta_news_banner_featured_posts_1_hide'] === 1 && $meta_news_settings['meta_news_banner_featured_posts_2_hide'] === 0) || ($meta_news_settings['meta_news_banner_featured_posts_1_hide'] === 0 && $meta_news_settings['meta_news_banner_featured_posts_2_hide'] === 1) ) {
						$col_slider_class = 'col-12 col-lg-8';
						$col_wrap_class = ' two-column-featured-section';
						$col_mid_class = 'col-lg-4';
						$col_mid_child_class = 'col-sm-6 col-lg-12';
					} else {
						$col_slider_class = 'col-12';
						$col_wrap_class = ' one-column-featured-section';
					} ?>

					<div class="featured-banner featured-banner-gutter-10<?php echo $col_wrap_class ?>">
						<div class="container featured-banner-inner">
							<div class="row">
								<?php if ( $meta_news_settings['meta_news_banner_slider_posts_hide'] === 0 ) {

									$meta_news_bs_cat = absint($meta_news_settings['meta_news_banner_slider_post_categories']);

									$post_type_bs = array(
										'posts_per_page' => 5,
										'post__not_in' => get_option('sticky_posts'),
										'post_type' => array(
											'post'
										),
									);
									if ( $meta_news_settings['meta_news_banner_slider_latest_post'] == 'category' ) {
										$post_type_bs['category__in'] = $meta_news_bs_cat;
									}

									$meta_news_get_banner_slider = new WP_Query($post_type_bs); ?>

									<div class="featured-banner-col <?php echo $col_slider_class ?>">
										<div class="featured-slider post-slider<?php echo ( $meta_news_settings['meta_news_banner_slider_posts_title'] === '' ) ? " slider-no-title" : ""; ?>">
											<div class="post-slider-header title-wrap">
												<?php if ( $meta_news_settings['meta_news_banner_slider_posts_title'] !== '' ) { ?>
													<h3 class="stories-title"><span><?php echo esc_html($meta_news_settings['meta_news_banner_slider_posts_title']); ?></span></h3>
												<?php } ?>
											</div>
											<div class="featured-banner-grid-col">
											<div class="owl-carousel">
												<?php while ($meta_news_get_banner_slider->have_posts()) {
													$meta_news_get_banner_slider->the_post(); ?>
													<div class="item">
														<div class="post-item post-block<?php echo (get_post_format()) ? ' format-'.get_post_format() : ''; ?>">
															<div class="post-img-wrap">
																<?php if ( has_post_thumbnail() ) { ?>
																	<a href="<?php the_permalink(); ?>" class="a-post-img">
																		<?php the_post_thumbnail('', array( 'class' => 'post-img' )); ?>
																	</a>
																<?php } ?>
															</div>
															<div class="entry-header">
																<?php if ($meta_news_settings['meta_news_posts_meta_hide_posts_category'] === 0) { ?>
																	<div class="entry-meta category-meta">
																		<div class="cat-links"><?php the_category(' '); ?></div>
																	</div><!-- .entry-meta -->
																<?php } ?>
																<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
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
															</div><!-- .entry-header -->
														</div><!-- .post-item .post-block -->
													</div>
												<?php }
												// Reset Post Data
												wp_reset_postdata(); ?>
											</div><!-- .owl-carousel -->
											</div><!-- .featured-banner-grid-col -->
										</div><!-- .featured-slider .post-slider -->
									</div><!-- .featured-banner-col -->
								<?php } ?>

								<?php if ( $meta_news_settings['meta_news_banner_featured_posts_1_hide'] === 0 ) {

									$meta_news_fp_1_cat = absint($meta_news_settings['meta_news_banner_featured_posts_1_post_categories']);

									$post_type_fp_1 = array(
										'posts_per_page' => 1,
										'post__not_in' => get_option('sticky_posts'),
										'post_type' => array(
											'post'
										),
									);
									if ( $meta_news_settings['meta_news_banner_featured_posts_1_latest_post'] == 'category' ) {
										$post_type_fp_1['category__in'] = $meta_news_fp_1_cat;
									}

									$meta_news_get_featured_post_1 = new WP_Query($post_type_fp_1); ?>

									<div class="featured-banner-col single-featured-post <?php echo $col_mid_class ?>">
										<div class="featured-post">
											<div class="title-wrap">
												<?php if ( $meta_news_settings['meta_news_banner_featured_posts_1_title'] !== '' ) { ?>
													<h3 class="stories-title"><span><?php echo esc_html($meta_news_settings['meta_news_banner_featured_posts_1_title']); ?></span></h3>
												<?php } ?>
											</div>
											<div class="featured-banner-grid-col">
											<div class="row">
												<?php while ($meta_news_get_featured_post_1->have_posts()) {
													$meta_news_get_featured_post_1->the_post(); ?>
													<div class="<?php echo $col_mid_child_class ?>">
														<div class="post-item post-block<?php echo (get_post_format()) ? ' format-'.get_post_format() : ''; ?>">
															<div class="post-img-wrap">
																<?php if ( has_post_thumbnail() ) { ?>
																	<a href="<?php the_permalink(); ?>" class="a-post-img">
																		<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
																	</a>
																<?php } ?>
															</div>
															<div class="entry-header">
																<?php if ($meta_news_settings['meta_news_posts_meta_hide_posts_category'] === 0) { ?>
																	<div class="entry-meta category-meta">
																		<div class="cat-links"><?php the_category(' '); ?></div>
																	</div><!-- .entry-meta -->
																<?php } ?>
																<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
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
															</div><!-- .entry-header -->
														</div><!-- .post-item .post-block -->
													</div><!-- <?php echo $col_mid_child_class ?> -->
												<?php }
												// Reset Post Data
												wp_reset_postdata(); ?>
											</div><!-- .row -->
											</div><!-- .featured-banner-grid-col -->
										</div><!-- .featured-post -->
									</div><!-- .featured-banner-col -->
								<?php } ?>

								<?php if ( $meta_news_settings['meta_news_banner_featured_posts_2_hide'] === 0 ) {

									$meta_news_fp_2_cat = absint($meta_news_settings['meta_news_banner_featured_posts_2_post_categories']);

									$post_type_fp_2 = array(
										'posts_per_page' => 2,
										'post__not_in' => get_option('sticky_posts'),
										'post_type' => array(
											'post'
										),
									);
									if ( $meta_news_settings['meta_news_banner_featured_posts_2_latest_post'] == 'category' ) {
										$post_type_fp_2['category__in'] = $meta_news_fp_2_cat;
									}

									$meta_news_get_featured_post_2 = new WP_Query($post_type_fp_2); ?>

									<div class="featured-banner-col <?php echo $col_mid_class ?>">
										<div class="featured-post">
											<div class="title-wrap">
												<?php if ( $meta_news_settings['meta_news_banner_featured_posts_2_title'] !== '' ) { ?>
													<h3 class="stories-title"><span><?php echo esc_html($meta_news_settings['meta_news_banner_featured_posts_2_title']); ?></span></h3>
												<?php } ?>
											</div>
											<div class="featured-banner-grid-col">
											<div class="row">
												<?php while ($meta_news_get_featured_post_2->have_posts()) {
													$meta_news_get_featured_post_2->the_post(); ?>
													<div class="<?php echo $col_mid_child_class ?>">
														<div class="post-item post-block<?php echo (get_post_format()) ? ' format-'.get_post_format() : ''; ?>">
															<div class="post-img-wrap">
																<?php if ( has_post_thumbnail() ) { ?>
																	<a href="<?php the_permalink(); ?>" class="a-post-img">
																		<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
																	</a>
																<?php } ?>
															</div>
															<div class="entry-header">
																<?php if ($meta_news_settings['meta_news_posts_meta_hide_posts_category'] === 0) { ?>
																	<div class="entry-meta category-meta">
																		<div class="cat-links"><?php the_category(' '); ?></div>
																	</div><!-- .entry-meta -->
																<?php } ?>
																<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
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
															</div><!-- .entry-header -->
														</div><!-- .post-item .post-block -->
													</div><!-- <?php echo $col_mid_child_class ?> -->
												<?php }
												// Reset Post Data
												wp_reset_postdata(); ?>
											</div><!-- .row -->
											</div><!-- .featured-banner-grid-col -->
										</div><!-- .featured-post -->
									</div><!-- .featured-banner-col -->
								<?php } ?>
							</div><!-- .row -->
						</div><!-- .container .featured-banner-inner -->
					</div><!-- .featured-banner -->
				<?php } ?>

				<?php if ( ( is_front_page() || ( is_home() && $meta_news_settings['meta_news_header_featured_posts_banner_display'] === 'front-blog' ) ) && $meta_news_settings['meta_news_header_featured_posts_hide'] === 0 ) {

					$header_meta_news_cat = absint($meta_news_settings['meta_news_header_featured_post_categories']);

					$header_post_type = array(
						'posts_per_page' => 4,
						'post__not_in' => get_option('sticky_posts'),
						'post_type' => array(
							'post'
						),
					);
					if ( $meta_news_settings['meta_news_header_featured_latest_post'] == 'category' ) {
						$header_post_type['category__in'] = $header_meta_news_cat;
					}

					$header_meta_news_get_featured_post = new WP_Query($header_post_type); ?>

					<div class="featured-stories">
						<div class="container">
							<h2 class="stories-title"><span><?php echo esc_html($meta_news_settings['meta_news_header_featured_posts_title']); ?></span></h2>
							<div class="row">
								<?php while ($header_meta_news_get_featured_post->have_posts()) {
									$header_meta_news_get_featured_post->the_post(); ?>
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
									</div><!-- .col-sm-6 .col-lg-3 .post-col-->
								<?php }
								// Reset Post Data
								wp_reset_postdata(); ?>
							</div><!-- .row -->
						</div><!-- .container -->
					</div><!-- .featured-stories -->
				<?php } ?>
			</div><!-- .featured-section -->
		<?php } ?>

		<?php if ( !is_front_page() && !is_home() && !is_page_template('templates/front-page-template.php') && function_exists('meta_news_breadcrumbs') && $meta_news_settings['meta_news_breadcrumbs_hide'] === 0 ) { ?>
			<div id="breadcrumb">
				<div class="container">
					<?php meta_news_breadcrumbs(); ?>
				</div>
			</div><!-- .breadcrumb -->
		<?php } ?>
	</header><!-- #masthead -->
	<div id="content" class="site-content <?php echo ( ( ( is_front_page() || ( is_home() && $meta_news_settings['meta_news_banner_display'] === 'front-blog' ) ) && ( $meta_news_settings['meta_news_banner_slider_posts_hide'] === 0 || $meta_news_settings['meta_news_banner_featured_posts_1_hide'] === 0 || $meta_news_settings['meta_news_banner_featured_posts_2_hide'] === 0 ) ) || ( ( is_front_page() || ( is_home() && $meta_news_settings['meta_news_header_featured_posts_banner_display'] === 'front-blog' ) ) && $meta_news_settings['meta_news_header_featured_posts_hide'] === 0 ) ) ? "pt-0" : ""; ?>">
		<?php if ( !is_page_template('templates/front-page-template.php') ) { ?>
			<div class="container">
				<div class="row justify-content-center site-content-row">
		<?php } ?>
