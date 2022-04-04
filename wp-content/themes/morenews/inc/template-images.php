<?php
/**
 * Custom template images for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MoreNews
 */


if ( ! function_exists( 'morenews_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function morenews_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        global $post;

        if ( is_singular() ) :

            $morenews_theme_class = morenews_get_option('global_image_alignment');
            $morenews_post_image_alignment = get_post_meta($post->ID, 'morenews-meta-image-options', true);
            $morenews_post_class = !empty($morenews_post_image_alignment) ? $morenews_post_image_alignment : $morenews_theme_class;

            if ( $morenews_post_class != 'no-image' ):
                ?>
                <div class="post-thumbnail <?php echo esc_attr($morenews_post_class); ?>">
                    <?php the_post_thumbnail('morenews-featured'); ?>
                </div>
            <?php endif; ?>

        <?php else :
            $morenews_archive_layout = morenews_get_option('archive_layout');
            $morenews_archive_layout = $morenews_archive_layout;
            $morenews_archive_class = '';
            if ($morenews_archive_layout == 'archive-layout-list') {
                $morenews_archive_image_alignment = morenews_get_option('archive_image_alignment');
                $morenews_archive_class = $morenews_archive_image_alignment;
                $morenews_archive_image = 'medium';
            } elseif ($morenews_archive_layout == 'archive-layout-full') {
                $morenews_archive_image = 'morenews-medium';
            } else {
                $morenews_archive_image = 'post-thumbnail';
            }

            ?>
            <div class="post-thumbnail <?php echo esc_attr($morenews_archive_class); ?>">
                <a href="<?php the_permalink(); ?>" aria-hidden="true">
                    <?php
                    the_post_thumbnail( $morenews_archive_image, array(
                        'alt' => the_title_attribute( array(
                            'echo' => false,
                        ) ),
                    ) );
                    ?>
                </a>
            </div>

        <?php endif; // End is_singular().
    }
endif;
