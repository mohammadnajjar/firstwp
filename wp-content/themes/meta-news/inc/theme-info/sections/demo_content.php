<div class="section-item clearfix">
	<div class="icon-item"><i class="dashicons dashicons-info info-demo-content"></i></div>
	<div class="content-item">
		<h3>
			<a href="<?php echo esc_url( admin_url('themes.php?page=meta-news-details&section=recommended_actions') ); ?>">
				<?php esc_html_e('Setup manually', 'meta-news'); ?>
			</a>
			<?php esc_html_e('or Follow the below steps to Import demo content:', 'meta-news'); ?>
		</h3>
	</div>
</div>
<div class="section-item clearfix">
	<div class="content-item">
		<p><?php printf( esc_html__( 'Importing demo data is the easiest way to setup your site same like our demos. %s It will allow you to quickly edit everything instead of creating content from scratch.', 'meta-news' ),'<br>'); ?></p>
		<ol>
			<li><?php echo sprintf( esc_html__( 'Install and Activate the %1$s"One Click Demo Import"%2$s plugin. If you have not.', 'meta-news' ), '<a target="_blank" rel="noopener noreferrer" href="' . esc_url('https://wordpress.org/plugins/one-click-demo-import/') . '">', '</a>' ); ?></li>
			<li><?php echo sprintf( esc_html__('After activating it just go to %1$s"Import Demo Data"%2$s option under %1$s"Appearance"%2$s.', 'meta-news'), '<strong>', '</strong>' ); ?></li>
			<li><?php echo sprintf( esc_html__( 'Download the desired demo data from %1$shere%2$s.', 'meta-news' ), '<a target="_blank" rel="noopener noreferrer" href="' . esc_url('https://www.themehorse.com/theme-instruction/meta-news/#DemoContent') . '">', '</a>' ); ?></li>
			<li><?php echo sprintf( esc_html__('Choose a %1$sXML, WIE%2$s and %1$sDAT%2$s file and click on %1$s"Import Demo Data"%2$s button than you can see your site with our demo content.', 'meta-news'), '<strong>', '</strong>' ); ?></li>
			<li><?php echo sprintf( esc_html__( 'Now go to the %1$sCustomize%2$s where all settings and theme options are available where you can easily customize different aspects of the theme.', 'meta-news' ), '<a href="' . esc_url(admin_url('customize.php')) . '">', '</a>' ); ?></li>
		</ol>
	</div>
</div>