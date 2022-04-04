<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Meta News
 */

?>
<?php global $meta_news_settings; ?>
<?php if ( !is_singular() ) { ?>
	<div class="col-sm-6<?php echo ( 'fullwidth' == $meta_news_settings['meta_news_content_layout'] ) ? ' col-lg-4': ''; ?> col-xxl-4 post-col">
<?php } ?>
	<div <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ) {

			if ( !is_single() ) { ?>

				<figure class="post-featured-image post-img-wrap">
					<a href="<?php the_permalink(); ?>" class="a-post-img">
						<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'large')); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
					</a>
				</figure><!-- .post-featured-image .post-img-wrap -->

			<?php } elseif ( is_single() ) {

				if ( $meta_news_settings['meta_news_featured_image_single'] === 1 ) { ?>

					<figure class="post-featured-image page-single-featured-image post-img-wrap">
						<div class="a-post-img">
							<?php the_post_thumbnail('', array( 'class' => 'post-img' )); ?>
						</div>
						<?php if ( get_the_post_thumbnail_caption( get_the_ID() ) ) { ?>
							<figcaption class="featured-image-caption"><?php echo get_the_post_thumbnail_caption( get_the_ID() ); ?></figcaption>
						<?php } ?>
					</figure><!-- .post-featured-image .page-single-featured-image .post-img-wrap -->

				<?php } ?>

			<?php }

		} ?>

		<?php if ( !has_post_format( 'quote' ) ) { // for not format quote ?>
			<header class="entry-header">
				<?php if ( ((is_home() || is_archive()) && ($meta_news_settings['meta_news_posts_meta_hide_posts_category'] === 0)) || ((is_single()) && ($meta_news_settings['meta_news_posts_meta_hide_single_post_category'] === 0)) ) { ?>
					<div class="entry-meta category-meta">
						<div class="cat-links"><?php the_category(' '); ?></div>
					</div><!-- .entry-meta -->
				<?php } ?>
				<?php if ( is_singular() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				} ?>

				<?php if ( ('post' === get_post_type()) && ( ((is_home() || is_archive()) && (($meta_news_settings['meta_news_posts_meta_hide_posts_date'] === 0) || ($meta_news_settings['meta_news_posts_meta_hide_posts_author'] === 0) || (($meta_news_settings['meta_news_posts_meta_hide_posts_comment'] === 0) && comments_open() && get_comments_number()))) || ((is_single()) && (($meta_news_settings['meta_news_posts_meta_hide_single_post_date'] === 0) || ($meta_news_settings['meta_news_posts_meta_hide_single_post_author'] === 0) || (($meta_news_settings['meta_news_posts_meta_hide_single_post_comment'] === 0) && comments_open() && get_comments_number()))) ) ) {
					if ( !has_post_format( 'link' ) ){ // for not format link ?>
					<div class="entry-meta">
						<?php if ( ((is_home() || is_archive()) && ($meta_news_settings['meta_news_posts_meta_hide_posts_date'] === 0)) || ((is_single()) && ($meta_news_settings['meta_news_posts_meta_hide_single_post_date'] === 0)) ) {
							meta_news_posted_on();
						}
						if ( ((is_home() || is_archive()) && ($meta_news_settings['meta_news_posts_meta_hide_posts_author'] === 0)) || ((is_single()) && ($meta_news_settings['meta_news_posts_meta_hide_single_post_author'] === 0)) ) {
							meta_news_posted_by();
						}

						if ( ((is_home() || is_archive()) && ($meta_news_settings['meta_news_posts_meta_hide_posts_comment'] === 0)) || ((is_single()) && ($meta_news_settings['meta_news_posts_meta_hide_single_post_comment'] === 0)) ) {
						 	if ( comments_open() && get_comments_number() ) { ?>
								<div class="comments">
									<?php comments_popup_link( __('No Comments', 'meta-news'), __('1 Comment', 'meta-news'), __('% Comments', 'meta-news'), '', __('Comments Off', 'meta-news') ); ?>
								</div><!-- .comments -->
							<?php }
						} ?>
					</div><!-- .entry-meta -->
					<?php }
				} ?>
			</header>
		<?php } ?>
		<div class="entry-content">
			<?php if ( is_single() ) {
				the_content();
			} else {
				if ( !(has_post_format('link') || has_post_format('quote')) ) { ?>
					<p><?php echo wp_trim_words( get_the_excerpt(), 16 ); ?></p>
					<?php if ( str_word_count( strip_tags( get_the_content() ) ) > 16 ) { ?>
						<a href="<?php the_permalink(); ?>" class="btn-read-more">
							<?php esc_html_e('Continue Reading','meta-news'); ?>
							<span class="read-more-icon">
								<svg x="0px" y="0px" viewBox="0 0 476.213 476.213" style="enable-background:new 0 0 476.213 476.213;" xml:space="preserve">
									<polygon points="345.606,107.5 324.394,128.713 418.787,223.107 0,223.107 0,253.107 418.787,253.107 324.394,347.5 345.606,368.713 476.213,238.106 "/>
								</svg>
							</span>
						</a>
					<?php }
				} else {
					the_content();
				}
			} ?>
		</div><!-- entry-content -->

		<?php if ( is_single() && ($meta_news_settings['meta_news_posts_meta_hide_single_post_tags'] === 0) ) {
			echo get_the_tag_list( sprintf('<footer class="entry-meta"><span class="tag-links"><span class="label">%s:</span> ', esc_html__('Tags', 'meta-news') ), ', ', '</span><!-- .tag-links --></footer><!-- .entry-meta -->' );
		}
		 wp_link_pages( array(
			'before' 			=> '<div class="page-links">' . esc_html__( 'Pages: ', 'meta-news' ),
			'separator'			=> '',
			'link_before'		=> '<span>',
			'link_after'		=> '</span>',
			'after'				=> '</div>'
		) ); ?>
	</div><!-- .post-<?php the_ID(); ?> -->
<?php if ( !is_singular() ) { ?>
	</div><!-- .col-sm-6 .col-xxl-4 .post-col -->
<?php } ?>
