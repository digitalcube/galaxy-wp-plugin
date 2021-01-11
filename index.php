<?php

/**
 * Galaxy Design System for WordPress
 *
 * @package Galaxy
 *
 * Plugin Name: Galaxy
 * Description: Galaxy Design System for WordPress
 * Plugin URI:  https://github.com/digitalcube/galaxy-wp-plugin
 * Version:     0.0.0
 * Author:      DigitalCube
 * Author URI:  https://www.digitalcube.jp
 * Text Domain: galaxy
 */

define('GALAXY', __FILE__);

/**
 * Include the Galaxy class.
 */
require plugin_dir_path(GALAXY) . 'class-galaxy.php';
