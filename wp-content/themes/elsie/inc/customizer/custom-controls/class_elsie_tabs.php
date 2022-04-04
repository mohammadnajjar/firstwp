<?php
/**
 * Tabs control
 *
 * @package Elsie
 */

class Elsie_Tabs extends WP_Customize_Control {
	public $type 		= 'elsie-tabs';
	public $label 		= '';
	public $label2 		= '';
	public $connected 	= '';
	public $connected2 	= '';
	public $linked 			= '';

	public function render_content() {
	?>
		<div data-tabs-id="<?php echo esc_attr( $this->linked ); ?>" class="elsie-customizer-tabs">
			<a class="tab1 active" href="javascript:wp.customize.section( '<?php echo esc_attr( $this->connected ); ?>' ).focus();"><?php echo esc_html( $this->label ); ?></a>
			<a class="tab2" href="javascript:wp.customize.section( '<?php echo esc_attr( $this->connected2 ); ?>' ).focus();"><?php echo esc_html( $this->label2 ); ?></a>
		</div>
	<?php
	}
}