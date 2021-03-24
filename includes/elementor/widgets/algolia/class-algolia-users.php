<?php

/**
 * Algolia class.
 *
 * @category   Class
 * @package    Algolia
 * @subpackage WordPress
 * @author     DigitalCube <info@digitalcube.jp>
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://github.com/digitalcube/algolia-wp-plugin, Algolia)
 * @since      0.0.0
 * php version 7.3.9
 */

namespace Algolia\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Algolia widget class.
 *
 * @since 0.0.0
 */
class AlgoliaUsers extends Widget_Base
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
		return 'algolia-users';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['algolia', 'users'];
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
		return __('Algolia Users', 'algolia-users');
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
		return 'fab fa-algolia';
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
		return array('algolia-wp-plugin');
	}

	/**
	 * Enqueue styles.
	 */
	public function get_style_depends()
	{
		return array('algolia-wp-plugin');
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
			'section_title',
			[
				'label' => __('Algolia Users', 'algolia-wp-plugin'),
			]
		);

		$this->add_control(
			'html',
			[
				'label' => '',
				'type' => Controls_Manager::CODE,
				'default' => '<div id="facet-users"></div>',
				'placeholder' => __('Enter your code', 'algolia-wp-plugin'),
				'show_label' => false,
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
		$algolia_api = get_option('algolia_api_is_reachable');
		if ($algolia_api === 'no') {
			echo '<pre>{"algolia_api_is_reachable": "' . $algolia_api . '"}</pre>';
			return;
		};

		echo $this->get_settings_for_display('html');
?>

	<?php }

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 0.0.0
	 *
	 * @access protected
	 */
	protected function content_template()
	{
	?>
		{{{ settings.html }}}
<?php
	}
}
