<?php

/**
 * Galaxy class.
 *
 * @category   Class
 * @package    Galaxy
 * @subpackage WordPress
 * @author     DigitalCube <info@digitalcube.jp>
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://github.com/digitalcube/galaxy-wp-plugin, Galaxy)
 * @since      0.0.0
 * php version 7.3.9
 */

namespace Galaxy\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Galaxy Spacer widget class.
 *
 * @since 0.0.0
 */
class GalaxySpacer extends Widget_Base
{
	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct($data = array(), $args = null)
	{
		parent::__construct($data, $args);
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 0.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'galaxy-spacer';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 0.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Spacer', 'galaxy-spacer');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 0.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'fas fa-sync';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 0.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return array('general');
	}

	/**
	 * Enqueue styles.
	 */
	public function get_style_depends()
	{
		return array('galaxy_spacer');
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 0.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __('Content', 'galaxy-spacer'),
			)
		);

		$this->add_control(
			'size',
			[
				'label' => __('Size', 'size'),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'9' => __('9', 'galaxy'),
					'8' => __('8', 'galaxy'),
					'7' => __('7', 'galaxy'),
					'6' => __('6', 'galaxy'),
					'5' => __('5', 'galaxy'),
					'4' => __('4', 'galaxy'),
					'3' => __('3', 'galaxy'),
					'2' => __('2', 'galaxy'),
					'1' => __('1', 'galaxy'),
					'0' => __('0', 'galaxy'),
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'class',
			[
				'class' => ['galaxy-spacer', 'h-' . $settings['size'], $settings['_css_classes']],
			]
		);
?>
		<div <?php echo $this->get_render_attribute_string('class'); ?>></div>
	<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 0.0.0
	 *
	 * @access protected
	 */
	protected function _content_template()
	{
	?>
		<div {{{ view.getRenderAttributeString( 'class' ) }}}></div>
<?php
	}
}
