<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Elsie
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function elsie_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) || ( false === apply_filters( 'elsie_enable_sidebar', true ) ) ) {
		$classes[] = 'no-sidebar';
	}

	global $post;
	if ( isset( $post) ) {
		$page_layout = get_post_meta( $post->ID, '_elsie_page_layout', true );	

		if ( 'stretched'  === $page_layout ) { 
			$classes[] = 'layout-stretched';
		}

		//Sidebar
		if ( is_singular() ) {
			if ( is_single() ) {
				$single_post_layout = get_theme_mod( 'single_post_layout', 'sidebar-right' );
			} elseif ( is_page() ) {
				$single_post_layout = get_theme_mod( 'single_page_layout', 'sidebar-right' );
			}
			$classes[] = $single_post_layout;	
		}
	}

	if ( !is_singular() ) {
		$blog_layout = get_theme_mod( 'blog_sidebar_layout', 'sidebar-right' );
		$classes[] = $blog_layout;
	}

	$sticky = get_theme_mod( 'enable_header_sticky', 1 );
	if ( $sticky ) {
		$classes[] = 'has-sticky-header';
	}

	//header image class
	$hero_type = get_theme_mod( 'elsie_hero_type', 'header_image' );
	if ( 'header_image' === $hero_type ) {
		$hero_front_page	= get_theme_mod( 'hero_front_page', 1 );
		$hero_blog_page		= get_theme_mod( 'hero_blog_page', 0 );

		if ( ( $hero_blog_page && is_home() ) || ( $hero_front_page && is_front_page() ) ) {
			if ( !is_paged() ) {
				$classes[] = 'has-header-image';
			}
		}
	}


	return $classes;
}
add_filter( 'body_class', 'elsie_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post elements.
 * @return array
 */
function elsie_post_classes( $classes ) {

	$layout 	= elsie_blog_layout();
	$columns 	= get_theme_mod( 'blog_grid_columns', 'columns2' );

	switch ( $columns ) {
		case 'columns2':
			$columns = 'col-md-6 col-sm-6';
			break;

		case 'columns3':
			$columns = 'col-md-4 col-sm-4';
			break;

		case 'columns4':
			$columns = 'col-md-3 col-sm-3';
			break;			
	}

	if ( !is_singular() ) {
		if ( 'grid' === $layout || 'masonry' === $layout ) {
			$classes[] = $columns;
		} else {
			$classes[] = 'col-md-12';
		}
	}
	
	if ( class_exists( 'WooCommerce') && is_woocommerce() ) { 
		$classes = array_diff( $classes, array( 'col-md-6 col-sm-6', 'col-md-12' ) );
	}	

	//Remove hentry class from single pages
	if ( 'page' == get_post_type() ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
	}	

	return $classes;
}
add_filter( 'post_class', 'elsie_post_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function elsie_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'elsie_pingback_header' );

/**
 * Add sidebar
 */
function elsie_sidebar() { 

	if ( false === apply_filters( 'elsie_enable_sidebar', true ) ) { 
		return;
	}
	
	get_sidebar();
}
add_action( 'elsie_sidebar', 'elsie_sidebar' );

/**
 * Filter the sidebar
 */
function elsie_filter_sidebar() {

	if ( is_singular() ) {
		global $post;
		if ( isset( $post) ) {
			$page_layout 		= get_post_meta( $post->ID, '_elsie_page_layout', true );	
			if ( is_single() ) {
				$single_post_layout = get_theme_mod( 'single_post_layout', 'sidebar-right' );
			} elseif ( is_page() ) {
				$single_post_layout = get_theme_mod( 'single_page_layout', 'sidebar-right' );
			}
	
			if ( 'no-sidebar'  === $page_layout || 'no-sidebar'  === $single_post_layout || 'stretched'  === $page_layout ) { 
				add_filter( 'elsie_enable_sidebar', '__return_false' );
			}
		}
	} else {
		$layout = get_theme_mod( 'blog_sidebar_layout', 'sidebar-right' );

		if ( 'no-sidebar'  === $layout ) { 
			add_filter( 'elsie_enable_sidebar', '__return_false' );
		}		
	}

}
add_action( 'wp', 'elsie_filter_sidebar' );

/**
 * Build fonts URL
 */
function elsie_generate_fonts_url() {
	$fonts_url = '';
	$subsets = 'latin';

	$defaults_body	= json_encode(
		array(
			'font' 			=> 'Inter',
			'regularweight' => 'regular',
			'category' 		=> 'sans-serif'
		)
	);
	
	$defaults_headings = json_encode(
		array(
			'font' 			=> 'Cormorant Garamond',
			'regularweight' => '600',
			'category' 		=> 'sans-serif'
		)
	);	

	$body_font		= get_theme_mod( 'elsie_body_font', $defaults_body );
	$headings_font 	= get_theme_mod( 'elsie_headings_font', $defaults_headings );

	$body_font 		= json_decode( $body_font, true );
	$headings_font 	= json_decode( $headings_font, true );

	$font_families = array();

	$font_families[] = $body_font['font'] . ':' . $body_font['regularweight'];
		
	$font_families[] = $headings_font['font'] . ':' . $headings_font['regularweight'];

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( $subsets ),
		'display' => urlencode( 'swap' ),
	);

	$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );

	return esc_url_raw( $fonts_url );
}

