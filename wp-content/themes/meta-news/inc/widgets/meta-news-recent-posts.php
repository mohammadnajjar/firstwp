<?php

/**
 * Widget for Any Sidebars.
 * Construct the widget.
 * i.e. Name and posts.
 */

if ( !class_exists('meta_news_recent_posts') ) {
	class meta_news_recent_posts extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'meta-news-widget-recent-posts',
				'description' => __('Display Recent Posts', 'meta-news')
			);
			parent::__construct(false, $name = __('TH: Recent Posts', 'meta-news') , $widget_ops);
		}

		function form($instance) {
			$instance = wp_parse_args(
				(array) $instance,
				array(
					'number' => '4',
					'widget_title' => '',
					'hide_featured_image' => 1,
				)
			);
			$title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
			$hide_featured_image = ( isset($instance['hide_featured_image']) && is_numeric($instance['hide_featured_image']) ) ? (int) $instance['hide_featured_image'] : 1; ?>
			<p>
				<?php esc_html_e('Set featured image on the related post if you need to display Image.', 'meta-news'); ?>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('widget_title'); ?>">
					<?php esc_html_e('Title:', 'meta-news'); ?>
				</label>
				<input id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>">
					<?php esc_html_e( 'Number of Post:', 'meta-news' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo absint($instance[ 'number']); ?>" size="3"/>
			</p>
			<p>
				<input type="radio" id="<?php echo ($this->get_field_id('hide_featured_image') . '-1'); ?>" name="<?php echo ($this->get_field_name('hide_featured_image')); ?>" value="1" <?php checked($hide_featured_image == 1, true); ?>>
				<label for="<?php echo ($this->get_field_id('hide_featured_image') . '-1'); ?>" class="input-label"><?php esc_html_e('Show Featured Images', 'meta-news'); ?></label>
				<br>
				<input type="radio" id="<?php echo ($this->get_field_id( 'hide_featured_image') . '-2'); ?>" name="<?php echo ($this->get_field_name('hide_featured_image')); ?>" value="2" <?php checked($hide_featured_image == 2, true); ?>>
				<label for="<?php echo ($this->get_field_id('hide_featured_image') . '-2'); ?>" class="input-label"><?php esc_html_e('Hide Featured Images', 'meta-news'); ?></label>
			</p>
			<?php
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['number'] = absint( $new_instance['number'] );
			$instance['widget_title'] = sanitize_text_field($new_instance['widget_title']);
			$instance['hide_featured_image'] = ( isset($new_instance['hide_featured_image']) && $new_instance['hide_featured_image'] > 0 && $new_instance['hide_featured_image'] < 3 ) ? (int) $new_instance['hide_featured_image'] : 1;
			return $instance;
		}

		function widget($args, $instance) {

			$widget_title = apply_filters( 'widget_title', empty( $instance['widget_title'] ) ? '' : $instance['widget_title'], $instance, $this->id_base );
			$number = empty($instance['number']) ? 4 : $instance['number'];
			$hide_featured_image = ( isset($instance['hide_featured_image']) && is_numeric($instance['hide_featured_image']) ) ? (int) $instance['hide_featured_image'] : 1;
			global $post;

			$get_featured_posts = new WP_Query(
				array(
					'posts_per_page' => $number,
					'post_type' => array('post'),
					'post__not_in' => get_option('sticky_posts'),
				)
			);

			echo $args['before_widget']; ?>

			<?php if ( !empty($widget_title) ) {
				echo $args['before_title'] . $widget_title . $args['after_title'];
			}

			global $meta_news_settings;
			$meta_news_settings = meta_news_get_option_defaults();
			?>
			<div class="row">
				<?php if ($number > 0) {
					$i = 0;
					while ($get_featured_posts->have_posts()):$get_featured_posts->the_post(); ?>
						<div class="col-md-6 post-col">
							<div class="post-boxed inlined<?php echo (get_post_format()) ? ' format-'.get_post_format() : ''; ?>">
								<?php if ( has_post_thumbnail() && $hide_featured_image == 1 ) { ?>
									<div class="post-img-wrap">
										<a href="<?php the_permalink(); ?>" class="a-post-img">
											<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'medium')); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
										</a>
									</div>
								<?php } ?>
								<div class="post-content">
									<div class="entry-meta category-meta">
										<div class="cat-links"><?php the_category(' '); ?></div>
									</div><!-- .entry-meta -->
									<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
									<?php if ( ($meta_news_settings['meta_news_posts_meta_hide_posts_date'] === 0) || ($meta_news_settings['meta_news_posts_meta_hide_posts_author'] === 0) || (($meta_news_settings['meta_news_posts_meta_hide_posts_comment'] === 0) && comments_open() && get_comments_number()) ) { ?>
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
								</div>
							</div><!-- post-boxed -->
						</div><!-- col-md-6 -->
						<?php $i++;
					endwhile;
					// Reset Post Data
					wp_reset_postdata();
				} ?>
			</div><!-- .row -->

			<?php echo $args['after_widget'] . '<!-- .widget_recent_post -->';
		}
	}
}
