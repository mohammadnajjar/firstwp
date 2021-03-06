<?php
/**
 * Toggle control
 *
 * @package Elsie
 */

class Elsie_Toggle_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'elsie-toggle_switch';

	public $forward;

	/**
	 * Render the control in the customizer
	 */
	public function render_content(){
	?>
		<div class="toggle-switch-control">
			
			<div class="toggle-links">
			<?php if( !empty( $this->forward ) ) { ?>
				<a class="toggle-configure" href="javascript:wp.customize.<?php echo esc_html( $this->forward['type'] ); ?>( '<?php echo esc_html( $this->forward['slug'] ); ?>' ).focus();"><?php echo esc_html__( 'Configure', 'elsie' ); ?></a>
			<?php } ?>				
				<div class="toggle-switch">				
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
			</div>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>		
			<?php if( !empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
		</div>
	<?php
	}
}