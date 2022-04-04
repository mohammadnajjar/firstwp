<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Promos
 */
$GLOBALS['promos_theme_options'] = promos_get_options_value();
global $promos_theme_options;
$enable_social = absint($promos_theme_options['promos_enable_top_header_social']);
$search_header = absint($promos_theme_options['promos_enable_search']);
$menu_text_mobile = esc_html($promos_theme_options['promos_mobile_menu_text']);
$mobile_menu_type = esc_attr($promos_theme_options['promos_mobile_menu_option']);
?>

<header class="header-1">	
	<?php $header_image = esc_url(get_header_image());
	$header_class = ($header_image == "") ? '' : 'header-image';
	?>
	<section class="main-header <?php echo esc_attr($header_class); ?>" style="background-image:url(<?php echo esc_url($header_image) ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
		<div class="head_one clearfix">
			<div class="container">
				<div class="logo">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				endif;
				$promos_description = get_bloginfo( 'description', 'display' );
				if ( $promos_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $promos_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-logo -->
		</div>
	</div>
	<div class="menu-area">
		<div class="container">					
			<nav id="site-navigation">
				<button class="bar-menu">
					<?php if($mobile_menu_type == 'menu-icon'){ ?>
						<span class="berger"><span></span></span>
						<?php }else{ ?>
						<span><?php echo $menu_text_mobile; ?></span>
					<?php } ?>
				</button>
				<div class="main-menu menu-caret">
					<?php
					if(has_nav_menu( 'menu-1' )) :
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container' => 'ul',
							'menu_class'      => ''
						));
					else:
						?>
						<ul>
							<?php
							wp_list_pages(array('depth' => 0, 'title_li' => ''));
							?>
						</ul>
						<?php
                        endif; // has_nav_menu
					?>
				</div>
				<div class="right-block d-flex align-items-center">
					<?php if( $enable_social == 1 ){ ?>
						<div class="right-side">
							<div class="social-links">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_id'        => 'social-menu',
										'menu_class'     => 'promos-social-menu',
									) );
								?>
							</div>
						</div>
					<?php } ?>
					<?php if( 1 == $search_header ){ ?>
						<div class="search-wrapper">					
							<div class="search-box">
								<a href="javascript:void(0);" class="s_click"><i class="fa fa-search first_click" aria-hidden="true" style="display: block;"></i></a>
								<a href="javascript:void(0);" class="s_click"><i class="fa fa-times second_click" aria-hidden="true" style="display: none;"></i></a>
							</div>
							<div class="search-box-text">
								<?php echo get_search_form(); ?>
							</div>				
						</div>
					<?php } ?>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</div>
</setion><!-- #masthead -->
</header>

