<?php
/**
 * Created by PhpStorm.
 * User: nabeel
 */

if ( ! class_exists( 'Rest_WPSettings_User' ) ) :

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}


	class Rest_WPSettings_User
	{
		public static function init() {
			$obj = new self;
			$obj->register( '', 'GET', 'all' );
			$obj->register( '(?P<id>.+\.php)', 'GET', 'get' );
		}

		private function register( $pattern, $method, $callback ) {
			register_rest_route( 'settings/v1', "/users/$pattern", array(
				'methods' => $method,
				'callback' => array( $this, $callback ),
				'permission_callback' => array( $this, 'permission' ),
			) );
		}

		public function permission() {
			return current_user_can( 'edit_users' );
		}

		public function all() {
			return get_users();
		}

		public function get( $request ) {
			$id = $request[ 'id' ];
			return array( 'Id' => $id, 'Active' => is_plugin_active( $id ) ) + get_plugins()[ $id ];
		}
	}

endif;
