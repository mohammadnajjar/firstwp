<?php

$morenews_main_posts_title = morenews_get_option('main_banner_news_section_title');

$morenews_title_class ='' ;
if(empty($morenews_main_posts_title)){
    $morenews_title_class .= 'no-main-slider-title';
}


?>
<div class="aft-main-banner-part af-container-row-5 <?php echo esc_attr($morenews_title_class); ?>">
    <div class="aft-slider-part col-66 pad">
        <div class="morenews-customizer">
            <?php if (!empty($morenews_main_posts_title)): ?>
                <?php morenews_render_section_title($morenews_main_posts_title); ?>
            <?php endif; ?>
            <?php morenews_get_block('carousel', 'banner'); ?>
        </div>
    </div>

    <div class="aft-trending-part col-3 pad">
        <div class="morenews-customizer">
        <?php morenews_get_block('tabs', 'banner'); ?>
        </div>
    </div>
</div>


