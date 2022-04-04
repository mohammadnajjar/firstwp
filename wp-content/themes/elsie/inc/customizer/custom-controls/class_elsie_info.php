<?php
/**
 * Info control
 *
 * @package Elsie
 */

class Elsie_Info extends WP_Customize_Control {
	public $type = 'elsie-info';
	public $label = '';
	public $description = '';
	public $attr = '';

	public function render_content() {
	?>
		<?php if ( $this->label ) : ?>
			<?php if ( '' === $this->attr ) : ?>
				<p class="elsie-customizer-info"><?php echo wp_kses_post( $this->label ); ?></p>
			<?php else : ?>
				<p><?php echo $this->label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		<?php endif; ?>
	<?php
	}
}   