<?php
/**
 * Best_Shop Customizer Partials
 *
 * @package Best_Shop
 */

if( ! function_exists( 'best_shop_customize_partial_blogname' ) ) :
/* Render the site title for the selective refresh partial.
 *
 * @return void
 */
function best_shop_customize_partial_blogname() {
	bloginfo( 'name' );
}
endif;

if( ! function_exists( 'best_shop_customize_partial_blogdescription' ) ) :
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function best_shop_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
endif;



if( ! function_exists( 'best_shop_instagram_title' ) ) :
/**
 * Instagram Section Title
*/
function best_shop_instagram_title(){
    return best_shop_get_setting( 'instagram_title' );
}
endif;

if( ! function_exists( 'best_shop_related_posts_title' ) ) :
/**
 * Related Posts Title
*/
function best_shop_related_posts_title(){
    return best_shop_get_setting( 'related_post_title' );
}
endif;


if( ! function_exists( 'best_shop_banner_title' ) ) :
/**
 * Banner Title
*/
function best_shop_banner_title(){
    return best_shop_get_setting( 'banner_title');
}
endif;

if( ! function_exists( 'best_shop_banner_content' ) ) :
/**
 * Banner Content
*/
function best_shop_banner_content(){
    return best_shop_get_setting( 'banner_content');
}
endif;

if( ! function_exists( 'best_shop_banner_btn_label' ) ) :
/**
 * Banner Button Label
*/
function best_shop_banner_btn_label(){
    return best_shop_get_setting( 'banner_btn_label' );
}
endif;

if( ! function_exists( 'best_shop_banner_btn_two_label' ) ) :
/**
 * Banner Button Two Label
*/
function best_shop_banner_btn_two_label(){
    return best_shop_get_setting( 'banner_btn_two_label' );
}
endif;


if( ! function_exists( 'best_shop_get_footer_copyright' ) ) :
/**
 * Show Author link in footer
*/
function best_shop_get_footer_copyright(){
    
    $footer_link = best_shop_get_setting( 'footer_link' ) ;
    
    $copyright = best_shop_get_setting( 'footer_copyright' );
    
    apply_filters('best_shop_footer_link', $footer_link);
    
    echo '<span class="copy-right">';
    
    if($copyright === ''){
            echo ' <a href="' . $footer_link . '">' . esc_html('A theme by Gradient Themes ©' , 'best-shop') . '</a> ';
    }else{
            echo ' <a href="' . $footer_link . '">' . best_shop_get_setting( 'footer_copyright' ) . '</a> ';
    }
        echo '</span>';
    }
    endif;

if( ! function_exists( 'best_shop_ed_author_link' ) ) :
/**
 * Show Author link in footer
*/
function best_shop_ed_author_link(){
    
    echo '<span class="author-link">'; 
    esc_html_e( 'Developed By ', 'best-shop' );
    echo '<a href="' . esc_url( best_shop_get_setting('footer_link') ) .'" rel="nofollow" target="_blank" class="link">' . esc_html__( 'Gradient Themes', 'best-shop' ) . '</a>';
    echo '</span>';
    
}
endif;



