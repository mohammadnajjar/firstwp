<?php

/**
 * Widget for Front Page Template.
 * Construct the widget.
 * i.e. Posts.
 */

if ( !class_exists('meta_news_card_block_posts') ) {
	class meta_news_card_block_posts extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'meta-news-widget-card-block-posts',
				'description' => __('Display Card/Block Posts', 'meta-news')
			);
			parent::__construct(false, $name = __('TH: Card/Block Posts', 'meta-news') , $widget_ops);
		}

		function form($instance) {

			$instance = wp_parse_args(
				(array) $instance,
				array(
					'widget_title' => '',
					'category' => '',
					'type' => 1,
					'style' => 0,
					'hide_featured_image' => 1,
				)
			);
			$title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
			$type = ( isset($instance['type']) && is_numeric($instance['type']) ) ? (int) $instance['type'] : 1;
			$hide_featured_image = ( isset($instance['hide_featured_image']) && is_numeric($instance['hide_featured_image']) ) ? (int) $instance['hide_featured_image'] : 1; ?>
			<p>
				<?php esc_html_e('Set featured image on the related post if you need to display Image.', 'meta-news'); ?>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="checkbox" value="1" <?php checked( '1', absint($instance['style']) ); ?>/>
				<label for="<?php echo $this->get_field_id('style'); ?>">
					<?php esc_html_e('Block Style','meta-news'); ?>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('widget_title'); ?>">
					<?php esc_html_e('Title: ', 'meta-news'); ?>
				</label>
				<input id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
			</p>
			<p>
				<input type="radio" id="<?php echo ($this->get_field_id('type') . '-1'); ?>" name="<?php echo ($this->get_field_name('type')); ?>" value="1" <?php checked($type == 1, true); ?>>
				<label for="<?php echo ($this->get_field_id('type') . '-1'); ?>" class="input-label"><?php esc_html_e('Latest Posts', 'meta-news'); ?></label>
				<br>
				<input type="radio" id="<?php echo ($this->get_field_id( 'type') . '-2'); ?>" name="<?php echo ($this->get_field_name('type')); ?>" value="2" <?php checked($type == 2, true); ?>>
				<label for="<?php echo ($this->get_field_id('type') . '-2'); ?>" class="input-label"><?php esc_html_e('Show Posts from Category', 'meta-news'); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>">
					<?php esc_html_e('Choose Category:', 'meta-news'); ?>
				</label>
				<?php wp_dropdown_categories(
					array(
						'show_option_none' => ' ',
						'name' => $this->get_field_name('category') ,
						'selected' => $instance['category']
					)
				); ?>
			</p>
			<p>
				<input type="radio" id="<?php echo ($this->get_field_id('hide_featured_image') . '-1'); ?>" name="<?php echo ($this->get_field_name('hide_featured_image')); ?>" value="1" <?php checked($hide_featured_image == 1, true); ?>>
				<label for="<?php echo ($this->get_field_id('hide_featured_image') . '-1'); ?>" class="input-label"><?php esc_html_e('Show Featured Images', 'meta-news'); ?></label>
				<br>
				<input type="radio" id="<?php echo ($this->get_field_id( 'hide_featured_image') . '-2'); ?>" name="<?php echo ($this->get_field_name('hide_featured_image')); ?>" value="2" <?php checked($hide_featured_image == 2, true); ?>>
				<label for="<?php echo ($this->get_field_id('hide_featured_image') . '-2'); ?>" class="input-label"><?php esc_html_e('Hide Featured Images in Card Style Only', 'meta-news'); ?></label>
			</p>
			<?php
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['category'] = absint($new_instance['category']);
			$instance['style'] = absint($new_instance['style']);
			$instance['widget_title'] = sanitize_text_field($new_instance['widget_title']);
			$instance['type'] = ( isset($new_instance['type']) && $new_instance['type'] > 0 && $new_instance['type'] < 3 ) ? (int) $new_instance['type'] : 1;
			$instance['hide_featured_image'] = ( isset($new_instance['hide_featured_image']) && $new_instance['hide_featured_image'] > 0 && $new_instance['hide_featured_image'] < 3) ? (int) $new_instance['hide_featured_image'] : 1;
			return $instance;
		}

		function widget($args, $instance) {

			$category = isset($instance['category']) ? $instance['category'] : '';
			$style = empty($instance['style']) ? '' : $instance['style'];
			$widget_title = apply_filters( 'widget_title', empty( $instance['widget_title'] ) ? '' : $instance['widget_title'], $instance, $this->id_base );
			$type = ( isset($instance['type']) && is_numeric($instance['type']) ) ? (int) $instance['type'] : 1;
			$hide_featured_image = ( isset($instance['hide_featured_image']) && is_numeric($instance['hide_featured_image']) ) ? (int) $instance['hide_featured_image'] : 1;
			global $post;

			$post_type = array(
				'posts_per_page' => 2,
				'post_type' => array('post'),
				'post__not_in' => get_option('sticky_posts'),
			);
			if ( $type == 2 ) {
				$post_type['category__in'] = $category;
			}

			$get_featured_posts = new WP_Query($post_type);

			echo $args['before_widget']; ?>
			<?php if ( !empty($widget_title) ) {
				echo $args['before_title'] . $widget_title . $args['after_title'];
			}

			global $meta_news_settings;
			$meta_news_settings = meta_news_get_option_defaults();
			?>
			<div class="row">
				<?php while ($get_featured_posts->have_posts()):$get_featured_posts->the_post(); ?>
					<div class="col-sm-6 post-col">
						<div class="post-item<?php echo ($style == 0) ? ' post-boxed' : ' post-block'; echo (get_post_format()) ? ' format-'.get_post_format() : ''; ?>">
							<?php if ( has_post_thumbnail() && $style == 0 && $hide_featured_image == 1 ) { ?>
								<div class="post-img-wrap">
									<a href="<?php the_permalink(); ?>" class="a-post-img">
										<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
									</a>
								</div><!-- .post-img-wrap -->
							<?php }
							if ( $style == 0 ) { ?>
								<div class="post-content">
									<?php if ( $meta_news_settings['meta_news_posts_meta_hide_posts_category'] === 0 ) { ?>
										<div class="entry-meta category-meta">
											<div class="cat-links"><?php the_category(' '); ?></div>
										</div><!-- .entry-meta -->
									<?php } ?>
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
									<div class="entry-content">
										<?php the_excerpt(); ?>
										<?php if ( str_word_count( strip_tags( get_the_content() ) ) > str_word_count( get_the_excerpt() ) ) { ?>
											<a href="<?php the_permalink(); ?>" class="btn-read-more">
												<?php esc_html_e('Continue Reading','meta-news'); ?>
												<span class="read-more-icon">
													<svg x="0px" y="0px" viewBox="0 0 476.213 476.213" style="enable-background:new 0 0 476.213 476.213;" xml:space="preserve">
														<polygon points="345.606,107.5 324.394,128.713 418.787,223.107 0,223.107 0,253.107 418.787,253.107 324.394,347.5 345.606,368.713 476.213,238.106 "/>
													</svg>
												</span>
											</a>
										<?php } ?>
									</div><!-- .entry-content -->
								</div><!-- .post-content -->
							<?php } else { ?>
								<div class="post-img-wrap">
									<?php if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink(); ?>" class="a-post-img">
											<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
										</a>
									<?php } ?>
								</div><!-- .post-img-wrap -->
								<div class="entry-header">
									<?php if ($meta_news_settings['meta_news_posts_meta_hide_posts_category'] === 0) { ?>
										<div class="entry-meta category-meta">
											<div class="cat-links"><?php the_category(' '); ?></div>
										</div><!-- .entry-meta -->
									<?php } ?>
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
								</div><!-- .entry-header -->
							<?php } ?>
						</div><!-- .post-item -->
					</div><!-- .col-sm-6 .post-col -->
				<?php endwhile;
				// Reset Post Data
				wp_reset_postdata(); ?>
			</div><!-- .row -->

			<?php echo $args['after_widget'] . '<!-- .widget_featured_post -->';
		}
	}
}
