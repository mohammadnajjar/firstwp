<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MoreNews
 */

if (!function_exists('morenews_post_categories')) :
    function morenews_post_categories($morenews_is_single = false)
    {
        $morenews_global_show_categories = morenews_get_option('global_show_categories');
        if ($morenews_global_show_categories == 'no') {
            return;
        }


        $morenews_global_number_of_categories = morenews_get_option('global_number_of_categories');
        if ($morenews_global_number_of_categories == 'custom') {
            $show_category_number = morenews_get_option('global_custom_number_of_categories');
            $show_category_number = absint($show_category_number);
        } elseif ($morenews_global_number_of_categories == 'one') {
            $show_category_number = 1;
        } else {
            $show_category_number = 0;
        }

        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            global $post;
            $morenews_post_categories = get_the_category($post->ID);
            if ($morenews_post_categories) {

                $morenews_output = '<ul class="cat-links">';
                $category_count = 0;
                foreach ($morenews_post_categories as $post_category) {
                    $morenews_t_id = $post_category->term_id;
                    $morenews_color_id = "category_color_" . $morenews_t_id;

                    // retrieve the existing value(s) for this meta field. This returns an array
                    $morenews_term_meta = get_option($morenews_color_id);
                    $morenews_color_class = ($morenews_term_meta) ? $morenews_term_meta['color_class_term_meta'] : 'category-color-1';

                    $morenews_output .= '<li class="meta-category">
                             <a class="morenews-categories ' . esc_attr($morenews_color_class) . '" href="' . esc_url(get_category_link($post_category)) . '">
                                 ' . esc_html($post_category->name) . '
                             </a>
                        </li>';

                    if ($morenews_is_single == false) {
                        if (++$category_count == $show_category_number) break;
                    }


                }
                $morenews_output .= '</ul>';
                echo wp_kses_post($morenews_output);

            }
        }
    }
endif;


if (!function_exists('morenews_get_category_color_class')) :

    function morenews_get_category_color_class($term_id)
    {

        $morenews_color_id = "category_color_" . $term_id;
        // retrieve the existing value(s) for this meta field. This returns an array
        $morenews_term_meta = get_option($morenews_color_id);
        $morenews_color_class = ($morenews_term_meta) ? $morenews_term_meta['color_class_term_meta'] : '';
        return $morenews_color_class;


    }
endif;

if (!function_exists('morenews_post_item_meta')) :

    function morenews_post_item_meta($morenews_post_display = 'spotlight-post')
    {

        global $post;
        if ('post' == get_post_type($post->ID)):

            $morenews_author_id = $post->post_author;
            $morenews_date_display_setting = morenews_get_option('global_date_display_setting');
            $morenews_author_icon_gravatar_display_setting = morenews_get_option('global_author_icon_gravatar_display_setting');

            if($morenews_post_display == 'list-post'){
                $morenews_post_meta = morenews_get_option('list_post_date_author_setting');
            }elseif($morenews_post_display == 'grid-post'){
                $morenews_post_meta = morenews_get_option('small_grid_post_date_author_setting');
            }else{
                $morenews_post_meta = morenews_get_option('global_post_date_author_setting');

            }

            if ($morenews_post_meta == 'show-date-only') {
                $morenews_display_author = false;
                $morenews_display_date = true;
            } elseif ($morenews_post_meta == 'show-author-only') {
                $morenews_display_author = true;
                $morenews_display_date = false;
            } elseif (($morenews_post_meta == 'show-date-author')) {
                $morenews_display_author = true;
                $morenews_display_date = true;
            } else {
                $morenews_display_author = false;
                $morenews_display_date = false;
            }

            ?>


            <span class="author-links">
                <?php if ($morenews_display_author): ?>
                <span class="item-metadata posts-author byline">
                    <a href="<?php echo esc_url(get_author_posts_url($morenews_author_id)) ?>">
                <?php if ($morenews_author_icon_gravatar_display_setting == 'display-gravatar'): ?>
                    <?php echo get_avatar(get_the_author_meta('user_email', $morenews_author_id), 16); ?>
                <?php elseif ($morenews_author_icon_gravatar_display_setting == 'display-icon'): ?>
                    <i class="far fa-user"></i>
                <?php endif; ?>
                        <?php echo esc_html(get_the_author_meta('display_name', $morenews_author_id)); ?>
                    </a>
            </span>
            <?php endif; ?>


            <?php
            if ($morenews_display_date): ?>
                <span class="item-metadata posts-date">
                    <i class="far fa-clock" aria-hidden="true"></i>
                        <?php
                        if ($morenews_date_display_setting == 'default-date') {
                            the_time(get_option('date_format'));
                        } else {
                            echo esc_html(human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago', 'morenews'));
                        }

                        ?>
            </span>
            <?php endif; ?>

            </span>
        <?php
        endif;

    }
endif;


if (!function_exists('morenews_post_item_tag')) :

    function morenews_post_item_tag($view = 'default')
    {
        global $post;

        if ('post' === get_post_type()) {

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', ' ');
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html('Tags: %1$s') . '</span>', $tags_list);
            }
        }

        if (is_single()) {
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'morenews'),
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

    }
endif;