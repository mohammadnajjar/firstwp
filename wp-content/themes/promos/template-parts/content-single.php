<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Promos
 */
global $promos_theme_options;
$social_share = absint($promos_theme_options['promos-single-social-share']);
$featured_image = absint($promos_theme_options['promos-single-page-featured-image']);
$post_tags = absint($promos_theme_options['promos-single-page-tags-option']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-wrap">
        <?php if($featured_image == 1){ ?>
        <div class="post-media">
            <?php promos_post_thumbnail(); ?>
        </div>
        <?php } ?>
        <div class="post-content">
            <div class="post-cats">
                <?php promos_entry_meta(); ?>
            </div>
            <?php
            if (is_singular()) :
                the_title('<h1 class="post-title entry-title">', '</h1>');
            else :
                the_title('<h2 class="post-title entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                ?>
            <?php endif; ?>
            <div class="post-date">
                <?php
                if ('post' === get_post_type()) :
                    ?>
                    <div class="entry-meta">
                        <?php
                        promos_posted_on();
                        promos_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </div>

            <div class="content post-excerpt entry-content clearfix">
                <?php
                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'promos'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                
                ));
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'promos'),
                    'after' => '</div>',
                
                ));
                ?>
            </div><!-- .entry-content -->
            <footer class="post-footer entry-footer">
                <?php 
                if($post_tags == 1 ){
                    promos_meta_tags(); 
                }
                ?>
                <?php 
                if( 1 == $social_share ){
                    do_action( 'promos_social_sharing' ,get_the_ID() );
                }
                ?>
                
            </footer><!-- .entry-footer -->
            <?php the_post_navigation(); ?>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->