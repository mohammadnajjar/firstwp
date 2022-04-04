<?php

if (!function_exists('morenews_front_page_widgets_section')) :
    /**
     *
     * @param null
     * @return null
     *
     * @since MoreNews 1.0.0
     *
     */
    function morenews_front_page_widgets_section()
    {
        $frontpage_layout = morenews_get_option('frontpage_content_alignment');

        ?>

        <section class="section-block-upper">
                <?php if (is_active_sidebar('home-content-widgets')): ?>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <?php dynamic_sidebar('home-content-widgets'); ?>
                        </main>
                    </div>

                <?php endif; ?>

                <?php if (is_active_sidebar('home-sidebar-widgets') && $frontpage_layout != 'full-width-content'): ?>

                    <?php
                    $sticky_sidebar_class = '';
                    $sticky_sidebar = morenews_get_option('frontpage_sticky_sidebar');
                    if ($sticky_sidebar) {
                        $sticky_sidebar_class = morenews_get_option('frontpage_sticky_sidebar_position');
                    }
                    ?>


                    <div id="secondary" class="sidebar-area <?php echo esc_attr($sticky_sidebar_class); ?>">
                        <aside class="widget-area color-pad">
                                <?php dynamic_sidebar('home-sidebar-widgets'); ?>
                        </aside>
                    </div>
                <?php endif; ?>
        </section>

        <?php
    }
endif;
add_action('morenews_front_page_section', 'morenews_front_page_widgets_section', 50);