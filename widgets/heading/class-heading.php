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
 * Galaxy Heading widget class.
 *
 * @since 0.0.0
 */
class GalaxyHeading extends Widget_Base
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

		add_action('elementor/frontend/after_enqueue_styles', function () {
			wp_register_style('galaxy_heading', plugins_url('/widgets/heading/style.css', GALAXY), array(), '0.0.0');
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
		return 'galaxy-heading';
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
		return __('Heading', 'galaxy-heading-heading');
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
		return array('galaxy_heading');
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
				'label' => __('Content', 'galaxy-heading'),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __('Title', 'galaxy'),
				'default' => __('Title', 'galaxy'),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
			)
		);

		$this->add_control(
			'website_link',
			[
				'label' => __('Link', 'galaxy'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'galaxy'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'galaxy'),
				'type' => Controls_Manager::SELECT,
				'default' => 'shifter-purple-primary',
				'options' => [
					'shifter-brand-gradient' => __('Shifter/Brand/Gradient', 'galaxy'),
					'shifter-purple-primary' => __('Shifter/Purple/Primary', 'galaxy'),
					'shifter-purple-100' => __('Shifter/Purple/100', 'galaxy'),
					'shifter-purple-200' => __('Shifter/Purple/200', 'galaxy'),
					'shifter-purple-300' => __('Shifter/Purple/300', 'galaxy'),
					'shifter-purple-400' => __('Shifter/Purple/400', 'galaxy'),
					'shifter-purple-500' => __('Shifter/Purple/500', 'galaxy'),
					'shifter-purple-600' => __('Shifter/Purple/600', 'galaxy'),
					'shifter-purple-700' => __('Shifter/Purple/700', 'galaxy'),
					'shifter-purple-800' => __('Shifter/Purple/800', 'galaxy'),
					'shifter-purple-900' => __('Shifter/Purple/900', 'galaxy'),
				],
			]
		);

		$this->add_control(
			'font_size',
			[
				'label' => __('Font Size', 'font-size'),
				'type' => Controls_Manager::SELECT,
				'default' => '5',
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
				],
			]
		);

		$this->add_control(
			'font_weight',
			[
				'label' => __('Font Weight', 'galaxy'),
				'type' => Controls_Manager::SELECT,
				'default' => 'strong',
				'options' => [
					'regular' => 'Regular',
					'strong' => 'Strong',
				],
			]
		);

		$this->add_control(
			'header_size',
			[
				'label' => __('HTML Tag', 'galaxy'),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
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

		$this->add_inline_editing_attributes('title', 'none');

		$target = $settings['website_link']['is_external'] === true ? '_blank' : null;
		$rel = $settings['website_link']['nofollow'] === true ? 'nofollow' : null;
		$link = esc_url($settings['website_link']['url']);

		$this->add_render_attribute(
			'link',
			[
				'href' => $link,
				'target' => $target,
				'rel' => $rel,
			]
		);

		$this->add_render_attribute(
			'class',
			[
				'class' => ['galaxy-heading', 'font-size-' . $settings['font_size'], 'text-' . $settings['text_color'], 'font-weight-' . $settings['font_weight'], $settings['_css_classes']],
			]
		);
?>
		<?php echo $link ? '<a ' . $this->get_render_attribute_string('link') . '>' : null ?>
		<<?php echo $settings['header_size']; ?> <?php echo $this->get_render_attribute_string('class'); ?>><?php echo wp_kses($settings['title'], array()); ?></<?php echo $settings['header_size']; ?>>
		<?php echo $link ? '</a>' : null ?>
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
		<{{{ settings.header_size }}} {{{ view.getRenderAttributeString( 'class' ) }}}>{{{ settings.title }}}</{{{ settings.header_size }}}>
<?php
	}
}
