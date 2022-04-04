<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Meta News
 */

?>

<?php global $meta_news_settings; ?>
<div class="col-sm-6 col-xxl-4 post-col">
	<div <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ) { ?>

			<figure class="post-featured-image post-img-wrap">
				<a href="<?php the_permalink(); ?>" class="a-post-img">
					<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'large')); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
				</a>
			</figure><!-- .post-featured-image .post-img-wrap -->

		<?php } ?>

		<?php if ( !has_post_format( 'quote' ) ) { // for not format quote ?>

			<header class="entry-header">

				<?php if ( ('post' === get_post_type()) && ($meta_news_settings['meta_news_posts_meta_hide_posts_category'] === 0) ) { ?>
					<div class="entry-meta category-meta">
						<div class="cat-links"><?php the_category(' '); ?></div>
					</div><!-- .entry-meta -->
				<?php } ?>

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

				<?php if ( ('post' === get_post_type()) && (!has_post_format('link')) && ( ($meta_news_settings['meta_news_posts_meta_hide_posts_date'] === 0) || ($meta_news_settings['meta_news_posts_meta_hide_posts_author'] === 0) || (($meta_news_settings['meta_news_posts_meta_hide_posts_comment'] === 0) && comments_open() && get_comments_number()) ) ) { ?>
					<div class="entry-meta">
						<?php if ($meta_news_settings['meta_news_posts_meta_hide_posts_date'] === 0) {
							meta_news_posted_on();
						}
						if ($meta_news_settings['meta_news_posts_meta_hide_posts_author'] === 0) {
							meta_news_posted_by();
						}
						if ( ($meta_news_settings['meta_news_posts_meta_hide_posts_comment'] === 0) && comments_open() && get_comments_number() ) { ?>
							<div class="comments">
								<?php comments_popup_link( __('No Comments', 'meta-news'), __('1 Comment', 'meta-news'), __('% Comments', 'meta-news'), '', __('Comments Off', 'meta-news') ); ?>
							</div><!-- .comments -->
						<?php } ?>
					</div><!-- .entry-meta -->
				<?php } ?>
			</header><!-- .entry-header -->

		<?php } ?>

		<div class="entry-content">

			<?php if ( !(has_post_format('link') || has_post_format('quote')) ) { ?>

				<p><?php echo wp_trim_words( get_the_excerpt(), 16 ); ?></p>

			<?php } else {

				the_content();

			} ?>

		</div><!-- .entry-content -->
	</div><!-- .post-<?php the_ID(); ?> -->
</div><!-- .col-sm-6 .col-xxl-4 .post-col -->
