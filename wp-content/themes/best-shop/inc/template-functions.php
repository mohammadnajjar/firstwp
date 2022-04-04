<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Best_Shop
 */

if( ! function_exists( 'best_shop_doctype' ) ) :
	/**
	 * Doctype Declaration
	*/
	function best_shop_doctype(){
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'best_shop_doctype', 'best_shop_doctype' );

if( ! function_exists( 'best_shop_head' ) ) :
	/**
	 * Before wp_head 
	*/
	function best_shop_head(){
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
	}
endif;
add_action( 'best_shop_before_wp_head', 'best_shop_head' );

if( ! function_exists( 'best_shop_page_start' ) ) :
	/**
	 * Page Start
	*/
	function best_shop_page_start(){
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'best-shop' ); ?></a>
		<?php
	}
endif;
add_action( 'best_shop_before_header', 'best_shop_page_start' );



if( ! function_exists( 'best_shop_primary_page_header' ) ) :
/**
 * Page Header
*/
function best_shop_primary_page_header(){ 
	if( is_front_page() ) return;

	if( is_search() || is_home() || is_archive() || is_singular( 'product' ) ){ ?>
		<header class="page-header">
			<div class="container">
				<div class="breadcrumb-wrapper">
					<?php best_shop_breadcrumb(); ?>
				</div>
				<?php 
				if( best_shop_is_woocommerce_activated() && is_singular( 'product' ) ){
					the_title( '<h2 class="page-title">','</h2>' ); 
				}
				if( is_search() ) { ?>
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html( '%s', 'best-shop' ), get_search_query() );
						?>
					</h1>
				<?php } elseif( is_home() && ! is_front_page() ) { 	?>			
					<h1 class="page-title">
						<?php echo esc_html( best_shop_get_setting( 'blog_section_title' ) ); ?>
					</h1>					
				<?php }
				 elseif ( is_archive() ) { 	
					if( best_shop_is_woocommerce_activated() && is_shop() ){
						echo '<h1 class="page-title">';
						echo esc_html( get_the_title( wc_get_page_id( 'shop' ) ) );
						echo '</h1>';
					}elseif( is_author() ){
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					}else{
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					}
				} ?>
			</div>
		</header><!-- .page-header -->
	<?php 
	}
}
endif;
add_action( 'best_shop_before_posts_content', 'best_shop_primary_page_header', 10 );

if( ! function_exists( 'best_shop_entry_header' ) ) :
/**
 * Entry Header
*/
function best_shop_entry_header(){ 
	if ( is_single() ) { ?>
		<header class="entry-header">
			<div class="category--wrapper">
				<?php best_shop_category(); ?>
			</div>
			<div class="entry-title-wrapper">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			</div>
			<?php best_shop_single_author_meta(); ?>
		</header>
	<?php } else { ?>
		<header class="entry-header">
			<div class="entry-meta">
				<?php best_shop_category(); ?>
			</div><!-- .entry-meta -->
			<div class="entry-details">
				<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );	?>
			</div>
		</header><!-- .entry-header -->
	<?php }
}
endif;
add_action( 'best_shop_post_entry_header', 'best_shop_entry_header' );

if( ! function_exists( 'best_shop_entry_content' ) ) :
/**
 * Entry Content
*/
function best_shop_entry_content(){ 
	if( is_front_page() ) return;
	?>
	<div class="entry-content" itemprop="text">
		<?php
			if( is_singular() ){
				the_content();    
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'best-shop' ),
					'after'  => '</div>',
				) );
			}elseif( is_archive() ){
				the_excerpt();
				best_shop_author_meta();
			}else{
				the_excerpt();
			}
		?>
	</div><!-- .entry-content -->
	<?php
}
endif;
add_action( 'best_shop_post_entry_content', 'best_shop_entry_content', 15 );

if( ! function_exists( 'best_shop_entry_footer' ) ) :
/**
 * Entry Footer
*/
function best_shop_entry_footer(){ 

	if( is_single() ){ ?>
		<footer class="entry-footer">
			<?php
				best_shop_tag();
				if( get_edit_post_link() ){
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'best-shop' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
				}
			?>
		</footer><!-- .entry-footer -->
	<?php }
}
endif;
add_action( 'best_shop_post_entry_content', 'best_shop_entry_footer', 20 );


		
if( ! function_exists( 'best_shop_mail' ) ) :
/**
 * Mail Settings
 */
function best_shop_mail(){
	$mail_title       = best_shop_get_setting( 'mail_title' );
	$mail_address     = best_shop_get_setting( 'mail_description' );
	$emails           = explode( ',', $mail_address);
	if( $mail_title || $mail_address ){ ?>
		<div class="email-wrapper">
			<li>
				<div class="email-wrap">
					<div class="icon">
						<?php echo wp_kses( best_shop_social_icons_svg_list( 'email' ), best_shop_kses_extended_ruleset() ); ?>	
					</div>
				</div>
				<div class="email-details">
					<?php if( $mail_title ){ ?>
						<span class="email-title">
							<?php echo esc_html( $mail_title ); ?>
						</span>
					<?php }
					if( $mail_address ){ ?>
						<div class="email-desc">
							<?php foreach( $emails as $email ){ ?>
								<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $email ) ); ?>" class="email-link">
									<?php echo esc_html( $email ); ?>
								</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</li>
		</div>
	<?php }
}
endif;
add_action( 'best_shop_contact_page_details', 'best_shop_mail', 20 );
		
if( ! function_exists( 'best_shop_phone' ) ) :
/**
 * Phone Settings
 */
function best_shop_phone(){
	$phone_title        = best_shop_get_setting( 'phone_title' ); 
	$phone_number       = best_shop_get_setting( 'phone_number' ); 

	$phones = explode( ',', $phone_number);

	if( $phone_title || $phone_number ){ ?>
		<div class="phone-wrapper">
			<li>
				<div class="phone-wrap">
					<div class="icon">
					<?php echo wp_kses( best_shop_social_icons_svg_list( 'phone' ), best_shop_kses_extended_ruleset() ); ?>					
					</div>
				</div>
				<div class="phone-details">
					<?php if( $phone_title ){ ?>
						<span class="phone-title">
							<?php echo esc_html( $phone_title ); ?>
						</span>
					<?php } 
					if( $phone_number ){ ?>
						<div class="phone-number">
							<?php foreach( $phones as $phone ){ ?>
								<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ); ?>" class="tel-link">
									<?php echo esc_html( $phone ); ?>
								</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</li>
		</div>
	<?php }
}
endif;
add_action( 'best_shop_contact_page_details', 'best_shop_phone', 30 );