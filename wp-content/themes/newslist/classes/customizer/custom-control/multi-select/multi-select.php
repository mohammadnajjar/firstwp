<?php
/** 
 * Customizer Control: multi-select
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress Theme
 */

# Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Multiple select customize control class.
 */
if ( class_exists( 'WP_Customize_Control' ) ) {	
	class Newslist_Multi_Select extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 */
		public $type = 'multiple-select';

		/**
		 * Displays the multiple select on the customize screen.
		 */
		public function render_content() {
			if( !$this->value() ){
				$val = array( '0' ); 
			}else{
				$val = json_decode( $this->value() );
			} ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ) ?></span>
				<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
					<?php
						foreach ( $this->choices as $value => $label ) {
							$selected = ( in_array( $value, $val ) ) ? selected( 1, 1, false ) : '';
							echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
						}
					?>
				</select>
			</label>
		<?php }

		public static function sanitize( $val ){
			if( is_array( $val ) ){
				return json_encode( $val );
			}else{
				return '';
			}
		}
	}
}

Newslist_Customizer::add_custom_control( array(
    'type'     => 'multiple-select',
    'class'    => 'Newslist_Multi_Select',
    'sanitize' =>  array( 'Newslist_Multi_Select', 'sanitize' ),
    'register_control_type' => false
));