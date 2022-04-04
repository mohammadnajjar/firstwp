<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Meta News
 */

if ( ! is_active_sidebar( 'meta_news_right_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="col-lg-4 widget-area sticky-column-bottom" role="complementary">
	<div class="column-inner">
		<?php dynamic_sidebar( 'meta_news_right_sidebar' ); ?>
	</div><!-- .column-inner -->
</aside><!-- #secondary -->
