<?php
/**
 * Content for header
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */ ?>
<div class="<?php echo Newslist_Helper::with_prefix( 'header-wrapper' ); ?>">
	<div class="container">
		<section class="<?php echo Newslist_Helper::with_prefix( 'header-top' ); ?>">
			<div class="site-branding">
				<div>
					<?php the_custom_logo(); ?>
					<div>
						<?php if ( is_front_page() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :	?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php 
				$banner_image = newslist_get( 'banner-image' ); 
				$banner_new_tab = newslist_get( 'banner-link-open-newtab' );
				if( $banner_new_tab) :
					$style = 'target="_blank" ';
				else :
					$style = '';
				endif;
				if( '' != $banner_image) : ?>
				<div class ="newslist-header-banner-image">		
					<?php echo $alt = get_post_meta( $banner_image, '_wp_attachment_image_alt', true );  ?>		
					<a href ="<?php echo esc_url(newslist_get( 'banner-link' ) ); ?>" <?php echo  $style?>>
						<span class="screen-reader-text"><?php esc_html__('Banner Image', 'newslist' ); ?></span>
							<img src="<?php echo esc_url( $banner_image ); ?>" alt="<?php echo esc_attr( $alt ); ?>">			
					</a> 		
				<?php endif; ?>
				</div> 
		</section>
	</div>
</div>
<div class="<?php echo Newslist_Helper::with_prefix('navigation-n-options'); ?>">
	<div class="container">
		<div class="newslist-header-bottom">
			<div class="<?php echo Newslist_Helper::with_prefix( 'navigation-n-options' ); ?>">
				<nav class="newslist-main-menu" id="site-navigation">
					<?php Newslist_Helper::get_menu( 'primary', true ); ?>
				</nav>
			</div>
			<div class="newslist-header-right">	
				<div class="newslist-header-social">
					<div class="newslist-social-link-header newslist-social-menu">
						<?php Newslist_Helper::get_menu( 'social-menu-header', true ); ?>
					</div>
				</div>
				<div class="newslist-btns-wrapper">			
					<?php do_action( Newslist_Helper::fn_prefix( 'after_primary_menu' ) ); ?>
				</div> 
				<div class="<?php echo Newslist_Helper::with_prefix( 'header-search' ); ?>">
					<button class="circular-focus screen-reader-text" data-goto=".newslist-header-search .newslist-toggle-search">
					<span class="screen-reader-text"> <?php esc_html__( 'Search', 'newslist' ); ?> </span>
						<?php esc_html_e( 'Circular focus', 'newslist' ); ?>
					</button>
					<?php get_search_form(); ?>
					<button type="button" class="close <?php echo Newslist_Helper::with_prefix( 'toggle-search' ); ?>">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
					<button class="circular-focus screen-reader-text" data-goto=".newslist-header-search .search-field">
						<?php esc_html_e( 'Circular focus', 'newslist' ); ?>
					</button>
				</div>
			<div>	
		</div>
	</div>
</div>
