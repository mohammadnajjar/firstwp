<?php
/**
 * Meta News functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package Meta News
 */

if ( !function_exists( 'meta_news_social_profiles' ) ) {
	/**
	 * Functions for Social Profiles.
	 */
	function meta_news_social_profiles() {
		$social_profiles = meta_news_social_profiles_list(); ?>
		<ul>
			<?php
			$social_profiles_output = '';
			foreach ($social_profiles as $key => $value) {
				$link = get_theme_mod( $key, '' );
				if ( !empty( $link ) ) {
					$social_profiles_output .= '<li><a target="_blank" rel="noopener noreferrer" class="fab fa-' . $value['class'] . '" href="' . esc_url($link) . '" title="' . esc_attr($value['title']) . '"></a></li>';
				}
			}
			echo $social_profiles_output; ?>
		</ul>
	<?php }
}

if ( !function_exists( 'meta_news_is_social_profiles_links' ) ) {
	/**
	 * Functions for to count Social Profiles links.
	 */
	function meta_news_is_social_profiles_links() {
		$social_profiles = meta_news_social_profiles_list();
		$social_profiles_links = 0;
		foreach ($social_profiles as $key => $value) {
			$link = get_theme_mod( $key, '' );
			if ( !empty( $link ) ) {
				$social_profiles_links += 1;
			}
		}
		return $social_profiles_links;
	}
}

if ( !function_exists('meta_news_layout_primary') ) {
	/**
	 * Functions for Sidebars.
	 */
	function meta_news_layout_primary() {
		$meta_news_settings = meta_news_get_option_defaults();
		global $post;

		if ($post) {
			$meta_news_meta_layout = get_post_meta($post->ID, 'meta_news_sidebarlayout', true);
		}
		$meta_news_custom_layout = $meta_news_settings['meta_news_content_layout'];

		if ( empty($meta_news_meta_layout) || is_archive() || is_search() || is_home() ) {
			$meta_news_meta_layout = 'default';
		}

		if ( 'default' == $meta_news_meta_layout ) {
			if ( ('right' == $meta_news_custom_layout) || ('nosidebar' == $meta_news_custom_layout) ) {
				$class = 'col-lg-8 ';
			}
			elseif ( 'left' == $meta_news_custom_layout ) {
				$class = 'col-lg-8 order-lg-2 ';
			}
			elseif ( 'fullwidth' == $meta_news_custom_layout ) {
				$class = 'col-lg-12 ';
			}
		}
		elseif ( ('meta-right' == $meta_news_meta_layout) || ('meta-nosidebar' == $meta_news_meta_layout) ) {
			$class = 'col-lg-8 ';
		}
		elseif ( 'meta-left' == $meta_news_meta_layout ) {
			$class = 'col-lg-8 order-lg-2 ';
		}
		elseif ( 'meta-fullwidth' == $meta_news_meta_layout ) {
			$class = 'col-lg-12 ';
		}

		$sticky_column_class = '';
		if ( ( ('default' == $meta_news_meta_layout) && ( !(('nosidebar' == $meta_news_custom_layout)|| (is_404()) || (is_search()) || ('fullwidth' == $meta_news_custom_layout)) ) ) || ( !(('default' == $meta_news_meta_layout) || ('meta-fullwidth' == $meta_news_meta_layout) || ('meta-nosidebar' == $meta_news_meta_layout)) ) ) {
			$sticky_column_class = ' sticky-column-bottom';
		}

		echo '<div id="primary" class="' . $class . 'content-area' . $sticky_column_class . '">';

	}
}

if ( ! function_exists( 'meta_news_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function meta_news_posted_on() {

		$time_string = get_the_time( get_option( 'date_format' ) );

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" title="'. the_title_attribute('echo=0') . '">' . esc_html( $time_string ) . '</a> ';

		echo '<div class="date">' . $posted_on . '</div>';

	}
endif;

if ( ! function_exists( 'meta_news_posted_by' ) ) :
	/**
	 * Prints HTML with meta information of post author.
	 */
	function meta_news_posted_by() {

		$byline = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html( get_the_author() ) . '</a> ';

		echo ' <div class="by-author vcard author">' . $byline . '</div>';

	}
endif;

if ( ! function_exists( 'meta_news_breadcrumbs' ) ) :
	/**
	 * Simple Breadcrumbs.
	 *
	 * @since 1.1.1
	 */
	function meta_news_breadcrumbs() {
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/assets/library/breadcrumbs/breadcrumbs.php';
		}
		$args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail($args);
	}

endif;


if ( ! function_exists( 'meta_news_register_required_plugins' ) ) :
	/**
	 * Register the required plugins for this theme.
	 *
	 */
	function meta_news_register_required_plugins() {

		$plugins = array(
			array(
				'name'     => esc_html__( 'One Click Demo Import', 'meta-news' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
		);

		tgmpa( $plugins );

	}
endif;

add_action( 'tgmpa_register', 'meta_news_register_required_plugins' );

if ( ! function_exists( 'meta_news_ocdi_after_import' ) ) :
	/**
	 * function to import/export demo data
	 */
	function meta_news_ocdi_after_import() {

		// Set static front page and posts page
		$front_page = 'Home';
		$blog_page  = 'Blog';
		update_option( 'show_on_front', 'page' );

		$pages = array(
			'page_on_front'  => $front_page,
			'page_for_posts' => $blog_page,
		);

		foreach ( $pages as $option_key => $slug ) {
			$result = get_page_by_title( $slug );
			if ( $result ) {
				if ( is_array( $result ) ) {
					$object = array_shift( $result );
				} else {
					$object = $result;
				}

				update_option( $option_key, $object->ID );
			}
		}

		// Assign navigation menu locations.
		$menu_details = array(
			'primary'			=> 'main-menu',
			'right-section'     => 'top-right-menu',
		);

		if ( !empty($menu_details) ) {
			$nav_settings  = array();
			$current_menus = wp_get_nav_menus();

			if ( !empty( $current_menus ) && !is_wp_error( $current_menus ) ) {
				foreach ( $current_menus as $menu ) {
					foreach ( $menu_details as $location => $menu_slug ) {
						if ( $menu->slug === $menu_slug ) {
							$nav_settings[ $location ] = $menu->term_id;
						}
					}
				}
			}

			set_theme_mod( 'nav_menu_locations', $nav_settings );
		}
	}
endif;

add_action( 'pt-ocdi/after_import', 'meta_news_ocdi_after_import' );

// Disable PT branding.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
