<?php
/**
 * Plugin Name: WP Ikimiz
 * Plugin URI:  http://example.com/plugin-url
 * Description: A brief description of your plugin.
 * Version:     1.0
 * Author:      Your Name
 * Author URI:  http://example.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ikimiz
 * Domain Path: /languages
 */

// Your plugin code goes here

namespace Ikimiz;

defined('ABSPATH') or die('No script kiddies please!');

require_once __DIR__ . '/src/vendor/autoload.php';

(new \Ikimiz\App(__FILE__))->init();