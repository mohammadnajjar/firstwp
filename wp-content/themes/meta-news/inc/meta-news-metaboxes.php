<?php
/**
 * Meta News Meta Boxes
 *
 * @package Meta News
 */

/**
 * Add Meta Boxes only to page and posts
 *
 */
function meta_news_metabox() {
	add_meta_box(
		'meta-news-siderbar-layout',
		__( 'Below setting will not reflect on main Blog Page and some Plugins Pages.', 'meta-news' ),
		'meta_news_sidebar_layout'
	);
}
add_action( 'add_meta_boxes_page', 'meta_news_metabox' );
add_action( 'add_meta_boxes_post', 'meta_news_metabox' );

/**
 * Displays metabox to page and posts for sidebar layout
 */
function meta_news_sidebar_layout( $post ) {
	$sidebar_options = array(
	'default-sidebar' => array(
		'id'				=> 'meta_news_sidebarlayout',
		'value'			=> 'default',
		'label'			=> __( 'Default Layout set in Customizer', 'meta-news' ),
		),
	'no-sidebar'		=> array(
		'id'				=> 'meta_news_sidebarlayout',
		'value'			=> 'meta-nosidebar',
		'label' 			=> __( 'No Sidebar', 'meta-news' ),
		),
	'no-sidebar-full-width' => array(
		'id'    			=> 'meta_news_sidebarlayout',
		'value' 			=> 'meta-fullwidth',
		'label' 			=> __( 'No Sidebar, Full Width', 'meta-news' ),
		),
	'left-sidebar' 	=> array(
		'id'    			=> 'meta_news_sidebarlayout',
		'value' 			=> 'meta-left',
		'label' 			=> __( 'Left Sidebar', 'meta-news' ),
		),
	'right-sidebar' 	=> array(
		'id'    			=> 'meta_news_sidebarlayout',
		'value' 			=> 'meta-right',
		'label' 			=> __( 'Right Sidebar', 'meta-news' ),
		),
	);

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'meta_news_metabox_check' );

	// Begin the field table and loop  ?>
	<table id="sidebar-metabox" class="form-table" width="100%">
		<tbody>
			<tr>
				<?php foreach ( $sidebar_options as $field ) {
					$meta = get_post_meta( $post->ID, 'meta_news_sidebarlayout', true );
					if ( empty( $meta ) ) {
						$meta = 'default';
					} ?>
					<td>
						<label class="description">
							<input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( esc_attr( $field['value'] ), $meta ); ?>/><?php echo esc_html( $field['label'] ); ?></label>
					</td>
				<?php } // End foreach(). ?>
			</tr>
		</tbody>
	</table>
<?php
}

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function meta_news_save_custom_meta( $post_id, $post ) {

	// Verify the nonce before proceeding.
	if ( ! isset( $_POST['meta_news_metabox_check'] ) || ! wp_verify_nonce( $_POST['meta_news_metabox_check'], basename( __FILE__ ) ) ) {
		return;
	}

	// Stop WP from clearing custom fields on autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// If user cannot edit posts/page we return.
	if ( ! current_user_can( 'edit_pages' )  || ! current_user_can( 'edit_posts' ) ) {
		return $post_id;
	}

	// Create a whitelist of accepted values.
	$options = array( 'default', 'meta-nosidebar', 'meta-right', 'meta-left', 'meta-fullwidth' );

	// We make sure there is something to save.
	if ( isset( $_POST['meta_news_sidebarlayout'] )
		&& ! empty( $_POST['meta_news_sidebarlayout'] )
		&& in_array( $_POST['meta_news_sidebarlayout'], $options, true ) ) {
		update_post_meta( $post_id, 'meta_news_sidebarlayout', $_POST['meta_news_sidebarlayout'] );
	}
}
add_action( 'save_post', 'meta_news_save_custom_meta', 10, 2 );
