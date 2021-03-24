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
 * Galaxy Table widget class.
 *
 * @since 0.0.0
 */
class GalaxyTable extends Widget_Base
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

		add_action('elementor/frontend/after_enqueue_scripts', function () {
			wp_register_script('galaxy-table', plugins_url('main.js', __FILE__), array(), '0.0.0',);
			wp_enqueue_script('galaxy-table');
		});
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
		return 'galaxy-table';
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
		return __('Table', 'galaxy-table');
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
	 * Enqueue scripts.
	 */
	public function get_script_depends()
	{
		return array('galaxy-table');
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
				'label' => __('Content', 'galaxy-table'),
			)
		);

		$this->add_control(
			'data',
			array(
				'label'   => __('Data', 'galaxy-table'),
				'default' => __('', 'galaxy-table'),
				'type' => Controls_Manager::CODE,
			)
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
		$id = wp_generate_uuid4();

		$this->add_render_attribute(
			'class',
			[
				'class' => ['galaxy-table', 'galaxy-table-' . $id, 'font-size-4', 'font-weight-regular', 'text-shifter-gray-500', $settings['_css_classes']],
			]
		);
?>
		<script type="text/javascript">
			document.addEventListener("DOMContentLoaded", function(event) {
				const settings = <?php echo $settings['data']; ?>;

				function generateTable(table, data) {
					for (let element of data) {
						let row = table.insertRow();
						for (key in element) {
							let cell = row.insertCell();
							let text = document.createTextNode(element[key]);
							cell.appendChild(text);
						}
					}
				}

				let table = document.querySelector("<?php echo '.galaxy-table-' . $id; ?>");
				let data = Object.keys(settings);
				generateTable(table, settings);
			});
		</script>
		<div class="overflow-x-auto">
			<table <?php echo $this->get_render_attribute_string('class'); ?>></table>
		</div>
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
		<div class="overflow-x-auto">
			<table class="galaxy-table">Table</table>
		</div>
<?php
	}
}
