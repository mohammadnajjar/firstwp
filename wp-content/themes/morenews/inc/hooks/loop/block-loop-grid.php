<?php
if (!function_exists('morenews_loop_grid')) :
    /**
     * Banner Slider
     *
     * @since Newsical 1.0.0
     *
     */
    function morenews_loop_grid($morenews_post_id, $morenews_grid_design = 'grid-design-default', $morenews_thumbnail_size = 'medium', $morenews_show_excerpt = false, $archive_content_view = 'archive-content-excerpt', $morenews_title_position = 'bottom', $morenews_small_grid = false)
    {
        $morenews_post_display = 'spotlight-post';
        if ($morenews_thumbnail_size == 'medium') {
            $morenews_post_display = 'grid-post';
        }

        ?>

        <div class="pos-rel read-single color-pad clearfix af-cat-widget-carousel <?php echo esc_attr($morenews_grid_design); ?>">
            <?php if ($morenews_title_position == 'top'): ?>
                <div class="read-title">
                    <h4>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                </div>
                <div class="post-item-metadata entry-meta">
                    <?php morenews_post_item_meta($morenews_post_display); ?>
                    <?php morenews_get_comments_views_share($morenews_post_id); ?>
                </div>
            <?php endif; ?>
            <div class="read-img pos-rel read-bg-img">
                <a class="aft-post-image-link"
                   href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php the_post_thumbnail($morenews_thumbnail_size); ?>

                    <div class="post-format-and-min-read-wrap">
                        <?php morenews_post_format($morenews_post_id); ?>
                        <?php morenews_count_content_words($morenews_post_id); ?>
                    </div>

                    <?php if ($morenews_grid_design == 'grid-design-default'): ?>
                        <div class="category-min-read-wrap">
                            <div class="read-categories">
                                <?php morenews_post_categories(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

            </div>
            <div class="pad read-details color-tp-pad">

                    <?php if ($morenews_grid_design == 'grid-design-texts-over-image'): ?>
                        <div class="read-categories">
                            <?php morenews_post_categories(); ?>
                        </div>
                    <?php endif; ?>

                <?php if ($morenews_title_position == 'bottom'): ?>
                    <div class="read-title">
                        <h4>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                    </div>
        <?php //if ($morenews_small_grid == false): ?>
                    <div class="post-item-metadata entry-meta">
                        <?php morenews_post_item_meta($morenews_post_display); ?>
                        <?php morenews_get_comments_views_share($morenews_post_id); ?>
                    </div>
                <?php endif; ?>
                <?php //endif; ?>

                <?php if ($morenews_show_excerpt == true): ?>
                    <div class="post-description">
                        <?php
                        if ($archive_content_view == 'archive-content-full') {
                            the_content();
                        } else {
                            echo wp_kses_post(morenews_get_the_excerpt($morenews_post_id));
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php
    }
endif;
add_action('morenews_action_loop_grid', 'morenews_loop_grid', 10, 7);