<?php
/**
 * @package WP Utils
 * @version 1.4
 */
/*
 * Plugin Name: WP Utils
 * Plugin URI: https://github.com/RenzoTejada/wp-utils
 * Description: WP Utils - Funciones de apoyo - Utilitarios, funciones basicas para todo desarrollador, como cortar texto palabras, agregar protocolo (http), mostrar dia y mes en español. 
 * Version: 1.4
 * Author: Renzo Tejada
 * Author URI: http://renzotejada.com/
 * License: GPLv2
 */
include 'functions.php';

class WP_Utils
{

    CONST TITLE = 'WP Utils';

    private static $instance;

    protected $templates;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    public function PluginMenu()
    {
        $this->my_plugin_screen_name = add_menu_page(self::TITLE, self::TITLE, 'manage_options', __FILE__, array(
            $this,
            'wp_utils_admin_section'
        ), plugins_url('/img/icon.png', __FILE__));
    }

    public function wp_utils_admin_section()
    {
        $wp_utils_options = get_option('wp_utils_options');
        
        if (isset($_POST['update_options_submit'])) {
            $wp_utils_options['url'] = $_POST['url'];
            update_option('$wp_utils_options', $wp_utils_options);
        }
        include ('panel.php');
    }

    public function InitPlugin()
    {
        add_action('admin_menu', array(
            $this,
            'PluginMenu'
        ));
        add_action('plugins_loaded', array(
            $this,
            'get_instance'
        ));
    }
}

$plugin = WP_Utils::get_instance();
$plugin->InitPlugin();



