<?php

/**
 * Algolia config class.
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
class AlgoliaConfig extends Widget_Base
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

		// Dequeue WP Search with Algolia plugin default scrips.
		// wp_dequeue_script('algolia-instantsearch');
		// wp_dequeue_script('algolia-search');
		wp_dequeue_script('algolia-autocomplete');
		wp_dequeue_script('algolia-autocomplete-noconflict');

		// Dequeue WP Search with Algolia plugin default styles.
		wp_dequeue_style('algolia-instantsearch');

		// Enqueue Algolia for Elementor config.
		wp_register_script('algolia-wp-plugin', plugins_url('main.js', __FILE__), array(), '0.0.0', true);
		wp_enqueue_script('algolia-wp-plugin');

		// Enqueue Algolia for Elementor styles.
		// wp_register_style('algolia-wp-plugin', plugins_url('/widgets/algolia/style.css', ALGOLIA), array(), '0.0.0', true);
		// wp_enqueue_style('algolia-wp-plugin');

		// Enqueue Algolia Search Lite from CDN
		wp_register_script('algolia-cdn-search-lite', 'https://cdn.jsdelivr.net/npm/algoliasearch@4.5.1/dist/algoliasearch-lite.umd.js', array(), '0.0.0', true);
		wp_enqueue_script('algolia-cdn-search-lite');

		// Enqueue Algolia InstantSearch from CDN
		wp_register_script('algolia-cdn-instantsearch', 'https://cdn.jsdelivr.net/npm/instantsearch.js@4.8.3/dist/instantsearch.production.min.js', array(), '0.0.0', true);
		wp_enqueue_script('algolia-cdn-instantsearch');

		// Enqueue Algolia Autocomplete from CDN
		wp_register_script('algolia-cdn-autocomplete', 'https://cdnjs.cloudflare.com/ajax/libs/autocomplete.js/0.38.0/autocomplete.jquery.min.js', array('algolia-autocomplete-noconflict'), '0.0.0', true);
		wp_enqueue_script('algolia-cdn-autocomplete');

		// Enqueue Algolia Reset from CDN
		wp_register_style('algolia-cdn-instantsearch-reset', 'https://cdn.jsdelivr.net/npm/instantsearch.css@latest/themes/reset-min.css', array(), '0.0.0');
		wp_enqueue_style('algolia-cdn-instantsearch-reset');

		// Enqueue Algolia Theme from CDN
		// wp_register_style('algolia-cdn-instantsearch-theme', 'https://cdn.jsdelivr.net/npm/instantsearch.css@7.4.5/themes/algolia.css', array(), '0.0.0');
		// wp_enqueue_style('algolia-cdn-instantsearch-theme');
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
		return 'algolia-wp-plugin';
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
		return ['algolia', 'search', 'algolia'];
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
		return __('Algolia Config', 'algolia-wp-plugin');
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
			'section_settings',
			[
				'label' => __('Settings', 'algolia-wp-plugin'),
			]
		);

		$this->add_control(
			'index_name',
			[
				'label' => __('Search Index', 'algolia-wp-plugin'),
				'type' => Controls_Manager::TEXT,
				'show_label' => true,
				'default' => 'wp_searchable_posts',
			]
		);

		$this->add_control(
			'facet_filters',
			[
				'label' => __('Facet Filters', 'algolia-wp-plugin'),
				'type' => Controls_Manager::CODE,
				'show_label' => true,
			]
		);

		$this->add_control(
			'hits_per_page',
			[
				'label' => __('Hits Per Page', 'algolia-wp-plugin'),
				'show_label' => true,
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
			]
		);

		$this->add_control(
			'localize',
			[
				'label' => __('Localize', 'algolia-wp-plugin'),
				'type' => Controls_Manager::SWITCHER,
				'default' => true,
				'frontend_available' => true,
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

		global $post;
		$post_id =  $post->ID;
		$post_type = get_post_type($post_id);
		$post_type_obj = get_post_type_object($post_type);
		$post_type_name = (string) strtolower($post_type_obj->labels->name);
		$rest_path = 'wp-json/wp/v2/' .  $post_type_name . '/' . $post_id;

		$config = array(
			'postId' => get_the_ID(),
			'facetFilters' => $this->get_settings_for_display('facet_filters'),
			'indexName' => $this->get_settings_for_display('index_name'),
			'hitsPerPage' => $this->get_settings_for_display('hits_per_page'),
			'localize' => $this->get_settings_for_display('localize'),
			'localeName' => function_exists('pll_current_language') ? pll_current_language('name') : null,
			'restPath' => $rest_path,
			'siteID' => '0e356941-b03b-4897-a1ed-8afc680eca3e',
		);

		wp_localize_script('algolia-wp-plugin', 'settings', $config);
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
		//
	}
}
