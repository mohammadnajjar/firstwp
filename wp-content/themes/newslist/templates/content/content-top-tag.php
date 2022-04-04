<?php
/**
  * Template part for displaying top tags in menubar
 *
 * @since 1.0.0
 * 
 * @package Newslist WordPress Theme
 */
?>
<section  class="newlist-tag-wrapper">
    <div class="container">
        <div class="newslist-tag-inner"> 
        <?php $tags = json_decode( newslist_get( 'top-tag-list' ) );
            if( $tags && $tags[0] ) { ?>
                <div class="newslist-tag">
                    <?php $title = newslist_get( 'top-tag-title' );
                    if( '' != $title ) { ?>
                        <h2 class="newslist-tag-title">
                            <?php echo esc_html( newslist_get( 'top-tag-title' ) ); ?>
                        </h2> 
                    <?php } ?>               
                    <ul class="newlist-tag-list">
                        <?php foreach( $tags as $t ) {
                            $tag = get_term( $t );
                            if( $tag ) { ?>
                                <li>
                                    <a href="<?php echo esc_url( get_term_link( $tag ) ); ?>">				
                                        <?php echo esc_html( $tag->name ); ?>
                                    </a>							 
                                </li>
                            <?php } 
                        } ?>
                    </ul>
                </div>
            <?php } 
            $time = newslist_get( 'newslist-time' );
            if( ''!= $time ){?>
                <div class="newslist-time-wrapper">
                        <div class="newslist-time-inner">
                            <time datetime="<?php echo esc_attr( date( DATE_W3C ) ); ?>">
                                <?php echo esc_html( date( get_option( 'date_format' ) ) ); ?>
                            </time>
                        </div>
                        <div class="newslist-digital-clock-wrapper">
                            <span class="newslist-time"></span>
                        </div> 
                    </div>            
                <?php }?>     
        </div>
    </div>
</section>



