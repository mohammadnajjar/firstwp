<?php
/**
 * Content for latest post
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */ 
?>
<section class = "newslist-latest-post-wrapper">
    <div class="container">
        <div class="newslist-latest-post-inner">
            <div class="newslist-latest-post">
                <h2 class="newslist-latest-post-title">
                    <?php echo esc_html__( newslist_get( 'latest-post-title' )); ?>
                    <span></span>
                </h2>
            </div>
            <div class="newslist-latest-post-slider">
            <?php $latest_posts = Newslist_Theme::get_posts_by_type( newslist_get( 'latest-post-type' ), newslist_get( 'latest-post-cat' ), newslist_get( 'latest-no-post' ) ); 
                if( $latest_posts ) : ?>
                    <?php foreach ( $latest_posts as $lp ) : ?>
                        <a href="<?php echo esc_url( get_the_permalink( $lp ) ); ?>">
                        <?php echo esc_html( get_the_title( $lp ) ); ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>		
            </div>
        </div>
    </div>
</section>