/**
 * Blog layout
 */
function elsie_blog_layout() {
	
	$blog_layout = get_theme_mod( 'blog_layout', 'classic' );

	return $blog_layout;	
}

/**
 * Get SVG code. From TwentTwenty
 */
function elsie_get_svg_icon( $icon, $echo = false ) {
	$svg_code = wp_kses(
		Elsie_SVG_Icons::get_svg_icon( $icon ),
		array(
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
			),
			'path'    => array(
				'fill'      => true,
				'fill-rule' => true,
				'd'         => true,
				'transform' => true,
			),
			'polygon' => array(
				'fill'      => true,
				'fill-rule' => true,
				'points'    => true,
				'transform' => true,
				'focusable' => true,
			),
		)
	);	

	if ( $echo != false ) {
		echo '<span class="elsie-icon">' . $svg_code . '</span>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return '<span class="elsie-icon">' . $svg_code . '</span>';
	}
}

/**
 * Excerpt length
 */
function elsie_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	$length = get_theme_mod( 'excerpt_length', '22' );

	return $length;
}
add_filter( 'excerpt_length', 'elsie_excerpt_length', 999 );

/**
 * Remove archive labels
 */
function elsie_remove_archive_labels( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
add_filter( 'get_the_archive_title', 'elsie_remove_archive_labels' );

/**
 * Post types helper
 */
function elsie_post_types_helper() {
	$args 	= array( 'public' => true );
	$post_types = get_post_types( $args, 'object' );

	$items = array();
	foreach ( $post_types as $key => $post_type ) {
		$items[$key] = $post_type->label;
	}

	unset($items['attachment']);

	return $items;
}

function elsie_get_all_posts_helper() {
	$args = array(
		'numberposts'	=> -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_numberposts
	);

	$posts = get_posts( $args );

	$items = array();
	foreach ( $posts as $key => $item ) {
		$items[$item->ID] = $item->post_title;
	};

	return $items;	
}


/**
 * Archives and search titles
 */
function elsie_archive_titles() { 

	if ( class_exists( 'WooCommerce' ) && is_woocommerce() && !is_product()	) : ?>
	<header class="woocommerce-products-header page-header">
		<div class="container">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>
			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>
		</div>
	</header>	
	<?php elseif ( is_archive() ) : ?>
	<header class="page-header">
		<div class="container">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>		
		</div>
	</header><!-- .page-header -->
	<?php elseif ( is_search() ) : ?>
	<header class="page-header">
		<div class="container">
			<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'elsie' ), '<h1 class="page-title">' . get_search_query() . '</h1>' );
			?>
		</div>
	</header><!-- .page-header -->
	<?php
	endif;
}
add_action( 'elsie_after_header', 'elsie_archive_titles' );

