<?php

/**
 * Plugin Name:       Galaxy
 * Plugin URI:        https://github.com/digitalcube/galaxy-wp-plugin
 * Description:       TODO: Add description.
 * Version:           0.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.2
 * Author:            DigitalCube
 * Author URI:        https://digitalcube.jp
 * License:           GNU General Public License v2.0 / MIT License
 * Text Domain:       galaxy-wp-plugin
 * Domain Path:       /languages
 *
 * @since   0.0.0
 * @package DigitalCube\GalaxyWpPlugin
 */

// Nothing to see here if not loaded in WP context.
if (!defined('WPINC')) {
	die;
}

require_once 'classmap.php';
