<?php
/**
 * Post Navigation Function
 *
 * @since Promos 1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('promos_posts_navigation')) :
    function promos_posts_navigation()
    {
        global $promos_theme_options;
        $promos_pagination_option = $promos_theme_options['promos-pagination-options'];
        if ('numeric' == $promos_pagination_option) {
            echo "<div class='pagination'>";
                the_posts_pagination();
            echo "</div>";
        } elseif ('default' == $promos_pagination_option) {
            the_posts_navigation();
        } else {
            return false;
        }
    }
endif;
add_action('promos_action_navigation', 'promos_posts_navigation', 10);