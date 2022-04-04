<?php
/**
 * Template part for displaying category related posts
 *
 * @since 1.0.0
 * 
 * @package Newslist WordPress Theme
 */

$thumb = get_query_var( 'post_url', false );
?>
    <article class="newslist-related-post">
        <?php if( $thumb['url'] ) : ?>
            <div class="newslist-related-image">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url( $thumb['url'] ); ?> " alt="<?php echo esc_attr( $thumb['alt'] ); ?>">
                </a>
            </div> 
        <?php endif; ?>
        <div class="newslist-related-entry">
            <div class="posted-on">
                <?php echo get_the_date(); ?>
            </div>
            <?php the_category(); ?>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>
        </div>             
    </article>