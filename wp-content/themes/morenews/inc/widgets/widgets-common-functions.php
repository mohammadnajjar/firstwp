<?php


/**
 * Returns all categories.
 *
 * @since CoverNews 1.0.0
 */
if (!function_exists('morenews_get_terms')):
    function morenews_get_terms($category_id = 0, $taxonomy = 'category', $default = '')
    {
        $taxonomy = !empty($taxonomy) ? $taxonomy : 'category';

        if ($category_id > 0) {
            $term = get_term_by('id', absint($category_id), $taxonomy);
            if ($term)
                return esc_html($term->name);


        } else {
            $terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => true,
            ));
            $first_item = __('Select', 'morenews');


            if (isset($terms) && !empty($terms)) {
                foreach ($terms as $term) {
                    if ($default != 'first') {
                        $array['0'] = $first_item;
                    }
                    $array[$term->term_id] = esc_html($term->name);
                }

                return $array;
            }
        }
    }
endif;

/**
 * Outputs the tab posts
 *
 * @param array $args Post Arguments.
 * @since 1.0.0
 *
 */
if (!function_exists('morenews_render_posts')):
    function morenews_render_posts($morenews_number_of_posts, $morenews_category, $morenews_filterby)
    {

        $all_posts = morenews_get_posts($morenews_number_of_posts, $morenews_category, $morenews_filterby);
        if ($all_posts->have_posts()):
                echo '<ul class="article-item article-list-item article-tabbed-list article-item-left">';
                while ($all_posts->have_posts()): $all_posts->the_post();
                    global $post;
                    ?>
                    <li class="aft-trending-posts list-part af-sec-post">
                        <div class="aft-trending-posts list-part af-sec-post">
                            <?php do_action('morenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                        </div>
                    </li>
                <?php
                endwhile;
                wp_reset_postdata();
                echo '</ul>';
            endif;

    }
endif;

if (!function_exists('morenews_render_tabbed_posts')):
    function morenews_render_tabbed_posts($tab_id, $latest_title, $latest_post_filterby, $latest_category, $popular_title, $popular_post_filterby, $popular_category, $number_of_posts)
    { ?>
        <div class="tabbed-container">
            <div class="tabbed-head">
                <ul class="nav nav-tabs af-tabs tab-warpper" role="tablist">

                        <li class="tab tab-recent ">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-label="<?php esc_attr_e('Recent', 'morenews'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1 active">
                                <i class="fas fa-clock"></i>
                                <?php echo esc_html($latest_title); ?>
                            </a>
                        </li>

                        <li role="presentation" class="tab tab-popular">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-label="<?php esc_attr_e('Popular', 'morenews'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <i class="fas fa-bolt"></i>
                                <?php echo esc_html($popular_title); ?>
                            </a>
                        </li>

                </ul>
            </div>
            <div class="tab-content af-widget-body">

                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane active">
                        <?php
                        morenews_render_posts($number_of_posts, $latest_category, $latest_post_filterby);
                        ?>
                    </div>

                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane">
                        <?php
                        morenews_render_posts($number_of_posts, $popular_category, $popular_post_filterby);
                        ?>
                    </div>

            </div>
        </div>
    <?php }
endif;

if (!function_exists('morenews_render_section_title')):
    function morenews_render_section_title($section_title, $color_class = '')
    { ?>

        <div class="af-title-subtitle-wrap">
            <h4 class="widget-title header-after1 <?php echo esc_attr($color_class); ?>">
                <span class="heading-line-before"></span>
                <span class="heading-line"><?php echo esc_html($section_title); ?></span>
                <span class="heading-line-after"></span>
            </h4>
        </div>
        <?php
    }
endif;
