<?php
/**
 * Created by PhpStorm.
 * User: nabeel
 * Date: 12/23/15
 * Time: 2:40 PM
 */

if ( ! class_exists( 'Rest_WPSettings_Plugin' ) ) :

    class Rest_WPSettings_Plugin
    {
        public static function init()
        {
            $obj = new self;

            register_rest_route( 'settings/v1', '/plugins', array(
                'methods' => 'GET',
                'callback' => array($obj, 'all')
            ) );
        }

        public function all()
        {
            if ( ! function_exists( 'get_plugins' ) ) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            $ret = array();
            foreach (get_plugins() as $id => $plugin)
            {
                $plugin['Id'] = $id;
                $ret[] = $plugin;
            }
            return $ret;
        }

        public function get($id)
        {
            return ['ok' => 'get'];
        }

        public function update($id, $data)
        {
            return ['ok' => 'update'];
        }
    }

endif;
