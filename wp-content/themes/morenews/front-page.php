<?php
get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {

    
    /**
     * morenews_action_sidebar_section hook
     * @since Newsium 1.0.0
     *
     * @hooked morenews_front_page_section -  20
     * @sub_hooked morenews_front_page_section -  20
     */
    do_action('morenews_front_page_section');


}
get_footer();