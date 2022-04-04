<?php

/**
 * Template part for displaying inner banner in pages
 *
 * @since 1.0.0
 * 
 * @package Newslist WordPress Theme
 */
?>
<div class="<?php echo esc_attr( Newslist_Helper::get_inner_banner_class() ); ?>" <?php Newslist_Helper::the_header_image(); ?>>
	<div class="container">
		<?php
			Newslist_Helper::the_inner_banner();
			Newslist_Helper::the_breadcrumb();
		?>
	</div>
</div>