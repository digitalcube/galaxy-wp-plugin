<?php
/**
 * Galaxy_Styles class file.
 *
 * @author  WebDevStudios <contact@webdevstudios.com>
 * @since   0.0.0
 *
 * @package DigitalCube\Galaxy
 */

/**
 * Class Galaxy_Styles
 *
 * @since 1.5.0
 */
class Galaxy_Styles {

	/**
	 * Galaxy_Styles constructor.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.5.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
	}

	/**
	 * Register styles.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.5.0
	 */
	public function register_styles() {

		wp_register_style(
			'algolia-autocomplete',
			ALGOLIA_PLUGIN_URL . 'css/algolia-autocomplete.css',
			[],
			ALGOLIA_VERSION
		);

		wp_register_style(
			'algolia-instantsearch',
			ALGOLIA_PLUGIN_URL . 'css/algolia-instantsearch.css',
			[],
			ALGOLIA_VERSION
		);
	}
}
