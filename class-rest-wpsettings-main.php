<?php
/**
 * Created by PhpStorm.
 * User: nabeel
 * Date: 12/23/15
 * Time: 2:42 PM
 */

if ( ! class_exists( 'Rest_WPSettings_Main' ) ) :

	include dirname( __FILE__ ) . '/class-rest-wpsettings-plugin.php';
	include dirname( __FILE__ ) . '/class-rest-wpsettings-user.php';

	class Rest_WPSettings_Main
	{
		public static function init() {
			Rest_WPSettings_Plugin::init();
			Rest_WPSettings_User::init();
		}
	}

endif;