/**
 * Theme colors
 */
if ( !function_exists( 'elsie_theme_colors' ) ) {
	function elsie_theme_colors() {
		return array(
			'color-accent' 				=> '#950b0b',
			'color-accent-dark' 		=> '#950b0b',
			'color-secondary' 			=> '#ff207d',
			'color-borders' 			=> '#e4e6ea',
			'color-light-background' 	=> '#F4F2F1',
			'color-gray' 				=> '#97a5b1',
			'color-dark-bg' 			=> '#000000',
			'color-white' 				=> '#ffffff',
			'color-white-text' 			=> '#ffffff',
			'color-headings' 			=> '#000000',
			'color-text' 				=> '#000000',
		);
	}
}

/**
 * Sharing options
 */
function elsie_post_sharing_links() {

	$enable = get_theme_mod( 'single_post_sharing', 1 );

	if ( !$enable ) {
		return;
	}

    global $post;

    $post_url   	= urlencode( esc_url( get_permalink($post->ID) ) );
    $post_title 	= urlencode( $post->post_title );
	$sharing_title 	= get_theme_mod( 'post_share_title', esc_html__( 'Share this post', 'elsie' ) );

	$urls = array(
		'facebook' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_facebook', 1 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://www.facebook.com/sharer.php?u={url}' ) ),
		),
		'twitter' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_twitter', 1 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://twitter.com/intent/tweet?url={url}&text={title}' ) ),
		),
		'linkedin' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_linkedin', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://www.linkedin.com/sharing/share-offsite/?url={url}' ) ),
		),
		'reddit' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_reddit', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://reddit.com/submit?url={url}&title={title}' ) ),
		),
		'whatsapp' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_whatsapp', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'whatsapp://send/?text={url}' ) ),
		),
		'pinterest' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_pinterest', 1 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'http://pinterest.com/pin/create/link/?url={url}' ) ),
		),
		'telegram' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_telegram', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://t.me/share/url?url={url}&text={title}' ) ),
		),
		'weibo' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_weibo', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'http://service.weibo.com/share/share.php?url={url}&appkey=&title={title}&pic=&ralateUid=' ) ),
		),
		'vk' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_vk', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'http://vk.com/share.php?url={url}&title={title}&comment={text}' ) ),
		),
		'ok' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_ok', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl={url}' ) ),
		),		
		'xing' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_xing', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://www.xing.com/spi/shares/new?url={url}' ) ),
		),		
		'mail' 	=> array(
			'enabled' 	=> get_theme_mod( 'enable_share_mail', 0 ),
			'url' 		=> str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'mailto:?subject=' . $post->post_title . '&body={url}' ) ),
		),
	);	

	$output = 	'<div class="elsie-sharing">';
	if ( '' !== $sharing_title ) {
		$output .=	'<h4>' . esc_html( $sharing_title ) . '</h4>';
	}
	$output .= 		'<div class="sharing-icons">';
						foreach ( $urls as $network => $url ) {
							if ( $url['enabled'] ) {
								$output .= '<a target="_blank" href="' . $url['url'] . '" class="share-button share-button-' . esc_attr( $network ) . '">' . elsie_get_svg_icon( 'icon-' . $network, false ) . '</a>';
							}
						}
	$output .= 		'</div>';
	$output .= 	'</div>';

    echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Submenu symbols
 */
function elsie_submenu_symbols( $item_output, $item, $depth, $args ) {
	
	if ( empty( $args->theme_location ) || 'primary-menu' !== $args->theme_location ) {
		return $item_output;
	}

	if ( ! empty( $item->classes ) && in_array( 'menu-item-has-children', $item->classes ) ) {
		return $item_output . '<span tabindex=0 class="icon-dropdown">' . elsie_get_svg_icon( 'icon-dropdown', false ) . '</span>';
	}

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'elsie_submenu_symbols', 10, 4 );

