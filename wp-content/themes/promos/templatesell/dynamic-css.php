<?php
/**
 * Dynamic css
 *
 * @since Promos 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('promos_dynamic_css')) :

    function promos_dynamic_css()
    {
        global $promos_theme_options;

        /* Color Options Options */
        $promos_primary_color              = esc_attr($promos_theme_options['promos_primary_color']);
        $promos_logo_width              = absint($promos_theme_options['promos_logo_width_option']);

        $promos_header_overlay  = esc_attr($promos_theme_options['promos_slider_overlay_color']);
        $promos_header_transparent  = esc_attr($promos_theme_options['promos_slider_overlay_transparent']);
        $promos_header_min_height              = absint($promos_theme_options['promos_header_image_height']);


        $custom_css = '';

        //Primary  Background 
        if (!empty($promos_primary_color)) {
            $custom_css .= "
            #toTop,
            a.effect:before,
            .mc4wp-form-fields input[type='submit'],
            .show-more,
            .modern-slider .slide-wrap .more-btn,
            a.link-format, .comment-form #submit,
            .comment-form #submit:hover, 
            .comment-form #submit:focus,
            .meta_bottom .post-share a:hover,
            .pagination .page-numbers.current,
            .modern-slider .slick-dots li.slick-active button,
            .tabs-nav li:before,
            .footer-wrap .widget-title:after,
            .post-slider-section .s-cat,
            .bottom-caption .slick-current .slider-items span,
            aarticle.format-status .post-content .post-format::after,
            article.format-chat .post-content .post-format::after, 
            article.format-link .post-content .post-format::after,
            article.format-standard .post-content .post-format::after, 
            article.format-image .post-content .post-format::after, 
            article.hentry.sticky .post-content .post-format::after, 
            article.format-video .post-content .post-format::after, 
            article.format-gallery .post-content .post-format::after, 
            article.format-audio .post-content .post-format::after, 
            article.format-quote .post-content .post-format::after,
            .post-excerpt .more-link { 
                background-color: ". $promos_primary_color."; 
                border-color: ".$promos_primary_color.";
            }";

        }
        if (!empty($promos_primary_color)) {
            $custom_css .= "
            #author:active, 
            #email:active, 
            #url:active, 
            #comment:active, 
            #author:focus, 
            #email:focus, 
            #url:focus, 
            #comment:focus,
            #author:hover, 
            #email:hover, 
            #url:hover, 
            #comment:hover{  
                border-color: ".$promos_primary_color.";
            }";

        }

        

        //Primary Color
        if (!empty($promos_primary_color)) {
            $custom_css .= "
            .comment-form .logged-in-as a:last-child:hover, 
            .comment-form .logged-in-as a:last-child:focus,
            .post-cats > span a:hover, 
            .post-cats > span a:focus,
            .main-header a:hover, 
            .main-header a:focus, 
            .main-header a:active,
            .top-menu > ul > li > a:hover,
            .main-menu ul ul li:hover > a,
            .main-menu ul li.current-menu-item > a, 
            .header-2 .main-menu > ul > li.current-menu-item > a,
            .main-menu ul li:hover > a,
            .post-navigation .nav-links a:hover, 
            .post-navigation .nav-links a:focus,
            .tabs-nav li.tab-active a, 
            .tabs-nav li.tab-active,
            .tabs-nav li.tab-active a, 
            .tabs-nav li.tab-active,
            ul.trail-items li a:hover span,
            .author-socials a:hover,
            .post-date a:focus, 
            .post-date a:hover,
            .post-excerpt a:hover, 
            .post-excerpt a:focus, 
            .content a:hover, 
            .content a:focus,
            .post-footer > span a:hover, 
            .post-footer > span a:focus,
            .widget a:hover, 
            .widget a:focus,
            .footer-menu li a:hover, 
            .footer-menu li a:focus,
            .footer-social-links a:hover,
            .footer-social-links a:focus,
            .site-footer a:hover, 
            .tags-links a,
            .tags-links i,
            .post-cats > span i,
            .promo-three .post-category a,
            .site-footer a:focus, .content-area p a{ 
                color : ". $promos_primary_color."; 
            }";
        }

        //Logo Width
        if (!empty($promos_logo_width)) {
            $custom_css .= "
            .header-1 .head_one .logo{ 
                max-width : ". $promos_logo_width."px; 
            }";
        }

         //Header Overlay
        if (!empty($promos_header_overlay)) {
            $custom_css .= "
            .header-image:before { 
                background-color : ". $promos_header_overlay."; 
            }";
        }

        //Header Tranparent
        if (!empty($promos_header_transparent)) {
            $custom_css .= "
            .header-image:before { 
                opacity : ". $promos_header_transparent."; 
            }";
        }

        //Header Min Height
        if (!empty($promos_header_min_height)) {
            $custom_css .= "
            .header-1 .header-image .head_one { 
                min-height : ". $promos_header_min_height."px; 
            }";
        }

        wp_add_inline_style('promos-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'promos_dynamic_css', 99);