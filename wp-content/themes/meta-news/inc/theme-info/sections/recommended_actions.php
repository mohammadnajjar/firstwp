<div class="section-item clearfix">
	<div class="icon-item"><i class="dashicons dashicons-info info-demo-content"></i></div>
	<div class="content-item">
		<h3>
			<a href="<?php echo esc_url( admin_url('themes.php?page=meta-news-details&section=demo_content') ); ?>">
				<?php esc_html_e('Import Demo Content', 'meta-news'); ?>
			</a>
			<?php esc_html_e('or', 'meta-news'); ?>
			<a target="_blank" rel="noopener noreferrer" href="<?php echo esc_url('https://youtu.be/DEt9E2qVP6g'); ?>">
				<?php esc_html_e('Watch Video Tutorial', 'meta-news'); ?>
			</a>
			<?php esc_html_e('or Follow the below steps to setup manually:', 'meta-news'); ?>
		</h3>
	</div>
</div>
<div class="section-item clearfix">
	<div class="icon-item"><?php esc_html_e('Step 1:', 'meta-news'); ?></div>
	<div class="content-item">
		<h3><?php esc_html_e('Create a new page with "Front Page Template"', 'meta-news'); ?></h3>
		<ol>
			<li><?php esc_html_e('Create a new page with any title.', 'meta-news'); ?></li>
			<li><?php echo sprintf( esc_html__('Select %1$s"Front Page Template"%2$s for the option %1$sPage Attributes > Template%2$s which you can find it from the right section of the page editor.', 'meta-news'), '<strong>', '</strong>'  ); ?></li>
			<li><?php esc_html_e('Click on Publish', 'meta-news'); ?></li>
		</ol>
		<a class="th-btn" target="_blank" rel="noopener noreferrer" href="<?php echo esc_url(admin_url('post-new.php?post_type=page')); ?>"><?php esc_html_e('Create New Page', 'meta-news'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<div class="icon-item"><?php esc_html_e('Step 2:', 'meta-news'); ?></div>
	<div class="content-item">
		<h3><?php esc_html_e('Set "Your homepage displays" to "A Static Page"', 'meta-news'); ?></h3>
		<ol>
			<li><?php echo sprintf( esc_html__('Go to %1$s"Appearance > Customize > Homepage Settings"%2$s.', 'meta-news'), '<strong>', '</strong>'  ); ?></li>
			<li><?php echo sprintf( esc_html__('Set %1$s"Your homepage displays"%2$s to %1$s"A Static Page"%2$s.', 'meta-news'), '<strong>', '</strong>'  ); ?></li>
			<li><?php echo sprintf( esc_html__('Select the page that you have created in the %1$s"Step 1"%2$s for %1$s"Homepage"%2$s.', 'meta-news'), '<strong>', '</strong>'  ); ?></li>
			<li><?php esc_html_e('Click on Publish', 'meta-news'); ?></li>
		</ol>
		<a class="th-btn" target="_blank" rel="noopener noreferrer" href="<?php echo esc_url(admin_url('options-reading.php')); ?>"><?php esc_html_e('Assign Static Page', 'meta-news'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<div class="icon-item"><?php esc_html_e('Step 3:', 'meta-news'); ?></div>
	<div class="content-item">
		<h3><?php esc_html_e('Set "Widgets"', 'meta-news'); ?></h3>
		<ol>
			<li><?php echo sprintf( esc_html__('Go to %1$s"Appearance > Widgets"%2$s.', 'meta-news'), '<strong>', '</strong>'  ); ?></li>
			<li><?php echo sprintf( esc_html__('You can see 3 additional widgets %1$s"TH: Horizontal/Vertical Posts, TH: Card/Block Posts and TH: Recent Posts"%2$s which is specally designed for this theme. Drag and Drop these widget in %1$s"Front Page 3 Cols"%2$s or %1$s"Front Page 2 Cols"%2$s Sidebars (Widget Areas) as per your wish.', 'meta-news'), '<strong>', '</strong>'  ); ?></li>
			<li><?php esc_html_e('Set up the content/settings accordingly to the widget options', 'meta-news'); ?></li>
			<li><?php esc_html_e('Click on Save', 'meta-news'); ?></li>
		</ol>
		<a class="th-btn" target="_blank" rel="noopener noreferrer" href="<?php echo esc_url(admin_url('widgets.php')); ?>"><?php esc_html_e('Set Widgets', 'meta-news'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<div class="icon-item"><?php esc_html_e('Step 4:', 'meta-news'); ?></div>
	<div class="content-item">
		<h3><?php esc_html_e('Theme Options', 'meta-news'); ?></h3>
		<p><?php echo sprintf( esc_html__('Theme uses customizer API for theme options. All settings and theme options are available via %1$s"Appearance > Customize"%2$s where you can easily customize different aspects of the theme.', 'meta-news'), '<strong>', '</strong>'  ); ?></p>
		<a class="th-btn" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php esc_html_e('Go to Theme Options', 'meta-news'); ?></a>
	</div>
</div>