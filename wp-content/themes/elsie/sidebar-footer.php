<?php
/**
 * Footer widget areas
 * 
 * @package Elsie
 */
?>

<?php
	if ( !is_active_sidebar( 'footer-1' ) ) {
		return;
	}


	$elsie_footer_widgets_layout 		= get_theme_mod( 'footer_widgets_layout', 'columns3' );
	$elsie_footer_widgets_container 	= get_theme_mod( 'footer_widgets_width', 'container' );

	switch ( $elsie_footer_widgets_layout ) {
		case 'columns1':
			$elsie_widget_areas = array(
				'no'	=> 1,
				'col'	=> 'col-lg-12',
			);
			break;

		case 'columns2':
			$elsie_widget_areas = array(
				'no'	=> 2,
				'col'	=> 'col-lg-6',
			);			
			break;
			 
		case 'columns3':
			$elsie_widget_areas = array(
				'no'	=> 3,
				'col'	=> 'col-lg-4',
			);			
			break;

		case 'columns4':
			$elsie_widget_areas = array(
				'no'	=> 4,
				'col'	=> 'col-lg-3',
			);			
			break;	

		default:
			return;
	}	
?>

<div class="footer-widgets <?php echo esc_attr( $elsie_footer_widgets_layout ); ?>">
	<div class="<?php echo esc_attr( $elsie_footer_widgets_container ); ?>">
		<div class="footer-widgets-inner">
			<div class="row">
			<?php for ( $elsie_counter = 1; $elsie_counter <= $elsie_widget_areas['no']; $elsie_counter++ ) { ?>
				<?php if ( is_active_sidebar( 'footer-' . $elsie_counter ) ) : ?>
				<div class="footer-column <?php echo esc_attr( $elsie_widget_areas['col'] ); ?>">
					<?php dynamic_sidebar( 'footer-' . $elsie_counter); ?>
				</div>
				<?php endif; ?>	
			<?php } ?>
			</div>
		</div>
	</div>
</div>
