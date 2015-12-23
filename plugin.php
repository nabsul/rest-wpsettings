<?php
/**
 * Plugin Name: WP REST SETTINGS
 * Description: Manage WordPress Settings from the REST API
 * Author: Nabeel Sulieman
 * Author URI: http://nabeel.us
 * Version: 0.1alpha
 * Plugin URI: https://github.com/nabsul/rest-wpsettings
 * License: GPL3
 */

include dirname(__FILE__) . '/class-rest-wpsettings-plugin.php';
include dirname(__FILE__) . '/class-rest-wpsettings-main.php';

add_action( 'rest_api_init', array('Rest_WPSettings_Main', 'init'));
