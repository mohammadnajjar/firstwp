<?php
/**
 * Social Sharing Hook *
 * @since 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('promos_social_sharing')) :
    function promos_social_sharing($post_id)
    {
        $promos_url = get_the_permalink($post_id);
        $promos_title = get_the_title($post_id);
        $promos_image = get_the_post_thumbnail_url($post_id);
        
        //sharing url
        $promos_twitter_sharing_url = esc_url('http://twitter.com/share?text=' . $promos_title . '&url=' . $promos_url);
        $promos_facebook_sharing_url = esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $promos_url);
        $promos_pinterest_sharing_url = esc_url('http://pinterest.com/pin/create/button/?url=' . $promos_url . '&media=' . $promos_image . '&description=' . $promos_title);
        $promos_linkedin_sharing_url = esc_url('http://www.linkedin.com/shareArticle?mini=true&title=' . $promos_title . '&url=' . $promos_url);
        
        ?>
        <div class="meta_bottom">
            <div class="post-share">
                <a data-tooltip="<?php esc_attr_e('Share it','promos'); ?>" class="ts-share"  target="_blank" href="<?php echo $promos_facebook_sharing_url; ?>"><i class="fa fa-facebook"></i><?php esc_html_e('Facebook','promos'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Tweet it','promos'); ?>" class="ts-share"  target="_blank" href="<?php echo $promos_twitter_sharing_url; ?>"><i
                            class="fa fa-twitter"></i> <?php esc_html_e('Twitter','promos'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Pin it','promos'); ?>" class="ts-share"  target="_blank" href="<?php echo $promos_pinterest_sharing_url; ?>"><i
                            class="fa fa-pinterest"></i><?php esc_html_e('Pinterest','promos'); ?></a>
                <a data-tooltip="<?php esc_attr_e('Share Now','promos'); ?>" class="ts-share"  target="_blank" href="<?php echo $promos_linkedin_sharing_url; ?>"><i class="fa fa-linkedin"></i><?php esc_html_e('Linkedin','promos'); ?></a>
            </div>
        </div>
        <?php
    }
endif;
add_action('promos_social_sharing', 'promos_social_sharing', 10);