<?php

/**
 *
 * @link              https://renzotejada.com/
 * @package           Utils para WooCommerce y WordPress
 *
 * @wordpress-plugin
 * Plugin Name:       Utils para WooCommerce y WordPress
 * Plugin URI:        https://renzotejada.com/utils-para-woocommerce-y-wordpress/
 * Description:       Support functions - Utilities, essential functions.
 * Version:           3.7
 * Author:            Renzo Tejada
 * Author URI:        https://renzotejada.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       rt-wp-utils
 * Domain Path:       /language
 * Requires at least: 5.6
 * Requires PHP:      7.4
 * WC tested up to:   9.5.2
 * WC requires at least: 2.6
 */
if (!defined('ABSPATH')) {
    exit;
}

$plugin_wp_utils_version = get_file_data(__FILE__, array('Version' => 'Version'), false);

define('Version_RT_WP_Utils', $plugin_wp_utils_version['Version']);

add_action( 'before_woocommerce_init', function() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );

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
