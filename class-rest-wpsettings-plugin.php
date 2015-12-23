<?php
/**
 * Created by PhpStorm.
 * User: nabeel
 * Date: 12/23/15
 * Time: 2:40 PM
 */

if ( ! class_exists( 'Rest_WPSettings_Plugin' ) ) :

    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }


    class Rest_WPSettings_Plugin
    {
        public static function init()
        {
            $obj = new self;

            register_rest_route( 'settings/v1', '/plugins', array(
                'methods' => 'GET',
                'callback' => array($obj, 'all')
            ) );

            register_rest_route( 'settings/v1', '/plugins/(?P<id>.+\.php)', array(
                'methods' => 'GET',
                'callback' => array($obj, 'get')
            ) );

            register_rest_route( 'settings/v1', '/plugins/(?P<id>.+\.php)/on', array(
                'methods' => 'GET',
                'callback' => array($obj, 'activate')
            ) );

            register_rest_route( 'settings/v1', '/plugins/(?P<id>.+\.php)/off', array(
                'methods' => 'GET',
                'callback' => array($obj, 'deactivate')
            ) );
        }

        public function all()
        {
            $ret = array();
            foreach (get_plugins() as $id => $plugin)
            {
                $ret[] = array( 'Id' => $id, 'Active' => is_plugin_active( $id ) ) + $plugin;
            }
            return $ret;
        }

        public function get( $request)
        {
            $id = $request[ 'id' ];
            return array( 'Id' => $id, 'Active' => is_plugin_active( $id ) ) + get_plugins()[$id];
        }

        public function activate( $request)
        {
            $id = $request[ 'id' ];
            activate_plugin($id);
            return $this->get($request);
        }

        public function deactivate( $request)
        {
            $id = $request[ 'id' ];
            deactivate_plugins($id);
            return $this->get($request);
        }
    }

endif;
