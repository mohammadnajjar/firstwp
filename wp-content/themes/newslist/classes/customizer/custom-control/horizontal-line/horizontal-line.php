<?php

/**
 *
 * A Custom control for post dropdown
 *
 * @since 1.0.0
 *
 * @package Newslist WordPress theme
 *
 * @uses  Class WP_Customize_Control
 * 
 */
if (class_exists('WP_Customize_Control')) :

	class Newslist_Horizontal_Line extends WP_Customize_Control	{
		public $type = 'horizontal-line';

		/**
		 *    
		 * Adds the horizontal line
		 * @since  1.0.0
		 * @access public
		 * @return void   
		 *  
		 * @package Newslist WordPress Theme
		 */
		public function render_content() { ?>
			<style>
				hr {
					border-top: 7px solid #c1c1c1;
					border-bottom: 0;
				}
			</style>
			<div class="horizontal-line">
				<span class="customize-control-title"><?php echo esc_html( $this->label ) ?></span>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ) ?></span>
				<hr>
			</div>
<?php }
	}

endif;

Newslist_Customizer::add_custom_control(array(
	'type'     => 'horizontal-line',
	'class'    => 'Newslist_Horizontal_Line',
	'sanitize' => false,
	'register_control_type' => false
));
