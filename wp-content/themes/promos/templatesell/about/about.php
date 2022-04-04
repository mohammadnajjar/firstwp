<?php
/**
 * Added promos Page.
*/

/**
 * Add a new page under Appearance
 */
function promos_menu() {
	add_theme_page( __( 'Promos Options', 'promos' ), __( 'Promos Options', 'promos' ), 'edit_theme_options', 'promos-theme', 'promos_page' );
}
add_action( 'admin_menu', 'promos_menu' );

/**
 * Enqueue styles for the help page.
 */
function promos_admin_scripts( $hook ) {
	if ( 'appearance_page_promos-theme' !== $hook ) {
		return;
	}
	wp_enqueue_style( 'promos-admin-style', get_template_directory_uri() . '/templatesell/about/about.css', array(), '' );
}
add_action( 'admin_enqueue_scripts', 'promos_admin_scripts' );

/**
 * Add the theme page
 */
function promos_page() {
	?>
	<div class="das-wrap">
		<div class="promos-panel">
			<div class="promos-logo">
				<img class="ts-logo" src="<?php echo esc_url( get_template_directory_uri() . '/templatesell/about/images/promos-logo.png' ); ?>" alt="Logo">
			</div>
			<a href="https://www.templatesell.com/item/promos-plus/" target="_blank" class="btn btn-success pull-right"><?php esc_html_e( 'Upgrade Pro $49', 'promos' ); ?></a>
			<p>
			<?php esc_html_e( 'A perfect theme for blog and magazine site. With masonry layout and multiple blog page layout, this theme is the awesome and minimal theme.', 'promos' ); ?></p>
			<a class="btn btn-primary" href="<?php echo esc_url (admin_url( '/customize.php?' ));
				?>"><?php esc_html_e( 'Theme Options - Click Here', 'promos' ); ?></a>
		</div>

		<div class="promos-panel">
			<div class="promos-panel-content">
				<div class="theme-title">
					<h3><?php esc_html_e( 'Looking for theme Documentation?', 'promos' ); ?></h3>
				</div>
				<a href="http://docs.templatesell.net/promos" target="_blank" class="btn btn-secondary"><?php esc_html_e( 'Documentation - Click Here', 'promos' ); ?></a>
			</div>
		</div>
		<div class="promos-panel">
			<div class="promos-panel-content">
				<div class="theme-title">
					<h3><?php esc_html_e( 'If you like the theme, please leave a review', 'promos' ); ?></h3>
				</div>
				<a href="https://wordpress.org/support/theme/promos/reviews/#new-post" target="_blank" class="btn btn-secondary"><?php esc_html_e( 'Rate this theme', 'promos' ); ?></a>
			</div>
		</div>
		<div class="promos-panel">
			<div class="promos-panel-content">
				<div class="theme-title">
					<h3><?php esc_html_e( 'Recommended plugin for SEO. Rank Math is the best plugin and we would like to recommend it.', 'promos' ); ?></h3>
				</div>
				<a href="https://rankmath.com/?ref=templatesell" target="_blank" class="btn btn-secondary"><?php esc_html_e( 'Download Rank Math Plugin', 'promos' ); ?></a>
				<span>
			<?php esc_html_e( 'Here we included an affiliate link to Rank Math Plugin. If you click on the link and buy the product, we’ll receive a small fee. No worries though, you’ll still pay the standard amount without any extra cost to you.', 'promos' ); ?></span><a href="https://www.templatesell.com/blog/template-sell-uses-rank-math/" target="_blank" class="about-link"><?php esc_html_e( 'Read why Template Sell recommend Rank Math', 'promos' ); ?></a>
			</div>
		</div>
	</div>
	<?php
}
