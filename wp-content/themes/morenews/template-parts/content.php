<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MoreNews
 */

?>


<?php if (is_singular()) : ?>
    <div class="color-pad">
        <div class="entry-content read-details">
            <?php
            the_content(sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'morenews'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )); ?>
            <?php if (is_single()): ?>
                <div class="post-item-metadata entry-meta">
                    <?php morenews_post_item_tag(); ?>
                </div>
            <?php endif; ?>
            <?php
            the_post_navigation(array(
                'prev_text' => __('<span class="em-post-navigation">Previous:</span> %title', 'morenews'),
                'next_text' => __('<span class="em-post-navigation">Next:</span> %title', 'morenews'),
                'in_same_term' => true,
                'taxonomy' => __('category', 'morenews'),
                'screen_reader_text' => __('Continue Reading', 'morenews'),
            ));
            ?>
            <?php wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'morenews'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->
    </div>
<?php else:



    do_action('morenews_action_archive_layout');

endif;
