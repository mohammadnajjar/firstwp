<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


/**
 * Customizer
 *
 * @class   morenews
 */

if (!function_exists('morenews_custom_style')) {

    function morenews_custom_style()
    {

        global $morenews_google_fonts;
        $morenews_background_color = get_background_color();
        $light_background_color = '#' . $morenews_background_color;
        $dark_background_color = morenews_get_option('dark_background_color');
        $secondary_color = morenews_get_option('secondary_color');
        $site_title_font = $morenews_google_fonts[morenews_get_option('site_title_font')];
        $primary_font = $morenews_google_fonts[morenews_get_option('primary_font')];
        $secondary_font = $morenews_google_fonts[morenews_get_option('secondary_font')];

        ob_start();
?>

        <?php if (!empty($dark_background_color)) : ?>
            body.aft-dark-mode #sidr,
        body.aft-dark-mode,
        body.aft-dark-mode.custom-background,
        body.aft-dark-mode #af-preloader {
            background-color: <?php morenews_esc_custom_style($dark_background_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($light_background_color)) : ?>
            body.aft-default-mode #sidr,
            body.aft-default-mode #af-preloader,
            body.aft-default-mode {
            background-color: <?php morenews_esc_custom_style($light_background_color) ?>;
            }

        <?php endif; ?>

        <?php if (!empty($secondary_color)): ?>
            .woocommerce span.onsale,
            .woocommerce #respond input#submit.disabled, 
            .woocommerce #respond input#submit:disabled, 
            .woocommerce #respond input#submit:disabled[disabled], 
            .woocommerce a.button.disabled, 
            .woocommerce a.button:disabled, 
            .woocommerce a.button:disabled[disabled], 
            .woocommerce button.button.disabled, 
            .woocommerce button.button:disabled, 
            .woocommerce button.button:disabled[disabled], 
            .woocommerce input.button.disabled, 
            .woocommerce input.button:disabled, 
            .woocommerce input.button:disabled[disabled],
            .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button,
            .woocommerce #respond input#submit.alt, 
            .woocommerce a.button.alt, 
            .woocommerce button.button.alt, 
            .woocommerce input.button.alt,

            .widget-title-fill-and-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-border .widget-title .heading-line,
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li>a.active,
            .widget-title-fill-and-border .aft-main-banner-wrapper .widget-title .heading-line ,
            .widget-title-fill-and-no-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-no-border .widget-title .heading-line,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li>a.active,
            .widget-title-fill-and-no-border .aft-main-banner-wrapper .widget-title .heading-line,
            a.sidr-class-sidr-button-close,
            body.widget-title-border-bottom .header-after1 .heading-line-before, 
            body.widget-title-border-bottom .widget-title .heading-line-before,
            .widget-title-border-center .wp_post_author_widget .widget-title .heading-line-before,
            .widget-title-border-center .aft-posts-tabs-panel .nav-tabs>li>a.active::after,
            .widget-title-border-center .wp_post_author_widget .widget-title .header-after::after, 
            .widget-title-border-center .widget-title .heading-line-after,
            .widget-title-border-bottom .heading-line::before, 
            .widget-title-border-bottom .wp-post-author-wrap .header-after::before,
            .widget-title-border-bottom .aft-posts-tabs-panel .nav-tabs>li>a.active::after,

            .aft-popular-taxonomies-lists span::before ,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
            #loader-wrapper div,
            span.heading-line::before,
            .wp-post-author-wrap .header-after::before,
            body.aft-default-mode.woocommerce span.onsale,
            body.aft-dark-mode input[type="button"],
            body.aft-dark-mode input[type="reset"],
            body.aft-dark-mode input[type="submit"],
            body.aft-dark-mode .inner-suscribe input[type=submit],
            body.aft-default-mode input[type="button"],
            body.aft-default-mode input[type="reset"],
            body.aft-default-mode input[type="submit"],
            body.aft-default-mode .inner-suscribe input[type=submit],
            .af-youtube-slider .af-video-wrap .af-bg-play i,
            .af-youtube-video-list .entry-header-yt-video-wrapper .af-yt-video-play i,
            .af-post-format i,
            body .btn-style1 a:visited,
            body .btn-style1 a,
            body .morenews-pagination .nav-links .page-numbers.current,
            body #scroll-up,
            body article.sticky .read-single:before,
            .aft-readmore-wrapper a.aft-readmore:hover,
            body.aft-dark-mode .aft-readmore-wrapper a.aft-readmore:hover, 
            footer.site-footer .aft-readmore-wrapper a.aft-readmore:hover,
            .aft-readmore-wrapper a.aft-readmore:hover,
            body .trending-posts-vertical .trending-no{
            background-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }

            .grid-design-texts-over-image .aft-readmore-wrapper a.aft-readmore:hover, 
            .aft-readmore-wrapper a.aft-readmore:hover,
            body.aft-dark-mode .aft-readmore-wrapper a.aft-readmore:hover, 
            body.aft-default-mode .aft-readmore-wrapper a.aft-readmore:hover, 

            body.single .entry-header .aft-post-excerpt-and-meta .post-excerpt,
            body.aft-dark-mode.single span.tags-links a:hover,
            .morenews-pagination .nav-links .page-numbers.current,
            .aft-readmore-wrapper a.aft-readmore:hover,
            p.awpa-more-posts a:hover{
            border-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            .wp-post-author-meta .wp-post-author-meta-more-posts a.awpa-more-posts:hover{
                border-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            body:not(.rtl) .aft-popular-taxonomies-lists span::after {
                border-left-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            body.rtl .aft-popular-taxonomies-lists span::after {
                border-right-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }

            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title::before,
            .widget-title-fill-and-no-border .morenews-customizer .widget-title::before{
                border-top-color: <?php morenews_esc_custom_style($secondary_color) ?>;

            }
            #scroll-up::after,
            .aft-dark-mode #loader,
            .aft-default-mode #loader {
                border-bottom-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            .aft-dark-mode .tagcloud a:hover, 
            .aft-dark-mode .widget ul.menu >li a:hover, 
            .aft-dark-mode .widget > ul > li a:hover,
            .banner-exclusive-posts-wrapper a:hover,
            .list-style .read-title h4 a:hover,
            .grid-design-default .read-title h4 a:hover,
            body.aft-dark-mode .banner-exclusive-posts-wrapper a:hover,
            body.aft-dark-mode .banner-exclusive-posts-wrapper a:visited:hover,
            body.aft-default-mode .banner-exclusive-posts-wrapper a:hover,
            body.aft-default-mode .banner-exclusive-posts-wrapper a:visited:hover,
            body.wp-post-author-meta .awpa-display-name a:hover,
            .widget_text a ,

            .wp_post_author_widget .wp-post-author-meta .awpa-display-name a:hover, 
            .wp-post-author-meta .wp-post-author-meta-more-posts a.awpa-more-posts:hover,
            body.aft-default-mode .af-breadcrumbs a:hover,
            body.aft-dark-mode .af-breadcrumbs a:hover,

            body .site-footer .color-pad .read-title h4 a:hover,
            body.aft-default-mode .site-footer .tagcloud a:hover,
            body.aft-dark-mode .site-footer .tagcloud a:hover,

            body.aft-dark-mode #secondary .morenews-widget ul[class*="wp-block-"] a:hover,
            body.aft-dark-mode #secondary .morenews-widget ol[class*="wp-block-"] a:hover,
            body.aft-dark-mode a.post-edit-link:hover,
            body.aft-default-mode #secondary .morenews-widget ul[class*="wp-block-"] a:hover,
            body.aft-default-mode #secondary .morenews-widget ol[class*="wp-block-"] a:hover,
            body.aft-default-mode a.post-edit-link:hover,

            body.aft-default-mode .comment-form a:hover,
            body.aft-dark-mode .comment-form a:hover,

            body.aft-dark-mode .morenews-pagination .nav-links a.page-numbers:hover,
            body.aft-default-mode .morenews-pagination .nav-links a.page-numbers:hover,
            body .site-footer .secondary-footer a:hover,
            body.aft-default-mode .aft-popular-taxonomies-lists ul li a:hover ,
            body.aft-dark-mode .aft-popular-taxonomies-lists ul li a:hover,
            body.aft-dark-mode .wp-calendar-nav a,
            body .entry-content > [class*="wp-block-"] a:not(.has-text-color),
            body .entry-content > [class*="wp-block-"] li,
            body .entry-content > ul a,
            body .entry-content > ol a,
            body .entry-content > p a ,
            body p.logged-in-as,
            body.aft-dark-mode .woocommerce-loop-product__title:hover,
            body.aft-default-mode .woocommerce-loop-product__title:hover,
            a:hover,
            body.aft-default-mode .tagcloud a:hover,
            body.aft-default-mode.single span.tags-links a:hover,
            body.aft-default-mode p.awpa-more-posts a:hover,
            body.aft-default-mode p.awpa-website a:hover ,
            body.aft-default-mode .wp-post-author-meta h4 a:hover,
            body.aft-default-mode .widget ul.menu >li a:hover,
            body.aft-default-mode .widget > ul > li a:hover,
            body.aft-default-mode .nav-links a:hover,
            body.aft-default-mode ul.trail-items li a:hover,
            body.aft-dark-mode .tagcloud a:hover,
            body.aft-dark-mode.single span.tags-links a:hover,
            body.aft-dark-mode p.awpa-more-posts a:hover,
            body.aft-dark-mode p.awpa-website a:hover ,
            body.aft-dark-mode .widget ul.menu >li a:hover,
            body.aft-dark-mode .nav-links a:hover,
            body.aft-dark-mode ul.trail-items li a:hover,
            h2.comments-title,
            .comment-metadata a,
            .fn a{
            color:<?php morenews_esc_custom_style($secondary_color) ?>;
            }   

            @media only screen and (min-width: 992px){
                body.aft-default-mode .morenews-header .main-navigation .menu-desktop > ul > li:hover > a:before,
                body.aft-default-mode .morenews-header .main-navigation .menu-desktop > ul > li.current-menu-item > a:before {
                background-color: <?php morenews_esc_custom_style($secondary_color) ?>;
                }
            }
        <?php endif; ?>

        <?php if (!empty($secondary_color)): ?>
            .woocommerce-product-search button[type="submit"], input.search-submit{
                background-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            #wp-calendar tbody td a,
            body.aft-dark-mode #wp-calendar tbody td#today,
            body.aft-default-mode #wp-calendar tbody td#today,
            body .entry-content > [class*="wp-block-"] a:not(.has-text-color),
            body .entry-content > ul a, body .entry-content > ul a:visited,
            body .entry-content > ol a, body .entry-content > ol a:visited,
            body .entry-content > p a, body .entry-content > p a:visited
            {
            color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            .woocommerce-product-search button[type="submit"], input.search-submit,
            body.single span.tags-links a:hover,
            body .entry-content > [class*="wp-block-"] a:not(.has-text-color),
            body .entry-content > ul a, body .entry-content > ul a:visited,
            body .entry-content > ol a, body .entry-content > ol a:visited,
            body .entry-content > p a, body .entry-content > p a:visited{
            border-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }

            @media only screen and (min-width: 993px){
                .main-navigation .menu-desktop > li.current-menu-item::after, 
                .main-navigation .menu-desktop > ul > li.current-menu-item::after, 
                .main-navigation .menu-desktop > li::after, .main-navigation .menu-desktop > ul > li::after{
                    background-color: <?php morenews_esc_custom_style($secondary_color) ?>;
                }
            }
        <?php endif; ?>


        <?php if (!empty($site_title_font)): ?>
            .site-title {
            font-family: <?php morenews_esc_custom_style($site_title_font) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($primary_font)): ?>
            body,
            button,
            input,
            select,
            optgroup,
            .cat-links li a,
            .min-read,
            .af-social-contacts .social-widget-menu .screen-reader-text,
            textarea {
            font-family: <?php morenews_esc_custom_style($primary_font) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($secondary_font)): ?>
            .navigation.post-navigation .nav-links a,
            div.custom-menu-link > a,
            .exclusive-posts .exclusive-now span,
            .aft-popular-taxonomies-lists span,
            .exclusive-posts a,
            .aft-posts-tabs-panel .nav-tabs>li>a,
            .widget-title-border-bottom .aft-posts-tabs-panel .nav-tabs>li>a,
            .nav-tabs>li,
            .widget ul ul li, 
            .widget ul.menu >li ,
            .widget > ul > li,
            .main-navigation ul li a,
            h1, h2, h3, h4, h5, h6 {
            font-family: <?php morenews_esc_custom_style($secondary_font) ?>;
            }
        <?php endif; ?>

        .elementor-page .elementor-section.elementor-section-full_width > .elementor-container,
        .elementor-page .elementor-section.elementor-section-boxed > .elementor-container,
        .elementor-default .elementor-section.elementor-section-full_width > .elementor-container,
        .elementor-default .elementor-section.elementor-section-boxed > .elementor-container{
            max-width: 1244px;
        }

        .container-wrapper .elementor {
            max-width: 100%;
        }

        .align-content-left .elementor-section-stretched,
        .align-content-right .elementor-section-stretched {
            max-width: 100%;
            left: 0 !important;
        }
<?php
        return ob_get_clean();
    }
}

if (!function_exists('morenews_esc_custom_style(')) {

    function morenews_esc_custom_style($props)
    {
        echo wp_kses($props, array("\'", '\"'));
    }
}
