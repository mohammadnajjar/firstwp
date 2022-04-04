<div class="section-item clearfix">
	<i class="icon-item dashicons dashicons-megaphone"></i>
	<div class="content-item">
		<h2><?php esc_html_e('Recommended Actions', 'meta-news'); ?></h2>
		<p><?php esc_html_e('Complete the list of steps so that you can set up your site same like our demo which is very easy to follow.', 'meta-news'); ?></p>
		<a class="th-btn" href="<?php echo esc_url( admin_url('themes.php?page=meta-news-details&section=recommended_actions') ); ?>"><?php esc_html_e('Recommended Actions', 'meta-news'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<i class="icon-item dashicons dashicons-book-alt"></i>
	<div class="content-item">
		<h2><?php esc_html_e('Read Full Documentation', 'meta-news'); ?></h2>
		<p><?php printf(
			/* translators: Theme Name */
				esc_html__('Read our full documentation for all the detailed information on how to setup and use %s theme.', 'meta-news'), esc_html($this->theme_name) ); ?></p>
		<a class="th-btn" target="_blank" rel="noopener noreferrer" href="<?php echo esc_url( 'https://www.themehorse.com/theme-instruction/meta-news/' ); ?>"><?php esc_html_e('Read Full Documentation', 'meta-news'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<i class="icon-item dashicons dashicons-upload"></i>
	<div class="content-item">
		<h2><?php esc_html_e('Demo Content', 'meta-news'); ?></h2>
		<p><?php esc_html_e('Importing demo data is the easiest way to setup your site. Quickly edit everything instead of creating content from scratch.', 'meta-news'); ?></p>
		<a class="th-btn" href="<?php echo esc_url( admin_url('themes.php?page=meta-news-details&section=demo_content') ); ?>"><?php esc_html_e('Import Demo Content', 'meta-news'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<i class="icon-item dashicons dashicons-video-alt3"></i>
	<div class="content-item">
		<h2><?php esc_html_e('Video Tutorial', 'meta-news'); ?></h2>
		<p><?php esc_html_e('Watch video tutorial to manually setup the front page (home page) same like our demo site instead of importing demo content.', 'meta-news'); ?></p>
		<a class="th-btn" target="_blank" rel="noopener noreferrer" href="<?php echo esc_url('https://youtu.be/DEt9E2qVP6g'); ?>"><?php esc_html_e('Watch Video Tutorial', 'meta-news'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<i class="icon-item dashicons dashicons-admin-customizer"></i>
	<div class="content-item">
		<h2><?php esc_html_e('Theme Options', 'meta-news'); ?></h2>
		<p><?php esc_html_e('All settings and theme options are available via "Customizer" where you can easily customize different aspects of the theme.', 'meta-news'); ?></p>
		<a class="th-btn" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Go to Theme Options', 'meta-news'); ?></a>
	</div>
</div>