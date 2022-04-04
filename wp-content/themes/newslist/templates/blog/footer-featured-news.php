<?php
/**
 * Footer featured news 
 * 
 * @return void
* @since 1.0.0
*
 * @package Newslist WordPress Theme
 */ 
?>
<div class ="newslist-you-missed container">
    <?php $ftr_featured_news = Newslist_Theme::get_posts_by_type( newslist_get( 'footer-featured-type' ), newslist_get( 'footer-featured-cat' ), 6 );
        if( $ftr_featured_news ){ ?>
            <div class="newslist-you-missed-title">
                <h2><?php echo esc_html(newslist_get( 'footer-featured-title' ) ); ?></h2>
            </div> 
            <div class="newslist-feature-news-inner init">  
                <?php foreach ( $ftr_featured_news as $p ) { ?>
                    <div class="col-md-12 newslist-you-missed-space"> 
                        <article >
                            <div class="newslist-missed-image-wrap" style="background-image: url( '<?php echo esc_url( get_the_post_thumbnail_url( $p ) ); ?>') , url('<?php echo esc_url( Newslist_Helper::get_theme_uri( 'assets/img/default-image.jpg' ) ); ?>' )">
                                <div class="newslist-footer-featured-link">
                                    <a href="<?php echo esc_url( get_the_permalink( $p ) ); ?>"></a>
                                </div>
                                <div class="newslist-blog-inner">
                                    <?php Newslist_Helper::the_category( $p ); ?>
                                    <div class="newslist-feature-news-content">
                                        <div class="date-n-cat-wrapper">
                                            <?php Newslist_Helper::the_date( $p ); ?>                           
                                        </div>
                                        <h3 class="newslist-news-title">
                                            <a href="<?php the_permalink( $p ); ?>"><?php echo esc_html( get_the_title( $p ) );?></a>
                                        </h3>
                                    </div>
                                </div>
                            </div>                            
                        </article>
                    </div>
                <?php } ?>
            </div>
        <?php }
    ?>
</div>