/**
 * Masonry init
 */
function elsie_masonry_init() {

	$layout = elsie_blog_layout();

	if ( 'masonry' !== $layout ) {
		return;
	}

	echo 'data-masonry=\'{ "itemSelector": "article", "horizontalOrder": true }\'';
}


/**
 * Get social network
 */
function elsie_get_social_network( $social ) {

	//Available networks
	$networks = array( 'facebook', 'twitter', 'instagram', 'github', 'linkedin', 'youtube', 'xing', 'instagram', 'flickr', 'dribbble', 'vk', 'weibo', 'vimeo', 'mix', 'behance', 'spotify', 'soundcloud', 'twitch', 'bandcamp', 'etsy', 'pinterest' );

	//Loop through the networks and find the current one
	foreach ( $networks as $network ) {
		$found = strpos( $social, $network );

		if ( $found !== false ) {
			return $network;
		}
	}
}


/**
 * Boxes
 */
function elsie_featured_boxes() {

	$front_page		= get_theme_mod( 'featured_boxes_front_page', 0 );
	$blog_page		= get_theme_mod( 'featured_boxes_blog_page', 0 );

	if ( ( $front_page && is_home() ) || ( $blog_page && is_front_page() ) ) {
		
		if ( is_paged() ) {
			return;
		}

		$img1 		= get_theme_mod( 'featured_box_img1', get_stylesheet_directory_uri() . '/assets/img/box1.jpg' );
		$img2 		= get_theme_mod( 'featured_box_img2', get_stylesheet_directory_uri() . '/assets/img/box2.jpg' );
		$img3 		= get_theme_mod( 'featured_box_img3', get_stylesheet_directory_uri() . '/assets/img/box3.jpg' );
		$title1 	= get_theme_mod( 'featured_box_title1', esc_html__( 'Travel', 'elsie' ) );
		$title2 	= get_theme_mod( 'featured_box_title2', esc_html__( 'Fashion', 'elsie' ) );
		$title3 	= get_theme_mod( 'featured_box_title3', esc_html__( 'Contact', 'elsie' ) );
		$link1 		= get_theme_mod( 'featured_box_link1', '#' );
		$link2 		= get_theme_mod( 'featured_box_link2', '#' );
		$link3 		= get_theme_mod( 'featured_box_link3', '#' );

		?>
		<div class="featured-boxes">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="featured-box" style="background-image: url('<?php echo esc_url( $img1 ); ?>')">
							<a class="box-img" title="<?php echo esc_attr( $title1 ); ?>" href="<?php echo esc_url( $link1 ); ?>"></a>
							<a class="box-link" title="<?php echo esc_attr( $title1 ); ?>" href="<?php echo esc_url( $link1 ); ?>"><span class="box-title-text1"><?php echo esc_html( $title1 ); ?></span></a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="featured-box" style="background-image: url('<?php echo esc_url( $img2 ); ?>')">
							<a class="box-img" title="<?php echo esc_attr( $title2 ); ?>" href="<?php echo esc_url( $link2 ); ?>"></a>
							<a class="box-link" title="<?php echo esc_attr( $title2 ); ?>" href="<?php echo esc_url( $link2 ); ?>"><span class="box-title-text2"><?php echo esc_html( $title2 ); ?></span></a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="featured-box" style="background-image: url('<?php echo esc_url( $img3 ); ?>')">
							<a class="box-img" title="<?php echo esc_attr( $title3 ); ?>" href="<?php echo esc_url( $link3 ); ?>"></a>
							<a class="box-link" title="<?php echo esc_attr( $title3 ); ?>" href="<?php echo esc_url( $link3 ); ?>"><span class="box-title-text3"><?php echo esc_html( $title3 ); ?></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

}
add_action( 'elsie_after_header', 'elsie_featured_boxes', 20 );