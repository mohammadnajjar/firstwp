<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Promos
 */
global $promos_theme_options;
$show_content_from = esc_attr($promos_theme_options['promos-content-show-from']);
$read_more = esc_html($promos_theme_options['promos-read-more-text']);
$image_location = esc_attr($promos_theme_options['promos-blog-image-layout']);
$cropped_original = esc_attr($promos_theme_options['promos-blog-image-crop-full']);
$social_share = absint($promos_theme_options['promos-show-hide-share']);
$date = absint($promos_theme_options['promos-show-hide-date']);
$category = absint($promos_theme_options['promos-show-hide-category']);
$author = absint($promos_theme_options['promos-show-hide-author']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-wrap <?php echo esc_attr($image_location); ?>">
        <?php if(has_post_thumbnail()) { ?>
            <div class="post-media-wrapper">
                <?php 
                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src( $image_id,'',true );
                ?>
                <?php if( $cropped_original == 'cropped-image'){ ?>
                    <div class="post-media img-corved">
                        <div class="img-cover" style="background-image: url(<?php echo esc_url($image_url[0]);?>)">

                            <?php 
                            if($image_location == 'full-image'){
                                promos_post_thumbnail('full');
                            }
                            ?>
                            <a class="img-link" href="<?php the_permalink(); ?>"></a>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="post-media">
                        <div class="post-thumbnail">
                            <?php promos_post_thumbnail('full'); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php 
                if( 1 == $social_share ){
                    do_action( 'promos_social_sharing' ,get_the_ID() );
                }
                ?>
            </div>
        <?php } ?>

        <div class="post-content">
            <?php if($category == 1 ){ ?>
                <div class="post-cats">
                    <?php promos_entry_meta(); ?>
                </div>
            <?php } ?>
            <div class="post_title">
                <?php
                if (is_singular()) :
                    the_title('<h1 class="post-title entry-title">', '</h1>');
                else :
                    the_title('<h2 class="post-title entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    ?>
                <?php endif; ?>
            </div>
            <!-- .entry-content end -->
            <div class="post-meta">
                <?php
                if ('post' === get_post_type()) :
                    ?>
                    <div class="post-date">
                        <div class="entry-meta">
                            <?php
                            if($date == 1 ){
                                promos_posted_on();
                            }
                            if($author == 1 ){
                                promos_posted_by();
                            }
                            ?>
                        </div><!-- .entry-meta -->
                    </div>
                <?php endif; ?>
            </div>
            <div class="post-excerpt entry-content">
                <?php
                if (is_singular()) {
                    the_content();
                } else {
                    if ($show_content_from == 'excerpt') {
                        the_excerpt();
                    } else {
                        the_content();
                    }
                }
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'promos'),
                    'after' => '</div>',
                ));
                ?>
                <!-- read more -->
                <?php if (!empty($read_more) && $show_content_from == 'excerpt'): ?>
                    <a class="more-link" href="<?php the_permalink(); ?>"><?php echo esc_html($read_more); ?>
                </a>
            <?php endif; ?>
        </div>
        
    </div>
</div>
</article><!-- #post- -->