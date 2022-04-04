<?php
/**
 * Single page and post metabox
 *
 * @package Elsie
 */


function elsie_page_metabox_init() {
    new Elsie_Page_Metabox();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'elsie_page_metabox_init' );
    add_action( 'load-post-new.php', 'elsie_page_metabox_init' );
}

class Elsie_Page_Metabox {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );

		
	}

	public function add_meta_box( $post_type ) {
        $post_types = array( 'post', 'page' );
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'elsie_single_page_metabox'
				,__( 'Elsie page options', 'elsie' )
				,array( $this, 'render_meta_box_content' )
				,array( 'post', 'page' )
				,'side'
				,'low'
			);
        }
	}

	public function save( $post_id ) {
	
		// Check if our nonce is set.
		if ( ! isset( $_POST['elsie_single_page_box_nonce'] ) )
			return $post_id;

		$nonce = sanitize_key( $_POST['elsie_single_page_box_nonce'] );

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'elsie_single_page_box' ) )
			return $post_id;


		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		}

		//Hide title
		$activate_title_hide = ( isset( $_POST['elsie_hide_title'] ) && '1' === $_POST['elsie_hide_title'] ) ? 1 : 0;
		update_post_meta( $post_id, '_elsie_hide_title', $activate_title_hide );	

		//Hide featured image
		$activate_featured_hide = ( isset( $_POST['elsie_hide_featured_image'] ) && '1' === $_POST['elsie_hide_featured_image'] ) ? 1 : 0;
		update_post_meta( $post_id, '_elsie_hide_featured_image', $activate_featured_hide );			

		//disable Header
		$activate_header_hide = ( isset( $_POST['elsie_hide_header'] ) && '1' === $_POST['elsie_hide_header'] ) ? 1 : 0;
		update_post_meta( $post_id, '_elsie_hide_header', $activate_header_hide );

		//disable Footer
		$activate_footer_hide = ( isset( $_POST['elsie_hide_footer'] ) && '1' === $_POST['elsie_hide_footer'] ) ? 1 : 0;
		update_post_meta( $post_id, '_elsie_hide_footer', $activate_footer_hide );		

		//Layout
		$layout_choices = array( 'regular', 'no-sidebar', 'stretched' );
		$post_layout = $this->sanitize_selects( sanitize_key( $_POST['elsie_page_layout'] ), $layout_choices ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated
		update_post_meta( $post_id, '_elsie_page_layout', $post_layout );
	}

	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'elsie_single_page_box', 'elsie_single_page_box_nonce' );
		$header_hide 			= get_post_meta( $post->ID, '_elsie_hide_header', true );
		$footer_hide 			= get_post_meta( $post->ID, '_elsie_hide_footer', true );
		$title_hide 			= get_post_meta( $post->ID, '_elsie_hide_title', true );
		$featured_hide 			= get_post_meta( $post->ID, '_elsie_hide_featured_image', true );
		$post_layout 			= get_post_meta( $post->ID, '_elsie_page_layout', true );
	?>
	<p>
	<label for="elsie_page_layout"><?php esc_html_e( 'Page layout', 'elsie' ); ?></label>	
	<select style="max-width:200px;" name="elsie_page_layout">
		<option value="regular" <?php selected( $post_layout, 'regular' ); ?>><?php esc_html_e( 'Regular', 'elsie' ); ?></option>
		<option value="no-sidebar" <?php selected( $post_layout, 'no-sidebar' ); ?>><?php esc_html_e( 'No sidebar', 'elsie' ); ?></option>
		<option value="stretched" <?php selected( $post_layout, 'stretched' ); ?>><?php esc_html_e( 'Stretched (for page builders)', 'elsie' ); ?></option>
	</select>
	</p>
	<p>
		<label><input type="checkbox" name="elsie_hide_title" value="1" <?php checked( $title_hide, 1 ); ?> /><?php esc_html_e( 'Disable the title', 'elsie' ); ?></label>
	</p>
	<p>
		<label><input type="checkbox" name="elsie_hide_featured_image" value="1" <?php checked( $featured_hide, 1 ); ?> /><?php esc_html_e( 'Disable the featured image', 'elsie' ); ?></label>
	</p>	
	<p>
		<label><input type="checkbox" name="elsie_hide_header" value="1" <?php checked( $header_hide, 1 ); ?> /><?php esc_html_e( 'Disable the header', 'elsie' ); ?></label>
	</p>	
	<p>
		<label><input type="checkbox" name="elsie_hide_footer" value="1" <?php checked( $footer_hide, 1 ); ?> /><?php esc_html_e( 'Disable the footer', 'elsie' ); ?></label>
	</p>	
		
	<?php
	}

	/**
	 * Function to sanitize selects
	 */
	public function sanitize_selects( $input, $choices ) {

		$input = sanitize_key( $input );

		return ( in_array( $input, $choices ) ? $input : '' );
	}
}