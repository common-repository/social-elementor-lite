<?php
/**
 * Social Elementor WooCommerce Query.
 *
 * @package SOCIAL_ELEMENTOR
 */

namespace SocialElementor\Modules\QueryPost\Controls;

use Elementor\Base_Data_Control;
use SocialElementor\Modules\QueryPost\Module;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Query.
 */
class Query extends Base_Data_Control {

	const CONTROL_ID = 'social-blog-posts-query';

	/**
	 * Get Control Type.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return self::CONTROL_ID;
	}

	/**
	 * Get Default Settings.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Settings.
	 */
	protected function get_default_settings() {
		return array(
			'label_block' => true,
			'multiple'    => false,
			'options'     => array(),
			'post_type'   => 'all',
		);
	}

	/**
	 * Enqueue control scripts and styles.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue() {

		wp_register_script( 'uaquery-control', SOCIAL_ELEMENTOR_URL . 'editor-assets/js/query-post.js', array( 'jquery' ), '1.0.0' );
		wp_enqueue_script( 'uaquery-control' );
	}

	/**
	 * Control content template.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
				<select id="<?php echo $control_uid; ?>" class="elementor-select2" type="select2" {{ multiple }} data-setting="{{ data.name }}">
					<# _.each( data.options, function( option_title, option_value ) {
						var value = data.controlValue;
						if ( typeof value == 'string' ) {
							var selected = ( option_value === value ) ? 'selected' : '';
						} else if ( null !== value ) {
							var value = _.values( value );
							var selected = ( -1 !== value.indexOf( option_value ) ) ? 'selected' : '';
						}
						#>
					<option {{ selected }} value="{{ option_value }}">{{{ option_title }}}</option>
					<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}
