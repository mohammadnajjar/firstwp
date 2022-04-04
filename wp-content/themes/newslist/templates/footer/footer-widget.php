<?php

/**
 * Content for footer widget
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */
if ( !apply_filters( Newslist_Helper::fn_prefix( 'disable_footer_widget' ), false ) ) : ?>
	<footer <?php Newslist_Helper::schema_body( 'footer' ) ; ?> class="footer-top-section">
		<div class="footer-widget">
			<div class="container">
				<div class="row">					
					<?php if ( is_active_sidebar( Newslist_Helper::fn_prefix( 'footer_widget_area' ) ) ) : ?>
						<aside class="col footer-widget-wrapper py-5">
							<?php dynamic_sidebar( Newslist_Helper::fn_prefix( 'footer_widget_area' ) ); ?>
						</aside>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</footer>
<?php endif;
