<?php

/**
 *
 * @link              https://renzotejada.com/
 * @package           WP Utils
 *
 * @wordpress-plugin
 * Plugin Name:       Utils para WooCommerce y WordPress
 * Plugin URI:        https://renzotejada.com/wp-utils/
 * Description:       Support functions - Utilities, essential functions.
 * Version:           2.0
 * Author:            Renzo Tejada
 * Author URI:        https://renzotejada.com/
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       rt-wp-utils
 * Domain Path:       /language
 * WC tested up to:   5.4.1
 * WC requires at least: 2.6
 */
if (!defined('ABSPATH')) {
    exit;
}

$plugin_wp_utils_version = get_file_data(__FILE__, array('Version' => 'Version'), false);

define('Version_RT_WP_Utils', $plugin_wp_utils_version['Version']);

function rt_utils_load_textdomain()
{
    load_plugin_textdomain('rt-wp-utils', false, basename(dirname(__FILE__)) . '/language/');
}

add_action('init', 'rt_utils_load_textdomain');

// Agrega la página de settings en plugins
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'rt_utils_add_plugin_page_settings_link');

// Agrega link plugins
add_filter( 'plugin_row_meta', 'rt_utils_plugin_row_meta', 10, 2 );

add_action( 'plugins_loaded', 'rt_utils_loaded');

function rt_utils_plugin_row_meta( $links, $file )
{
    if ( 'wp-utils/wp-utils.php' !== $file ) {
        return $links;
    }

    $row_meta = array(
        'docs'    => '<a href="' . admin_url('admin.php?page=utils_settings') . '">' .  __('Docs', 'rt-wp-utils') . '</a>',
        'support' => '<a href="' . esc_url( 'https://wordpress.org/support/plugin/wp-utils/' ) . '">' . esc_html__( 'Support', 'rt-wp-utils' ) . '</a>',
    );

    return array_merge( $links, $row_meta );
}

function rt_utils_add_plugin_page_settings_link($links)
{
    $links2[] = '<a href="' . admin_url('admin.php?page=utils_settings') . '">' .  __('Settings', 'rt-wp-utils') . '</a>';
    $links = array_merge($links2, $links);
    return $links;
}

/*
 * LIB
 */
require dirname(__FILE__) . "/rt_utils_lib.php";


/*
 * ADMIN
 */
require dirname(__FILE__) . "/rt_utils_admin.php";
