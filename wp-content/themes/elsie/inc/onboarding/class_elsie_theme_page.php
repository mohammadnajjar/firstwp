<?php
/**
 * Theme page
 *
 */

class Elsie_Theme_Page {
	/**
	 * Instance of class.
	 *
	 * @var bool $instance instance variable.
	 */
	private static $instance;

	/**
	 * Check if instance already exists.
	 *
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Main ) ) {
			self::$instance = new Elsie_Theme_Page();
		}

		return self::$instance;
	}

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'admin_menu', __CLASS__ . '::theme_page', 99 );

	}	

	/**
	 * Theme page
	 */
	public static function theme_page() {
		$theme_page = add_theme_page( esc_html__( 'Elsie theme', 'elsie' ), esc_html__( 'Elsie theme', 'elsie' ), 'edit_theme_options', 'elsie-theme.php', __CLASS__ . '::markup' );
		add_action( 'load-' . $theme_page, __CLASS__ . '::theme_page_styles' );
	}	

	/**
	 * Theme page markup
	 */
	public static function markup() {
		if ( !current_user_can( 'edit_theme_options' ) )  {
			wp_die( esc_html__( 'You do not have the right to view this page', 'elsie' ) );
		}

		$theme = wp_get_theme();

		?>
		<div class="elsie-theme-page">
			<div class="theme-page-header">
				<div class="theme-page-container">
					<h2>Elsie</h2><span class="theme-version"><?php echo esc_html( $theme->version ); ?></span>
				</div>
			</div>
			<div class="theme-page-container">
				<div class="theme-page-content">
					<div class="theme-grid">
						<?php /*
						<div class="grid-item">
							<h3><span class="dashicons dashicons-admin-page"></span><?php echo esc_html__( 'Starter sites', 'elsie' ); ?></h3>
							<p><?php echo esc_html__( 'Looking for a quick start? You can import one of our premade demos.', 'elsie' ); ?></p>
							<?php Elsie_Install_Plugins::instance()->do_plugin_install(); ?>
						</div>
						*/ ?>
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-sos"></span><?php echo esc_html__( 'Need help?', 'elsie' ); ?></h3>
							<p><?php echo esc_html__( 'Are you stuck? No problem! Send us a message and we\'ll be happy to help you.', 'elsie' ); ?></p>
							<a class="button" href="https://elfwp.com/support/" target="_blank"><?php echo esc_html__( 'Contact support', 'elsie' ); ?></a>
						</div>
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-welcome-write-blog"></span><?php echo esc_html__( 'Changelog', 'elsie' ); ?></h3>
							<p><?php echo esc_html__( 'Read our changelog and see what recent changes we\'ve implemented in Elsie', 'elsie' ); ?></p>
							<a class="button" href="https://elfwp.com/changelog/elsie/" target="_blank"><?php echo esc_html__( 'See the changelog', 'elsie' ); ?></a>
						</div>	

						<div class="grid-item">
							<h3><span class="dashicons dashicons-admin-generic"></span><?php echo esc_html__( 'Header options', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=elsie_header_panel' ) ); ?>"><?php esc_html_e( 'Go to the options', 'elsie' ); ?></a>
						</div>							

						<div class="grid-item">
							<h3><span class="dashicons dashicons-grid-view"></span><?php echo esc_html__( 'Blog options', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=elsie_section_blog_archives' ) ); ?>"><?php esc_html_e( 'Go to the options', 'elsie' ); ?></a>
						</div>		
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-admin-generic"></span></span><?php echo esc_html__( 'Single post options', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=elsie_section_blog_singles' ) ); ?>"><?php esc_html_e( 'Go to the options', 'elsie' ); ?></a>
						</div>							
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-format-image"></span><?php echo esc_html__( 'Upload your logo', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ); ?>"><?php esc_html_e( 'Go to the options', 'elsie' ); ?></a>
						</div>
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-admin-customizer"></span><?php echo esc_html__( 'Change colors', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=colors' ) ); ?>"><?php esc_html_e( 'Change colors', 'elsie' ); ?></a>
						</div>	

						<div class="grid-item">
							<h3><span class="dashicons dashicons-admin-customizer"></span><?php echo esc_html__( 'Change fonts', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=elsie_typography' ) ); ?>"><?php esc_html_e( 'Change colors', 'elsie' ); ?></a>
						</div>	
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-text"></span><?php echo esc_html__( 'Change footer credits', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=footer_credits' ) ); ?>"><?php esc_html_e( 'Go to the options', 'elsie' ); ?></a>
						</div>			
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-format-image"></span><?php echo esc_html__( 'Customize buttons', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=elsie_buttons' ) ); ?>"><?php esc_html_e( 'Go to the options', 'elsie' ); ?></a>
						</div>		
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-controls-forward"></span><?php echo esc_html__( 'Configure breadcrumbs', 'elsie' ); ?></h3>
							<a target="_blank" class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=elsie_breadcrumbs ' ) ); ?>"><?php esc_html_e( 'Go to the options', 'elsie' ); ?></a>
						</div>							
					</div>					
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Theme page styles and scripts
	 */
	public static function theme_page_styles() {
		add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles' );
	}

	/**
	 * Styles
	 */
	public static function styles( $hook ) {

		if ( 'appearance_page_elsie-theme' != $hook ) {
			return;
		}

		wp_enqueue_style( 'elsie-theme-page-styles', get_template_directory_uri() . '/inc/onboarding/assets/css/theme-page.min.css', array(), ELSIE_VERSION );
	}	

}

$elsie_theme_page = new Elsie_Theme_Page();