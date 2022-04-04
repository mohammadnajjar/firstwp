<?php

/** 
 * Customizer Control: order.
 *
 * @since 1.0.09
 * @package Newslist Theme
 */

# Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Newslist_Section_Order extends WP_Customize_Control {
		/**
		 * The control type.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 *
		 * @package Newslist Theme
		 */
		public $type = 'newslist-section-order';

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 *
		 * @since  1.0.0
		 * @access public
		 *
		 * @package Newslist Theme
		 */
		public function to_json() {
			parent::to_json();

			$this->json['value']       = $this->value();
			$this->json['link']  = $this->get_link();
			$this->json['id']    = $this->id;
			if ( empty( $this->value() ) ) {
				$this->json['sections'] = $this->choices;
			} else {
				$saved = array();
				$val = json_decode( $this->value() );
				foreach ($val as $v) {
					$saved[$v] = $this->choices[$v];
				}
				if ( !empty( $saved ) ) {
					$this->json['sections'] = $saved;
				} else {
					$this->json['sections'] = $this->choices;
				}
			}
		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @access protected
		 * @since 1.0.0
		 *
		 * @package Newslist Theme
		 */
		protected function content_template() { ?>
			<div class="newslist-section-order">
				<span class="customize-control-title">{{{ data.label }}}</span>
				<span class="description customize-control-description">{{{ data.description }}}</span>
				<# if( '' !=data.sections ){ #>
					<ul class="newslist-sortable-section {{data.id}}">
						<# _.each( data.sections, function( name, index ) { #>
							<li class="ui-state-default" data-val="{{index}}">
								{{name}}
								<span class="dashicons dashicons-menu"></span>
							</li>
							<# } ) #>
					</ul>
					<# }else{ #>
						<li><?php esc_html_e('No section enabled. Please enable sections', 'newslist'); ?></li>
						<# } #>
							<input type="hidden" {{{ data.link }}}>
			</div>
<?php
		}

		public static function sanitize( $val ) {
			if ( json_decode( $val ) != null ) {
				// is json
				return $val;
			}
			return '';
		}
	}
}

Newslist_Customizer::add_custom_control(array(
	'type'     => 'newslist-section-order',
	'class'    => 'Newslist_Section_Order',
	'sanitize' =>  array( 'Newslist_Section_Order', 'sanitize' )
));
