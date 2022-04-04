<?php
/**
 * Enqueue scripts and styles.
 */
function promos_scripts() {
	global $promos_theme_options, $wp_query;
    $promos_pagination_option =  esc_attr($promos_theme_options['promos-pagination-options']);        

    wp_enqueue_style('promos-body', '//fonts.googleapis.com/css?family=Lato:400,500,700&display=swap', array(), null);
    wp_enqueue_style('promos-heading', '//fonts.googleapis.com/css2?family=Bellefair&display=swap', array(), null);
    wp_enqueue_style('promos-sign', '//fonts.googleapis.com/css?family=Monsieur+La+Doulaise&display=swap', array(), null);
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );
    wp_enqueue_style( 'grid-css', get_template_directory_uri() . '/css/bootstrap.css', array(), '4.5.0' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '4.5.0' );
    wp_enqueue_style( 'promos-style', get_stylesheet_uri() );
	wp_style_add_data( 'promos-style', 'rtl', 'replace' );    

	wp_enqueue_script( 'promos-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20200412', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '4.6.0' );    
	wp_enqueue_script( 'promos-script', get_template_directory_uri() . '/assets/js/script.js', array(), '20200412', true );
    wp_enqueue_script( 'promos-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '20200412', true );

	wp_enqueue_script( 'promos-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20200412', true );

	global $promos_theme_options;
	if( 1 == absint($promos_theme_options['promos-enable-sticky-sidebar'])) {
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array(), '20200412', true );
        wp_enqueue_script( 'promos-sticky-sidebar', get_template_directory_uri() . '/assets/js/custom-sticky-sidebar.js', array(), '20200412', true );
	}
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action( 'wp_enqueue_scripts', 'promos_scripts' );

/**
 * Enqueue fonts for the editor style
 */
function promos_block_styles() {
    wp_enqueue_style( 'promos-editor-styles', get_theme_file_uri( 'css/editor-styles.css' ) );
    wp_enqueue_style('promos-editor-body', '//fonts.googleapis.com/css?family=Lato:400,500,700&display=swap', array(), null);
    wp_enqueue_style('promos-editor-heading', '//fonts.googleapis.com/css?family=Bellefair&display=swap', array(), null);

    $promos_custom_css = '
    .edit-post-visual-editor.editor-styles-wrapper{ font-family: Lato;}

    .editor-post-title__block .editor-post-title__input,
    .editor-styles-wrapper h1,
    .editor-styles-wrapper h2,
    .editor-styles-wrapper h3,
    .editor-styles-wrapper h4,
    .editor-styles-wrapper h5,
    .editor-styles-wrapper h6{
        font-family:Bellefair;
    }';

    wp_add_inline_style( 'promos-editor-styles', $promos_custom_css );
}

add_action( 'enqueue_block_editor_assets', 'promos_block_styles' );

