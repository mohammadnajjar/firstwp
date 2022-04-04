<?php
/**
 * The template for displaying WooCommerce pages
 *
 * This is the template that displays WooCommerce pages by default.
 * Please note that this is the WooCommerce construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Meta News
 */

get_header();

meta_news_layout_primary(); ?>
	<div class="column-inner">
	<main id="main" class="site-main">

		<?php woocommerce_content(); ?>

	</main><!-- #main -->
	</div><!-- .column-inner -->
	</div><!-- #primary -->

	<?php if ( is_active_sidebar( 'meta_news_woocommerce_sideber' ) ) {

		$meta_news_settings = meta_news_get_option_defaults();
		$meta_news_custom_layout = $meta_news_settings['meta_news_content_layout'];

		global $post;
		if ($post) {
			$meta_news_meta_layout = get_post_meta($post->ID, 'meta_news_sidebarlayout', true);
		}
		if ( empty($meta_news_meta_layout) || is_archive() || is_search() || is_home() ) {
			$meta_news_meta_layout = 'default';
		}

		$woosidebarorder = '';
		if ( ( ('default' == $meta_news_meta_layout) && ('left' == $meta_news_custom_layout) ) || ('meta-left' == $meta_news_meta_layout) ) {
			$woosidebarorder = ' order-lg-1';
		}

		if ( ( ('default' == $meta_news_meta_layout) && ( ('left' == $meta_news_custom_layout) || ('right' == $meta_news_custom_layout) ) ) || ('meta-left' == $meta_news_meta_layout) || ('meta-right' == $meta_news_meta_layout) ) { ?>
			<aside id="secondary" class="col-lg-4 widget-area<?php echo esc_attr($woosidebarorder);?> sticky-column-bottom" role="complementary">
				<div class="column-inner">
					<?php dynamic_sidebar( 'meta_news_woocommerce_sideber' ); ?>
				</div><!-- .column-inner -->
			</aside><!-- #secondary -->
		<?php }

	}

get_footer();
